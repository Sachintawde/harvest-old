<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Safety_first extends HOME_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
   }

   public function index(){
      $this->load->view('safety_first');
   }
}
?>