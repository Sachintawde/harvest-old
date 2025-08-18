<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Montessori_vs_traditional extends HOME_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
   }

   public function index(){
      $this->load->view('montessori-vs-traditional', $data);
   }
}
?>