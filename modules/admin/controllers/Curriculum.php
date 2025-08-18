<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curriculum extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    }
    public function index(){
        $this->load->view("curriculum");
    } 

    public function get_all_curriculum(){
        $this->load->model("curriculum_model");
        $c = $this->curriculum_model->get_all_curriculum();
        $output = array('data' => array());
 
        foreach($c as $row) {
            $c_id = $row->c_id;
            $imageUrl = $row->c_path;
        
            $c = "<img class='img-round' title='".$imageUrl."' src='".$imageUrl."' style='height:30px; width:50px;'  />";
        
            $button = '<!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
                <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#viewCurriculumModal" onclick="viewCurriculum('.$c_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View Curriculum</a></li>
                <li><a type="button" data-toggle="modal" data-target="#editCurriculumModal" onclick="editCurriculum('.$c_id.')"> <i class="glyphicon glyphicon-edit"></i> Edit Curriculum</a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeCurriculumModal" onclick="removeCurriculum('.$c_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
              </ul>
            </div>';
        
            $output['data'][] = array( 		
                $c,
                $row->c_title,
                date('m-d-Y', strtotime($row->c_select_date)),
                $row->c_desc,
                $button
            ); 	        
        }
        echo json_encode($output);
    }

    public function get_single_curriculum(){
        $data['c_id'] = $this->input->post("c_id");
        $this->load->model("curriculum_model");
        $d = $this->curriculum_model->get_single_curriculum($data);
        echo json_encode($d);
    }
    
	public function add_curriculum(){ 
        $post_data = $this->input->post();    
		$this->load->model("curriculum_model");
		$d = $this->curriculum_model->add_curriculum($post_data);
		echo json_encode($d);		
	}

	public function edit_curriculum_data(){
        $post_data = $this->input->post();        
		$this->load->model("curriculum_model");
		$d = $this->curriculum_model->edit_curriculum_data($post_data);
		echo json_encode($d);		 
    }

	public function edit_image_only(){
        $post_data = $this->input->post();        
		$this->load->model("curriculum_model");
		$d = $this->curriculum_model->edit_image_only($post_data);
		echo json_encode($d);		
    }
    
    public function remove_Curriculum(){
        $data['c_id'] = $this->input->post("c_id");
        $this->load->model("curriculum_model");
        $d = $this->curriculum_model->remove_curriculum($data);       
        echo json_encode($d); 
    }

}
  