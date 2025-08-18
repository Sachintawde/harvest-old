<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    }
    public function index(){
        $this->load->view("message");
    }

    public function get_all_message(){
        $this->load->model("message_model");
        $msg = $this->message_model->get_all_msg();
        $output = array('data' => array());

        foreach($msg as $row) {
            $msg_id = $row->con_id;        
        
            $button = '<!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
                <ul class="dropdown-menu">
                    <li><a type="button" data-toggle="modal" data-target="#viewMessageModal" onclick="viewMessage('.$msg_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View</a></li>	
                    <li><a type="button" data-toggle="modal" data-target="#removeMessageModal" onclick="removeMessage('.$msg_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
              </ul>
            </div>';
        
            $msg_content = '<div class="msg"><input type="checkbox" id="expanded"><p>'.$row->con_msg.'</p><label for="expanded">...</label></div>';
            
            $output['data'][] = array( 		
                $row->con_name,
                $row->con_mail,
                $row->con_mob,
                $msg_content,
                $row->con_date,
                $button
            );
        }
        echo json_encode($output);
    }

    public function get_single_message(){
        $data['con_id'] = $this->input->post("msg_id");
        $this->load->model("message_model");
        $d = $this->message_model->get_single_msg($data);
        echo json_encode($d);
    }

    public function remove_message(){
        $data['con_id'] = $this->input->post("msg_id");
        $this->load->model("message_model");
        $d = $this->message_model->remove_msg($data);       
        echo json_encode($d); 
    }
    
}
