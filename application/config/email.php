<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Email Configuration
|--------------------------------------------------------------------------
| Email delivery is handled exclusively through Microsoft Graph API
| (MsGraphMailer library). SMTP is disabled.
|
| This config file is kept for compatibility with CI's Email class loader,
| but no SMTP credentials are used.
|--------------------------------------------------------------------------
*/

$config = array(
    'protocol' => 'mail',  // fallback only — Graph API is used for all sending
    'charset'  => 'utf-8',
    'mailtype' => 'html',
    'wordwrap' => TRUE,
    'newline'  => "\r\n",
    'crlf'     => "\r\n",
);
