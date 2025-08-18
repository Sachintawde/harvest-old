<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Social_setting_model extends MY_Model{

   public function __construct(){
   
     parent::__construct();
	 
   }
	

	public function get_social_by_id($id)
	{
		$condtion = "social_id ='$id' ";
		$fetch_config = array(
							  'condition'=>$condtion,
							  'debug'=>FALSE,
							  'return_type'=>"array"							  
							  );		
		$result = $this->find('tbl_social_profile',$fetch_config);
		return $result;	
	}
	
	
	
}