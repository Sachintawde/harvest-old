<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Popup_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_popup()
	{		
		$data = $this->db->get('popup');
		$popup = $data->result();		
		return $popup; 
	}
}