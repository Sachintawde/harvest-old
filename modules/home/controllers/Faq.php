<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends HOME_Controller {

	public function __construct()
	{
		ob_start();
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('faq_model');
		$data['faqs'] = $this->faq_model->get_all_faq();
		$this->load->view('faq', $data);
	}
}
