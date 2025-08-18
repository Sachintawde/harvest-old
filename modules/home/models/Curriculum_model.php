<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Curriculum_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_curriculum()
	{		
		$data = $this->db->get('curriculum');
		$curriculum = $data->result();		
		return $curriculum;
	}
 
	public function get_single_curriculum($data)
	{		
		$curriculum_data = $this->db->get_where('curriculum',$data);
		$curriculum = $curriculum_data->row_array();
		return $curriculum;
	} 
}