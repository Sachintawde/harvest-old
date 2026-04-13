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

	public function update_smtp($row){
		$this->load->library('env');
		$env_file = $this->env->get_env_file();

		if (!$env_file || !is_writable($env_file)) {
			return ['status' => 'warning', 'messages' => 'Environment file is not writable'];
		}

		$allowed = ['MAIL_HOST', 'MAIL_PORT', 'MAIL_USERNAME', 'MAIL_PASSWORD',
		            'MAIL_ENCRYPTION', 'MAIL_FROM_ADDRESS', 'MAIL_FROM_NAME'];

		$content = file_get_contents($env_file);

		foreach ($allowed as $key) {
			if (isset($row[$key])) {
				$value = str_replace(["\r", "\n"], '', $row[$key]);
				$content = $this->_update_env_key($content, $key, $value);
			}
		}

		if (file_put_contents($env_file, $content) !== false) {
			return ['status' => 'success', 'messages' => 'SMTP settings updated successfully'];
		}
		return ['status' => 'warning', 'messages' => 'Failed to write environment file'];
	}

	public function update_admin_smtp($row){
		$this->load->library('env');
		$env_file = $this->env->get_env_file();

		if (!$env_file || !is_writable($env_file)) {
			return ['status' => 'warning', 'messages' => 'Environment file is not writable'];
		}

		$allowed = ['ADMIN_MAIL_HOST', 'ADMIN_MAIL_PORT', 'ADMIN_MAIL_USERNAME', 'ADMIN_MAIL_PASSWORD',
		            'ADMIN_MAIL_ENCRYPTION', 'ADMIN_MAIL_FROM_ADDRESS', 'ADMIN_MAIL_FROM_NAME', 'ADMIN_MAIL_TO'];

		$content = file_get_contents($env_file);

		foreach ($allowed as $key) {
			if (isset($row[$key])) {
				$value = str_replace(["\r", "\n"], '', $row[$key]);
				$content = $this->_update_env_key($content, $key, $value);
			}
		}

		if (file_put_contents($env_file, $content) !== false) {
			return ['status' => 'success', 'messages' => 'Admin SMTP settings updated successfully'];
		}
		return ['status' => 'warning', 'messages' => 'Failed to write environment file'];
	}

	public function update_applicant_smtp($row){
		$this->load->library('env');
		$env_file = $this->env->get_env_file();

		if (!$env_file || !is_writable($env_file)) {
			return ['status' => 'warning', 'messages' => 'Environment file is not writable'];
		}

		$allowed = ['APPLICANT_MAIL_HOST', 'APPLICANT_MAIL_PORT', 'APPLICANT_MAIL_USERNAME', 'APPLICANT_MAIL_PASSWORD',
		            'APPLICANT_MAIL_ENCRYPTION', 'APPLICANT_MAIL_FROM_ADDRESS', 'APPLICANT_MAIL_FROM_NAME'];

		$content = file_get_contents($env_file);

		foreach ($allowed as $key) {
			if (isset($row[$key])) {
				$value = str_replace(["\r", "\n"], '', $row[$key]);
				$content = $this->_update_env_key($content, $key, $value);
			}
		}

		if (file_put_contents($env_file, $content) !== false) {
			return ['status' => 'success', 'messages' => 'Applicant SMTP settings updated successfully'];
		}
		return ['status' => 'warning', 'messages' => 'Failed to write environment file'];
	}

	/**
	 * Replace an existing KEY=value line in env content, or append the key if absent.
	 */
	private function _update_env_key($content, $key, $value)
	{
		$pattern = '/^' . preg_quote($key, '/') . '=.*/m';
		$line    = $key . '=' . $value;

		if (preg_match($pattern, $content)) {
			return preg_replace($pattern, $line, $content);
		}

		// Key not found — append after the last line (with trailing newline)
		return rtrim($content) . "\n" . $line . "\n";
	}
	
}
// model end here