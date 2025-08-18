<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Testimonial_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_testimonial()
	{		
		$data = $this->db->get('testimonial');
		$t = $data->result();		
		return $t;
	}

	public function get_single_testimonial($data)
	{		
		$t_data = $this->db->get_where('testimonial',$data);
		$t = $t_data->row_array();
		return $t; 
	}

	public function add_testimonial($row){

		$valid = array(); 
		$config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4';

		$this->load->library('upload', $config);
		
		$defaultImagePath = ($row['t_gender'] == 'Male') ? 'man.png' : '25.png';
		
		$t_path= base_url("assets/home/images/others/{$defaultImagePath}");
		$t_path_two= "";


		if ( ! $this->upload->do_upload('t_path'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$t_path = base_url("assets/uploads/".$file_data['file_name']);
		}

		if ( ! $this->upload->do_upload('t_path_two'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$t_path_two = base_url("assets/uploads/".$file_data['file_name']);
		}
			$data = array(
				't_path' => $t_path,
				't_path_two' => $t_path_two,
				't_name' => $row['t_name'], 
				't_msg' => $row['t_msg'],
				't_gender' => $row['t_gender'],
				't_design' => $row['t_design'],
				't_date' => date('Y-m-d H:i:s')
			);
			$query = $this->db->insert('testimonial',$data);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = $row['t_name']." added successfully";
			} else {
				$valid['status'] = "warning";
				$valid['messages'] = "Can't add this".$row['t_name'];
			}
		
		return $valid;
	}


	public function edit_testimonial_data($row){

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
			't_name' => $row['edit_t_name'], 
			't_msg' => $row['edit_t_msg'],
			't_gender' => $row['edit_t_gender'],
			't_design' => $row['edit_t_design'],
			't_date' => date('Y-m-d H:i:s')
		);
		$valid = array();

		$query = $this->db->update('testimonial',$data, 't_id='.$row['t_id_2']);

		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = $row['edit_t_name']." updated successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't update this".$row['edit_t_name'];
		}	
		return $valid;
	}


	public function edit_image_only($row){

		$valid = array(); 
		$config['upload_path']   = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|mp4';
	
		$this->load->library('upload', $config);
	
		// Upload the first image (edit_t_path)
		if ( ! $this->upload->do_upload('edit_t_path'))
		{
			// Set default path for the first image
			$t_path = base_url("assets/uploads/25.png");
			
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$t_path = base_url("assets/uploads/".$file_data['file_name']);
		}
	
		// Upload the second image (edit_t_path_two)
		if ( ! $this->upload->do_upload('edit_t_path_two'))
		{
			// Set default path for the second image
			$t_path_two = "";
	
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$t_path_two = base_url("assets/uploads/".$file_data['file_name']);
		}
	
		// Prepare data array for update
		$data = array('t_path' => $t_path, 't_path_two' => $t_path_two);
	
		// Update the testimonial table
		$query = $this->db->update('testimonial', $data, 't_id='.$row['t_id_1']);
	
		// Check the result of the update operation
		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = "Image updated successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't update this image";
		}
	
		return $valid;
	}

	
	public function remove_Testimonial($data)
	{		
		$query = $this->db->delete('testimonial', $data);		
		$valid = array();
		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = "This testimonial record deleted successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't Delete this testimonial record";
		}	
		return $valid;
	}  
 

}
// model end here