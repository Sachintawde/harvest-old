<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    }
    public function index(){
         $this->load->view("login");
    }
    public function auth(){
         $this->form_validation->set_rules("u_mail", "User Mail", "required|valid_email");
         $this->form_validation->set_rules("u_pswd", "User Password", "required|min_length[3]");

         $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

         if($this->form_validation->run()){
             $data['u_mail'] = $this->input->post("u_mail");
             $u_pswd = $this->input->post("u_pswd");
             $data['u_pswd'] = md5($u_pswd);
             
             $this->load->model("admin_model");
             $this->admin_model->is_validate($data);

         }else{
            $this->load->view("login");
         }
    }
    public function logout(){
        
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            $this->session->unset_userdata($key);
        }
        $this->session->set_userdata(array('msg_type'=>'success'));		
        $this->session->set_flashdata('success', 'Logout Successfully');
        return redirect("admin");

    }

}
