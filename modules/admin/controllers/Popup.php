<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Popup extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    }
    public function index(){
        $this->load->view("popup");
    } 

    public function get_all_popup(){
        $this->load->model("popup_model");
        $popup = $this->popup_model->get_all_popup();
        $output = array('data' => array());
 
        foreach($popup as $row) {
            $popup_id = $row->popup_id;
            $imageUrl = img_url($row->popup_path);
        
            $popup = "<img class='img-round' title='".$imageUrl."' src='".$imageUrl."' style='height:30px; width:50px;'  />";
        
            $button = '<!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
                <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#viewPopupModal" onclick="viewPopup('.$popup_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View Popup</a></li>
                <li><a type="button" data-toggle="modal" data-target="#editPopupModal" onclick="editPopup('.$popup_id.')"> <i class="glyphicon glyphicon-edit"></i> Edit Popup</a></li>
              </ul>
            </div>';
        
            $output['data'][] = array( 		
                $popup,
                $row->popup_name,
                $row->popup_desc,
                $button
            ); 	        
        }
        echo json_encode($output);
    }

    public function get_single_popup(){
        $data['popup_id'] = $this->input->post("popup_id");
        $this->load->model("popup_model");
        $d = $this->popup_model->get_single_popup($data);
        if (isset($d['popup_path'])) {
            $d['popup_path'] = img_url($d['popup_path']);
        }
        echo json_encode($d);
    }
    
	public function add_popup(){ 
        $post_data = $this->input->post();    
		$this->load->model("popup_model");
		$d = $this->popup_model->add_popup($post_data);
		echo json_encode($d);		
	}

	public function edit_popup_data(){
        $post_data = $this->input->post();        
		$this->load->model("popup_model");
		$d = $this->popup_model->edit_popup_data($post_data);
		echo json_encode($d);		 
    }

	public function edit_image_only(){
        $post_data = $this->input->post();   
        // print_r($_FILES);
        // die;     
		$this->load->model("popup_model");
		$d = $this->popup_model->edit_image_only($post_data);
		echo json_encode($d);		
    }
    
    public function remove_Popup(){
        $data['popup_id'] = $this->input->post("popup_id");
        $this->load->model("popup_model");
        $d = $this->popup_model->remove_popup($data);       
        echo json_encode($d); 
    }

}