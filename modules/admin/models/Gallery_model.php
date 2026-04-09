<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gallery_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_img()
	{		
		$data = $this->db->get('gallery');
		$img = $data->result();		
		return $img;
	}

	public function get_single_img($data)
	{		
		$img_data = $this->db->get_where('gallery',$data);
		$img = $img_data->row_array();
		return $img; 
	}

	public function add_img($row){

		$valid = array(); 
		$config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('img_path'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$path = "assets/uploads/".$file_data['file_name'];
		
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
				'img_path' => $path,
				'img_cat' => $row['img_cat'], 
				'img_sub' => $row['img_sub'], 
				'img_title' => $row['img_title'], 
				'img_desc' => $row['img_desc'],
				'img_link' => $row['img_link'],
				'img_ytb_link' => $ytb_link,
				'img_ext_link' => $ext_link,
				'img_date' => date('Y-m-d H:i:s')
			);
			$query = $this->db->insert('gallery',$data);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = $row['img_cat']." added successfully";
			} else {
				$valid['status'] = "warning";
				$valid['messages'] = "Can't add this".$row['img_cat'];
			}
		}
		return $valid;
	}


	public function edit_img_data($row){

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
			'img_cat' => $row['edit_img_cat'], 
			'img_sub' => $row['edit_img_sub'], 
			'img_title' => $row['edit_img_title'], 
			'img_desc' => $row['edit_img_desc'],
			'img_ytb_link' => $ytb_link,
			'img_ext_link' => $ext_link,
			'img_date' => date('Y-m-d H:i:s')
		);
		$valid = array();

		$query = $this->db->update('gallery',$data, 'img_id='.$row['img_id_2']);

		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = $row['edit_img_cat']." updated successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't update this".$row['edit_img_cat'];
		}	
		return $valid;
	}


	public function edit_img_only($row){

		$valid = array();
		$config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);

		$old_record = $this->db->get_where('gallery', array('img_id' => $row['img_id_1']))->row_array();
		
		if ( ! $this->upload->do_upload('edit_img_path'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$path = "assets/uploads/".$file_data['file_name'];
		
		
			$data = array('img_path' => $path);

			$query = $this->db->update('gallery',$data,'img_id='.$row['img_id_1']);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = "Image updated successfully";
				if (!empty($old_record['img_path']) && strpos($old_record['img_path'], 'assets/uploads/') !== false) {
					$old_file = './assets/uploads/' . basename($old_record['img_path']);
					if (file_exists($old_file)) {
						@unlink($old_file);
					}
				}
			} else {
				$valid['status'] = "warning";
				$valid['messages'] = "Can't update this image";
			}
		}
		return $valid; 
	}

	
	public function remove_img($data)
	{		
		$query = $this->db->delete('gallery', $data);		
		$valid = array();
		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = "This gallery record deleted successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't Delete this gallery record";
		}	
		return $valid;
	}  


}
// model end here