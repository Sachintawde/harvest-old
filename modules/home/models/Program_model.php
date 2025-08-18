<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Program_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_program()
	{		
		$data = $this->db->get('program');
		$p = $data->result();		 
		return $p;
	}
 
	public function get_single_program($data)
	{		
		$p_data = $this->db->get_where('program',$data);
		$p = $p_data->row_array();
		return $p;
	}  
	 
	public function get_page_program($data){
		$program_data = $this->db->get_where('program',$data);
		$program = $program_data->result();
		return $program; 
	} 


    public function get_program_name(){ 
        $query = $this->db->query("SELECT program_name FROM program GROUP BY program_name ORDER BY MIN(program_id) ASC");
        $program_names = $query->result();
        return $program_names;
    }

public function get_home_program()
{
    $this->db->order_by('program_id', 'desc');

    $this->db->limit(2);

    $data = $this->db->get('program');

    $p = $data->result();

    return $p;
}

	 
} 