<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Contact extends ADMIN_Controller {



	public function __construct()

	{	

	   ob_start();

	   parent::__construct();

    }

    public function index(){

        $this->load->view("contact");

    } 



    public function get_all_contact(){

        $this->load->model("contact_model");

        $con = $this->contact_model->get_all_contact();

        $output = array('data' => array());

 

        foreach($con as $row) {

            $con_id = $row->con_id;

            $button = '<!-- Single button -->

            <div class="btn-group">

              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                Action <span class="caret"></span>

              </button>

                <ul class="dropdown-menu">

                <li><a type="button" data-toggle="modal" data-target="#viewContactModal" onclick="viewContact('.$con_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View Contact</a></li>

                <li><a type="button" data-toggle="modal" data-target="#removeContactModal" onclick="removeContact('.$con_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       

              </ul>

            </div>';

         

            $output['data'][] = array( 		

                $row->con_name,

                $row->con_lname,

                $row->con_mail,

                $row->con_mob,

                date('m-d-Y', strtotime($row->con_date)),

                $button

            ); 	        

        }

        echo json_encode($output);

    }



    public function get_single_contact(){

        $data['con_id'] = $this->input->post("con_id");

        $this->load->model("contact_model");

        $d = $this->contact_model->get_single_contact($data);

        echo json_encode($d);

    } 

    public function remove_Contact(){

        $data['con_id'] = $this->input->post("con_id");

        $this->load->model("contact_model");

        $d = $this->contact_model->remove_contact($data);       

        echo json_encode($d); 

    }



}

  