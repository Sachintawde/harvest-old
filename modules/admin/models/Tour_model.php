<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tour_model extends CI_Model{



	public function __construct()

	{

		parent::__construct();

	}

	

	// public function get_all_tour()

	// {		

	// 	$data = $this->db->get('tour');

	// 	$t = $data->result();		

	// 	return $t;

	// }
	public function get_all_tour()
    {        
        return $this->db->get('tour')->result_array();
    }



	public function get_single_tour($data)

	{		

		$t_data = $this->db->get_where('tour',$data);

		$t = $t_data->row_array();

		return $t;

	}

	

	public function remove_Tour($data)

	{		

		$query = $this->db->delete('tour', $data);		

		$valid = array();

		if ($query) {

			$valid['status'] = "success";

			$valid['messages'] = "This tour record deleted successfully";

		} else {

			$valid['status'] = "warning";

			$valid['messages'] = "Can't Delete this tour record";

		}	

		return $valid;

	}  





}

// model end here