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
     * Lazy-load the MsGraphMailer library (loaded once per request).
     *
     * @return MsGraphMailer
     */
    private function _mailer()
    {
        if (!isset($this->msgraphmailer)) {
            $this->load->library('MsGraphMailer');
        }
        return $this->msgraphmailer;
    }

    /**
     * Send admin notification email (tour details + optional ICS attachment).
     * Recipient is always ADMIN_MAIL_TO from the env file.
     *
     * @param  array       $mail  ['sub' => ..., 'body' => ...]
     * @param  string|null $attachment  Absolute path to ICS file (optional)
     * @return bool
     */
    public function send_admin_mail($mail, $attachment = null)
    {
        $admin_to = env('ADMIN_MAIL_TO', 'info@harvestgreenmontessori.com');

        $params = [
            'to'      => $admin_to,
            'subject' => $mail['sub'],
            'body'    => $mail['body'],
        ];

        if (!empty($attachment) && file_exists($attachment)) {
            $params['attachments'] = [$attachment];
        }

        $result = $this->_mailer()->send($params);

        if ($result) {
            log_message('info', '[HOME_Controller] Admin email sent to: ' . $admin_to);
        } else {
            log_message('error', '[HOME_Controller] Admin email FAILED to: ' . $admin_to);
        }
        return $result;
    }

    /**
     * Send thank-you confirmation email to the applicant (parent).
     *
     * @param  array $mail  ['adrs' => ..., 'sub' => ..., 'body' => ...]
     * @return bool
     */
    public function send_applicant_mail($mail)
    {
        $params = [
            'to'      => $mail['adrs'],
            'subject' => $mail['sub'],
            'body'    => $mail['body'],
        ];

        $result = $this->_mailer()->send($params);

        if ($result) {
            log_message('info', '[HOME_Controller] Applicant email sent to: ' . $mail['adrs']);
        } else {
            log_message('error', '[HOME_Controller] Applicant email FAILED to: ' . $mail['adrs']);
        }
        return $result;
    }

    /**
     * General-purpose send_mail — used by reminder emails and other controllers.
     *
     * @param  array       $mail  ['adrs' => ..., 'sub' => ..., 'body' => ...]
     * @param  string|null $attachment  Absolute path to file (optional)
     * @return bool
     */
    public function send_mail($mail, $attachment = null)
    {
        $params = [
            'to'      => $mail['adrs'],
            'subject' => $mail['sub'],
            'body'    => $mail['body'],
        ];

        if (!empty($attachment) && file_exists($attachment)) {
            $params['attachments'] = [$attachment];
        }

        $result = $this->_mailer()->send($params);

        if ($result) {
            log_message('info', '[HOME_Controller] Email sent to: ' . $mail['adrs']);
        } else {
            log_message('error', '[HOME_Controller] Email FAILED to: ' . $mail['adrs']);
        }
        return $result;
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

	

