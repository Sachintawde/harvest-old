<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uniform extends HOME_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
   }

   public function index(){
      $this->load->view('uniform', $data);
   }
}
?>