<?php
class Setting extends ADMIN_Controller {

	public function __construct() {					
		parent::__construct(); 
	}
	 
	public function index(){
		$this->load->helper('env');

		$data['smtp'] = [
			'MAIL_HOST'         => env('MAIL_HOST', 'smtp.office365.com'),
			'MAIL_PORT'         => env('MAIL_PORT', 587),
			'MAIL_USERNAME'     => env('MAIL_USERNAME', ''),
			'MAIL_PASSWORD'     => env('MAIL_PASSWORD', ''),
			'MAIL_ENCRYPTION'   => env('MAIL_ENCRYPTION', 'tls'),
			'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS', ''),
			'MAIL_FROM_NAME'    => env('MAIL_FROM_NAME', ''),
			'ADMIN_MAIL_TO'     => env('ADMIN_MAIL_TO', ''),
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

	public function update_smtp(){
		$post = $this->input->post();
		$this->load->model('setting_model');
		$d = $this->setting_model->update_smtp($post);
		echo json_encode($d);
	}

}
// End of controller