<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MsGraphMailer — Send emails via Microsoft Graph API
 *
 * Uses OAuth 2.0 Client Credentials flow (app-only).
 * Requires: Mail.Send application permission granted with admin consent in Azure AD.
 *
 * Usage (from any controller):
 *   $this->load->library('MsGraphMailer');
 *   $result = $this->msgraphmailer->send([
 *       'to'          => 'recipient@example.com',           // string or array
 *       'subject'     => 'Hello',
 *       'body'        => '<p>HTML content</p>',
 *       'attachments' => ['/absolute/path/to/file.ics'],    // optional
 *   ]);
 */
class MsGraphMailer
{
    /** @var string Cached access token */
    private $access_token = null;

    /** @var int Token expiry unix timestamp */
    private $token_expires = 0;

    /** Maximum number of send attempts before giving up */
    const MAX_RETRIES = 2;

    /** Seconds to wait between retries */
    const RETRY_DELAY = 2;

    public function __construct()
    {
        // CodeIgniter 3 doesn't auto-inject CI; we don't need it here.
    }

    // -------------------------------------------------------------------------
    // Public API
    // -------------------------------------------------------------------------

    /**
     * Send an email through Microsoft Graph.
     *
     * @param array $params {
     *   'to'          => string|string[]  — recipient(s)
     *   'subject'     => string
     *   'body'        => string           — HTML content
     *   'attachments' => string[]         — absolute file paths (optional)
     *   'save_sent'   => bool             — save to Sent Items (default: false)
     * }
     * @return bool
     */
    public function send(array $params): bool
    {
        $to          = $params['to']          ?? '';
        $subject     = $params['subject']     ?? '(no subject)';
        $body        = $params['body']        ?? '';
        $attachments = $params['attachments'] ?? [];
        $save_sent   = $params['save_sent']   ?? false;

        if (empty($to)) {
            log_message('error', '[MsGraphMailer] send() called without a "to" address.');
            return false;
        }

        $token = $this->_get_access_token();
        if (!$token) {
            return false;
        }

        $payload = $this->_build_payload($to, $subject, $body, $attachments, $save_sent);

        return $this->_send_with_retry($token, $payload);
    }

    // -------------------------------------------------------------------------
    // Token management
    // -------------------------------------------------------------------------

    /**
     * Retrieve (and cache in-process) an OAuth 2.0 access token.
     *
     * @return string|null
     */
    private function _get_access_token(): ?string
    {
        // Return cached token if still valid (with 60 s buffer)
        if ($this->access_token && time() < ($this->token_expires - 60)) {
            return $this->access_token;
        }

        $tenant_id     = env('MS_GRAPH_TENANT_ID',     '');
        $client_id     = env('MS_GRAPH_CLIENT_ID',     '');
        $client_secret = env('MS_GRAPH_CLIENT_SECRET', '');

        if (empty($tenant_id) || empty($client_id) || empty($client_secret)) {
            log_message('error', '[MsGraphMailer] Missing one or more MS_GRAPH_* environment variables (TENANT_ID, CLIENT_ID, CLIENT_SECRET).');
            return null;
        }

        $url  = "https://login.microsoftonline.com/{$tenant_id}/oauth2/v2.0/token";
        $body = http_build_query([
            'grant_type'    => 'client_credentials',
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'scope'         => 'https://graph.microsoft.com/.default',
        ]);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $body,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
        ]);

        $response  = curl_exec($ch);
        $curl_err  = curl_error($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false || $http_code !== 200) {
            log_message('error', "[MsGraphMailer] Token request failed. HTTP {$http_code}. cURL: {$curl_err}. Response: {$response}");
            return null;
        }

        $data = json_decode($response, true);
        if (empty($data['access_token'])) {
            log_message('error', "[MsGraphMailer] Token response missing access_token: {$response}");
            return null;
        }

        $this->access_token  = $data['access_token'];
        $this->token_expires = time() + (int)($data['expires_in'] ?? 3600);

        log_message('debug', '[MsGraphMailer] Access token acquired. Expires in ' . ($data['expires_in'] ?? '?') . 's.');
        return $this->access_token;
    }

    // -------------------------------------------------------------------------
    // Payload builder
    // -------------------------------------------------------------------------

    /**
     * Build the JSON payload for the sendMail endpoint.
     *
     * @param  string|array $to
     * @param  string       $subject
     * @param  string       $body          HTML content
     * @param  array        $attachments   Absolute file paths
     * @param  bool         $save_sent
     * @return array
     */
    private function _build_payload($to, string $subject, string $body, array $attachments, bool $save_sent): array
    {
        // Normalise recipients
        $recipients = [];
        foreach ((array)$to as $address) {
            $address = trim($address);
            if (filter_var($address, FILTER_VALIDATE_EMAIL)) {
                $recipients[] = ['emailAddress' => ['address' => $address]];
            }
        }

        $message = [
            'subject' => $subject,
            'body'    => [
                'contentType' => 'HTML',
                'content'     => $body,
            ],
            'toRecipients' => $recipients,
        ];

        // Attachments
        if (!empty($attachments)) {
            $message['attachments'] = [];
            foreach ($attachments as $path) {
                if (!file_exists($path) || !is_readable($path)) {
                    log_message('error', "[MsGraphMailer] Attachment not found or not readable: {$path}");
                    continue;
                }
                $content  = file_get_contents($path);
                $filename = basename($path);
                $ext      = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $mime     = $this->_mime_type($ext);

                $message['attachments'][] = [
                    '@odata.type'  => '#microsoft.graph.fileAttachment',
                    'name'         => $filename,
                    'contentType'  => $mime,
                    'contentBytes' => base64_encode($content),
                ];
            }
        }

        return [
            'message'         => $message,
            'saveToSentItems' => $save_sent ? 'true' : 'false',
        ];
    }

    // -------------------------------------------------------------------------
    // HTTP send with retry
    // -------------------------------------------------------------------------

    /**
     * POST the payload to the Graph sendMail endpoint.
     * Retries on 429 (rate limit) or 5xx errors up to MAX_RETRIES times.
     *
     * @param  string $token
     * @param  array  $payload
     * @return bool
     */
    private function _send_with_retry(string $token, array $payload): bool
    {
        $sender_email = env('MAIL_FROM_ADDRESS', '');
        if (!filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
            log_message('error', '[MsGraphMailer] MAIL_FROM_ADDRESS is missing or invalid.');
            return false;
        }

        $url     = "https://graph.microsoft.com/v1.0/users/" . rawurlencode($sender_email) . "/sendMail";
        $json    = json_encode($payload);
        $headers = [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json),
        ];

        for ($attempt = 1; $attempt <= self::MAX_RETRIES; $attempt++) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => $json,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_HTTPHEADER     => $headers,
            ]);

            $response  = curl_exec($ch);
            $curl_err  = curl_error($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // Graph returns 202 Accepted on success
            if ($http_code === 202) {
                $to_list = implode(', ', array_column(
                    array_column($payload['message']['toRecipients'] ?? [], 'emailAddress'),
                    'address'
                ));
                log_message('info', "[MsGraphMailer] Email sent successfully to: {$to_list} (attempt {$attempt}).");
                return true;
            }

            // Token expired mid-flight — refresh and retry
            if ($http_code === 401 && $attempt < self::MAX_RETRIES) {
                log_message('error', '[MsGraphMailer] 401 Unauthorised — refreshing token and retrying.');
                $this->access_token = null;
                $token = $this->_get_access_token();
                if (!$token) {
                    return false;
                }
                $headers[0] = 'Authorization: Bearer ' . $token;
                continue;
            }

            // Rate limited — wait then retry
            if ($http_code === 429 && $attempt < self::MAX_RETRIES) {
                log_message('error', "[MsGraphMailer] 429 Rate limited — waiting " . self::RETRY_DELAY . "s before retry.");
                sleep(self::RETRY_DELAY);
                continue;
            }

            // Transient server error — retry
            if ($http_code >= 500 && $attempt < self::MAX_RETRIES) {
                log_message('error', "[MsGraphMailer] HTTP {$http_code} server error — retrying (attempt {$attempt}).");
                sleep(self::RETRY_DELAY);
                continue;
            }

            // Non-retryable failure
            log_message('error', "[MsGraphMailer] Send failed. HTTP {$http_code}. cURL: {$curl_err}. Response: {$response}");
            return false;
        }

        log_message('error', '[MsGraphMailer] All retry attempts exhausted. Email not sent.');
        return false;
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /**
     * Map a file extension to a MIME type.
     */
    private function _mime_type(string $ext): string
    {
        $map = [
            'pdf'  => 'application/pdf',
            'ics'  => 'text/calendar',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'gif'  => 'image/gif',
            'txt'  => 'text/plain',
            'csv'  => 'text/csv',
            'zip'  => 'application/zip',
        ];
        return $map[$ext] ?? 'application/octet-stream';
    }
}
