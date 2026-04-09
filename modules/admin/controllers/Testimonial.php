<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    } 
    public function index(){
        $this->load->view("testimonial");
    } 

    public function get_all_testimonial(){
        $this->load->model("testimonial_model");
        $t = $this->testimonial_model->get_all_testimonial();
        $output = array('data' => array());
 
        foreach($t as $row) {
            $t_id = $row->t_id;
            $imageUrl = img_url($row->t_path);
        
            $t = "<img class='img-round' title='".$imageUrl."' src='".$imageUrl."' style='height:30px; width:50px;'  />";
        
            $button = '<!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
                <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#viewTestimonialModal" onclick="viewTestimonial('.$t_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View Testimonial</a></li>
                <li><a type="button" data-toggle="modal" data-target="#editTestimonialModal" onclick="editTestimonial('.$t_id.')"> <i class="glyphicon glyphicon-edit"></i> Edit Testimonial</a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeTestimonialModal" onclick="removeTestimonial('.$t_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
              </ul>
            </div>';
        
            $output['data'][] = array( 		
                $t,
                $row->t_name,
                $row->t_gender,
                $row->t_design,
                $button
            ); 	        
        }
        echo json_encode($output);
    }

    public function get_single_testimonial(){
        $data['t_id'] = $this->input->post("t_id");
        $this->load->model("testimonial_model");
        $d = $this->testimonial_model->get_single_testimonial($data);
        if (isset($d['t_path'])) {
            $d['t_path'] = img_url($d['t_path']);
        }
        if (isset($d['t_path_two']) && !empty($d['t_path_two'])) {
            $d['t_path_two'] = img_url($d['t_path_two']);
        }
        echo json_encode($d);
    }
    
	public function add_testimonial(){ 
        $post_data = $this->input->post();    
		$this->load->model("testimonial_model");
		$d = $this->testimonial_model->add_testimonial($post_data);
		echo json_encode($d);		
	}

	public function edit_testimonial_data(){
        $post_data = $this->input->post();        
		$this->load->model("testimonial_model");
		$d = $this->testimonial_model->edit_testimonial_data($post_data);
		echo json_encode($d);		 
    }

	public function edit_image_only(){
        $post_data = $this->input->post();        
		$this->load->model("testimonial_model");
		$d = $this->testimonial_model->edit_image_only($post_data);
		echo json_encode($d);		
    }
    
    public function remove_testimonial(){
        $data['t_id'] = $this->input->post("t_id");
        $this->load->model("testimonial_model");
        $d = $this->testimonial_model->remove_testimonial($data);       
        echo json_encode($d); 
    }

}
  