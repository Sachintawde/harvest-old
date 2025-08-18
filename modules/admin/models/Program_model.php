<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Program_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_program()
	{		
		$data = $this->db->get('program');
		$program = $data->result();		
		return $program;
	}

	public function get_single_program($data) 
	{		
		$program_data = $this->db->get_where('program',$data);
		$program = $program_data->row_array();
		return $program;
	}
	
	public function add_program($row){

		$valid = array(); 
		$config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);

		$program_path='';
		$program_path_two='';


		if ( ! $this->upload->do_upload('program_path'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$program_path = base_url("assets/uploads/".$file_data['file_name']);
		}

		if ( ! $this->upload->do_upload('program_path_two'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$program_path_two = base_url("assets/uploads/".$file_data['file_name']);
		}
				    
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
				'program_path' => $program_path,
				'program_path_two' => $program_path_two,
				'program_name' => $row['program_name'], 
				'program_title' => $row['program_title'], 
				'program_title_two' => $row['program_title_two'], 
				'program_title_three' => $row['program_title_three'], 
				'program_title_four' => $row['program_title_four'], 
				'program_title_five' => $row['program_title_five'], 
				'program_title_six' => $row['program_title_six'], 
				'program_title_seven' => $row['program_title_seven'], 
				'program_title_eight' => $row['program_title_eight'], 
				'program_title_nine' => $row['program_title_nine'], 
				'program_title_ten' => $row['program_title_ten'], 
				'program_title_eleven' => $row['program_title_eleven'], 
				'program_desc' => $row['program_desc'], 
				'program_desc_two' => $row['program_desc_two'], 
				'program_desc_three' => $row['program_desc_three'], 
				'program_desc_four' => $row['program_desc_four'], 
				'program_desc_five' => $row['program_desc_five'], 
				'program_desc_six' => $row['program_desc_six'], 
				'program_desc_seven' => $row['program_desc_seven'],
				'program_desc_eight' => $row['program_desc_eight'],
				'program_desc_nine' => $row['program_desc_nine'],
				'program_desc_ten' => $row['program_desc_ten'],
				'program_desc_eleven' => $row['program_desc_eleven'],
				'program_display' => $row['program_display'], 
				'program_display_two' => $row['program_display_two'], 
				'program_display_three' => $row['program_display_three'], 
				'program_display_four' => $row['program_display_four'], 
				'program_display_five' => $row['program_display_five'], 
				'program_display_six' => $row['program_display_six'], 
				'program_display_seven' => $row['program_display_seven'], 
				'program_display_eight' => $row['program_display_eight'], 
				'program_display_nine' => $row['program_display_nine'], 

				'program_date' => date('Y-m-d H:i:s')
			);
			$query = $this->db->insert('program',$data);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = $row['program_name']." added successfully";
			} else {
				$valid['status'] = "warning";
				$valid['messages'] = "Can't add this".$row['program_name'];
			}
		return $valid;
	}

	public function edit_program_data($row){

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
            'program_name' => $row['edit_program_name'], 
            'program_title' => $row['edit_program_title'], 
            'program_title_two' => $row['edit_program_title_two'], 
            'program_title_three' => $row['edit_program_title_three'], 
            'program_title_four' => $row['edit_program_title_four'], 
            'program_title_five' => $row['edit_program_title_five'], 
            'program_title_six' => $row['edit_program_title_six'], 
            'program_title_seven' => $row['edit_program_title_seven'], 
            'program_title_eight' => $row['edit_program_title_eight'], 
            'program_title_nine' => $row['edit_program_title_nine'], 
            'program_title_ten' => $row['edit_program_title_ten'], 
            'program_title_eleven' => $row['edit_program_title_eleven'], 
            'program_desc' => $row['edit_program_desc'], 
            'program_desc_two' => $row['edit_program_desc_two'], 
            'program_desc_three' => $row['edit_program_desc_three'], 
            'program_desc_four' => $row['edit_program_desc_four'], 
            'program_desc_five' => $row['edit_program_desc_five'], 
            'program_desc_six' => $row['edit_program_desc_six'], 
            'program_desc_seven' => $row['edit_program_desc_seven'], 
            'program_desc_eight' => $row['edit_program_desc_eight'], 
            'program_desc_nine' => $row['edit_program_desc_nine'], 
            'program_desc_ten' => $row['edit_program_desc_ten'], 
            'program_desc_eleven' => $row['edit_program_desc_eleven'],
            'program_display' => $row['edit_program_display'], 
            'program_display_two' => $row['edit_program_display_two'], 
            'program_display_three' => $row['edit_program_display_three'], 
            'program_display_four' => $row['edit_program_display_four'], 
            'program_display_five' => $row['edit_program_display_five'], 
            'program_display_six' => $row['edit_program_display_six'], 
            'program_display_seven' => $row['edit_program_display_seven'], 
            'program_display_eight' => $row['edit_program_display_eight'], 
            'program_display_nine' => $row['edit_program_display_nine'], 
            'program_date' => date('Y-m-d H:i:s')
		);
		$valid = array();

		$query = $this->db->update('program',$data, 'program_id='.$row['program_id_2']);

		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = $row['edit_program_name']." updated successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't update this".$row['edit_program_name'];
		}	
		return $valid;
	}


	public function edit_image_only($row){

		$valid = array(); 
		$config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('edit_program_path'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$program_path = base_url("assets/uploads/".$file_data['file_name']);
		}

		if ( ! $this->upload->do_upload('edit_program_path_two'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$program_path_two = base_url("assets/uploads/".$file_data['file_name']);
		}
			$data = array('program_path' => $program_path,'program_path_two' => $program_path_two);


			$query = $this->db->update('program',$data,'program_id='.$row['program_id_1']);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = "Image updated successfully";
			} else {
				$valid['status'] = "warning";
				$valid['messages'] = "Can't update this image";
			}
		return $valid;
	}

	public function remove_Program($data)
	{		
		$query = $this->db->delete('program', $data);		
		$valid = array();
		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = "This program record deleted successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't Delete this program record";
		}	
		return $valid;
	}  


}
// model end here