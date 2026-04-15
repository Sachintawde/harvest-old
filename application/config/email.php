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

$config = array(
    'protocol'     => 'smtp',
    'smtp_host'    => getenv('MAIL_HOST')       ?: 'smtp.office365.com',
    'smtp_crypto'  => getenv('MAIL_ENCRYPTION') ?: 'tls',
    'smtp_port'    => (int)(getenv('MAIL_PORT') ?: 587),
    'smtp_user'    => getenv('MAIL_USERNAME')   ?: '',
    'smtp_pass'    => getenv('MAIL_PASSWORD')   ?: '',
    'charset'      => 'utf-8',
    'mailtype'     => 'html',
    'wordwrap'     => TRUE,
    'priority'     => 1,
    'smtp_timeout' => 30,
    'newline'      => "\r\n",
    'crlf'         => "\r\n",
);
