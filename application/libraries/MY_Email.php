<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Email — extends CI_Email with platform-aware SSL handling.
 *
 * On Windows/Apache, PHP has no default CA certificate bundle, so
 * stream_socket_enable_crypto() and fsockopen('ssl://...') both fail with
 * "SSL certificate verify failed".  This override fixes that by supplying a
 * custom SSL context with the cacert.pem bundle.
 *
 * On Linux (cPanel shared hosting, etc.) the standard CI_Email _smtp_connect()
 * using fsockopen() works correctly with the OS-provided CA bundle, so the
 * override is skipped to avoid compatibility issues.
 */
class MY_Email extends CI_Email
{
    /**
     * Absolute path to the CA certificate bundle (cacert.pem).
     * Downloaded from https://curl.se/ca/cacert.pem — placed in application/config/.
     * Used only on Windows where the OS CA store is not available to PHP streams.
     */
    protected $_cacert_path = '';

    /**
     * Whether to use the custom _smtp_connect override (Windows only).
     */
    protected $_use_custom_smtp = FALSE;

    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->_cacert_path = APPPATH . 'config/cacert.pem';

        // Only apply the custom SMTP connect on Windows where the CA bundle
        // is missing.  On Linux/macOS, let CI_Email use its native fsockopen()
        // which works reliably with the OS-provided CA certificates.
        $this->_use_custom_smtp = (DIRECTORY_SEPARATOR === '\\');
    }

    /**
     * SMTP Connect — platform-aware override.
     *
     * Windows:  Uses stream_socket_client() with a custom SSL context that
     *           supplies cacert.pem for peer verification.
     * Linux:    Delegates to the parent CI_Email::_smtp_connect() which uses
     *           fsockopen() and the OS CA bundle.
     */
    protected function _smtp_connect()
    {
        // On Linux/macOS, use the standard CI_Email implementation
        if ( ! $this->_use_custom_smtp) {
            return parent::_smtp_connect();
        }

        // --- Windows-specific implementation below ---

        if (is_resource($this->_smtp_connect)) {
            return TRUE;
        }

        // Build SSL context options
        $ssl_opts = $this->_build_ssl_context_options();
        $context  = stream_context_create(['ssl' => $ssl_opts]);

        if ($this->smtp_crypto === 'ssl') {
            // Direct SSL connection (port 465)
            $this->_smtp_connect = @stream_socket_client(
                'ssl://' . $this->smtp_host . ':' . $this->smtp_port,
                $errno,
                $errstr,
                $this->smtp_timeout,
                STREAM_CLIENT_CONNECT,
                $context
            );
        } else {
            // Plain connection first (port 587 for STARTTLS, or no crypto)
            $this->_smtp_connect = @stream_socket_client(
                'tcp://' . $this->smtp_host . ':' . $this->smtp_port,
                $errno,
                $errstr,
                $this->smtp_timeout,
                STREAM_CLIENT_CONNECT
            );
        }

        if ( ! is_resource($this->_smtp_connect)) {
            $this->_set_error_message('lang:email_smtp_error', $errno . ' ' . $errstr);
            log_message('error', 'MY_Email: stream_socket_client failed — ' . $errno . ' ' . $errstr);
            return FALSE;
        }

        stream_set_timeout($this->_smtp_connect, $this->smtp_timeout);
        $this->_set_error_message($this->_get_smtp_data());

        if ($this->smtp_crypto === 'tls') {
            $this->_send_command('hello');
            $this->_send_command('starttls');

            // Apply SSL context to the existing stream before upgrading
            stream_context_set_option($this->_smtp_connect, ['ssl' => $ssl_opts]);

            // Build TLS method bitmask — TLSv1.3 may not be available on all
            // platforms, so only include it when the constant exists.
            $method = STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
            if (defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT')) {
                $method |= STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT;
            }

            $crypto = stream_socket_enable_crypto($this->_smtp_connect, TRUE, $method);

            if ($crypto !== TRUE) {
                $this->_set_error_message('lang:email_smtp_error', $this->_get_smtp_data());
                log_message('error', 'MY_Email: STARTTLS crypto upgrade failed');
                return FALSE;
            }
        }

        return $this->_send_command('hello');
    }

    /**
     * Build SSL context options (Windows only).
     * Uses cacert.pem if present; falls back to disabling peer verification.
     */
    protected function _build_ssl_context_options()
    {
        if (is_file($this->_cacert_path)) {
            return [
                'cafile'            => $this->_cacert_path,
                'verify_peer'       => TRUE,
                'verify_peer_name'  => FALSE,
                'allow_self_signed' => FALSE,
            ];
        }

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
     */
    public function print_debugger($include = array('headers', 'subject', 'body'))
    {
        $output = parent::print_debugger($include);

        if (!empty($this->smtp_pass)) {
            $encoded = base64_encode($this->smtp_pass);
            $output  = str_replace($encoded, '[REDACTED]', $output);
        }

        return $output;
    }
}
