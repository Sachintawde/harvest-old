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

	public function save_contact($data)

	{

		$this->db->set('con_name',   $data['con_name']);

		$this->db->set('con_lname',  $data['con_lname']);

		$this->db->set('con_mail',   $data['con_mail']);

		$this->db->set('con_mob',    $data['con_mob']);

		$this->db->set('con_kid',    $data['con_kid']);

		$this->db->set('con_msg',    $data['con_msg']);

		$this->db->set('con_status', 1);

		$this->db->set('con_date',   date('Y-m-d H:i:s'));

		$query = $this->db->insert('contact');

		$valid = array();

		if ($query) {

			$valid['status']   = "success";

			$valid['messages'] = "Contact saved successfully";

			$valid['con_id']   = $this->db->insert_id();

		} else {

			$valid['status']   = "error";

			$valid['messages'] = "Could not save contact";

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