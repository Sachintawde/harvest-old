
var manageContactTable;

$(document).ready(function() {
	// top bar active
	$('.navContact').addClass('active');
	
	// manage Image table
	manageContactTable = $("#manageContactTable").DataTable({
		'ajax': 'contact/get_all_contact',
		'image': [],
		dom: 'Bfrtip',
		responsive: true,
		buttons: [{
		  extend: 'pdf',
		  title: 'harvest Image List',
		  filename: 'harvest_contact_pdf',
		  exportOptions: {
				columns: [ 0, ':visible' ]
		  }      
		}, 
		{
		  extend: 'excel',
		  title: 'harvest Image List',
		  filename: 'CP_contact_excel',
		  exportOptions: {
				columns: [ 0, ':visible' ]
		  }      
		}, 
		{	
		  extend: 'print',
		  title: 'harvest Image List',
		  text: 'print',
		  autoPrint: false,
		  exportOptions: {
				columns: [ 0, ':visible' ]
		  }      
		}, 
		'colvis'
	  ]		
	});

    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').datepicker('getDate');
            var max = $('#max').datepicker('getDate');
            var startDate = new Date(data[5]);
            if (min == null && max == null) {
                return true;
            }
            if (min == null && startDate <= max) {
                return true;
            }
            if (max == null && startDate >= min) {
                return true;
            }
            if (startDate <= max && startDate >= min) {
                return true;
            }
            return false;
        }
    );

    $("#min").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        changeMonth: true,
        changeYear: true
    }).on('changeDate', function () {
        manageContactTable.draw();
    });
    $("#max").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        changeMonth: true,
        changeYear: true
    }).on('changeDate', function () {
        manageContactTable.draw();
    });
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function () {
        manageContactTable.draw();
    });


	// add product modal btn clicked
	$("#addContactModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitContactForm")[0].reset();		
		$('.myprogress').css('width', '0'); 
		$('.up_msg').text('');			

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#con_path").fileinput({  
			
			overwriteInitial: true,
			maxFileSize: 2500,
			showClose: false,
			showCaption: false,
			defaultPreviewContent: '<img src="'+base_url+'assets/admin/images/profile.png" alt="Image / Thumbnail" style="display:block; margin: 0 auto; width: 30%;">',
			layoutTemplates: {
				main2: '{preview} {remove} {browse}'
			},
			allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF", "jpeg"]
		});   

        // submit Image form function
        $("#submitContactForm").unbind('submit').bind('submit', function() {

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
			$('.myprogress').css('width', '0');
			$('.up_msg').text('');			
			var isValid = true;

			$('#submitContactForm input[type="text"], #submitContactForm input[type="file"]').each(function() {
				var element = $(this);
				if (element.val() == "") {
					 isValid = false;
					 element.closest('.form-group').append('<span class="text-danger"> This field is required </span>');
					 element.closest('.form-group').addClass('has-error');
				} else {
					// remove text-error 
						if(element.closest('span').hasClass('text-danger')){
							element.closest(".text-danger").remove();
							element.closest('.form-group').addClass('has-success');
						}else{
							isValid = true;
						}
				} // /else   
			});

            if(isValid == true) {
				$('#createContactBtn').attr('disabled', 'disabled');
				$('.up_msg').text('Uploading in progress...');				
				var form = $(this);
				var formData = new FormData(this);

                $.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false, 
					xhr: function () {
						var xhr = new window.XMLHttpRequest();
						xhr.upload.addEventListener("progress", function (evt) {
							if (evt.lengthComputable) {
								var percentComplete = evt.loaded / evt.total;
								percentComplete = parseInt(percentComplete * 100);
								$('.myprogress').text(percentComplete + '%');
								$('.myprogress').css('width', percentComplete + '%');
							}
						}, false);
						return xhr;
					},					
					success:function(response) { 

						// submit loading button
						$("#createContactBtn").removeAttr('disabled');
						$('.up_msg').text(response.messages);

						// reload the manage student table
						manageContactTable.ajax.reload(null, true);

						// remove text-error 
						$(".text-danger").remove();
						// remove from-group error
						$(".form-group").removeClass('has-error').removeClass('has-success');
                    } // /success
                }); // /ajax	
            } // if

            return false;
        }); // /submit Image form function

    });

});


function viewContact(Contact_id = null) {
	if(Contact_id) {
		$('.myprogress').css('width', '0');
		$('.up_msg').text('');			
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');
		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.view-Image-result').addClass('div-hide');
		// modal footer
		$('.viewContactFooter').addClass('div-hide');

		$.ajax({
			url: 'contact/get_single_contact',
			type: 'post',
			data: {con_id : Contact_id},
			dataType: 'json',
			success:function(response) {

				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.view-Image-result').removeClass('div-hide');
				// modal footer
                $('.viewContactFooter').removeClass('div-hide');
				// setting the Contact name value 
				

				$('.view_contact_data').html(
					'<div class="row">' +
					'<div class="col-md-12">' +
					'<table class="table table-bordered table-striped">' +
					'<tr><th style="width:35%">First Name</th><td>' + response['con_name'] + '</td></tr>' +
					'<tr><th>Last Name</th><td>' + response['con_lname'] + '</td></tr>' +
					'<tr><th>Email</th><td>' + response['con_mail'] + '</td></tr>' +
					'<tr><th>Phone</th><td>' + (response['con_mob'] || '—') + '</td></tr>' +
					'<tr><th>Program of Interest</th><td>' + (response['con_kid'] || '—') + '</td></tr>' +
					'<tr><th>Message</th><td>' + (response['con_msg'] || '—') + '</td></tr>' +
					'</table>' +
					'</div></div>'
				);
			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit Images function

function editContact(Contact_id = null) {
	if(Contact_id) {

		$("#editContactForm")[0].reset();		
		$("#updateContactForm")[0].reset();		

		$('.myprogress').css('width', '0');
		$('.up_msg').text('');			

		$("#con_id").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal result
		$('.div-result').addClass('div-hide');
		// modal footer 
		$('.editContactImageFooter').addClass('div-hide');

		$.ajax({
			url: 'contact/get_single_contact',
			type: 'post',
			data: {con_id : Contact_id},
			dataType: 'json', 
			success:function(response) {

				// modal loading
				$('.div-loading').addClass('div-hide');
				// modal result
				$('.div-result').removeClass('div-hide');
				// modal footer
				$('.editContactImageFooter').removeClass('div-hide');
				// setting the Image status value

				$("#getContactImage").attr('src', response['con_path']);

				$("#edit_con_path").fileinput({		      
				});  

				// Image id 
				$(".editContactImageFooter").after('<input type="hidden" name="con_id_1" id="con_id_1" value="'+Contact_id+'" />');
				// Galllery id 
				$(".editContactFooter").append('<input type="hidden" name="con_id_2" id="con_id_2" value="'+Contact_id+'" />');				

				
				
                
				$("#edit_con_name").val(response['con_name']);
				$("#edit_con_msg").val(response['con_msg']);
				$("#edit_con_design").val(response['con_design']);
				$("#edit_con_batch").val(response['con_batch']);
				
				
				
				$("#editContactForm").find('input').each(function(){
					if($(this).val()) {
						$(this).parent(".nk-int-st").addClass("nk-toggled");
					}					
				});		
				
				// update the Student data function
				$("#editContactForm").unbind('submit').bind('submit', function() {
					

					var isValid = true;

					$('#editContactForm input').each(function() {
						var element = $(this);
						if (element.val() == "") {
							 isValid = false;
							 element.closest('.form-group').append('<span class="text-danger"> This field is required </span>');
							 element.closest('.form-group').addClass('has-error');
						} else {
							// remove text-error 
								if(element.closest('span').hasClass('text-danger')){
									element.closest(".text-danger").remove();
									element.closest('.form-group').addClass('has-success');
								}else{
									isValid = true;
								}
						} // /else   
					});
				 		
					if(isValid == true) {
                        // submit loading button
						$("#editContactBtn").attr('disabled', 'disabled');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {

									console.log(response);
									// submit loading button
									$("#editContactBtn").removeAttr('disabled');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-Image-messages').html('<div class="alert alert-'+ response.status +'">'+
				            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            		'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +'</div>');

									// remove the mesages
				            		$(".alert-"+ response.status).delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          			// reload the manage student table
									manageContactTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // update the Student data function
				
				// update the Student image				
				$("#updateContactForm").unbind('submit').bind('submit', function() {					
					// form validation
					var ContactImage = $("#edit_con_path").val();					
					
					console.log(ContactImage);

					if(ContactImage == "") {
						$("#edit_con_path").closest('.center-block').after('<p class="text-danger">Contact Image field is required</p>');
						$('#edit_con_path').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#edit_con_path").find('.text-danger').remove();
						// success out for form 
						$("#edit_con_path").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(ContactImage) {
						// submit loading button
						$("#editContactImageBtn").attr('disabled', 'disabled');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								
									console.log(response);

									// submit loading button
									$("#editContactImageBtn").removeAttr('disabled');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-Image-Contact-messages').html('<div class="alert alert-'+ response.status +'">'+
						            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +'</div>');

									// remove the mesages
				            		$(".alert-"+ response.status).delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				            		// reload the manage student table
									manageContactTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'contact/get_single_contact',
										data: {con_id: Contact_id},
										type: 'post',
										success:function(response_img) {

											console.log(response_img);

											$("#getContactImage").attr('src', response_img['con_path']);
										}
									});																		

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // /update the Student image
			} // /success
		}); // ajax function
	} else {
		alert('error!! Refresh the page again');
	}
} // /edit Images function

function removeContact(Contact_id = null) {
	if(Contact_id) {
		$('#removeContact_id').remove();

		// click on remove button to remove the Image
		$("#removeContactBtn").unbind('click').bind('click', function() {
			// button loading
			$("#removeContactBtn").attr('disabled', 'disabled');

			$.ajax({
				url: 'contact/remove_contact',
				type: 'post',
				data: {con_id : Contact_id},
				dataType: 'json',
				success:function(response) {

					// button loading
					$("#removeContactBtn").removeAttr('disabled');
					// hide the remove modal 
					$('#removeContactModal').modal('hide');

					// reload the Image table 
					manageContactTable.ajax.reload(null, false);
					
					$('.remove-messages').html('<div class="alert alert-'+response.status+'">'+
					'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
					'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+response.messages +
					'</div>');

					$('.alert-'+response.status).delay(500).show(10, function() {
						$(this).delay(3000).hide(10, function() {
							$(this).remove();
						});
					}); // /.alert
					
				} // /response messages
			}); // /ajax function to remove the Image

		}); // /click on remove button to remove the Image

		$('.removeImageFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove Images function