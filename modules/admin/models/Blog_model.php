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
	
	public function add_blog($row){

		$valid = array(); 
		$config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('blog_path'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$path = base_url("assets/uploads/".$file_data['file_name']);
		    
			if(isset($row['ytb_link'])) {
				$ytb_link = $row['ytb_link'];
				$ext_link = "-";
			}else if(isset($row['ext_link'])) {
				$ext_link = $row['ext_link'];
				$ytb_link = "-";
			}else{
				$ytb_link = "-";
				$ext_link = "-";
			}
			$data = array(
				'blog_path' => $path,
				'blog_name' => $row['blog_name'], 
				'blog_datee' => $row['blog_datee'], 
				'blog_desc' => $row['blog_desc'], 
				'blog_date' => date('Y-m-d H:i:s')
			);
			$query = $this->db->insert('blog',$data);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = $row['blog_name']." added successfully";
			} else {
				$valid['status'] = "warning";
				$valid['messages'] = "Can't add this".$row['blog_name'];
			}
		}
		return $valid;
	}

	public function edit_blog_data($row){

		if(isset($row['edit_ytb_link'])) {
			$ytb_link = $row['edit_ytb_link'];
			$ext_link = "-";
		}else if(isset($row['edit_ext_link'])) {
			$ext_link = $row['edit_ext_link'];
			$ytb_link = "-";
		}else{
			$ytb_link = "-";
			$ext_link = "-";
		}
		
		$data = array(
			'blog_name' => $row['edit_blog_name'], 
			'blog_datee' => $row['edit_blog_datee'], 
			'blog_desc' => $row['edit_blog_desc'], 
			'blog_date' => date('Y-m-d H:i:s')
		);
		$valid = array();

		$query = $this->db->update('blog',$data, 'blog_id='.$row['blog_id_2']);

		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = $row['edit_blog_name']." updated successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't update this".$row['edit_blog_name'];
		}	
		return $valid;
	}


	public function edit_image_only($row){
		// print_r($row);
		// print_r($_FILES);
		// die;
		$valid = array(); 
		$config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('edit_blog_path'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$path = base_url("assets/uploads/".$file_data['file_name']);
		
		
			$data = array('blog_path' => $path);

			$query = $this->db->update('blog',$data,'blog_id='.$row['blog_id_1']);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = "Image updated successfully";
			} else {
				$valid['status'] = "warning";
				$valid['messages'] = "Can't update this image";
			}
		}
		return $valid;
	}

	public function remove_Blog($data)
	{		
		$query = $this->db->delete('blog', $data);		
		$valid = array();
		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = "This blog record deleted successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't Delete this blog record";
		}	
		return $valid;
	}  


}
// model end here