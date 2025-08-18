
var manageImageTable;

$(document).ready(function() {
	// top bar active
	$('.navGallery').addClass('active');
	$('#ytb_space').hide();
	$('#ext_space').hide();
	$('#edit_ytb_space').hide();
	$('#edit_ext_space').hide();
		
	console.log(gp_g_id);
	
	// manage Image table
	manageImageTable = $("#manageImageTable").DataTable({
		'ajax': {
			"url": base_url+'admin/add_more/get_all_images/',
			"type": 'POST',
			"data": {gp_g_id : gp_g_id}
		},
		'image': [],
		dom: 'Bfrtip',
		responsive: true,
		buttons: [{
		  extend: 'pdf',
		  title: 'CP Photography Image List',
		  filename: 'CP_Image_pdf',
		  exportOptions: {
				columns: [ 0, ':visible' ]
		  }      
		}, 
		{
		  extend: 'excel',
		  title: 'CP Photography Image List',
		  filename: 'CP_Image_excel',
		  exportOptions: {
				columns: [ 0, ':visible' ]
		  }      
		}, 
		{	
		  extend: 'print',
		  title: 'CP Photography Image List',
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
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
            var startDate = new Date(data[2]);
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
        onSelect: function () {
            manageMessageTable.draw();
        },
        changeMonth: true,
        changeYear: true
    });
    $("#max").datepicker({
        onSelect: function () {
            manageMessageTable.draw();
        },
        changeMonth: true,
        changeYear: true
    });
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function () {
        manageMessageTable.draw();
    });

	$("#img_cat").on("change", function(){
		var val = $(this).val();

		if(val == "Video"){
			$('#ytb_space').show();
			$('#ytb_link').removeAttr('disabled');
		}
		else{
			$('#ytb_space').hide();		
			$('#ytb_link').attr('disabled', 'disabled');
		}

	});

	$("#edit_img_cat").on("change", function(){
		var val = $(this).val();

		if(val == "Video"){
			$('#edit_ytb_space').show();
			$('#edit_ytb_link').removeAttr('disabled');
		}
		else{
			$('#edit_ytb_space').hide();		
			$('#edit_ytb_link').attr('disabled', 'disabled');
		}
	});

	// add product modal btn clicked
	$("#addImageModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitImageForm")[0].reset();		
		$('.myprogress').css('width', '0');
		$('.up_msg').text('');			

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#img_path").fileinput({
			overwriteInitial: true,
			maxFileSize: 2500,
			showClose: false,
			showCaption: false,
			defaultPreviewContent: '<img src="'+base_url+'assets/admin/images/profile.png" alt="Image / Thumbnail" style="display:block; margin: 0 auto; width: 30%;">',
			layoutTemplates: {
				main2: '{preview} {remove} {browse}'
			},
			allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
		});   

        // submit Image form function
        $("#submitImageForm").unbind('submit').bind('submit', function() {

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
			$('.myprogress').css('width', '0');
			$('.up_msg').text('');			
			var isValid = true;

			$('#submitImageForm input[type="text"], #submitImageForm input[type="file"]').each(function() {
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
				$('#createImageBtn').attr('disabled', 'disabled');
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
						$("#createImageBtn").removeAttr('disabled');
						$('.up_msg').text(response.messages);

						// reload the manage student table
						manageImageTable.ajax.reload(null, true);

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


function viewImages(Image_id = null) {
	if(Image_id) {
		$('.myprogress').css('width', '0');
		$('.up_msg').text('');			
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');
		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.view-Image-result').addClass('div-hide');
		// modal footer
		$('.viewImageFooter').addClass('div-hide');

		$.ajax({
			url: base_url+'admin/add_more/get_single_image',
			type: 'post',
			data: {gp_id : Image_id},
			dataType: 'json',
			success:function(response) {

				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.view-Image-result').removeClass('div-hide');
				// modal footer
                $('.viewImageFooter').removeClass('div-hide');
				// setting the Image name value 
				var link;

				if(response['gp_cat'] == "Video"){
					link = '<p><b> Youtube Link : </b><a href="'+response['gp_ytb_link']+'" target="_blank">'+response['gp_ytb_link']+'</a></p>';
				}
				else{
					link = '';
				}

				$('.view_Image_data').html('<div class="row"><div class="col-md-6"> <p><b> Type : </b>'+response['gp_cat']+'</p> '+link+' </div> <div class="col-md-6"><img style="width:150px;height:auto;" src="'+response['gp_path']+'"> </div></div>');
			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit Images function

function editImages(Image_id = null) {
	if(Image_id) {

		$("#editImageForm")[0].reset();		
		$("#updateGalleryImageForm")[0].reset();		

		$('.myprogress').css('width', '0');
		$('.up_msg').text('');			

		$("#img_id").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal result
		$('.div-result').addClass('div-hide');
		// modal footer 
		$('.editGalleryImageFooter').addClass('div-hide');

		$.ajax({
			url: base_url+'admin/add_more/get_single_image',
			type: 'post',
			data: {gp_id : Image_id},
			dataType: 'json', 
			success:function(response) {

				// modal loading
				$('.div-loading').addClass('div-hide');
				// modal result
				$('.div-result').removeClass('div-hide');
				// modal footer
				$('.editGalleryImageFooter').removeClass('div-hide');
				// setting the Image status value

				$("#getGalleryImage").attr('src', response['gp_path']);

				$("#edit_img_path").fileinput();  

				// Image id 
				$(".editGalleryImageFooter").after('<input type="hidden" name="img_id_1" id="img_id_1" value="'+Image_id+'" />');
				// Galllery id 
				$(".editGalleryFooter").append('<input type="hidden" name="img_id_2" id="img_id_2" value="'+Image_id+'" />');				

				if(!(response['gp_cat'] == null || response['gp_cat'] == '-')){
					$('select[name="edit_img_cat"] option[value="'+response['gp_cat']+'"]').attr("selected","selected");
					$('select[name="edit_img_cat"]').selectpicker("refresh");	
				}else{
					$('select[name="edit_img_cat"] option:selected').each(function () {
						$(this).removeAttr('selected'); 
					});
					$('select[name="edit_img_cat"]').selectpicker("refresh");	
				}

				if(response['gp_cat'] == "Video"){
					$("#edit_ytb_link").val(response['gp_ytb_link']);
					$('#edit_ytb_space').show();
					$('#edit_ytb_link').removeAttr('disabled');
				}else{
					$("#edit_ytb_link").val("-");
					$('#edit_ytb_space').hide();		
					$('#edit_ytb_link').attr('disabled', 'disabled');
		
				}
				
				$("#editImageForm").find('input').each(function(){
					if($(this).val()) {
						$(this).parent(".nk-int-st").addClass("nk-toggled");
					}					
				});		
				
				// update the Student data function
				$("#editImageForm").unbind('submit').bind('submit', function() {

					var isValid = true;

					$('#editImageForm input').each(function() {
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
						$("#editImageBtn").attr('disabled', 'disabled');

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
									// submit loading button
									$("#editImageBtn").removeAttr('disabled');																		

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
									manageImageTable.ajax.reload(null, true);

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
				$("#updateGalleryImageForm").unbind('submit').bind('submit', function() {					
					// form validation
					var GalleryImage = $("#edit_img_path").val();					
					
					if(GalleryImage == "") {
						$("#edit_img_path").closest('.center-block').after('<p class="text-danger">gallery Image field is required</p>');
						$('#edit_img_path').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#edit_img_path").find('.text-danger').remove();
						// success out for form 
						$("#edit_img_path").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(GalleryImage) {
						// submit loading button
						$("#editGalleryImageBtn").attr('disabled', 'disabled');

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
								
									// submit loading button
									$("#editGalleryImageBtn").removeAttr('disabled');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-Image-Gallery-messages').html('<div class="alert alert-'+ response.status +'">'+
						            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +'</div>');

									// remove the mesages
				            		$(".alert-"+ response.status).delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				            		// reload the manage student table
									manageImageTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: base_url+'admin/add_more/get_single_image',
										data: {gp_id: Image_id},
										type: 'post',
										success:function(response_img) {
											var response = JSON.parse(response_img);

											$("#getGalleryImage").attr('src', response['gp_path']);
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

function removeImages(Image_id = null) {
	if(Image_id) {
		$('#removeImage_id').remove();

		// click on remove button to remove the Image
		$("#removeImageBtn").unbind('click').bind('click', function() {
			// button loading
			$("#removeImageBtn").attr('disabled', 'disabled');

			$.ajax({
				url: base_url+'admin/add_more/remove_image',
				type: 'post',
				data: {gp_id : Image_id},
				dataType: 'json',
				success:function(response) {

					// button loading
					$("#removeImageBtn").removeAttr('disabled');
					// hide the remove modal 
					$('#removeImageModal').modal('hide');

					// reload the Image table 
					manageImageTable.ajax.reload(null, false);
					
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