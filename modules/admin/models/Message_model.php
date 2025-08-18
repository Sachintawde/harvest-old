<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Message_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_msg()
	{		
		$data = $this->db->get('contact');
		$msg = $data->result();		
		return $msg;
	}

	public function get_single_msg($data)
	{		
		$msg_data = $this->db->get_where('contact',$data);
		$msg = $msg_data->row_array();
		return $msg;
	}

	public function remove_msg($data)
	{		
		$query = $this->db->delete('contact', $data);		
		$valid = array();

		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = "message deleted successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't Delete message";
		}	
		return $valid;
	}


}
// model end here