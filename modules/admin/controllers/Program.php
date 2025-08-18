<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    }
    public function index(){
        $this->load->view("program");
    } 

    public function get_all_program(){
        $this->load->model("program_model");
        $program = $this->program_model->get_all_program();
        $output = array('data' => array());
 
        foreach($program as $row) {
            $program_id = $row->program_id;
            $imageUrl = $row->program_path;
        
            $program = "<img class='img-round' title='".$imageUrl."' src='".$imageUrl."' style='height:30px; width:50px;'  />";
        
            $button = '<!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
                <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#viewProgramModal" onclick="viewProgram('.$program_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View Program</a></li>
                <li><a type="button" data-toggle="modal" data-target="#editProgramModal" onclick="editProgram('.$program_id.')"> <i class="glyphicon glyphicon-edit"></i> Edit Program</a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeProgramModal" onclick="removeProgram('.$program_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
              </ul>
            </div>';
        
            $output['data'][] = array( 		
                $program,
                $row->program_name,
                $row->program_desc,
                $button
            ); 	        
        }
        echo json_encode($output);
    }

    public function get_single_program(){
        $data['program_id'] = $this->input->post("program_id");
        $this->load->model("program_model");
        $d = $this->program_model->get_single_program($data);
        echo json_encode($d);
    }
    
	public function add_program(){ 
        $post_data = $this->input->post();    
		$this->load->model("program_model");
		$d = $this->program_model->add_program($post_data);
		echo json_encode($d);		
	}

	public function edit_program_data(){ 
        $post_data = $this->input->post();        
		$this->load->model("program_model");
		$d = $this->program_model->edit_program_data($post_data);
		echo json_encode($d);		 
    }

	public function edit_image_only(){
        $post_data = $this->input->post();        
		$this->load->model("program_model");
		$d = $this->program_model->edit_image_only($post_data);
		echo json_encode($d);		
    }
    
    public function remove_Program(){
        $data['program_id'] = $this->input->post("program_id");
        $this->load->model("program_model");
        $d = $this->program_model->remove_program($data);       
        echo json_encode($d); 
    }

}