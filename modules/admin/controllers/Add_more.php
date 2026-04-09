<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_more extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    }

    function _remap($method,$args)
    {
        if (method_exists($this, $method)){
            $this->$method($args);
        }else{
            $this->index($method,$args);
        }     
    }

    public function index($gp_g_id = ''){
        if($gp_g_id && (is_numeric($gp_g_id))){
            $data['img_id'] = $gp_g_id;
            $this->load->model("gallery_model");
            $d = $this->gallery_model->get_single_img($data);
            $this->load->view("add_more", $d);
        }
    } 

    public function get_all_images(){
        $data['gp_g_id'] = $this->input->post("gp_g_id");
        $data_img['img_id'] = $this->input->post("gp_g_id");

        $this->load->model("gallery_model");
        $d = $this->gallery_model->get_single_img($data_img);

        $this->load->model("add_more_model");
        $img = $this->add_more_model->get_all_img($data);
        
        $output = array('data' => array());

        foreach($img as $row) {
            $gp_id = $row->gp_id;
            $imageUrl = img_url($row->gp_path);
        
            $img = "<img class='img-round' title='".$imageUrl."' src='".$imageUrl."' style='height:30px; width:50px;'  />";
        
            $button = '<!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span> 
              </button>
                <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#viewImageModal" onclick="viewImages('.$gp_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View Img</a></li>
                <li><a type="button" data-toggle="modal" data-target="#editImageModal" onclick="editImages('.$gp_id.')"> <i class="glyphicon glyphicon-edit"></i> Edit Img</a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeImageModal" onclick="removeImages('.$gp_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
              </ul>
            </div>';
        
            $output['data'][] = array( 		
                $img,
                $d['img_title'],
                $row->gp_cat,
                $row->gp_date,
                $button
            ); 	        
        }
        echo json_encode($output);
    }

    public function get_single_image(){
        $data['gp_id'] = $this->input->post("gp_id");
        $this->load->model("add_more_model");
        $d = $this->add_more_model->get_single_img($data);
        echo json_encode($d);
    }
    
	public function add_image(){
        $post_data = $this->input->post();    
		$this->load->model("add_more_model");
		$d = $this->add_more_model->add_img($post_data);
		echo json_encode($d);		
	}

	public function edit_image_data(){
        $post_data = $this->input->post();        
		$this->load->model("add_more_model");
		$d = $this->add_more_model->edit_img_data($post_data);
		echo json_encode($d);		
    }

	public function edit_image_only(){
        $post_data = $this->input->post();        
		$this->load->model("add_more_model");
		$d = $this->add_more_model->edit_img_only($post_data);
		echo json_encode($d);		
    }
    
    public function remove_image(){
        $data['gp_id'] = $this->input->post("gp_id");
        $this->load->model("add_more_model");
        $d = $this->add_more_model->remove_img($data);       
        echo json_encode($d); 
    }

}
