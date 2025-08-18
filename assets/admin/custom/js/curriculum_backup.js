
var manageCurriculumTable;

$(document).ready(function() {
	// Check if jQuery is loaded
	console.log('jQuery version:', $.fn.jquery);
	
	// top bar active
	$('.navCurriculum').addClass('active');
	
	// manage Image table
	console.log('Initializing DataTable...');
	console.log('Table element exists:', $("#manageCurriculumTable").length > 0);
	console.log('Table element:', $("#manageCurriculumTable")[0]);
	console.log('Table HTML:', $("#manageCurriculumTable").html());
	console.log('Table headers:', $("#manageCurriculumTable thead tr th").length);
	
	// Test if DataTable is working
	console.log('DataTable available:', typeof $.fn.DataTable !== 'undefined');
	if (typeof $.fn.DataTable === 'undefined') {
		alert('DataTable library not loaded!');
		return;
	}
	
	try {
		manageCurriculumTable = $("#manageCurriculumTable").DataTable({
		'ajax': {
			'url': base_url + 'admin/curriculum/get_all_curriculum',
			'type': 'GET',
					'beforeSend': function() {
			console.log('AJAX URL:', base_url + 'admin/curriculum/get_all_curriculum');
			console.log('base_url value:', base_url);
		},
		'success': function(data, textStatus, xhr) {
			console.log('AJAX Success - data:', data);
			console.log('AJAX Success - textStatus:', textStatus);
			console.log('AJAX Success - xhr:', xhr);
		},
					'dataSrc': 'data', // Use the 'data' property directly
			'error': function(xhr, error, thrown) {
				console.error('DataTable AJAX Error:', error, thrown);
				console.log('Response:', xhr.responseText);
			}
		},
		'columns': [
			{ 'data': 0, 'title': 'Image' }, // Image column
			{ 'data': 1, 'title': 'Title' }, // Title column  
			{ 'data': 2, 'title': 'Date' }, // Date column
			{ 'data': 3, 'title': 'Description' }, // Description column
			{ 'data': 4, 'title': 'Options' }  // Options column
		],
		dom: 'lrt', // Default dom - length, results, table
		responsive: false, // Disable responsive temporarily
		processing: true, // Show processing indicator
		serverSide: false, // Client-side processing
		pageLength: 10, // Show 10 entries per page
		lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]		
	});
	
	console.log('DataTable initialized:', manageCurriculumTable);
	
	// Test if the table is working
	if (manageCurriculumTable) {
		console.log('Table rows:', manageCurriculumTable.rows().count());
		console.log('Table data:', manageCurriculumTable.data().toArray());
	}
	
	// Test AJAX manually
	$.ajax({
		url: base_url + 'admin/curriculum/get_all_curriculum',
		type: 'GET',
		success: function(response) {
			console.log('Manual AJAX test - response:', response);
			if (response.data && response.data.length > 0) {
				console.log('Manual AJAX test - first row:', response.data[0]);
			}
		},
		error: function(xhr, status, error) {
			console.error('Manual AJAX test - error:', error);
		}
	});
} catch (error) {
	console.error('DataTable initialization error:', error);
	alert('DataTable initialization failed: ' + error.message);
}

    // Date filtering for DataTable
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').datepicker('getDate');
            var max = $('#max').datepicker('getDate');
            console.log('Date filter - data:', data, 'dataIndex:', dataIndex);
            console.log('Date filter - min:', min, 'max:', max);
            
            if (min == null && max == null) {
                return true;
            }
            
            var startDate = new Date(data[2]);
            console.log('Date filter - startDate:', startDate, 'from data[2]:', data[2]);
            
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
        manageCurriculumTable.draw();
    });
    $("#max").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        changeMonth: true,
        changeYear: true
    }).on('changeDate', function () {
        manageCurriculumTable.draw();
    });
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function () {
        manageCurriculumTable.draw();
    });


	// add product modal btn clicked
	$("#addCurriculumModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitCurriculumForm")[0].reset();		
		$('.myprogress').css('width', '0'); 
		$('.up_msg').text('');			

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#c_path").fileinput({  
			
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
        $("#submitCurriculumForm").unbind('submit').bind('submit', function() {

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
			$('.myprogress').css('width', '0');
			$('.up_msg').text('');			
			var isValid = true;

			$('#submitCurriculumForm input[type="text"], #submitCurriculumForm input[type="file"]').each(function() {
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
				$('#createCurriculumBtn').attr('disabled', 'disabled');
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
						$("#createCurriculumBtn").removeAttr('disabled');
						$('.up_msg').text(response.messages);

						// reload the manage student table
						manageCurriculumTable.ajax.reload(null, true);

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


function viewCurriculum(Curriculum_id = null) {
    if (Curriculum_id) {
        $('.myprogress').css('width', '0');
        $('.up_msg').text('');
        // remove the form-error
        $('.form-group').removeClass('has-error').removeClass('has-success');
        // modal loading
        $('.modal-loading').removeClass('div-hide');
        // modal result
        $('.view-Image-result').addClass('div-hide');
        // modal footer
        $('.viewCurriculumFooter').addClass('div-hide');

        $.ajax({
            url: 'curriculum/get_single_curriculum',
            type: 'post',
            data: { c_id: Curriculum_id },
            dataType: 'json',
            success: function (response) {

                // modal loading
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.view-Image-result').removeClass('div-hide');
                // modal footer
                $('.viewCurriculumFooter').removeClass('div-hide');
                // setting the Curriculum name value 

                var formattedDate = formatDate(response['c_select_date']);

                $('.view_curriculum_data').html('<div class="row"><div class="col-md-6"> <p><b> Title : </b>' + response['c_title'] + ' </p> <p><b> Curriculum Date : </b>' + formattedDate + ' </p> <p><b>Description : </b>' + response['c_desc'] + ' </p>  </div> <div class="col-md-6"><img style="width:150px;height:auto;" src="' + response['c_path'] + '"> </div></div>');
            } // /success
        }); // ajax function

    } else {
        alert('error!! Refresh the page again');
    }
}

// Function to format date as mm-dd-yyyy
function formatDate(inputDate) {
    var date = new Date(inputDate);
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var year = date.getFullYear();

    // Pad single-digit month and day with leading zero
    if (month < 10) {
        month = '0' + month;
    }
    if (day < 10) {
        day = '0' + day;
    }

    return month + '-' + day + '-' + year;
}


function editCurriculum(Curriculum_id = null) {
	if(Curriculum_id) {

		$("#editCurriculumForm")[0].reset();		
		$("#updateCurriculumForm")[0].reset();		

		$('.myprogress').css('width', '0');
		$('.up_msg').text('');			

		$("#c_id").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal result
		$('.div-result').addClass('div-hide');
		// modal footer 
		$('.editCurriculumImageFooter').addClass('div-hide');

		$.ajax({
			url: 'curriculum/get_single_curriculum',
			type: 'post',
			data: {c_id : Curriculum_id},
			dataType: 'json', 
			success:function(response) {

				// modal loading
				$('.div-loading').addClass('div-hide');
				// modal result
				$('.div-result').removeClass('div-hide');
				// modal footer
				$('.editCurriculumImageFooter').removeClass('div-hide');
				// setting the Image status value

				$("#getCurriculumImage").attr('src', response['c_path']);

				$("#edit_c_path").fileinput({		      
				});  

				// Image id 
				$(".editCurriculumImageFooter").after('<input type="hidden" name="c_id_1" id="c_id_1" value="'+Curriculum_id+'" />');
				// Galllery id 
				$(".editCurriculumFooter").append('<input type="hidden" name="c_id_2" id="c_id_2" value="'+Curriculum_id+'" />');				

				
				
                
				$("#edit_c_title").val(response['c_title']);
				$("#edit_c_select_date").val(response['c_select_date']);
				CKEDITOR.instances['edit_c_desc'].setData(response['c_desc']);	
				
				$("#editCurriculumForm").find('input').each(function(){
					if($(this).val()) {
						$(this).parent(".nk-int-st").addClass("nk-toggled");
					}					
				});		
				
				// update the Student data function
				$("#editCurriculumForm").unbind('submit').bind('submit', function() {
					

					var isValid = true;

					$('#editCurriculumForm input').each(function() {
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
						$("#editCurriculumBtn").attr('disabled', 'disabled');

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
									$("#editCurriculumBtn").removeAttr('disabled');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-Curriculum-messages').html('<div class="alert alert-'+ response.status +'">'+
				            		'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            		'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +'</div>');

									// remove the mesages
				            		$(".alert-"+ response.status).delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          			// reload the manage student table
									manageCurriculumTable.ajax.reload(null, true);

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
				$("#updateCurriculumForm").unbind('submit').bind('submit', function() {					
					// form validation
					var CurriculumImage = $("#edit_c_path").val();					
					
					console.log(CurriculumImage);

					if(CurriculumImage == "") {
						$("#edit_c_path").closest('.center-block').after('<p class="text-danger">Curriculum Image field is required</p>');
						$('#edit_c_path').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#edit_c_path").find('.text-danger').remove();
						// success out for form 
						$("#edit_c_path").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(CurriculumImage) {
						// submit loading button
						$("#editCurriculumImageBtn").attr('disabled', 'disabled');

						var form = $(this);
						var formData = new FormData(this);

						var filedata = $('#edit_c_path')[0].files[0];
						formData.append('c_path', filedata);                        
						formData.append('c_id', $('#c_id_1').val());

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
									$("#editCurriculumImageBtn").removeAttr('disabled');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-Image-Curriculum-messages').html('<div class="alert alert-'+ response.status +'">'+
						            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +'</div>');

									// remove the mesages
				            		$(".alert-"+ response.status).delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				            		// reload the manage student table
									manageCurriculumTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'curriculum/get_single_curriculum',
										data: {c_id: Curriculum_id},
										type: 'post',
										success:function(response_img) {

											console.log(response_img);

											$("#getCurriculumImage").attr('src', response_img['c_path']);
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

function removeCurriculum(Curriculum_id = null) {
	if(Curriculum_id) {
		$('#removeCurriculum_id').remove();

		// click on remove button to remove the Image
		$("#removeCurriculumBtn").unbind('click').bind('click', function() {
			// button loading
			$("#removeCurriculumBtn").attr('disabled', 'disabled');

			$.ajax({
				url: 'curriculum/remove_curriculum',
				type: 'post',
				data: {c_id : Curriculum_id},
				dataType: 'json',
				success:function(response) {

					// button loading
					$("#removeCurriculumBtn").removeAttr('disabled');
					// hide the remove modal 
					$('#removeCurriculumModal').modal('hide');

					// reload the Image table 
					manageCurriculumTable.ajax.reload(null, false);
					
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