<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_all_event()
	{		
		$data = $this->db->get('event');
		$event = $data->result();		
		return $event;
	}

	public function get_single_event($data)
	{		
		$event_data = $this->db->get_where('event',$data);
		$event = $event_data->row_array();
		return $event;
	}
	
public function add_event($row) {
        $valid = array(); 
        $config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('event_path')) {
            // If no file is uploaded, use default image
            $path = "assets/home/images/others/little_boy.png";
        } else {
            // If file is uploaded, use the uploaded file
            $file_data = $this->upload->data();
            $path = "assets/uploads/".$file_data['file_name'];
        }
        
        if(isset($row['ytb_link'])) {
            $ytb_link = $row['ytb_link'];
            $ext_link = "-";
        } else if(isset($row['ext_link'])) {
            $ext_link = $row['ext_link'];
            $ytb_link = "-";
        } else {
            $ytb_link = "-";
            $ext_link = "-";
        }

        $data = array(
            'event_path'      => $path,
            'event_name'      => $row['event_name'], 
            'event_start'     => $row['event_start'], 
            'event_end'       => $row['event_end'], 
            'event_classname' => $row['event_classname'], 
            'event_icon'      => $row['event_icon'], 
            'event_desc'      => $row['event_desc'], 
            'event_type'      => $row['event_type'], 
            'event_location'  => $row['event_location'],
            'event_date'      => date('Y-m-d H:i:s')
        );

        $query = $this->db->insert('event', $data);

        if ($query) {
            $valid['status']   = "success";
            $valid['messages'] = $row['event_name']." added successfully";
        } else {
            $valid['status']   = "warning";
            $valid['messages'] = "Can't add this ".$row['event_name'];
        }

        return $valid;
    }

	public function edit_event_data($row){

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
			'event_name' => $row['edit_event_name'], 
			'event_start' => $row['edit_event_start'], 
			'event_end' => $row['edit_event_end'], 
			'event_classname' => $row['edit_event_classname'], 
			'event_icon' => $row['edit_event_icon'], 
			'event_desc' => $row['edit_event_desc'], 
			'event_type' => $row['edit_event_type'], 
			'event_location' => $row['edit_event_location'],
			'event_date' => date('Y-m-d H:i:s')
		);
		$valid = array();

		$query = $this->db->update('event',$data, 'event_id='.$row['event_id_2']);

		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = $row['edit_event_name']." updated successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't update this".$row['edit_event_name'];
		}	
		return $valid;
	}


	public function edit_image_only($row){

		$valid = array(); 
		$config['upload_path']   = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload', $config);

		$old_record = $this->db->get_where('event', array('event_id' => $row['event_id_1']))->row_array();
		
		if ( ! $this->upload->do_upload('edit_event_path'))
		{
			$valid['status'] = "warning";
			$valid['messages'] = "Error : ".$this->upload->display_errors();
		}
		else
		{
			$file_data = $this->upload->data();
			$path = "assets/uploads/".$file_data['file_name'];
		
		
			$data = array('event_path' => $path);

			$query = $this->db->update('event',$data,'event_id='.$row['event_id_1']);

			if ($query) {
				$valid['status'] = "success";
				$valid['messages'] = "Image updated successfully";
				if (!empty($old_record['event_path']) && strpos($old_record['event_path'], 'assets/uploads/') !== false) {
					$old_file = './assets/uploads/' . basename($old_record['event_path']);
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

	public function remove_Event($data)
	{		
		$query = $this->db->delete('event', $data);		
		$valid = array();
		if ($query) {
			$valid['status'] = "success";
			$valid['messages'] = "This event record deleted successfully";
		} else {
			$valid['status'] = "warning";
			$valid['messages'] = "Can't Delete this event record";
		}	
		return $valid;
	}  


}
// model end here