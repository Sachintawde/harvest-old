
var manageTestimonialTable;

$(document).ready(function() {
	// top bar active
	$('.navTestimonial').addClass('active');
	
	// manage Image table
	manageTestimonialTable = $("#manageTestimonialTable").DataTable({
		'ajax': 'testimonial/get_all_testimonial',
		'image': [],
		dom: 'Bfrtip',
		responsive: true,
		buttons: [{
		  extend: 'pdf',
		  title: 'Harvest Image List',
		  filename: 'harvest_testimonial_pdf',
		  exportOptions: {
				columns: [ 0, ':visible' ]
		  }      
		}, 
		{
		  extend: 'excel',
		  title: 'Harvest Image List',
		  filename: 'harvest_testimonial_excel',
		  exportOptions: {
				columns: [ 0, ':visible' ]
		  }      
		}, 
		{	
		  extend: 'print',
		  title: 'Harvest Image List',
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
            var startDate = new Date(data[4]);
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
        manageTestimonialTable.draw();
    });
    $("#max").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        changeMonth: true,
        changeYear: true
    }).on('changeDate', function () {
        manageTestimonialTable.draw();
    });
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function () {
        manageTestimonialTable.draw();
    });
    
    	$("#t_gender").on("change", function(){
		var val = $(this).val();

		if(val == "Video"){
			$('#ytb_space').show();
			$('#ytb_link').removeAttr('disabled');
			$('#ext_space').hide();
			$('#ext_link').attr('disabled', 'disabled');
		}
		else if(val == "Demo"){
			$('#ytb_space').show();
			$('#ytb_link').removeAttr('disabled');
			$('#ext_space').hide();
			$('#ext_link').attr('disabled', 'disabled');
		}		
		else{
			$('#ytb_space').hide();		
			$('#ext_space').hide();
			$('#ext_link').attr('disabled', 'disabled');			
			$('#ytb_link').attr('disabled', 'disabled');
		}

	});

	$("#edit_t_gender").on("change", function(){
		var val = $(this).val();

		if(val == "Video"){
			$('#edit_ytb_space').show();
			$('#edit_ytb_link').removeAttr('disabled');
			$('#edit_ext_space').hide();
			$('#edit_ext_link').attr('disabled', 'disabled');			
		}
		else if(val == "Demo"){
			$('#edit_ytb_space').show();
			$('#edit_ytb_link').removeAttr('disabled');
			$('#edit_ext_space').hide();
			$('#edit_ext_link').attr('disabled', 'disabled');
		}		
		else{
			$('#edit_ytb_space').hide();		
			$('#edit_ext_space').hide();
			$('#edit_ext_link').attr('disabled', 'disabled');			
			$('#edit_ytb_link').attr('disabled', 'disabled');
		}
	}); 


	// add product modal btn clicked
	$("#addTestimonialModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitTestimonialForm")[0].reset();		
		$('.myprogress').css('width', '0'); 
		$('.up_msg').text('');			

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#t_path").fileinput({  
			
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
		$("#t_path_two").fileinput({

			overwriteInitial: true,
			maxFileSize: 10000,
			showClose: false,
			showCaption: false,
			defaultPreviewContent: '<video style="display:block; margin: 0 auto; width: 30%;" poster="'+base_url+'assets/admin/images/profile.png" controls></video>',
			layoutTemplates: {
				main2: '{preview} {remove} {browse}'
			},
			allowedFileExtensions: ["mp4"]
		});  

        // submit Image form function
        $("#submitTestimonialForm").unbind('submit').bind('submit', function() {

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
			$('.myprogress').css('width', '0');
			$('.up_msg').text('');			
			var isValid = true;

			$('#submitTestimonialForm input[type="text"]').each(function() {
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
				$('#createTestimonialBtn').attr('disabled', 'disabled');
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
						$("#createTestimonialBtn").removeAttr('disabled');
						$('.up_msg').text(response.messages);

						// reload the manage student table
						manageTestimonialTable.ajax.reload(null, true);

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


function viewTestimonial(Testimonial_id = null) {
	if(Testimonial_id) {
		$('.myprogress').css('width', '0');
		$('.up_msg').text('');			
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');
		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.view-Image-result').addClass('div-hide');
		// modal footer
		$('.viewTestimonialFooter').addClass('div-hide');

		$.ajax({
			url: 'testimonial/get_single_testimonial',
			type: 'post',
			data: {t_id : Testimonial_id},
			dataType: 'json',
			success:function(response) {

				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.view-Image-result').removeClass('div-hide');
				// modal footer
                $('.viewTestimonialFooter').removeClass('div-hide');
				// setting the Testimonial name value 
				

				$('.view_testimonial_data').html('<div class="row"><div class="col-md-6"> <p><b> Name : </b>'+response['t_name']+' </p> <p><b>Designation : </b>'+response['t_design']+' </p> <p><b>Message : </b>'+response['t_msg']+' </p> </div> <div class="col-md-6"><img style="width:150px;height:auto;" src="'+response['t_path']+'"> </div></div>');
			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit Images function

function editTestimonial(Testimonial_id = null) {
	if(Testimonial_id) {

		$("#editTestimonialForm")[0].reset();		
		$("#updateTestimonialForm")[0].reset();		

		$('.myprogress').css('width', '0');
		$('.up_msg').text('');			

		$("#t_id").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal result
		$('.div-result').addClass('div-hide');
		// modal footer 
		$('.editTestimonialImageFooter').addClass('div-hide');

		$.ajax({
			url: 'testimonial/get_single_testimonial',
			type: 'post',
			data: {t_id : Testimonial_id},
			dataType: 'json', 
			success:function(response) {

				// modal loading
				$('.div-loading').addClass('div-hide');
				// modal result
				$('.div-result').removeClass('div-hide');
				// modal footer
				$('.editTestimonialImageFooter').removeClass('div-hide');
				// setting the Image status value

				$("#getTestimonialImage").attr('src', response['t_path']);
				$("#getTestimonialImageTwo").attr('src', response['t_path_two']);

				$("#edit_t_path").fileinput({		      
				});  
				$("#edit_t_path_two").fileinput({});

				// Image id 
				$(".editTestimonialImageFooter").after('<input type="hidden" name="t_id_1" id="t_id_1" value="'+Testimonial_id+'" />');
				// Galllery id 
				$(".editTestimonialFooter").append('<input type="hidden" name="t_id_2" id="t_id_2" value="'+Testimonial_id+'" />');
				
				if(!(response['t_gender'] == null || response['t_gender'] == '-')){
					$('select[name="edit_t_gender"] option[value="'+response['t_gender']+'"]').attr("selected","selected");
					$('select[name="edit_t_gender"]').selectpicker("refresh");	
				}else{
					$('select[name="edit_t_gender"] option:selected').each(function () {
						$(this).removeAttr('selected'); 
					});
					$('select[name="edit_t_gender"]').selectpicker("refresh");	
				}


				$("#edit_t_name").val(response['t_name']);
				$("#edit_t_msg").val(response['t_msg']);
				$("#edit_t_design").val(response['t_design']);	
				
				$("#editTestimonialForm").find('input').each(function(){
					if($(this).val()) {
						$(this).parent(".nk-int-st").addClass("nk-toggled");
					}					
				});		
				
				// update the Student data function
				$("#editTestimonialForm").unbind('submit').bind('submit', function() {
					

					var isValid = true;

					$('#editTestimonialForm input').each(function() {
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
						$("#editTestimonialBtn").attr('disabled', 'disabled');

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
									$("#editTestimonialBtn").removeAttr('disabled');																		

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
									manageTestimonialTable.ajax.reload(null, true);

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
				$("#updateTestimonialForm").unbind('submit').bind('submit', function() {
					// form validation
					var TestimonialImage = $("#edit_t_path").val();
					var TestimonialVideo = $("#edit_t_path_two").val();
				
					if (TestimonialImage == "" && TestimonialVideo == "") {
						// Both fields are empty, show an error message for the Image field
						$("#edit_t_path").closest('.center-block').after('<p class="text-danger">Testimonial Image field is required</p>');
						$('#edit_t_path').closest('.form-group').addClass('has-error');
					} else {
						// Remove error text field
						$("#edit_t_path").find('.text-danger').remove();
						// Success out for form 
						$("#edit_t_path").closest('.form-group').addClass('has-success');
					}
				
					if (TestimonialImage || TestimonialVideo) {
						// submit loading button
						$("#editTestimonialImageBtn").attr('disabled', 'disabled');
				
						var form = $(this);
						var formData = new FormData(this);
				
						var filedata = $('#edit_t_path')[0].files[0];
						formData.append('t_path', filedata);
						formData.append('t_id', $('#t_id_1').val());
				
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success: function(response) {
								console.log("Response:", response);
				
								// submit loading button
								$("#editTestimonialImageBtn").removeAttr('disabled');
				
								// shows a successful message after operation
								console.log("Response Status:", response.status);
								console.log("Response Messages:", response.messages);
				
								$('#edit-Image-Testimonial-messages').html('<div class="alert alert-'+ response.status +'">'+
									'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
									'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +'</div>');
				
								// remove the messages
								$(".alert-"+ response.status).delay(500).show(10, function() {
									$(this).delay(3000).hide(10, function() {
										$(this).remove();
									});
								}); // /.alert
				
								// reload the manage student table
								manageTestimonialTable.ajax.reload(null, true);
				
								$(".fileinput-remove-button").click();
				
								$.ajax({
									url: 'testimonial/get_single_testimonial',
									data: {t_id: Testimonial_id},
									type: 'post',
									success:function(response_img) {
										console.log("Response Image:", response_img);
										$("#getTestimonialImage").attr('src', response_img['t_path']);
										$("#getTestimonialImageTwo").attr('src', response_img['t_path_two']);
									}
								});
				
								// remove text-error 
								$(".text-danger").remove();
								// remove form-group error
								$(".form-group").removeClass('has-error').removeClass('has-success');
							} // /success function
						}); // /ajax function
					} // /if validation is ok                     
				
					return false;
				});
				// /update the Student image
			} // /success
		}); // ajax function
	} else {
		alert('error!! Refresh the page again');
	}
} // /edit Images function

function removeTestimonial(Testimonial_id = null) {
	if(Testimonial_id) {
		$('#removeTestimonial_id').remove();

		// click on remove button to remove the Image
		$("#removeTestimonialBtn").unbind('click').bind('click', function() {
			// button loading
			$("#removeTestimonialBtn").attr('disabled', 'disabled');

			$.ajax({
				url: 'testimonial/remove_testimonial',
				type: 'post',
				data: {t_id : Testimonial_id},
				dataType: 'json',
				success:function(response) {

					// button loading
					$("#removeTestimonialBtn").removeAttr('disabled');
					// hide the remove modal 
					$('#removeTestimonialModal').modal('hide');

					// reload the Image table 
					manageTestimonialTable.ajax.reload(null, false);
					
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