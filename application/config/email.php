<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Email / SMTP Configuration
|--------------------------------------------------------------------------
| All values are read from environment variables so credentials are never
| hardcoded in source code.  Set MAIL_* keys in env.local / env.live.
|
| Fallbacks exist only so the app doesn't crash if the env file is absent;
| email sending will still fail until real credentials are provided.
|--------------------------------------------------------------------------
*/

$protocol   = getenv('MAIL_PROTOCOL')   ?: 'mail';
$encryption = getenv('MAIL_ENCRYPTION') ?: '';

$config = array(
    'protocol'     => $protocol,
    'charset'      => 'utf-8',
    'mailtype'     => 'html',
    'wordwrap'     => TRUE,
    'priority'     => 1,
    'newline'      => "\r\n",
    'crlf'         => "\r\n",
);

if ($protocol === 'smtp') {
    $config['smtp_host']    = getenv('MAIL_HOST')     ?: 'smtp.office365.com';
    $config['smtp_port']    = (int)(getenv('MAIL_PORT') ?: 587);
    $config['smtp_user']    = getenv('MAIL_USERNAME') ?: '';
    $config['smtp_pass']    = getenv('MAIL_PASSWORD') ?: '';
    $config['smtp_timeout'] = 30;
    if (!empty($encryption)) {
        $config['smtp_crypto'] = $encryption;
    }
}
