<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_blog()
	{		
		$data = $this->db->get('blog');
		$blog = $data->result();		
		return $blog;
	}

	public function get_single_blog($data)
	{		
		$blog_data = $this->db->get_where('blog',$data); 
		$blog = $blog_data->row_array();
		return $blog;
	} 

	public function get_blog_name(){ 
		$query = $this->db->query("SELECT blog_name FROM blog GROUP BY blog_name");
        $blog_name = $query->result();
		return $blog_name;
	}  

	public function get_latest_blog($blog_id)
	{		
		$this->db->from("blog");
		$this->db->where("blog_id!=",$blog_id);
		$this->db->where("blog_status",1);
        $this->db->order_by('blog_id', 'asc');
        $this->db->limit('6');
        $data = $this->db->get();
		$blog = $data->result();		
		return $blog;
	}
} 