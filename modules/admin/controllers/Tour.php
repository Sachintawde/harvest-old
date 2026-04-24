<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Tour extends ADMIN_Controller {



	public function __construct()

	{	

	   ob_start();

	   parent::__construct();
       $this->load->model('tour_model');

    }

    public function index(){

        $this->load->view("tour");

    } 



    public function get_all_tour(){

        $this->load->model("tour_model");

        $t = $this->tour_model->get_all_tour();

        $output = array('data' => array());

 

        foreach($t as $row) {

            $t_id = $row['t_id'];

            $button = '<!-- Single button -->

            <div class="btn-group">

              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                Action <span class="caret"></span>

              </button>

                <ul class="dropdown-menu">

                <li><a type="button" data-toggle="modal" data-target="#viewTourModal" onclick="viewTour('.$t_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View Tour</a></li>

                <li><a type="button" data-toggle="modal" data-target="#removeTourModal" onclick="removeTour('.$t_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       

              </ul>

            </div>';

         

            $output['data'][] = array( 		

                $row['t_child_name_1'],
                $row['t_child_lname_1'],
                $row['t_mother_name'],
                $row['t_mother_email'],
                $row['t_mother_phone'],

                $button

            ); 	        

        }

        echo json_encode($output);

    }



    public function get_single_tour(){

        $data['t_id'] = $this->input->post("t_id");

        $this->load->model("tour_model");

        $d = $this->tour_model->get_single_tour($data);

        echo json_encode($d);

    } 

    public function remove_Tour(){

        $data['t_id'] = $this->input->post("t_id");

        $this->load->model("tour_model");

        $d = $this->tour_model->remove_tour($data);       

        echo json_encode($d); 

    }

    public function calendar()
    {
        $this->load->view("tour_calendar");
    }

    public function get_tour_events() {
        $tours = $this->tour_model->get_all_tour();
        
        $data = array();
    
        foreach ($tours as $tour) {
            $data[] = array(
                'id'                => $tour['t_id'],
                'title'             => $tour['t_mother_name'],
                'start'             => $tour['t_start_date_field'],
                't_child_name_1'    => $tour['t_child_name_1'] ?? 'N/A',
                't_child_lname_1'   => $tour['t_child_lname_1'] ?? 'N/A',
                't_gender_1'        => $tour['t_gender_1'] ?? 'N/A',
                't_dob_1'           => $tour['t_dob_1'] ?? 'N/A',
                't_class_1'         => $tour['t_class_1'] ?? 'N/A',
                't_child_name_2'    => $tour['t_child_name_2'] ?? 'N/A',
                't_child_lname_2'   => $tour['t_child_lname_2'] ?? 'N/A',
                't_gender_2'        => $tour['t_gender_2'] ?? 'N/A',
                't_dob_2'           => $tour['t_dob_2'] ?? 'N/A',
                't_class_2'         => $tour['t_class_2'] ?? 'N/A',
                't_address'         => $tour['t_address'] ?? 'N/A',
                't_city'            => $tour['t_city'] ?? 'N/A',
                't_state'           => $tour['t_state'] ?? 'N/A',
                't_zip_code'        => $tour['t_zip_code'] ?? 'N/A',
                't_mother_phone'    => $tour['t_mother_phone'] ?? 'N/A',
                't_mother_email'    => $tour['t_mother_email'] ?? 'N/A',
                't_father_name'     => $tour['t_father_name'] ?? 'N/A',
                't_father_phone'    => $tour['t_father_phone'] ?? 'N/A',
                't_father_email'    => $tour['t_father_email'] ?? 'N/A',
                't_communication_method' => $tour['t_communication_method'] ?? 'N/A',
                't_time_slot'       => $tour['t_time_slot'] ?? 'N/A',
                't_previous_school' => $tour['t_previous_school'] ?? 'N/A',
                't_important_factors'=> $tour['t_important_factors'] ?? 'N/A',
                't_source'          => $tour['t_source'] ?? 'N/A',
                't_program'         => $tour['t_program'] ?? 'N/A',
                't_referral_name'   => $tour['t_referral_name'] ?? 'N/A',
                't_other_notes'     => $tour['t_other_notes'] ?? 'N/A',
                't_signature_date'  => $tour['t_signature_date'] ?? 'N/A',
                't_agegroups'       => $tour['t_agegroups'] ?? 'N/A',
                't_signature'       => !empty($tour['t_signature']) ? base_url('uploads/signatures/' . $tour['t_signature']) : 'N/A',
                'timestamp'         => $tour['timestamp'] ?? time(),
            );
        }
    
        header('Content-Type: application/json');
        echo json_encode($data);
    }



}

  