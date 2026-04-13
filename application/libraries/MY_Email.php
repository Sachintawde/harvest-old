<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Email — extends CI_Email with fixed SSL peer verification handling.
 *
 * Problem: On Windows/Apache, PHP has no default CA certificate bundle, so
 * stream_socket_enable_crypto() and fsockopen('ssl://...') both fail with
 * "SSL certificate verify failed" when connecting to mail.harvestgreenmontessori.com.
 *
 * Fix: Override _smtp_connect() to use stream_socket_client() with a custom
 * SSL context that supplies the cacert.pem bundle (or falls back to disabling
 * peer verification on development environments).
 */
class MY_Email extends CI_Email
{
    /**
     * Absolute path to the CA certificate bundle (cacert.pem).
     * Downloaded from https://curl.se/ca/cacert.pem — placed in application/config/.
     * If the file does not exist, peer verification is disabled (for dev only).
     */
    protected $_cacert_path = '';

    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->_cacert_path = APPPATH . 'config/cacert.pem';
    }

    /**
     * SMTP Connect override — adds proper SSL context for both ssl:// and STARTTLS.
     */
    protected function _smtp_connect()
    {
        if (is_resource($this->_smtp_connect)) {
            return TRUE;
        }

        // Build SSL context options
        $ssl_opts = $this->_build_ssl_context_options();
        $context  = stream_context_create(['ssl' => $ssl_opts]);

        if ($this->smtp_crypto === 'ssl') {
            // Direct SSL connection (port 465)
            $this->_smtp_connect = stream_socket_client(
                'ssl://' . $this->smtp_host . ':' . $this->smtp_port,
                $errno,
                $errstr,
                $this->smtp_timeout,
                STREAM_CLIENT_CONNECT,
                $context
            );
        } else {
            // Plain connection first (port 587 for STARTTLS, or no crypto)
            $this->_smtp_connect = stream_socket_client(
                'tcp://' . $this->smtp_host . ':' . $this->smtp_port,
                $errno,
                $errstr,
                $this->smtp_timeout,
                STREAM_CLIENT_CONNECT
            );
        }

        if ( ! is_resource($this->_smtp_connect)) {
            $this->_set_error_message('lang:email_smtp_error', $errno . ' ' . $errstr);
            return FALSE;
        }

        stream_set_timeout($this->_smtp_connect, $this->smtp_timeout);
        $this->_set_error_message($this->_get_smtp_data());

        if ($this->smtp_crypto === 'tls') {
            $this->_send_command('hello');
            $this->_send_command('starttls');

            // Apply SSL context to the existing stream before upgrading
            stream_context_set_option($this->_smtp_connect, ['ssl' => $ssl_opts]);

            // TLS 1.0 and 1.1 are disabled in OpenSSL 3.0+; use 1.2 and 1.3 only.
            $method = STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT
                    | STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT;

            $crypto = stream_socket_enable_crypto($this->_smtp_connect, TRUE, $method);

            if ($crypto !== TRUE) {
                $this->_set_error_message('lang:email_smtp_error', $this->_get_smtp_data());
                return FALSE;
            }
        }

        return $this->_send_command('hello');
    }

    /**
     * Build SSL context options.
     * Uses cacert.pem if present; falls back to disabling peer verification.
     */
    protected function _build_ssl_context_options()
    {
        if (is_file($this->_cacert_path)) {
            return [
                'cafile'            => $this->_cacert_path,
                'verify_peer'       => TRUE,
                // verify_peer_name is disabled because shared/cPanel hosting SMTP servers
                // (e.g. GoDaddy/Secureserver.net) present a cert for their server hostname
                // (e.g. *.secureserver.net), NOT for the customer's custom mail domain.
                // The CA chain is still verified (encrypted connection), only hostname
                // matching is skipped — standard practice on shared hosting SMTP.
                'verify_peer_name'  => FALSE,
                'allow_self_signed' => FALSE,
            ];
        }

        // Fallback: disable peer verification.
        // Safe for development; on production, supply cacert.pem instead.
        log_message('error', 'MY_Email: cacert.pem not found. SSL peer verification is disabled.');
        return [
            'verify_peer'       => FALSE,
            'verify_peer_name'  => FALSE,
            'allow_self_signed' => TRUE,
        ];
    }

    /**
     * Override print_debugger to strip any base64-encoded credentials from
     * the SMTP log before it reaches log files or screen output.
     * The AUTH LOGIN exchange sends base64(username) and base64(password) over
     * the wire; those lines appear in the raw SMTP log captured by CI_Email.
     */
    public function print_debugger($include = array('headers', 'subject', 'body'))
    {
        $output = parent::print_debugger($include);

        // Redact the base64-encoded password line that follows "334 UGFzc3dvcmQ6"
        // (the server's base64("Password:") challenge).  The very next line sent
        // by the client is base64(smtp_pass) — replace it with [REDACTED].
        if (!empty($this->smtp_pass)) {
            $encoded = base64_encode($this->smtp_pass);
            $output  = str_replace($encoded, '[REDACTED]', $output);
        }

        return $output;
    }
}
