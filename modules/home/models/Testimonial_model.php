<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Testimonial_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_testimonial()
	{		
		$data = $this->db->get('testimonial');
		$testimonial = $data->result();		
		return $testimonial;
	}

	public function get_single_testimonial($data)
	{		
		$testimonial_data = $this->db->get_where('testimonial',$data);
		$testimonial = $testimonial_data->row_array();
		return $testimonial;
	}	
	
}