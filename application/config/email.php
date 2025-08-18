<?php defined('BASEPATH') OR exit('No direct script access allowed');

// $config = array(
//     'protocol' => 'smtp', // Ensure using SMTP protocol
//     'smtp_host' => 'smtp.office365.com',
//     'smtp_crypto' => 'tls', // Use 'tls' for port 587
//     'smtp_port' => 587, // Port for TLS
//     'smtp_user' => 'info@harvestgreenmontessori.com',
//     'smtp_pass' => 'Saibaba76543$', // Use an app password if 2FA is enabled
//     'charset'  => 'utf-8',
//     'mailtype' => 'html',
//     'priority' => 1,
//     'smtp_timeout' => '200', // Increased timeout
//     'newline' => "\r\n",
//     'crlf' => "\r\n"
// );


$config = array(
    'protocol' => 'mail',
    'smtp_host' => 'mail.harvestgreenmontessori.com',
    'smtp_crypto' => 'STARTTLS', 
    'smtp_port' => 587, 
    'smtp_user' => 'info@harvestgreenmontessori.com',
    'smtp_pass' => 'Saibaba76543$', 
    'charset'  => 'iso-8859-1',
    'mailtype' => 'html',
    'wordwrap' => TRUE,
    'priority' => 1,
    'smtp_timeout' => '200', 
    'newline' => "\r\n",
    'crlf' => "\r\n"
);

// $config = array(
//     'protocol' => 'smtp', 
//     'smtp_host' => 'smtp.gmail.com',
//     'smtp_port' => 587,
//     'smtp_user' => 'Harvestgreenmontessori4100@gmail.com',
//     'smtp_pass' => 'mzmgolxkcpohhnvh',
//     'smtp_crypto' => 'tls', 
//     'charset'  => 'iso-8859-1',
//     'mailtype' => 'html',
//     'priority' => '1',
//     'smtp_timeout' => '30', 
//     'wordwrap' => TRUE,
//     'newline' => "\r\n",
//     'crlf' => "\n"
// );
