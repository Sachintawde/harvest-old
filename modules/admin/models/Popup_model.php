<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Popup_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_popup()
	{		
		$data = $this->db->get('popup');
		$popup = $data->result();		
		return $popup;
	}

	public function get_single_popup($data)
	{		
		$popup_data = $this->db->get_where('popup',$data);
		$popup = $popup_data->row_array();
		return $popup;
	}
	
	public function add_popup($row){

		$valid = array(); 
		$config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('popup_path'))
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
				'popup_path' => $path,
				'popup_name' => $row['popup_name'], 
				'popup_desc' => $row['popup_desc'], 
				'popup_date' => date('Y-m-d H:i:s')
			);
			$query = $this->db->insert('popup',$data);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = $row['popup_name']." added successfully";
			} else {
				$valid['status'] = "warning";
				$valid['messages'] = "Can't add this".$row['popup_name'];
			}
		}
		return $valid;
	}

	public function edit_popup_data($row){

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
			'popup_name' => $row['edit_popup_name'], 
			'popup_desc' => $row['edit_popup_desc'], 
			'popup_date' => date('Y-m-d H:i:s')
		);
		$valid = array();

		$query = $this->db->update('popup',$data, 'popup_id='.$row['popup_id_2']);

		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = $row['edit_popup_name']." updated successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't update this".$row['edit_popup_name'];
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

		$old_record = $this->db->get_where('popup', array('popup_id' => $row['popup_id_1']))->row_array();
		
		if ( ! $this->upload->do_upload('edit_popup_path'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$path = "assets/uploads/".$file_data['file_name'];
		
		
			$data = array('popup_path' => $path);

			$query = $this->db->update('popup',$data,'popup_id='.$row['popup_id_1']);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = "Image updated successfully";
				if (!empty($old_record['popup_path']) && strpos($old_record['popup_path'], 'assets/uploads/') !== false) {
					$old_file = './assets/uploads/' . basename($old_record['popup_path']);
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

	public function remove_Popup($data)
	{		
		$query = $this->db->delete('popup', $data);		
		$valid = array();
		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = "This popup record deleted successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't Delete this popup record";
		}	
		return $valid;
	}  


}
// model end here