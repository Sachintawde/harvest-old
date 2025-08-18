<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Enroll extends HOME_Controller
{

    public function __construct()
    {
        ob_start();
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('enroll');
    }
}
