<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

	// public $count_visitor;
	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
	//    $this->count_visitor = count_visitor();
	 }
}
 