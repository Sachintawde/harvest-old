<?php
class Setting extends ADMIN_Controller {

	public function __construct() {					
		parent::__construct(); 
	}
	 
	public function index(){
		$this->load->helper('env');

		$data['admin_smtp'] = [
			'ADMIN_MAIL_HOST'         => env('ADMIN_MAIL_HOST', ''),
			'ADMIN_MAIL_PORT'         => env('ADMIN_MAIL_PORT', ''),
			'ADMIN_MAIL_USERNAME'     => env('ADMIN_MAIL_USERNAME', ''),
			'ADMIN_MAIL_PASSWORD'     => env('ADMIN_MAIL_PASSWORD', ''),
			'ADMIN_MAIL_ENCRYPTION'   => env('ADMIN_MAIL_ENCRYPTION', 'tls'),
			'ADMIN_MAIL_FROM_ADDRESS' => env('ADMIN_MAIL_FROM_ADDRESS', ''),
			'ADMIN_MAIL_FROM_NAME'    => env('ADMIN_MAIL_FROM_NAME', ''),
			'ADMIN_MAIL_TO'           => env('ADMIN_MAIL_TO', ''),
		];

		$data['applicant_smtp'] = [
			'APPLICANT_MAIL_HOST'         => env('APPLICANT_MAIL_HOST', ''),
			'APPLICANT_MAIL_PORT'         => env('APPLICANT_MAIL_PORT', ''),
			'APPLICANT_MAIL_USERNAME'     => env('APPLICANT_MAIL_USERNAME', ''),
			'APPLICANT_MAIL_PASSWORD'     => env('APPLICANT_MAIL_PASSWORD', ''),
			'APPLICANT_MAIL_ENCRYPTION'   => env('APPLICANT_MAIL_ENCRYPTION', 'ssl'),
			'APPLICANT_MAIL_FROM_ADDRESS' => env('APPLICANT_MAIL_FROM_ADDRESS', ''),
			'APPLICANT_MAIL_FROM_NAME'    => env('APPLICANT_MAIL_FROM_NAME', ''),
		];

		$this->load->view('setting', $data);
	}

	public function update_mail(){
		$u_id = $this->input->post("u_id");
		$u_mail = $this->input->post("u_mail");		
        $this->load->model("setting_model");
        $d = $this->setting_model->edit_mail($u_id, $u_mail);
        echo json_encode($d);		
	}

	public function update_pswd(){
		$post_data = $this->input->post();
		$this->load->model("setting_model");
		$d = $this->setting_model->edit_pswd($post_data);
		echo json_encode($d);		
	}

	public function update_admin_smtp(){
		$post = $this->input->post();
		$this->load->model('setting_model');
		$d = $this->setting_model->update_admin_smtp($post);
		echo json_encode($d);
	}

	public function update_applicant_smtp(){
		$post = $this->input->post();
		$this->load->model('setting_model');
		$d = $this->setting_model->update_applicant_smtp($post);
		echo json_encode($d);
	}

	// Legacy endpoint — kept for backward compatibility
	public function update_smtp(){
		$post = $this->input->post();
		$this->load->model('setting_model');
		$d = $this->setting_model->update_smtp($post);
		echo json_encode($d);
	}

}
// End of controller