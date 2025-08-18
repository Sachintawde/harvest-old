$(document).ready(function () {
	// main menu
	$(".navSetting").addClass('active');
	// sub manin
	$("#user").addClass('in').addClass('active');	
	$(".topNavSetting").addClass('active');

	// change usermail
	$("#changeUsermailForm").unbind('submit').bind('submit', function () {
		var form = $(this);
		var usermail = $("#u_mail").val();

		if (usermail == "") {
			$("#u_mail").after('<p class="text-danger">User mail field is required</p>');
			$("#u_mail").closest('.form-group').addClass('has-error');
		} else {
			$(".text-danger").remove();
			$('.form-group').removeClass('has-error');
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success: function (response) {
					// remove text-error 
					$(".text-danger").remove();
					// remove from-group error
					$(".form-group").removeClass('has-error').removeClass('has-success');
					var alert = (response.success) ? 'alert-success': 'alert-warning';
					// shows a successful message after operation
					$('.changeUsenrameMessages').html('<div class="alert '+alert+'">' +
						'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
						'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
						'</div>');

					// remove the mesages
					$("."+alert).delay(500).show(10, function () {
						$(this).delay(3000).hide(10, function () {
							$(this).remove();
						});
					}); // /.alert	          					
				} // /success 
			}); // /ajax
		}

		return false;
	});

	$("#changeUserPasswordForm").unbind('submit').bind('submit', function () {

		var form = $(this);
		var formData = new FormData(this);

		$("input").each(function() {
			var element = $(this);
			if (element.val() == "") {
				 isValid = false;
				 $(this).after('<p class="text-danger"> This field is required </p>');
				 $(this).closest('.form-group').addClass('has-error');
			} else {
				 isValid = true;
				 $(this).closest('.form-group').addClass('has-success');
			} // /else   
		});

		if(isValid){
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: formData,
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				success: function (response) {
					$('.changeUserPasswordMessage').html('<div class="alert alert-'+response.status+'">' +
						'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
						'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
						'</div>');

					// remove the mesages
					$(".alert-"+response.status).delay(500).show(10, function () {
						$(this).delay(3000).hide(10, function () {
							$(this).remove();
						});
					}); // /.alert	    
				} // /success function
			}); // /ajax function
		}
		return false;
	});
}); // /document