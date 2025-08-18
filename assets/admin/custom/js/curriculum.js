var manageCurriculumTable;

$(document).ready(function() {
	// top bar active
	$('.navCurriculum').addClass('active');
	
	// manage Curriculum table
	manageCurriculumTable = $("#manageCurriculumTable").DataTable({
		'ajax': 'curriculum/get_all_curriculum',
		'image': [],
		dom: 'Bfrtip',
		responsive: true,
		buttons: [{
		  extend: 'pdf',
		  title: 'Harvest Curriculum List',
		  filename: 'harvest_curriculum_pdf',
		  exportOptions: {
				columns: [ 0, ':visible' ]
		  }      
		}, 
		{
		  extend: 'excel',
		  title: 'Harvest Curriculum List',
		  filename: 'harvest_curriculum_excel',
		  exportOptions: {
				columns: [ 0, ':visible' ]
		  }      
		}, 
		{	
		  extend: 'print',
		  title: 'Harvest Curriculum List',
		  text: 'print',
		  autoPrint: false,
		  exportOptions: {
				columns: [ 0, ':visible' ]
		  }      
		}, 
		'colvis'
	  ]		
	});

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

});

// remove curriculum	
$(document).on('click', '.removeCurriculumBtn', function() {

	var curriculumId = $(this).attr('data-curriculum-id');
	$("#removeCurriculumBtn").unbind('click').bind('click', function() {
		$("#removeCurriculumBtn").button('loading');

		$.ajax({
			url: 'curriculum/remove_curriculum',
			type: 'post',
			data: {curriculumId: curriculumId},
			dataType: 'json',
			success:function(response) {
				$("#removeCurriculumBtn").button('reset');

				if(response.success == true) {
					$("#remove-messages").html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+response.messages+
          '</div>');

					// hide the remove modal
					$("#removeCurriculumModal").modal('hide');

					// reload the manage curriculum table
					manageCurriculumTable.ajax.reload(null, false);

          $('.remove-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+response.messages+
          '</div>');

				} else {

					$("#remove-messages").html('<div class="alert alert-warning">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+response.messages+
          '</div>');
				}
			}
		});

	}); // click remove curriculum btn	

}); // /remove curriculum	

// edit curriculum function
function editCurriculum(curriculumId = null) {
	if(curriculumId) {
		$("#curriculumId").remove();		
		// remove hidden curriculum id text
		$('#editCurriculumForm').append('<input type="hidden" name="curriculumId" id="curriculumId" value="'+curriculumId+'" />');

		// fetch the curriculum data
		$.ajax({
			url: 'curriculum/get_curriculum_by_id',
			type: 'post',
			data: {curriculumId: curriculumId},
			dataType: 'json',
			success:function(response) {

				$("#edit_curriculum_name").val(response.curriculum_name);
				$("#edit_curriculum_datee").val(response.curriculum_datee);
				$("#edit_curriculum_description").val(response.curriculum_description);

				// mmeber id 
				$(".editCurriculumPhotoURL").attr('src', response.curriculum_path);

				// update the curriculum data function
				$("#editCurriculumForm").unbind('submit').bind('submit', function() {

					var form = $(this);

					// remove the text-danger
					$(".text-danger").remove();

					$.ajax({
						url: form.attr('action'),
						type: form.attr('method'),
						data: new FormData(this),
						processData: false,
						contentType: false,
						dataType: 'json',
						success:function(response) {

							if(response.success == true) {
								$("#edit-curriculum-messages").html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+response.messages+
				          '</div>');

								// reload the manage curriculum table
								manageCurriculumTable.ajax.reload(null, false);

				        $('.remove-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+response.messages+
				          '</div>');

							} else {

								if(response.messages instanceof Object) {
									$.each(response.messages, function(index, value) {
										var id = $("#"+index);

										id.after(value);
									});
								} else {
									$("#edit-curriculum-messages").html('<div class="alert alert-warning">'+
					            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
					            '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+response.messages+
					          '</div>');

								}
							}
						}
					});

					return false;
				});

			}
		});
	} else {
		alert('Error : Refresh the page again');
	}
}

// submit curriculum form function
$("#submitCurriculumForm").unbind('submit').bind('submit', function() {
	// form validation
	var curriculumName = $("#curriculum_name").val();
	var curriculumDate = $("#curriculum_datee").val();
	var curriculumDescription = $("#curriculum_description").val();

	if(curriculumName == "") {
		$("#curriculum_name").after('<p class="text-danger">The Curriculum Name field is required</p>');
		$('#curriculum_name').closest('.form-group').addClass('has-error');
	} else {
		$("#curriculum_name").find('.text-danger').remove();
		$("#curriculum_name").closest('.form-group').addClass('has-success');	  	
	}

	if(curriculumDate == "") {
		$("#curriculum_datee").after('<p class="text-danger">The Curriculum Date field is required</p>');
		$('#curriculum_datee').closest('.form-group').addClass('has-error');
	} else {
		$("#curriculum_datee").find('.text-danger').remove();
		$("#curriculum_datee").closest('.form-group').addClass('has-success');	  	
	}

	if(curriculumDescription == "") {
		$("#curriculum_description").after('<p class="text-danger">The Curriculum Description field is required</p>');
		$('#curriculum_description').closest('.form-group').addClass('has-error');
	} else {
		$("#curriculum_description").find('.text-danger').remove();
		$("#curriculum_description").closest('.form-group').addClass('has-success');	  	
	}

	if(curriculumName && curriculumDate && curriculumDescription) {
		var form = $(this);
		// remove the text-danger
		$(".text-danger").remove();

		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			data: new FormData(this),
			processData: false,
        	contentType: false,
			dataType: 'json',
			success:function(response) {

				if(response.success == true) {
					$("#add-Curriculum-messages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+response.messages+
		          '</div>');

					// reload the manage curriculum table
					manageCurriculumTable.ajax.reload(null, false);

					// reset the form
					$("#submitCurriculumForm")[0].reset();
					// remove the error 
					$(".form-group").removeClass('has-error').removeClass('has-success');

	        $('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+response.messages+
	          '</div>');

				} else {

					if(response.messages instanceof Object) {
						$.each(response.messages, function(index, value) {
							var id = $("#"+index);

							id.after(value);
						});
					} else {
						$("#add-Curriculum-messages").html('<div class="alert alert-warning">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+response.messages+
			          '</div>');

					}
				}
			}
		});
	}

	return false;
});
