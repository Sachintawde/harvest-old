<?php
class Setting extends ADMIN_Controller {

	public function __construct() {					
		parent::__construct(); 
	}
	 
	public  function index(){	
		$this->load->view('setting',$data);
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

}
// End of controller