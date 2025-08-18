

var manageEnrollTable;



$(document).ready(function() {

	// top bar active

	$('.navEnroll').addClass('active');

	

	// manage Image table

	manageEnrollTable = $("#manageEnrollTable").DataTable({

		'ajax': 'enroll/get_all_enroll',

		'image': [],

		dom: 'Bfrtip',

		responsive: true,

		buttons: [{

		  extend: 'pdf',

		  title: 'harvest Image List',

		  filename: 'harvest_enroll_pdf',

		  exportOptions: {

				columns: [ 0, ':visible' ]

		  }      

		}, 

		{

		  extend: 'excel',

		  title: 'harvest Image List',

		  filename: 'harvest_enroll_excel',

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
        manageEnrollTable.draw();
    });

    $("#max").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        changeMonth: true,
        changeYear: true
    }).on('changeDate', function () {
        manageEnrollTable.draw();
    });

    // Event listener to the two range filtering inputs to redraw on input

    $('#min, #max').change(function () {

        manageEnrollTable.draw();

    });





	// add product modal btn clicked

	$("#addEnrollModalBtn").unbind('click').bind('click', function() {

		// // product form reset

		$("#submitEnrollForm")[0].reset();		

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

        $("#submitEnrollForm").unbind('submit').bind('submit', function() {



			$('.form-group').removeClass('has-error').removeClass('has-success');

			$('.text-danger').remove();

			$('.myprogress').css('width', '0');

			$('.up_msg').text('');			

			var isValid = true;



			$('#submitEnrollForm input[type="text"], #submitEnrollForm input[type="file"]').each(function() {

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

				$('#createEnrollBtn').attr('disabled', 'disabled');

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

						$("#createEnrollBtn").removeAttr('disabled');

						$('.up_msg').text(response.messages);



						// reload the manage student table

						manageEnrollTable.ajax.reload(null, true);



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





function viewEnroll(Enroll_id = null) {

	if(Enroll_id) {

		$('.myprogress').css('width', '0');

		$('.up_msg').text('');			

		// remove the form-error

		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading

		$('.modal-loading').removeClass('div-hide');

		// modal result

		$('.view-Image-result').addClass('div-hide');

		// modal footer

		$('.viewEnrollFooter').addClass('div-hide');



		$.ajax({

			url: 'enroll/get_single_enroll',

			type: 'post',

			data: {e_id : Enroll_id},

			dataType: 'json',

			success:function(response) {



				// modal loading

				$('.modal-loading').addClass('div-hide');

				// modal result

				$('.view-Image-result').removeClass('div-hide');

				// modal footer

                $('.viewEnrollFooter').removeClass('div-hide');

				// setting the Enroll name value 

				



				$('.view_enroll_data').html('<div class="row"><div class="col-md-6"> <p><b> Guardian First Name : </b>'+response['g_fname']+' </p> <p><b>Guardian Last Name : </b>'+response['g_lname']+' </p> <p><b>Mobile No. : </b>'+response['g_mob']+' </p><p><b>Phone Type : </b>'+response['g_mob_type']+' </p><p><b>Mail : </b>'+response['g_mail']+' </p><p><b>method of communication : </b>'+response['communication']+' </p><p><b>Has your child been in a Montessori school or childcare before? : </b>'+response['previous_school']+' </p><p><b>What is most important to you when looking for a Montessori School? : </b>'+response['important_factors']+' </p><p><b>How did you hear about us?* : </b>'+response['g_hear_about']+' </p><p><b>First Child Name : </b>'+response['c_fname1']+' </p><p><b>First Child Last Name : </b>'+response['c_lname1']+' </p><p><b>Gender : </b>'+response['gender1']+' </p><p><b>First Child Dob : </b>'+response['dob1']+' </p><p><b>Class : </b>'+response['c_class1']+' </p><p><b>Childs Desired Start Date : </b>'+response['s_date1']+' </p><p><b>Second Child FIrst Name : </b>'+response['c_fname2']+' </p><p><b>Second Child Last Name : </b>'+response['c_lname2']+' </p><p><b>Gender : </b>'+response['gender2']+' </p><p><b>Second Child Dob : </b>'+response['dob2']+' </p><p><b>Classs : </b>'+response['c_class2']+' </p><p><b>Second Child Desired Start Date : </b>'+response['s_date2']+' </p><p><b>Parent Information : </b>'+response['g_info']+' </p><p><b>Programs Intersted : </b>'+response['Interested']+' </p><p><b>Other Notes : </b>'+response['other_notes']+' </p> </div> </div>');
			} // /success

		}); // ajax function



	} else {

		alert('error!! Refresh the page again');

	}

} // /edit Images function



function editEnroll(Enroll_id = null) {

	if(Enroll_id) {



		$("#editEnrollForm")[0].reset();		

		$("#updateEnrollForm")[0].reset();		



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

		$('.editEnrollImageFooter').addClass('div-hide');



		$.ajax({

			url: 'enroll/get_single_enroll',

			type: 'post',

			data: {e_id : Enroll_id},

			dataType: 'json', 

			success:function(response) {



				// modal loading

				$('.div-loading').addClass('div-hide');

				// modal result

				$('.div-result').removeClass('div-hide');

				// modal footer

				$('.editEnrollImageFooter').removeClass('div-hide');

				// setting the Image status value



				$("#getEnrollImage").attr('src', response['con_path']);



				$("#edit_con_path").fileinput({		      

				});  



				// Image id 

				$(".editEnrollImageFooter").after('<input type="hidden" name="e_id_1" id="e_id_1" value="'+Enroll_id+'" />');

				// Galllery id 

				$(".editEnrollFooter").append('<input type="hidden" name="e_id_2" id="e_id_2" value="'+Enroll_id+'" />');				



				

				

                

				$("#edit_con_name").val(response['con_name']);

				$("#edit_con_msg").val(response['con_msg']);

				$("#edit_con_design").val(response['con_design']);

				$("#edit_con_batch").val(response['con_batch']);

				

				

				

				$("#editEnrollForm").find('input').each(function(){

					if($(this).val()) {

						$(this).parent(".nk-int-st").addClass("nk-toggled");

					}					

				});		

				

				// update the Student data function

				$("#editEnrollForm").unbind('submit').bind('submit', function() {

					



					var isValid = true;



					$('#editEnrollForm input').each(function() {

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

						$("#editEnrollBtn").attr('disabled', 'disabled');



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

									$("#editEnrollBtn").removeAttr('disabled');																		



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

									manageEnrollTable.ajax.reload(null, true);



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

				$("#updateEnrollForm").unbind('submit').bind('submit', function() {					

					// form validation

					var EnrollImage = $("#edit_con_path").val();					

					

					console.log(EnrollImage);



					if(EnrollImage == "") {

						$("#edit_con_path").closest('.center-block').after('<p class="text-danger">Enroll Image field is required</p>');

						$('#edit_con_path').closest('.form-group').addClass('has-error');

					}	else {

						// remov error text field

						$("#edit_con_path").find('.text-danger').remove();

						// success out for form 

						$("#edit_con_path").closest('.form-group').addClass('has-success');	  	

					}	// /else



					if(EnrollImage) {

						// submit loading button

						$("#editEnrollImageBtn").attr('disabled', 'disabled');



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

									$("#editEnrollImageBtn").removeAttr('disabled');																		



									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

																			

									// shows a successful message after operation

									$('#edit-Image-Enroll-messages').html('<div class="alert alert-'+ response.status +'">'+

						            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+

						            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +'</div>');



									// remove the mesages

				            		$(".alert-"+ response.status).delay(500).show(10, function() {

										$(this).delay(3000).hide(10, function() {

											$(this).remove();

										});

									}); // /.alert



				            		// reload the manage student table

									manageEnrollTable.ajax.reload(null, true);



									$(".fileinput-remove-button").click();



									$.ajax({

										url: 'enroll/get_single_enroll',

										data: {e_id: Enroll_id},

										type: 'post',

										success:function(response_img) {



											console.log(response_img);



											$("#getEnrollImage").attr('src', response_img['con_path']);

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



function removeEnroll(Enroll_id = null) {

	if(Enroll_id) {

		$('#removeEnroll_id').remove();



		// click on remove button to remove the Image

		$("#removeEnrollBtn").unbind('click').bind('click', function() {

			// button loading

			$("#removeEnrollBtn").attr('disabled', 'disabled');



			$.ajax({

				url: 'enroll/remove_enroll',

				type: 'post',

				data: {e_id : Enroll_id},

				dataType: 'json',

				success:function(response) {



					// button loading

					$("#removeEnrollBtn").removeAttr('disabled');

					// hide the remove modal 

					$('#removeEnrollModal').modal('hide');



					// reload the Image table 

					manageEnrollTable.ajax.reload(null, false);

					

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