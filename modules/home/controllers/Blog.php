<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends HOME_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct(); 
   }

   public function index(){
      $this->load->model("blog_model");
      $blog = $this->blog_model->get_all_blog(); 
      $data['blog'] = $blog;
      $this->load->view('blog', $data);    
   } 
 
 
  public function details($blog_name){
      $blog_name = str_replace("_"," ",$blog_name);
      $blog_name = ucfirst($blog_name);
      $post['blog_name'] = $blog_name; 
      $this->load->model("blog_model");
      $d = $this->blog_model->get_single_blog($post);
      $data['blog'] = $d;

      $latest = $this->blog_model->get_latest_blog($d['blog_id']);
      // print_r($latest);
      // die;
      $data['latest'] = $latest;
      $this->load->view('blog-details', $data);  
  }
}
?> 