
var manageCareerTable;

$(document).ready(function() {
	// top bar active
	$('.navCareer').addClass('active');
	
	// manage Image table
	manageCareerTable = $("#manageCareerTable").DataTable({
		'ajax': 'career/get_all_career',
		'image': [],
		dom: 'Bfrtip',
		responsive: true,
		buttons: [{
		  extend: 'pdf',
		  title: 'Harvest Image List',
		  filename: 'harvest_career_pdf',
		  exportOptions: {
				columns: [ 0, ':visible' ]
		  }      
		}, 
		{
		  extend: 'excel',
		  title: 'Harvest Image List',
		  filename: 'harvest_career_excel',
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
        manageCareerTable.draw();
    });
    $("#max").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        changeMonth: true,
        changeYear: true
    }).on('changeDate', function () {
        manageCareerTable.draw();
    });
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function () {
        manageCareerTable.draw();
    });


	// add product modal btn clicked
	$("#addCareerModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitCareerForm")[0].reset();		
		$('.myprogress').css('width', '0'); 
		$('.up_msg').text('');			

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#r_path").fileinput({  
			
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
        $("#submitCareerForm").unbind('submit').bind('submit', function() {

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
			$('.myprogress').css('width', '0');
			$('.up_msg').text('');			
			var isValid = true;

			$('#submitCareerForm input[type="text"], #submitCareerForm input[type="file"]').each(function() {
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
				$('#createCareerBtn').attr('disabled', 'disabled');
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
						$("#createCareerBtn").removeAttr('disabled');
						$('.up_msg').text(response.messages);

						// reload the manage student table
						manageCareerTable.ajax.reload(null, true);

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


function viewCareer(Career_id = null) {
    if (Career_id) {
        $('.myprogress').css('width', '0');
        $('.up_msg').text('');
        // remove the form-error
        $('.form-group').removeClass('has-error').removeClass('has-success');
        // modal loading
        $('.modal-loading').removeClass('div-hide');
        // modal result
        $('.view-Image-result').addClass('div-hide');
        // modal footer
        $('.viewCareerFooter').addClass('div-hide');

        $.ajax({
            url: 'career/get_single_career',
            type: 'post',
            data: { e_id: Career_id },
            dataType: 'json',
            success: function (response) {
                // modal loading
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.view-Image-result').removeClass('div-hide');
                // modal footer
                $('.viewCareerFooter').removeClass('div-hide');
                // setting the Career name value

                var resumeDownloadLink = ' <iframe src="'+response['e_resume']+'" width="100%" height="350px" style="border:none"></iframe>';

                $('.view_career_data').html('<div class="row"><div class="col-md-6"> <p><b> First Name : </b>' + response['e_name'] + ' </p> <p><b> Last Name : </b>' + response['e_lname'] + ' </p>  <p><b>Mobile No. : </b>' + response['e_mob'] + ' </p> <p><b>Email : </b>' + response['e_mail'] + ' </p> <p><b>Position : </b>' + response['e_prog'] + ' </p> <p><b>Address : </b>' + response['e_addrs'] + ' </p> <p><b>Message : </b>' + response['e_msg'] + ' </p> </div><div class="col-md-6">' + resumeDownloadLink + '</div> </div>');
            } // /success
        }); // ajax function
    } else {
        alert('error!! Refresh the page again');
    }
}


function editCareer(Career_id = null) {
	if(Career_id) {

		$("#editCareerForm")[0].reset();		
		$("#updateCareerForm")[0].reset();		

		$('.myprogress').css('width', '0');
		$('.up_msg').text('');			

		$("#e_id").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal result
		$('.div-result').addClass('div-hide');
		// modal footer 
		$('.editCareerImageFooter').addClass('div-hide');

		$.ajax({
			url: 'career/get_single_career',
			type: 'post',
			data: {e_id : Career_id},
			dataType: 'json', 
			success:function(response) {

				// modal loading
				$('.div-loading').addClass('div-hide');
				// modal result
				$('.div-result').removeClass('div-hide');
				// modal footer
				$('.editCareerImageFooter').removeClass('div-hide');
				// setting the Image status value

				$("#getCareerImage").attr('src', response['r_path']);

				$("#edit_r_path").fileinput({		      
				});  

				// Image id 
				$(".editCareerImageFooter").after('<input type="hidden" name="e_id_1" id="e_id_1" value="'+Career_id+'" />');
				// Galllery id 
				$(".editCareerFooter").append('<input type="hidden" name="e_id_2" id="e_id_2" value="'+Career_id+'" />');				

				
				
                
				$("#edit_r_name").val(response['r_name']);
				$("#edit_r_msg").val(response['r_msg']);
				$("#edit_r_design").val(response['r_design']);
				$("#edit_r_batch").val(response['r_batch']);
				
				
				
				$("#editCareerForm").find('input').each(function(){
					if($(this).val()) {
						$(this).parent(".nk-int-st").addClass("nk-toggled");
					}					
				});		
				
				// update the Student data function
				$("#editCareerForm").unbind('submit').bind('submit', function() {
					

					var isValid = true;

					$('#editCareerForm input').each(function() {
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
						$("#editCareerBtn").attr('disabled', 'disabled');

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
									$("#editCareerBtn").removeAttr('disabled');																		

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
									manageCareerTable.ajax.reload(null, true);

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
				$("#updateCareerForm").unbind('submit').bind('submit', function() {					
					// form validation
					var CareerImage = $("#edit_r_path").val();					
					
					console.log(CareerImage);

					if(CareerImage == "") {
						$("#edit_r_path").closest('.center-block').after('<p class="text-danger">Career Image field is required</p>');
						$('#edit_r_path').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#edit_r_path").find('.text-danger').remove();
						// success out for form 
						$("#edit_r_path").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(CareerImage) {
						// submit loading button
						$("#editCareerImageBtn").attr('disabled', 'disabled');

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
									$("#editCareerImageBtn").removeAttr('disabled');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-Image-Career-messages').html('<div class="alert alert-'+ response.status +'">'+
						            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +'</div>');

									// remove the mesages
				            		$(".alert-"+ response.status).delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				            		// reload the manage student table
									manageCareerTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'career/get_single_career',
										data: {e_id: Career_id},
										type: 'post',
										success:function(response_img) {

											console.log(response_img);

											$("#getCareerImage").attr('src', response_img['r_path']);
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

function removeCareer(Career_id = null) {
	if(Career_id) {
		$('#removeCareer_id').remove();

		// click on remove button to remove the Image
		$("#removeCareerBtn").unbind('click').bind('click', function() {
			// button loading
			$("#removeCareerBtn").attr('disabled', 'disabled');

			$.ajax({
				url: 'career/remove_career',
				type: 'post',
				data: {e_id : Career_id},
				dataType: 'json',
				success:function(response) {

					// button loading
					$("#removeCareerBtn").removeAttr('disabled');
					// hide the remove modal 
					$('#removeCareerModal').modal('hide');

					// reload the Image table 
					manageCareerTable.ajax.reload(null, false);
					
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