<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Curriculum_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_curriculum()
	{		
		$data = $this->db->get('curriculum');
		$c = $data->result();		
		return $c;
	}

	public function get_single_curriculum($data)
	{		
		$c_data = $this->db->get_where('curriculum',$data);
		$c = $c_data->row_array();
		return $c;
	}

	public function add_curriculum($row){

		$valid = array(); 
		$config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('c_path'))
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
				'c_path' => $path,
				'c_title' => $row['c_title'],
				'c_select_date' => $row['c_select_date'], 
				'c_desc' => $row['c_desc'], 
				'c_date' => date('Y-m-d H:i:s')
			);
			$query = $this->db->insert('curriculum',$data);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = $row['c_name']." added successfully";
			} else {
				$valid['status'] = "warning";
				$valid['messages'] = "Can't add this".$row['c_name'];
			}
		}
		return $valid;
	}


	public function edit_curriculum_data($row){

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
			'c_title' => $row['edit_c_title'],
			'c_select_date' => $row['edit_c_select_date'], 
			'c_desc' => $row['edit_c_desc'], 
			'c_date' => date('Y-m-d H:i:s')
		);
		$valid = array();

		$query = $this->db->update('curriculum',$data, 'c_id='.$row['c_id_2']);

		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = $row['edit_c_name']." updated successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't update this".$row['edit_c_name'];
		}	
		return $valid;
	}


	public function edit_image_only($row){

		$valid = array(); 
		$config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);

		$old_record = $this->db->get_where('curriculum', array('c_id' => $row['c_id_1']))->row_array();
		
		if ( ! $this->upload->do_upload('edit_c_path'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$path = "assets/uploads/".$file_data['file_name'];
		
		
			$data = array('c_path' => $path);

			$query = $this->db->update('curriculum',$data,'c_id='.$row['c_id_1']);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = "Image updated successfully";
				if (!empty($old_record['c_path']) && strpos($old_record['c_path'], 'assets/uploads/') !== false) {
					$old_file = './assets/uploads/' . basename($old_record['c_path']);
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

	
	public function remove_Curriculum($data)
	{		
		$query = $this->db->delete('curriculum', $data);		
		$valid = array();
		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = "This curriculum record deleted successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't Delete this curriculum record";
		}	
		return $valid;
	}  
 

}
// model end here