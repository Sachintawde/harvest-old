<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends ADMIN_Controller {

	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
    }
    public function index(){
        $this->load->view("blog");
    } 

    public function get_all_blog(){
        $this->load->model("blog_model");
        $blog = $this->blog_model->get_all_blog();
        $output = array('data' => array());
 
        foreach($blog as $row) {
            $blog_id = $row->blog_id;
            $imageUrl = img_url($row->blog_path);
        
            $blog = "<img class='img-round' title='".$imageUrl."' src='".$imageUrl."' style='height:30px; width:50px;'  />";
        
            $button = '<!-- Single button -->
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
              </button>
                <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" data-target="#viewBlogModal" onclick="viewBlog('.$blog_id.')"> <i class="glyphicon glyphicon-eye-open"></i> View Blog</a></li>
                <li><a type="button" data-toggle="modal" data-target="#editBlogModal" onclick="editBlog('.$blog_id.')"> <i class="glyphicon glyphicon-edit"></i> Edit Blog</a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeBlogModal" onclick="removeBlog('.$blog_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
              </ul>
            </div>';
        
            $output['data'][] = array( 		
                $blog,
                $row->blog_name,
                $row->blog_desc,
                date('m-d-Y', strtotime($row->blog_datee)),
                $button
            ); 	        
        }
        echo json_encode($output);
    }

    public function get_single_blog(){
        $data['blog_id'] = $this->input->post("blog_id");
        $this->load->model("blog_model");
        $d = $this->blog_model->get_single_blog($data);
        if (isset($d['blog_path'])) {
            $d['blog_path'] = img_url($d['blog_path']);
        }
        echo json_encode($d);
    }
    
	public function add_blog(){ 
        $post_data = $this->input->post();    
		$this->load->model("blog_model");
		$d = $this->blog_model->add_blog($post_data);
		echo json_encode($d);		
	}

	public function edit_blog_data(){
        $post_data = $this->input->post();        
		$this->load->model("blog_model");
		$d = $this->blog_model->edit_blog_data($post_data);
		echo json_encode($d);		 
    }

	public function edit_image_only(){
        $post_data = $this->input->post();   
        // print_r($_FILES);
        // die;     
		$this->load->model("blog_model");
		$d = $this->blog_model->edit_image_only($post_data);
		echo json_encode($d);		
    }
    
    public function remove_Blog(){
        $data['blog_id'] = $this->input->post("blog_id");
        $this->load->model("blog_model");
        $d = $this->blog_model->remove_blog($data);       
        echo json_encode($d); 
    }

}