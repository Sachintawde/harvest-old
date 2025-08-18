<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends HOME_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
   }

   public function index(){
      $this->load->view('calendar');
   }

   public function calendar_event(){
      $this->load->model("event_model");
      $event = $this->event_model->get_all_event(); 
      echo json_encode($event);    
   } 
}
?>