<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class HOME_Controller extends MY_Controller {



	public $program;

	public $latest_event;





	public function __construct(){

	   ob_start();

       parent::__construct(); 



    //    ini_set('display_errors', '1');

    //    ini_set('display_startup_errors', '1');

    //    error_reporting(E_ALL);

        

       date_default_timezone_set('Asia/Calcutta');

            $this->load->model("program_model");  

            $this->program = $this->program_model->get_program_name();



            $this->load->model("event_model");

            $this->latest_event = $this->event_model->get_latest_event('event_id');

    }

    

    /**
     * Single SMTP config using MAIL_* env keys — routes through Microsoft Outlook.
     * Used by all email channels: admin notifications, applicant confirmations, etc.
     */
    protected function _smtp_config()
    {
        $username = env('MAIL_USERNAME', '');
        $password = env('MAIL_PASSWORD', '');

        if (empty($username) || empty($password)) {
            log_message('error', 'SMTP credentials missing. Set MAIL_USERNAME and MAIL_PASSWORD in env.' . ENVIRONMENT);
        }

        return array(
            'protocol'     => 'smtp',
            'smtp_host'    => env('MAIL_HOST',       'smtp.office365.com'),
            'smtp_crypto'  => env('MAIL_ENCRYPTION', 'tls'),
            'smtp_port'    => (int) env('MAIL_PORT', 587),
            'smtp_user'    => $username,
            'smtp_pass'    => $password,
            'charset'      => 'utf-8',
            'mailtype'     => 'html',
            'wordwrap'     => TRUE,
            'priority'     => 1,
            'smtp_timeout' => 30,
            'newline'      => "\r\n",
            'crlf'         => "\r\n",
        );
    }

    /**
     * Send tour-details + ICS to the configured admin email address via Gmail SMTP.
     * The recipient is always ADMIN_MAIL_TO from the env file — not hardcoded.
     *
     * @param  array       $mail  ['sub' => ..., 'body' => ...]
     * @param  string|null $attachment  Absolute path to ICS file (optional)
     * @return bool
     */
    public function send_admin_mail($mail, $attachment = null)
    {
        $this->email->clear(TRUE);
        $this->email->initialize($this->_smtp_config());

        $from_address = env('MAIL_FROM_ADDRESS', 'info@harvestgreenmontessori.com');
        $from_name    = env('MAIL_FROM_NAME',    'Harvest Green Montessori School');
        $admin_to     = env('ADMIN_MAIL_TO',     'info@harvestgreenmontessori.com');

        $this->email->from($from_address, $from_name);
        $this->email->reply_to($from_address, $from_name);
        $this->email->to($admin_to);
        $this->email->subject($mail['sub']);
        $this->email->message($mail['body']);

        if (!empty($attachment) && file_exists($attachment)) {
            $this->email->attach($attachment);
        }

        if ($this->email->send()) {
            log_message('info', 'Admin email sent successfully to: ' . $admin_to);
            return true;
        } else {
            log_message('error', 'Admin email failed to [' . $admin_to . ']: ' . $this->email->print_debugger(['headers', 'subject', 'body']));
            return false;
        }
    }

    /**
     * Send thank-you confirmation to the applicant (parent) via cPanel SMTP.
     *
     * @param  array $mail  ['adrs' => ..., 'sub' => ..., 'body' => ...]
     * @return bool
     */
    public function send_applicant_mail($mail)
    {
        $this->email->clear(TRUE);
        $this->email->initialize($this->_smtp_config());

        $from_address = env('MAIL_FROM_ADDRESS', 'info@harvestgreenmontessori.com');
        $from_name    = env('MAIL_FROM_NAME',    'Harvest Green Montessori School');

        $this->email->from($from_address, $from_name);
        $this->email->reply_to($from_address, $from_name);
        $this->email->to($mail['adrs']);
        $this->email->subject($mail['sub']);
        $this->email->message($mail['body']);

        if ($this->email->send()) {
            log_message('info', 'Applicant email sent successfully to: ' . $mail['adrs']);
            return true;
        } else {
            log_message('error', 'Applicant email failed to [' . $mail['adrs'] . ']: ' . $this->email->print_debugger(['headers', 'subject', 'body']));
            return false;
        }
    }

    /**
     * Legacy send_mail — uses the single MAIL_* SMTP config with auto-CC to admin.
     * Still used by reminder emails and other controllers that have not migrated.
     */
    public function send_mail($mail, $attachment = null)
    {
        // clear(TRUE) resets everything including attachments — prevents state bleed between calls
        $this->email->clear(TRUE);
        $this->email->initialize($this->_smtp_config());

        $from_address = env('MAIL_FROM_ADDRESS', 'info@harvestgreenmontessori.com');
        $from_name    = env('MAIL_FROM_NAME',    'Harvest Green Montessori School');

        $this->email->from($from_address, $from_name);
        $this->email->reply_to($from_address, $from_name);
        $this->email->to($mail['adrs']);
        $this->email->subject($mail['sub']);
        $this->email->message($mail['body']);

        if (!empty($attachment) && file_exists($attachment)) {
            $this->email->attach($attachment);
        }

        if ($this->email->send()) {
            log_message('info', 'Email sent successfully to: ' . $mail['adrs']);
            return true;
        } else {
            // print_debugger with only headers/subject/body — never logs SMTP password
            log_message('error', 'Email send failed to [' . $mail['adrs'] . ']: ' . $this->email->print_debugger(['headers', 'subject', 'body']));
            return false;
        }
    }
    

    public function send_msg($msg){

        // Account details

        $apiKey = urlencode('mn3nHtZRk4s-TekY5rURW9tO1wQP5IW0Ckfd1tVxKD');// My API key

        // Message details

        $sender = urlencode('EKVIRA');//This my six digit sender name

            

        $message = rawurlencode($msg['msg']);

        // Prepare data for POST request

        $data = array('apikey' => $apiKey, 'numbers' => $msg['no'], "sender" => $sender, "message" => $message);

        // Send the POST request with cURL

        $ch = curl_init('https://api.textlocal.in/send/');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

    }

}

	

