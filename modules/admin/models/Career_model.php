<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Career_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_career()
	{		
		$data = $this->db->get('career');
		$e = $data->result();		
		return $e;
	}

	public function get_single_career($data)
	{		
		$e_data = $this->db->get_where('career',$data);
		$e = $e_data->row_array();
		return $e;
	}
	
	public function remove_Career($data)
	{		
		$query = $this->db->delete('career', $data);		
		$valid = array();
		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = "This career record deleted successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't Delete this career record";
		}	
		return $valid;
	}  


}
// model end here