<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Career_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function add_career($row){

		$valid = false;  
			$data = array(
				'e_name' => $row['e_name'],
				'e_lname' => $row['e_lname'],
				'e_mail' => $row['e_mail'],
				'e_mob' => $row['e_mob'], 
				'e_prog' => $row['e_prog'],
				'e_addrs' => $row['e_addrs'],
				'e_msg' => $row['e_msg'],
				'e_resume' => $row['e_resume'],
				'e_date' => date('Y-m-d H:i:s')
			);
			$query = $this->db->insert('career',$data);

			if ($query) {
				$valid = true;
				$this->session->set_flashdata(array('class'=>'success','head'=>'success','msg'=>"Thank you ".$row['e_name'].", your form has been submited successfully!"));	
			} else {
				$valid = false;
				$this->session->set_flashdata('post_data', $row);
				$this->session->set_flashdata('class','danger');
				$this->session->set_flashdata('head','Error');
				$this->session->set_flashdata('msg',"Sorry ".$row['e_name'].", your form can't submit, please try later");
			}
			
		
		return $valid;
	}
}
// model end here