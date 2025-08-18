<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Career extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    }
    public function index(){
        $this->load->view("career");
    } 

    public function get_all_career(){
        $this->load->model("career_model");
        $c = $this->career_model->get_all_career();
        $output = array('data' => array());
 
        foreach($c as $row) {
            $e_id = $row->e_id;
            $button = '<!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
                <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#viewCareerModal" onclick="viewCareer('.$e_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View Career</a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeCareerModal" onclick="removeCareer('.$e_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
              </ul>
            </div>';
         
            $output['data'][] = array( 		
                $row->e_name,
                $row->e_lname,
                $row->e_mob,
                $row->e_mail,
                $row->e_prog,
                $button
            ); 	        
        }
        echo json_encode($output);
    }

    public function get_single_career(){
        $data['e_id'] = $this->input->post("e_id");
        $this->load->model("career_model");
        $d = $this->career_model->get_single_career($data);
        echo json_encode($d);
    } 
    public function remove_Career(){
        $data['e_id'] = $this->input->post("e_id");
        $this->load->model("career_model");
        $d = $this->career_model->remove_career($data);       
        echo json_encode($d); 
    }

}
  