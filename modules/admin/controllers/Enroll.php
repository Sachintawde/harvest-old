<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enroll extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    }
    public function index(){
        $this->load->view("enroll");
    } 

    public function get_all_enroll(){
        $this->load->model("enroll_model");
        $enroll = $this->enroll_model->get_all_enroll();
        $output = array('data' => array());
 
        foreach($enroll as $row) {
            $e_id = $row->e_id;
            $button = '<!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
                <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#viewEnrollModal" onclick="viewEnroll('.$e_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View Enroll</a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeEnrollModal" onclick="removeEnroll('.$e_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
              </ul>
            </div>';
         
            $output['data'][] = array( 		
                $row->g_fname,
                $row->c_fname1,
                $row->c_lname1,
                $row->g_mob,
                $button
            ); 	        
        }
        echo json_encode($output);
    }

    public function get_single_enroll(){
        $data['e_id'] = $this->input->post("e_id");
        $this->load->model("enroll_model");
        $d = $this->enroll_model->get_single_enroll($data);
        echo json_encode($d);
    } 
    public function remove_Enroll(){
        $data['e_id'] = $this->input->post("e_id");
        $this->load->model("enroll_model");
        $d = $this->enroll_model->remove_enroll($data);       
        echo json_encode($d); 
    }

}
  