<?php defined('BASEPATH') OR exit('No direct script access allowed');
function validation_message($style="")
{	
  
	$processing_result=validation_errors();
	
	if($processing_result!='')
	{	
	?>

         
         
         							<div class="alert alert-danger">
									<button class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>

									<i class="ace-icon fa fa-hand-o-right"></i>
	 Please correct the invalid enteries in form given below.
   	<?php echo $processing_result; ?>
	   	</div>

<?php
	 
 }
}
 function error_message($style="")
 {  
 
  $ci = &get_instance();
  $msgtype = $ci->session->userdata('msg_type');
  
   if( $msgtype )
   {	 
   

 ?>
 

  								<div class="alert alert-<?php echo $msgtype;?>">
									<button class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>

									<i class="ace-icon fa fa-hand-o-right"></i>
	   <?php echo $ci->session->flashdata($msgtype);  $ci->session->unset_userdata(array('msg_type'=>0) ); ?>
	   	</div>


		  <?php
	
    }   
  } 
 ?>