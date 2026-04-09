<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_more_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_img($data)
	{		
		$sql = $this->db->get_where('gallery_pic', $data);
		$img = $sql->result();
		return $img;
	}

	public function get_single_img($data)
	{		
		$img_data = $this->db->get_where('gallery_pic',$data);
		$img = $img_data->row_array();
		return $img;
	}

	public function add_img($row){

		$valid = array();
		$img_sent = true;
		$data_img = [];
		$count_img = count($_FILES['img_path']['name']);
	
		for($i=0;$i<$count_img;$i++){	  
		  if(!empty($_FILES['img_path']['name'][$i])){	  	

			$_FILES['file_img']['name'] = $_FILES['img_path']['name'][$i];
			$_FILES['file_img']['type'] = $_FILES['img_path']['type'][$i];
			$_FILES['file_img']['tmp_name'] = $_FILES['img_path']['tmp_name'][$i];
			$_FILES['file_img']['error'] = $_FILES['img_path']['error'][$i];
			$_FILES['file_img']['size'] = $_FILES['img_path']['size'][$i];

			$config_img['upload_path'] = 'assets/uploads/'; 
			$config_img['allowed_types'] = 'jpg|jpeg|png|gif';
			$config_img['max_size'] = '5000';
			$config_img['file_name'] = $_FILES['file_img']['name'][$i];	 
			$this->load->library('upload');
			$this->upload->initialize($config_img);

	  
			if($this->upload->do_upload('file_img')){
			  $uploadData = $this->upload->data();
			  $file_path = "assets/uploads/".$uploadData['file_name'];
			  $file_name = $uploadData['file_name'];
			  $data_img['img_path'][] = $file_path;
			  $img_sent = true;	
			}else{
				$valid['status'] = "warning";
				$valid['messages'] = "Error Msg : ".$this->upload->display_errors();
				$img_sent = false;	
			}
		  }	 
		}

		if($img_sent)
		{

			if(isset($row['ytb_link'])) {
				$ytb_link = $row['ytb_link'];
			}else{
				$ytb_link = "-";
			}
		
			for($i = 0; $i<$count_img;$i++){
				$data_imgs = array(
					'gp_cat' => $row['img_cat'],
					'gp_g_id' => $row['gp_g_id'], 
					'gp_path' => $data_img['img_path'][$i],
					'gp_ytb_link' => $ytb_link,
					'gp_date' => date('Y-m-d H:i:s')
				);

				$query_img = $this->db->insert('gallery_pic',$data_imgs);
			}

			if ($query_img) {
				$valid['status'] = "success";
				$valid['messages'] = "Images Added successfully !";
			} else {
				$valid['status'] = "warning";
				$valid['messages'] = "Sorry ! Can't add images";
			}

		}		
		return $valid;
	}


	public function edit_img_data($row){

		if(isset($row['edit_ytb_link'])) {
			$ytb_link = $row['edit_ytb_link'];
		}else{
			$ytb_link = "-";
		}
	
		$data = array(
			'gp_cat' => $row['edit_img_cat'], 
			'gp_ytb_link' => $ytb_link,
			'gp_date' => date('Y-m-d H:i:s')
		);
		$valid = array();

		$query = $this->db->update('gallery_pic',$data, 'gp_id='.$row['img_id_2']);

		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = "Image updated successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't update this Image";
		}	
		return $valid;
	}


	public function edit_img_only($row){

		$valid = array();
		$config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);

		$old_record = $this->db->get_where('gallery_pic', array('gp_id' => $row['img_id_1']))->row_array();
		
		if ( ! $this->upload->do_upload('edit_img_path'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$path = "assets/uploads/".$file_data['file_name'];
		
			$data = array('gp_path' => $path);

			$query = $this->db->update('gallery_pic',$data,'gp_id='.$row['img_id_1']);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = "Image updated successfully";
				if (!empty($old_record['gp_path']) && strpos($old_record['gp_path'], 'assets/uploads/') !== false) {
					$old_file = './assets/uploads/' . basename($old_record['gp_path']);
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
		$query = $this->db->delete('gallery_pic', $data);		
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