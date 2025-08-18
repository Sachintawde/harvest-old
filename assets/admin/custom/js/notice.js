
var manageNoticeTable;

$(document).ready(function() {
	// top bar active
	$('.navNotice').addClass('active');
	
	// manage Image table
	manageNoticeTable = $("#manageNoticeTable").DataTable({
		'ajax': 'notice/get_all_notice',
		'image': [],
		dom: 'Bfrtip',
		responsive: true,
		buttons: [{
		  extend: 'pdf',
		  title: 'Harvest Image List',
		  filename: 'harvest_notice_pdf',
		  exportOptions: {
				columns: [ 0, ':visible' ]
		  }      
		}, 
		{
		  extend: 'excel',
		  title: 'Harvest Image List',
		  filename: 'harvest_notice_excel',
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
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
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
        onSelect: function () {
            manageNoticeTable.draw();
        },
        changeMonth: true,
        changeYear: true
    });
    $("#max").datepicker({
        onSelect: function () {
            manageNoticeTable.draw();
        },
        changeMonth: true,
        changeYear: true
    });
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function () {
        manageNoticeTable.draw();
    });


	// add product modal btn clicked
	$("#addNoticeModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitNoticeForm")[0].reset();		
		$('.myprogress').css('width', '0'); 
		$('.up_msg').text('');			

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#n_path").fileinput({  
			
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
        $("#submitNoticeForm").unbind('submit').bind('submit', function() {

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
			$('.myprogress').css('width', '0');
			$('.up_msg').text('');			
			var isValid = true;

			$('#submitNoticeForm input[type="text"], #submitNoticeForm input[type="file"]').each(function() {
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
				$('#createNoticeBtn').attr('disabled', 'disabled');
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
						$("#createNoticeBtn").removeAttr('disabled');
						$('.up_msg').text(response.messages);

						// reload the manage student table
						manageNoticeTable.ajax.reload(null, true);

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


function viewNotice(Notice_id = null) {
	if(Notice_id) {
		$('.myprogress').css('width', '0');
		$('.up_msg').text('');			
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');
		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.view-Image-result').addClass('div-hide');
		// modal footer
		$('.viewNoticeFooter').addClass('div-hide');

		$.ajax({
			url: 'notice/get_single_notice',
			type: 'post',
			data: {n_id : Notice_id},
			dataType: 'json',
			success:function(response) {

				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.view-Image-result').removeClass('div-hide');
				// modal footer
                $('.viewNoticeFooter').removeClass('div-hide');
				// setting the Notice name value 
				

				$('.view_notice_data').html('<div class="row"><div class="col-md-6"> <p><b> Title : </b>'+response['n_title']+' </p> <p><b>Description : </b>'+response['n_desc']+' </p> <p><b>Link : </b>'+response['n_link']+' </p> </div> <div class="col-md-6"><img style="width:150px;height:auto;" src="'+response['n_path']+'"> </div></div>');
			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit Images function

function editNotice(Notice_id = null) {
	if(Notice_id) {

		$("#editNoticeForm")[0].reset();		
		$("#updateNoticeForm")[0].reset();		

		$('.myprogress').css('width', '0');
		$('.up_msg').text('');			

		$("#n_id").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal result
		$('.div-result').addClass('div-hide');
		// modal footer 
		$('.editNoticeImageFooter').addClass('div-hide');

		$.ajax({
			url: 'notice/get_single_notice',
			type: 'post',
			data: {n_id : Notice_id},
			dataType: 'json', 
			success:function(response) {

				// modal loading
				$('.div-loading').addClass('div-hide');
				// modal result
				$('.div-result').removeClass('div-hide');
				// modal footer
				$('.editNoticeImageFooter').removeClass('div-hide');
				// setting the Image status value

				$("#getNoticeImage").attr('src', response['n_path']);

				$("#edit_n_path").fileinput({		      
				});  

				// Image id 
				$(".editNoticeImageFooter").after('<input type="hidden" name="n_id_1" id="n_id_1" value="'+Notice_id+'" />');
				// Galllery id 
				$(".editNoticeFooter").append('<input type="hidden" name="n_id_2" id="n_id_2" value="'+Notice_id+'" />');				

				if(!(response['n_type'] == null || response['n_type'] == '-')){
					$('select[name="edit_n_type"] option[value="'+response['n_type']+'"]').attr("selected","selected");
					$('select[name="edit_n_type"]').selectpicker("refresh");	
				}else{
					$('select[name="edit_n_type"] option:selected').each(function () {
						$(this).removeAttr('selected'); 
					});
					$('select[name="edit_n_type"]').selectpicker("refresh");	
				}
				
                
				$("#edit_n_title").val(response['n_title']);
				CKEDITOR.instances['edit_n_desc'].setData(response['n_desc']); 
				$("#edit_n_link").val(response['n_link']);
				
				
				
				
				$("#editNoticeForm").find('input').each(function(){
					if($(this).val()) {
						$(this).parent(".nk-int-st").addClass("nk-toggled");
					}					
				});		
				
				// update the Student data function
				$("#editNoticeForm").unbind('submit').bind('submit', function() {
					

					var isValid = true;

					$('#editNoticeForm input').each(function() {
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
						$("#editNoticeBtn").attr('disabled', 'disabled');

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
									$("#editNoticeBtn").removeAttr('disabled');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-Notice-messages').html('<div class="alert alert-'+ response.status +'">'+
				            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            		'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +'</div>');

									// remove the mesages
				            		$(".alert-"+ response.status).delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          			// reload the manage student table
									manageNoticeTable.ajax.reload(null, true);

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
				$("#updateNoticeForm").unbind('submit').bind('submit', function() {					
					// form validation
					var NoticeImage = $("#edit_n_path").val();					
					
					console.log(NoticeImage);

					if(NoticeImage == "") {
						$("#edit_n_path").closest('.center-block').after('<p class="text-danger">Notice Image field is required</p>');
						$('#edit_n_path').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#edit_n_path").find('.text-danger').remove();
						// success out for form 
						$("#edit_n_path").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(NoticeImage) {
						// submit loading button
						$("#editNoticeImageBtn").attr('disabled', 'disabled');

						var form = $(this);
						var formData = new FormData(this);

						
						var filedata = $('#edit_n_path')[0].files[0];
						formData.append('n_path', filedata);                        
						formData.append('n_id', $('#n_id_1').val());
						

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
									$("#editNoticeImageBtn").removeAttr('disabled');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-Image-Notice-messages').html('<div class="alert alert-'+ response.status +'">'+
						            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +'</div>');

									// remove the mesages
				            		$(".alert-"+ response.status).delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				            		// reload the manage student table
									manageNoticeTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'notice/get_single_notice',
										data: {n_id: Notice_id},
										type: 'post',
										success:function(response_img) {

											console.log(response_img);

											$("#getNoticeImage").attr('src', response_img['n_path']);
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

function removeNotice(Notice_id = null) {
	if(Notice_id) {
		$('#removeNotice_id').remove();

		// click on remove button to remove the Image
		$("#removeNoticeBtn").unbind('click').bind('click', function() {
			// button loading
			$("#removeNoticeBtn").attr('disabled', 'disabled');

			$.ajax({
				url: 'notice/remove_notice',
				type: 'post',
				data: {n_id : Notice_id},
				dataType: 'json',
				success:function(response) {

					// button loading
					$("#removeNoticeBtn").removeAttr('disabled');
					// hide the remove modal 
					$('#removeNoticeModal').modal('hide');

					// reload the Image table 
					manageNoticeTable.ajax.reload(null, false);
					
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