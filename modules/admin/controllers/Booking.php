<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    }
    public function index(){
        $this->load->view("booking");
    }

    public function get_all_book(){
        $this->load->model("booking_model");
        $book = $this->booking_model->get_all_booking();
        $output = array('data' => array());

        foreach($book as $row) {
            $book_id = $row->book_id;        
        
            $button = '<!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
                <ul class="dropdown-menu">
                    <li><a type="button" data-toggle="modal" data-target="#viewBookModal" onclick="viewBook('.$book_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View</a></li>	
                    <li><a type="button" data-toggle="modal" data-target="#removeBookModal" onclick="removeBook('.$book_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
              </ul>
            </div>';
        
            $book_content = '<div class="msg"><input type="checkbox" id="expanded"><p>'.$row->book_msg.'</p><label for="expanded">...</label></div>';
            
            $output['data'][] = array( 		
                $row->book_name,
                $row->book_mail,
                $row->book_contact,
                $row->book_budget,
                $row->book_event_date,
                $book_content,
                $row->book_added_date,
                $button
            );
        }
        echo json_encode($output);
    }

    public function get_single_book(){
        $data['book_id'] = $this->input->post("book_id");
        $this->load->model("booking_model");
        $d = $this->booking_model->get_single_booking($data);
        echo json_encode($d);
    }

    public function remove_book(){
        $data['book_id'] = $this->input->post("book_id");
        $this->load->model("booking_model");
        $d = $this->booking_model->remove_booking($data);     
        echo json_encode($d); 
    }
    
}
