<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curriculum extends HOME_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
   }

   public function index(){
      $this->load->model("curriculum_model");
      $curriculum = $this->curriculum_model->get_all_curriculum();
      $data['curriculum'] = $curriculum;
      $this->load->view('curriculum', $data);   
   } 
   

  public function details($curriculum_id){
      $post['c_id'] = $curriculum_id;
      $this->load->model("curriculum_model");
      $d = $this->curriculum_model->get_single_curriculum($post);
      $data['curriculum'] = $d;
      $this->load->view('curriculum', $data);  
  }
}
?>