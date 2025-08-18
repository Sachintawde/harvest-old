
<?php

if( isset( $_SESSION['error']) && !empty( $_SESSION['error'] )){
     echo "<script> window.onload = function(e) {
		e.preventDefault();
		notify('Error Box :  ','".$_SESSION['error']."','danger');
 }; </script>";
 
}

if ( isset( $_SESSION['success']) && !empty( $_SESSION['success'] )){
	echo "<script> window.onload = function(e) {
		e.preventDefault();
		notify('Success Box :  ','".$_SESSION['success']."','success');
	}; </script>";  

}


unset($_SESSION['error']);
unset($_SESSION['success']);  

?>

<script>
	/*
	 * Notifications
	 */ 
	function notify(title, message, type ){
		$.growl({
			icon: '',
			title: title,
			message: message,
			url: ''
		},{
				element: 'body', 
				type: type ,
				allow_dismiss: true,
				placement: {
						from: 'top',
						align: 'center'
				},
				offset: {
					x: 20,
					y: 85
				},
				spacing: 10,
				z_index: 1031,
				delay: 2500,
				timer: 5000,
				url_target: '_blank',
				mouse_over: false,
				animate: {
						enter: 'animated fadeInLeft',
						exit: 'animated fadeOutLeft'
				},
				icon_type: 'class',
				template: '<div data-growl="container" class="alert" role="alert">' +
								'<button type="button" class="close" data-growl="dismiss">' +
									'<span aria-hidden="true">&times;</span>' +
									'<span class="sr-only">Close</span>' +
								'</button>' +
								'<span data-growl="icon"></span>' +
								'<span data-growl="title"></span>' +
								'<span data-growl="message"></span>' +
								'<a href="#" data-growl="url"></a>' +
							'</div>'
		});
	};

</script>