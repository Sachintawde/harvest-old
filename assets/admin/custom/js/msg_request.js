var manageMessageTable;

$(document).ready(function () {
    /    $("#min").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        changeMonth: true,
        changeYear: true
    }).on('changeDate', function () {
        manageMsgRequestTable.draw();
    });
    $("#max").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        changeMonth: true,
        changeYear: true
    }).on('changeDate', function () {
        manageMsgRequestTable.draw();
    });
    $('.navMessage').addClass('active');
    // manage Message data table

    manageMessageTable = $('#manageMessageTable').DataTable({
        'ajax': 'message/get_all_message',
        'message': [],
        dom: 'Bfrtip',
        responsive: true,
        buttons: [{
                extend: 'pdf',
                title: 'harvest Message List',
                filename: 'harvest_Message_pdf',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'excel',
                title: 'harvest Message List',
                filename: 'harvest_Message_pdf',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'print',
                title: 'harvest Message List',
                text: 'print',
                autoPrint: false,
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            'colvis'
        ]
    });

    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').datepicker('getDate');
            var max = $('#max').datepicker('getDate');
            var startDate = new Date(data[3]);
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


    /*=======================================================
        Expand text
        * Since the pseudo class :truncated is sadly not a thing, if your truncated box is responsive or the text in the box is of arbitrary size, the following code adds or removes a "truncated" class to simulate the feature.
        * Warning: Doesn't work in all browsers due to the use of ResizeObserver, use something like the window's resize event if you need it to be moar cross browser.
    ========================================================*/

    const ps = document.querySelectorAll('p');
    const observer = new ResizeObserver(entries => {
        for (let entry of entries) {
            entry.target.classList[entry.target.scrollHeight > entry.contentRect.height ? 'add' : 'remove']('truncated');
        }
    });

    ps.forEach(p => {observer.observe(p);});
    
}); // document.ready fucntion


function viewMessage(Message_id = null) {
	if(Message_id) {
		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.view-Message-result').addClass('div-hide');
		// modal footer
		$('.viewMessageFooter').addClass('div-hide');
		
		console.log(Message_id);

		$.ajax({
			url: 'message/get_single_message',
			type: 'post',
			data: {msg_id : Message_id},
			dataType: 'json',
			success:function(response) {

				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.view-Message-result').removeClass('div-hide');
				// modal footer
                $('.viewMessageFooter').removeClass('div-hide');                
				// setting the Message name value 
				console.log(response);
				$('.view_Message_data').html('<div class="row"><div class="col-md-6"> <p><b> Id : </b>'+response['msg_id']+'</p> <p><b> From : </b>'+response['msg_name']+'</p> <p><b> Mail Id : </b>'+response['msg_mail']+' </p> <p><b>Contact no. : </b>'+response['msg_contact']+' </p> <p><b>Date : </b>'+response['msg_added_date']+' </p> </div> <div class="col-md-6"><p><b>Message : </b>'+response['msg_content']+'</p></div></div>');
			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit Messages function

// remove Message 
function removeMessage(Message_id = null) {
	if(Message_id) {
		$('#removeMessage_id').remove();

		// click on remove button to remove the Message
		$("#removeMessageBtn").unbind('click').bind('click', function() {
			// button loading
			$("#removeMessageBtn").attr('disabled', 'disabled');

			$.ajax({
				url: 'message/remove_message',
				type: 'post',
				data: {msg_id : Message_id},
				dataType: 'json',
				success:function(response) {

					console.log(response);

					// button loading
					$("#removeMessageBtn").removeAttr('disabled');
					// hide the remove modal 
					$('#removeMessageModal').modal('hide');

					// reload the Message table 
					manageMessageTable.ajax.reload(null, false);
					
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
			}); // /ajax function to remove the Message

		}); // /click on remove button to remove the Message

		$('.removeMessageFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove Messages function