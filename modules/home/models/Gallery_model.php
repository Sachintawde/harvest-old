<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gallery_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}
	
	public function get_all_gallery(){	
        $data = $this->db->order_by('pic_added_date', 'DESC')->get_where('gallery','pic_status=1');
		$gallery = $data->result();
		return $gallery; 
	}
	
	public function get_single_gallery($data){
		$gallery_data = $this->db->get_where('gallery',$data);
		$gallery = $gallery_data->row_array();
		return $gallery;
	}  
 
    public function get_page_gallery($data){
        $gallery_data = $this->db->order_by('img_id', 'ASC')->get_where('gallery', $data);
        $gallery = $gallery_data->result();
        return $gallery;
    }
 

	public function get_home_gallery($data, $limit = 10) {
		$this->db->order_by('img_id', 'ASC');
		$this->db->limit($limit);
		$gallery_data = $this->db->get_where('gallery', $data);
		$gallery = $gallery_data->result();
		return $gallery;
	}
	

	public function get_gallery_type($data){ 
		$cat = $data['img_cat'];
		// $cat = "image";
		$query = $this->db->query("SELECT img_sub FROM gallery WHERE img_cat='$cat' GROUP BY img_sub");
        $type = $query->result();
		return $type;
	}  
} 