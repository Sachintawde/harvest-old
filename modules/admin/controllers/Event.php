<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    }
    public function index(){
        $this->load->view("event");
    } 

    public function get_all_event(){
        $this->load->model("event_model");
        $event = $this->event_model->get_all_event();
        $output = array('data' => array());
 
        foreach($event as $row) {
            $event_id = $row->event_id;
            $imageUrl = $row->event_path;
        
            $event = "<img class='img-round' title='".$imageUrl."' src='".$imageUrl."' style='height:30px; width:50px;'  />";
        
            $button = '<!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
                <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#viewEventModal" onclick="viewEvent('.$event_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View Event</a></li>
                <li><a type="button" data-toggle="modal" data-target="#editEventModal" onclick="editEvent('.$event_id.')"> <i class="glyphicon glyphicon-edit"></i> Edit Event</a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeEventModal" onclick="removeEvent('.$event_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
              </ul>
            </div>';
        
            $output['data'][] = array( 		
                $event,
                $row->event_type,
                $row->event_name,
                date('m-d-Y', strtotime($row->event_start)),
                date('m-d-Y', strtotime($row->event_end)),
                $button
            ); 	        
        }
        echo json_encode($output);
    }

    public function get_single_event(){
        $data['event_id'] = $this->input->post("event_id");
        $this->load->model("event_model");
        $d = $this->event_model->get_single_event($data);
        echo json_encode($d);
    }
    
	public function add_event(){ 
        $post_data = $this->input->post();    
		$this->load->model("event_model");
		$d = $this->event_model->add_event($post_data);
		echo json_encode($d);		
	}

	public function edit_event_data(){
        $post_data = $this->input->post();        
		$this->load->model("event_model");
		$d = $this->event_model->edit_event_data($post_data);
		echo json_encode($d);		 
    }

	public function edit_image_only(){
        $post_data = $this->input->post();        
		$this->load->model("event_model");
		$d = $this->event_model->edit_image_only($post_data);
		echo json_encode($d);		
    }
    
    public function remove_Event(){
        $data['event_id'] = $this->input->post("event_id");
        $this->load->model("event_model");
        $d = $this->event_model->remove_event($data);       
        echo json_encode($d); 
    }

}