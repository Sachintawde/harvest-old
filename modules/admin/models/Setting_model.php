<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting_model extends CI_Model{

   public function __construct()
   {   
     parent::__construct();     
    }

	public function edit_mail($u_id, $u_mail){
		
		$cond = array('u_id !=' => $u_id, 'u_mail = ' => $u_mail);
		$valid = array();

		$total_mail = $this->db->get_where('users',$cond);
		if($total_mail->num_rows()){
			$valid['status'] = "warning";
			$valid['messages'] = "Mail id allready used";
		}else{
			$data = array('u_mail' => $u_mail);
			$query = $this->db->update('users', $data, 'u_id='.$u_id);
			if($query){
				$this->session->set_userdata($data);

				$valid['status'] = "success";
				$valid['messages'] = "Mail id changed successfully";
			}else{
				$valid['status'] = "warning";
				$valid['messages'] = $this->db->error();
			}
		}
		return $valid;
	}

	public function edit_pswd($row){
		
		$cond = array('u_id =' => $row['u_id'], 'u_pswd = ' => md5($row['password']));
		$valid = array();

		$total_mail = $this->db->get_where('users',$cond);

		if($row['npassword'] == $row['cpassword']){
			if($total_mail->num_rows()){
				$u_pswd = md5($row['npassword']);
				$data = array('u_pswd' => $u_pswd);
				$query = $this->db->update('users', $data, 'u_id='.$row['u_id']);
				if($query){
					$valid['status'] = "success";
					$valid['messages'] = "Password changed successfully";
				}else{
					$valid['status'] = "warning";
					$valid['messages'] = $this->db->error();
				}
			}else{
				$valid['status'] = "warning";
				$valid['messages'] = "Old password not matched";
			}
		} else{
			$valid['status'] = "warning";
			$valid['messages'] = "Confirm password not matched";
		}		
		return $valid;
	}
	
}
// model end here