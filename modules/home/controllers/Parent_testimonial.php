<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parent_testimonial extends HOME_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
   }

   public function index(){
      $this->load->model("testimonial_model");
      $testimonial = $this->testimonial_model->get_all_testimonial();
      $data['testimonial'] = $testimonial;
      $this->load->view('parent-testimonial', $data);     
   } 
   

  public function details($testimonial_id){ 
      $post['t_id'] = $testimonial_id;
      $this->load->model("testimonial_model");
      $d = $this->testimonial_model->get_single_testimonial($post);
      $data['testimonial'] = $d;
      $this->load->view('parent-testimonial', $data);  
  }
}
?>