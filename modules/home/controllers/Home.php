<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends HOME_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
   }

   public function index(){
      $data = array();
      $this->load->model("gallery_model");
      $this->load->model("event_model"); 
      $this->load->model("testimonial_model");
      $this->load->model("program_model");
      $this->load->model("popup_model");


      
      $get = array('img_cat' => "Banner");
      $gallery = $this->gallery_model->get_page_gallery($get);      
      $reversedGallery = array_reverse($gallery);      
      $data['gallery'] = $reversedGallery;
      
      /////////////////////////////////////
      $get = array('img_cat' => "Image");
      $gallery = $this->gallery_model->get_home_gallery($get, 8); // Limit the result to 8 records
      $type = $this->gallery_model->get_gallery_type($get);
      $data['gallery_image'] = $gallery;
      $data['type'] = $type;
      ///////////////////////////////////////////// 
      $event = $this->event_model->get_home_event();
      $data['event'] = $event;
      ////////////////////////////
      $popup = $this->popup_model->get_popup(); 
      $data['popup'] = $popup; 
      ////////////////////////////
      $event_daily = $this->event_model->get_event_daily();
      $data['event_daily'] = $event_daily;
      //////////////////////////// 
      $program = $this->program_model->get_home_program();
      $data['program'] = $program;
      //////////////////////////// 
      $testimonial = $this->testimonial_model->get_all_testimonial();
      $data['testimonial'] = $testimonial;

      $this->load->view('index', $data);
   }

   public function program($page){
      $this->load->model("program_model");
      $p = strtolower(str_replace("-"," ",$page));
      $pd['program_name'] = $p;
      $program = $this->program_model->get_single_program($pd); 

      $data['program'] = $program;
      $this->load->view('program', $data);
   }


   // public function error(){
   //    $this->load->view('404', $data);
   // }

}
?>