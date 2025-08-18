<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ADMIN_Controller extends MY_Controller {
    public $con_msg;
	public $con_tour;
    
	public function __construct(){
         
	   ob_start(); 
       parent::__construct();
       date_default_timezone_set('Asia/Calcutta');
    //    require (APPPATH.'libraries/textlocal.class.php');
       $this->load->model("contact_model");
       $this->con_msg = $this->contact_model->get_contact_massage();     
       $this->con_tour = $this->contact_model->get_contact_tour();
  }

	public function update_status($data){
    $valid = array();
    
    $table = $data['table'];
    $id = $data['id'];
    $key = $data['key'];
    $status = $key.'_status';
    $table_id = $key.'_id';

    $update_data = array($status => $data['action']);
        
    $query = $this->db->update($table, $update_data, $table_id.'='.$id);

    if ($query) {
        $valid['status'] = "success";
        $valid['messages'] = "id ".$id." status updated successfully";
    } else {
        $valid['status'] = "warning";
        $valid['messages'] = "Can't update this id status";
    }

    return $valid;		

  }

  public function send_mail($mail){
    $this->load->config('email'); // Load email configuration
    $this->load->library('email');
    
    $from_mail = 'info@harvestgreenmontessori.com';
    $from_name = 'Harvest Green Montessori';
            
    $this->email->from($from_mail, $from_name);
    $this->email->to($mail['adrs']);
    $this->email->cc(array('swapn007.sr@gmail.com', 'sachintawde548@gmail.com'));
    $this->email->subject($mail['sub']);
    $this->email->message($mail['body']);
    $this->email->set_mailtype('html');
    
    if ($this->email->send()) {
        return true;
    } else {
        // Log the error message for debugging
        $error = $this->email->print_debugger();
        log_message('error', $error);
        return false;
    }
}


public function send_msg($msg){
    // Account details
    $apiKey = urlencode('mn3nHtZRk4s-1nG37b5m0tn63sTqt3YKlbBhbtxruq');// My API key
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
	
