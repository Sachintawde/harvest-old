<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Enroll_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_enroll()
	{		
		$data = $this->db->get('enroll');
		$enroll = $data->result();		
		return $enroll;
	}

	public function get_single_enroll($data)
	{		
		$enroll_data = $this->db->get_where('enroll',$data);
		$enroll = $enroll_data->row_array();
		return $enroll;
	}
	
	public function remove_Enroll($data)
	{		
		$query = $this->db->delete('enroll', $data);		
		$valid = array();
		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = "This enroll record deleted successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't Delete this enroll record";
		}	
		return $valid;
	}  

	public function get_enroll_massage()
	{		
		$this->db->from("enroll");
        $this->db->order_by('e_date', 'asc');
        $this->db->limit('5');
        $data = $this->db->get(); 
		$enroll = $data->result();		
		return $enroll;
	}

}
// model end here