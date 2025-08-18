<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends HOME_Controller {

	public function __construct(){
	   ob_start();
	   parent::__construct();
   }

   public function index(){
      $data = array();
      $this->load->model("gallery_model");
      $get = array('img_cat' => "Image");
      $gallery = $this->gallery_model->get_page_gallery($get);
      $type = $this->gallery_model->get_gallery_type($get);
      $data['gallery'] = $gallery;
      $data['type'] = $type;
      $this->load->view('picture-gallery', $data);
   }  
   public function award(){
      $data = array();
      $this->load->model("gallery_model");
      $get = array('img_cat' => "Award");
      $gallery = $this->gallery_model->get_page_gallery($get);
      $type = $this->gallery_model->get_gallery_type($get);
      $data['gallery'] = $gallery;
      $data['type'] = $type;
      $this->load->view('award', $data);
   }  

   // public function demo(){
   //    $data = array();
   //    $this->load->model("gallery_model");
   //    $get = array('img_cat' => "Demo");
   //    $gallery = $this->gallery_model->get_page_gallery($get);
   //    $type = $this->gallery_model->get_gallery_type($get);
   //    $data['gallery'] = $gallery;
   //    $data['type'] = $type;
   //    $this->load->view('demo_lecture', $data);
   // }  
} 
?>