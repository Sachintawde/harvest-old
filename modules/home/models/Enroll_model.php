<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Enroll_model extends CI_Model{



	public function __construct()

	{

		parent::__construct();

	}

 

    public function add_contact($row)

    {

        $valid = false;



        $data = array(
            'g_fname' => $row['g_fname'],
            'g_lname' => $row['g_lname'],
            'g_mob' => $row['g_mob'],
            'g_mob_type' => $row['g_mob_type'],
            'g_mail' => $row['g_mail'],
            'communication' => $row['communication'], // New field
            'previous_school' => $row['previous_school'], // New field
            'important_factors' => $row['important_factors'], // New field
            'g_hear_about' => $row['g_hear_about'],
            'c_fname1' => $row['c_fname1'],
            'c_lname1' => $row['c_lname1'],
            'dob1' => $row['dob1'],
            'c_class1' => $row['c_class1'],
            'gender1' => $row['gender1'], // New field
            's_date1' => $row['s_date1'],
            'c_fname2' => $row['c_fname2'],
            'c_lname2' => $row['c_lname2'],
            'dob2' => $row['dob2'],
            'c_class2' => $row['c_class2'],
            'gender2' => $row['gender2'], // New field
            's_date2' => $row['s_date2'],
            'g_info' => $row['g_info'],
            'other_notes' => $row['other_notes'],
            'Interested' => implode(',', $row['Interested']), // Convert array to comma-separated string
            'e_date' => date('Y-m-d H:i:s')
        );



        $query = $this->db->insert('enroll', $data);



        if ($query) {

            $valid = true;

            $this->session->set_flashdata(array('class'=>'success','head'=>'success','msg'=>"Thank you ".$row['g_fname'].", for contacting us! We will get in touch with you shortly."));	

        } else {

            $valid = false;

            $this->session->set_flashdata('post_data', $row);

            $this->session->set_flashdata('class','danger');

            $this->session->set_flashdata('head','Error');

            $this->session->set_flashdata('msg',"Sorry ".$row['g_fname'].", we can't enroll, please try later");

        }



        return $valid;

    }

}

// model end here



