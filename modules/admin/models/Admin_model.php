<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_model extends CI_Model{

  	public function __construct(){

		  parent::__construct();	
 	}
 
 
 	public function is_validate($data){
	 
		$query = $this->db->get_where('users',$data);	 

		if ($query->num_rows() > 0) {

			$row = $query->row_array();
			$sess_arr = array(
							'u_name' => $row['u_name'],
							'u_mail'    => $row['u_mail'],
							'u_id' 	=> $row['u_id'],
							'admin_logged_in' => TRUE
							);

		$this->session->set_userdata($sess_arr);
		$this->session->set_userdata(array('msg_type'=>'success'));		
		$this->session->set_flashdata('success', 'Login Successfully');

		redirect('admin/dashboard');	

		}else{	
			$this->session->set_userdata(array('msg_type'=>'error'));		
			$this->session->set_flashdata('error', 'Invalid username/password');
			redirect('admin');	
		}	 
 	}

	public function get_recent_msg(){
		$data = $this->db->get_where('message','msg_added_date >= ( CURDATE() - INTERVAL 5 DAY )');
		$recent_msg = $data->result();
		return $recent_msg;
	}

	public function get_recent_book(){
		$data = $this->db->get_where('booking','book_added_date >= ( CURDATE() - INTERVAL 5 DAY )');
		$recent_book = $data->result();
		return $recent_book;
	}

}
/* End of file mstudent.php */
/* Location: ./system/application/models/mstudent.php */