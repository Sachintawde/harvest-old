<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_faq()
	{
		$this->db->where('faq_status', 1);
		$this->db->order_by('faq_order', 'ASC');
		$data = $this->db->get('faq');
		return $data->result();
	}
}
