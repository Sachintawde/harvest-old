<?php
	$status = $this->session->userdata('status');
    $messages = $this->session->userdata('messages');

    if(isset($status) && isset($messages)){
        $type = ($status == 'success')?'success':'error';
        $title = ($status == 'success')?'Success':'Error';

		echo "
		<script>
		 window.onload = function(e) {
			e.preventDefault();			
			new PNotify({title: '".$title."',text: '".$messages."',type: '".$type."',styling: 'bootstrap3'});
		 }
        </script>";    
    }

    $this->session->unset_userdata('status');
    $this->session->unset_userdata('messages');
?>
