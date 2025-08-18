<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    }
    public function index(){
        $this->load->view("gallery");
    } 

    public function get_all_images(){ 
        $this->load->model("gallery_model");
        $img = $this->gallery_model->get_all_img();
        $output = array('data' => array());

        foreach($img as $row) {
            $img_id = $row->img_id;
            $imageUrl = $row->img_path;
        
            $img = "<img class='img-round' title='".$imageUrl."' src='".$imageUrl."' style='height:30px; width:50px;'  />";
        
            $button = '<!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
                <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#viewImageModal" onclick="viewImages('.$img_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View Img</a></li>
                <li><a type="button" data-toggle="modal" data-target="#editImageModal" onclick="editImages('.$img_id.')"> <i class="glyphicon glyphicon-edit"></i> Edit Img</a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeImageModal" onclick="removeImages('.$img_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
              </ul>
            </div>';
         
            $output['data'][] = array( 		 
                $img,
                $row->img_cat,
                $row->img_sub,
                $row->img_title,
                date('m-d-Y', strtotime($row->img_date)),
                $button
            ); 	        
        }
        echo json_encode($output);
    }

    public function get_single_image(){
        $data['img_id'] = $this->input->post("img_id");
        $this->load->model("gallery_model");
        $d = $this->gallery_model->get_single_img($data);
        echo json_encode($d);
    }
    
	public function add_image(){
        $post_data = $this->input->post();    
		$this->load->model("gallery_model");
		$d = $this->gallery_model->add_img($post_data);
		echo json_encode($d);		
	}

	public function edit_image_data(){
        $post_data = $this->input->post();        
		$this->load->model("gallery_model");
		$d = $this->gallery_model->edit_img_data($post_data);
		echo json_encode($d);		
    }

	public function edit_image_only(){
        $post_data = $this->input->post();        
		$this->load->model("gallery_model");
		$d = $this->gallery_model->edit_img_only($post_data);
		echo json_encode($d);		
    }
    
    public function remove_image(){
        $data['img_id'] = $this->input->post("img_id");
        $this->load->model("gallery_model");
        $d = $this->gallery_model->remove_img($data);       
        echo json_encode($d); 
    }

}