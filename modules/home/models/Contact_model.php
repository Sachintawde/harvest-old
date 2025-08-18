<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Contact_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function add_contact($row) {
		$valid = false;
	
		// Check if inputs contain links
		$urlPattern = "/(https?:\/\/[^\s]+)/"; 
	
		if (preg_match($urlPattern, $row['con_name']) || 
			preg_match($urlPattern, $row['con_lname']) || 
			preg_match($urlPattern, $row['con_msg'])) {
			
			$this->session->set_flashdata(array(
				'class' => 'danger',
				'head' => 'Error',
				'msg' => "Links are not allowed in Name, Last Name, or Message fields."
			));
			
			return false;
		}
	
		// Data to insert
		$data = array(
			'con_name' => $row['con_name'],
			'con_lname' => $row['con_lname'],
			'con_mail' => $row['con_mail'],
			'con_mob' => $row['con_mob'],
			'con_kid' => $row['con_kid'],
			'con_msg' => $row['con_msg'],
			'con_date' => date('Y-m-d H:i:s')
		);
	
		// Insert data
		$query = $this->db->insert('contact', $data);
	
		if ($query) {
			$valid = true;
			$this->session->set_flashdata(array(
				'class' => 'success',
				'head' => 'Success',
				'msg' => "Thank you " . $row['con_name'] . ", for contacting us. We will get back to you!"
			));
		} else {
			$valid = false;
			$this->session->set_flashdata('post_data', $row);
			$this->session->set_flashdata(array(
				'class' => 'danger',
				'head' => 'Error',
				'msg' => "Sorry " . $row['con_name'] . ", we can't send this message. Please try again later."
			));
		}
	
		return $valid;
	}
	
}
// model end here