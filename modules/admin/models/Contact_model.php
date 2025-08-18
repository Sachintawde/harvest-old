<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model{



	public function __construct()

	{

		parent::__construct();

	}

	

	public function get_all_contact()

	{		

		$data = $this->db->get('contact');

		$con = $data->result();		

		return $con;

	}



	public function get_single_contact($data)

	{		

		$con_data = $this->db->get_where('contact',$data);

		$con = $con_data->row_array();

		return $con;

	}

	

	public function remove_Contact($data)

	{		

		$query = $this->db->delete('contact', $data);		

		$valid = array();

		if ($query) {

			$valid['status'] = "success";

			$valid['messages'] = "This contact record deleted successfully";

		} else {

			$valid['status'] = "warning";

			$valid['messages'] = "Can't Delete this contact record";

		}	

		return $valid;

	}  



	public function get_contact_massage()

	{		

		$this->db->from("contact");

        $this->db->order_by('con_date', 'asc');

        $this->db->limit('5');

        $data = $this->db->get(); 

		$con = $data->result();		

		return $con;

	}



	public function get_contact_tour()

	{		

		$this->db->from("tour");

        $this->db->order_by('t_date', 'asc');

        $this->db->limit('5');

        $data = $this->db->get(); 

		$con = $data->result();		

		return $con;

	}



}

// model end here