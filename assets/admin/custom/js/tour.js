

var manageTourTable;



$(document).ready(function() {

	// top bar active

	$('.navTour').addClass('active');

	

	// manage Image table

	manageTourTable = $("#manageTourTable").DataTable({

		'ajax': 'tour/get_all_tour',

		'image': [],

		dom: 'Bfrtip',

		responsive: true,

		buttons: [{

		  extend: 'pdf',

		  title: 'Harvest Image List',

		  filename: 'harvest_tour_pdf',

		  exportOptions: {

				columns: [ 0, ':visible' ]

		  }      

		}, 

		{

		  extend: 'excel',

		  title: 'Harvest Image List',

		  filename: 'harvest_tour_excel',

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
        manageTourTable.draw();
    });
    $("#max").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        changeMonth: true,
        changeYear: true
    }).on('changeDate', function () {
        manageTourTable.draw();
    });

    // Event listener to the two range filtering inputs to redraw on input

    $('#min, #max').change(function () {

        manageTourTable.draw();

    });





	// add product modal btn clicked

	$("#addTourModalBtn").unbind('click').bind('click', function() {

		// // product form reset

		$("#submitTourForm")[0].reset();		

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



        // submit Image form function

        $("#submitTourForm").unbind('submit').bind('submit', function() {



			$('.form-group').removeClass('has-error').removeClass('has-success');

			$('.text-danger').remove();

			$('.myprogress').css('width', '0');

			$('.up_msg').text('');			

			var isValid = true;



			$('#submitTourForm input[type="text"], #submitTourForm input[type="file"]').each(function() {

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

				$('#createTourBtn').attr('disabled', 'disabled');

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

						$("#createTourBtn").removeAttr('disabled');

						$('.up_msg').text(response.messages);



						// reload the manage student table

						manageTourTable.ajax.reload(null, true);



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





function viewTour(Tour_id = null) {
    if (Tour_id) {
        $('.myprogress').css('width', '0');
        $('.up_msg').text('');
        // remove the form-error
        $('.form-group').removeClass('has-error').removeClass('has-success');
        // modal loading
        $('.modal-loading').removeClass('div-hide');
        // modal result
        $('.view-Image-result').addClass('div-hide');
        // modal footer
        $('.viewTourFooter').addClass('div-hide');

        $.ajax({
            url: 'tour/get_single_tour',
            type: 'post',
            data: { t_id: Tour_id },
            dataType: 'json',
            success: function (response) {

                // modal loading
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.view-Image-result').removeClass('div-hide');
                // modal footer
                $('.viewTourFooter').removeClass('div-hide');
                // setting the Tour name value 

                var formattedDate = formatDate(response['t_sdate']);

                var src        = response['t_source'] || '';
                var refRow     = (src === 'Word of mouth' || src === 'Referred by a friend')
                                 ? `<tr><th>Referral Name</th><td>${response['t_referral_name'] || '&mdash;'}</td></tr>` : '';
                var child2     = (response['t_child_name_2'] && response['t_child_name_2'] !== 'N/A' && response['t_child_name_2'] !== '')
                                 ? `<tr><th colspan="2" class="info"><i class="glyphicon glyphicon-user"></i> &nbsp; Child 2 Details</th></tr>
									<tr><th>First Name</th><td>${response['t_child_name_2']}</td></tr>
									<tr><th>Last Name</th><td>${response['t_child_lname_2']}</td></tr>
									<tr><th>Date of Birth</th><td>${response['t_dob_2'] || '&mdash;'}</td></tr>
									<tr><th>Program / Class</th><td>${response['t_class_2'] || '&mdash;'}</td></tr>` : '';

                $('.view_tour_data').html(`
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr><th colspan="2" class="info"><i class="glyphicon glyphicon-user"></i> &nbsp; Child 1 Details</th></tr>
                            <tr><th>First Name</th><td>${response['t_child_name_1'] || '&mdash;'}</td></tr>
                            <tr><th>Last Name</th><td>${response['t_child_lname_1'] || '&mdash;'}</td></tr>
                            <tr><th>Date of Birth</th><td>${response['t_dob_1'] || '&mdash;'}</td></tr>
                            <tr><th>Program of Interest</th><td>${response['t_program'] || '&mdash;'}</td></tr>
                            ${child2}
                            <tr><th colspan="2" class="info"><i class="glyphicon glyphicon-home"></i> &nbsp; Parent / Guardian Information</th></tr>
                            <tr><th>Guardian Name</th><td>${response['t_mother_name'] || '&mdash;'}</td></tr>
                            <tr><th>Phone</th><td>${response['t_mother_phone'] || '&mdash;'}</td></tr>
                            <tr><th>Email</th><td>${response['t_mother_email'] || '&mdash;'}</td></tr>
                            <tr><th colspan="2" class="info"><i class="glyphicon glyphicon-calendar"></i> &nbsp; Tour Information</th></tr>
                            <tr><th>Tour Date</th><td>${response['t_start_date_field'] || '&mdash;'}</td></tr>
                            <tr><th>Time Slot</th><td>${response['t_time_slot'] || '&mdash;'}</td></tr>
                            <tr><th colspan="2" class="info"><i class="glyphicon glyphicon-info-sign"></i> &nbsp; Additional Information</th></tr>
                            <tr><th>How Did You Hear About Us?</th><td>${src || '&mdash;'}</td></tr>
                            ${refRow}
                            <tr><th>Signature Date</th><td>${response['t_signature_date'] || '&mdash;'}</td></tr>
                        </tbody>
                    </table>
                `);
				
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

    month = month < 10 ? '0' + month : month;

    day = day < 10 ? '0' + day : day;



    return month + '-' + day + '-' + year;

}





function editTour(Tour_id = null) {

	if(Tour_id) {



		$("#editTourForm")[0].reset();		

		$("#updateTourForm")[0].reset();		



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

		$('.editTourImageFooter').addClass('div-hide');



		$.ajax({

			url: 'tour/get_single_tour',

			type: 'post',

			data: {t_id : Tour_id},

			dataType: 'json', 

			success:function(response) {



				// modal loading

				$('.div-loading').addClass('div-hide');

				// modal result

				$('.div-result').removeClass('div-hide');

				// modal footer

				$('.editTourImageFooter').removeClass('div-hide');

				// setting the Image status value



				$("#getTourImage").attr('src', response['t_path']);



				$("#edit_t_path").fileinput({		      

				});  



				// Image id 

				$(".editTourImageFooter").after('<input type="hidden" name="t_id_1" id="t_id_1" value="'+Tour_id+'" />');

				// Galllery id 

				$(".editTourFooter").append('<input type="hidden" name="t_id_2" id="t_id_2" value="'+Tour_id+'" />');				



				

				

                

				$("#edit_t_name").val(response['t_name']);

				$("#edit_t_msg").val(response['t_msg']);

				$("#edit_t_design").val(response['t_design']);

				$("#edit_t_batch").val(response['t_batch']);

				

				

				

				$("#editTourForm").find('input').each(function(){

					if($(this).val()) {

						$(this).parent(".nk-int-st").addClass("nk-toggled");

					}					

				});		

				

				// update the Student data function

				$("#editTourForm").unbind('submit').bind('submit', function() {

					



					var isValid = true;



					$('#editTourForm input').each(function() {

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

						$("#editTourBtn").attr('disabled', 'disabled');



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

									$("#editTourBtn").removeAttr('disabled');																		



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

									manageTourTable.ajax.reload(null, true);



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

				$("#updateTourForm").unbind('submit').bind('submit', function() {					

					// form validation

					var TourImage = $("#edit_t_path").val();					

					

					console.log(TourImage);



					if(TourImage == "") {

						$("#edit_t_path").closest('.center-block').after('<p class="text-danger">Tour Image field is required</p>');

						$('#edit_t_path').closest('.form-group').addClass('has-error');

					}	else {

						// remov error text field

						$("#edit_t_path").find('.text-danger').remove();

						// success out for form 

						$("#edit_t_path").closest('.form-group').addClass('has-success');	  	

					}	// /else



					if(TourImage) {

						// submit loading button

						$("#editTourImageBtn").attr('disabled', 'disabled');



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

									$("#editTourImageBtn").removeAttr('disabled');																		



									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);

																			

									// shows a successful message after operation

									$('#edit-Image-Tour-messages').html('<div class="alert alert-'+ response.status +'">'+

						            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+

						            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +'</div>');



									// remove the mesages

				            		$(".alert-"+ response.status).delay(500).show(10, function() {

										$(this).delay(3000).hide(10, function() {

											$(this).remove();

										});

									}); // /.alert



				            		// reload the manage student table

									manageTourTable.ajax.reload(null, true);



									$(".fileinput-remove-button").click();



									$.ajax({

										url: 'tour/get_single_tour',

										data: {t_id: Tour_id},

										type: 'post',

										success:function(response_img) {



											console.log(response_img);



											$("#getTourImage").attr('src', response_img['t_path']);

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



function removeTour(Tour_id = null) {

	if(Tour_id) {

		$('#removeTour_id').remove();



		// click on remove button to remove the Image

		$("#removeTourBtn").unbind('click').bind('click', function() {

			// button loading

			$("#removeTourBtn").attr('disabled', 'disabled');



			$.ajax({

				url: 'tour/remove_tour',

				type: 'post',

				data: {t_id : Tour_id},

				dataType: 'json',

				success:function(response) {



					// button loading

					$("#removeTourBtn").removeAttr('disabled');

					// hide the remove modal 

					$('#removeTourModal').modal('hide');



					// reload the Image table 

					manageTourTable.ajax.reload(null, false);

					

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