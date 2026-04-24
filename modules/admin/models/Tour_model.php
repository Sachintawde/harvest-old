<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tour_model extends CI_Model{



	public function __construct()

	{

		parent::__construct();

	}

	

	public function get_all_tour()

	{		

		$data = $this->db->get_where('tour', array('t_status' => 1));

		return $data->result_array();

	}



	public function get_single_tour($data)

	{		

		$t_data = $this->db->get_where('tour',$data);

		$t = $t_data->row_array();

		return $t;

	}

	

	public function remove_Tour($data)

	{		

		// Soft delete: set t_status = 0 to preserve history
		// This allows the slot to be re-booked by others
		$this->db->where('t_id', $data['t_id']);
		$query = $this->db->update('tour', array('t_status' => 0));

		$valid = array();

		if ($query && $this->db->affected_rows() > 0) {

			log_message('info', '[Tour_model] Tour ID ' . $data['t_id'] . ' deleted (t_status=0). Slot is now available for rebooking.');

			$valid['status'] = "success";

			$valid['messages'] = "This tour record deleted successfully";

		} else {

			log_message('error', '[Tour_model] Failed to delete Tour ID ' . $data['t_id'] . ' or record not found.');

			$valid['status'] = "warning";

			$valid['messages'] = "Can't Delete this tour record";

		}	

		return $valid;

	}  





}

// model end here