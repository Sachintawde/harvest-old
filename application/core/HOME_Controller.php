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

    

    public function send_mail($mail){
        /* mail template */
        $this->load->config('email');
        $this->load->library('email');
        
        $from_mail   = 'info@harvestgreenmontessori.com';
        $from_name    =  "Harvest Green Montessori School";
                
        $this->email->from($from_mail, $from_name);
        $this->email->to($mail['adrs']);
        
        // Only CC if sending to someone other than info@
        if($mail['adrs'] != 'info@harvestgreenmontessori.com'){
            $list = array('info@harvestgreenmontessori.com');
            $this->email->cc($list);
        }
        
        $this->email->subject($mail['sub']);
        $this->email->message($mail['body']);
        $this->email->set_mailtype('html');
        
        if($this->email->send()){
            return true;
        }else{
            // Log the error for debugging
            log_message('error', 'Email send failed: ' . $this->email->print_debugger());
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

	

