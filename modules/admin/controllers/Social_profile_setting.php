<?php
class Social_profile_setting extends Admin_Controller {

	 public function __construct() {
			
			
			parent::__construct(); 
			$this->load->model(array('adminzone/social_setting_model')); 
			$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
 
	 }
	 
	 public  function index($page = null){	
	         
		 $data['heading_title'] = 'Social Profile Setting';	
		
		 $data['social_info'] = $this->social_setting_model->get_social_by_id(1);		
		 $this->load->view('dashboard/social_setting_edit_view',$data);

		
	   }
	   
	   public function edit(){
		   
		       $this->form_validation->set_rules('facebook', 'Facebook', 'required');
			   $this->form_validation->set_rules('google', 'Google+', 'required');
			   $this->form_validation->set_rules('twitter', 'Twitter',  'required');
			   $this->form_validation->set_rules('instagram', 'Instagram',  'trim|required');
			   $this->form_validation->set_rules('youtube', 'Youtube', 'required');
			  
			 if ($this->form_validation->run() == TRUE)
			 {	
			 		$id = $this->input->post('social_id');
				 $data     = array(
				 				'facebook'	=>	$this->input->post('facebook',TRUE),
				 				'google'	=>	$this->input->post('google',TRUE),
							   	'twitter'	=>	$this->input->post('twitter',TRUE),
					 			'linkedIn'	=>	$this->input->post('linkedIn',TRUE),
							 	'instagram'	=>	$this->input->post('instagram',TRUE),
							  	'youtube'	=>	$this->input->post('youtube',TRUE),
							 );	
			
				$where = "social_id=".$id." ";
				$this->social_setting_model->safe_update('tbl_social_profile',$data,$where,FALSE);		
				$this->session->set_userdata('msg_type',"success" ); 
				$this->session->set_flashdata('success',"Record has been updated successfully." ); 
		   
		
				  
			     redirect('adminzone/social_profile_setting/','');
			   
			  }
			  
			 $data['heading_title'] = 'Social Profile Setting'; 
			 $data['social_info'] = $this->social_setting_model->get_social_by_id(1);		
		     $this->load->view('dashboard/social_setting_edit_view',$data);  
		
	   }
	   
}
// End of controller