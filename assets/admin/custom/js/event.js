var manageEventTable;

$(document).ready(function () {
    // top bar active
    $('.navEvent').addClass('active');

    // manage Image table
    manageEventTable = $("#manageEventTable").DataTable({
        'ajax': 'event/get_all_event',
        'image': [],
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            {
                extend: 'pdf',
                title: 'Harvest Image List',
                filename: 'harvest_event_pdf',
                exportOptions: {
                    columns: [0, ':visible']
                }
            }, {
                extend: 'excel',
                title: 'Harvest Image List',
                filename: 'harvest_event_excel',
                exportOptions: {
                    columns: [0, ':visible']
                }
            }, {
                extend: 'print',
                title: 'Harvest Image List',
                text: 'print',
                autoPrint: false,
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            'colvis'
        ]
    });

    $
        .fn
        .dataTable
        .ext
        .search
        .push(function (settings, data, dataIndex) {
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
        });

    $("#min").datepicker({
        onSelect: function () {
            manageEventTable.draw();
        },
        changeMonth: true,
        changeYear: true
    });
    $("#max").datepicker({
        onSelect: function () {
            manageEventTable.draw();
        },
        changeMonth: true,
        changeYear: true
    });
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function () {
        manageEventTable.draw();
    });

    // add product modal btn clicked
    $("#addEventModalBtn")
        .unbind('click')
        .bind('click', function () {
            //  product form reset
            $("#submitEventForm")[0].reset();
            $('.myprogress').css('width', '0');
            $('.up_msg').text('');

            // remove text-error
            $(".text-danger").remove();
            // remove from-group error
            $(".form-group")
                .removeClass('has-error')
                .removeClass('has-success');

            $("#event_path").fileinput({

                overwriteInitial: true,
                maxFileSize: 2500,
                showClose: false,
                showCaption: false,
                defaultPreviewContent: '<img src="' + base_url + 'assets/admin/images/profile.png" alt="Image / Thumbn' +
                        'ail" style="display:block; margin: 0 auto; width: 30%;">',
                layoutTemplates: {
                    main2: '{preview} {remove} {browse}'
                },
                allowedFileExtensions: [
                    "jpg",
                    "png",
                    "gif",
                    "JPG",
                    "PNG",
                    "GIF",
                    "jpeg"
                ]
            });

            // submit Image form function
            $("#submitEventForm")
                .unbind('submit')
                .bind('submit', function () {

                    $('.form-group')
                        .removeClass('has-error')
                        .removeClass('has-success');
                    $('.text-danger').remove();
                    $('.myprogress').css('width', '0');
                    $('.up_msg').text('');
                    var isValid = true;

                    $('#submitEventForm input[type="text"], #submitEventForm input[type="file"]').each(
                        function () {
                            var element = $(this);
                            if (element.val() == "") {
                                isValid = false;
                                element
                                    .closest('.form-group')
                                    .append('<span class="text-danger"> This field is required </span>');
                                element
                                    .closest('.form-group')
                                    .addClass('has-error');
                            } else {
                                // remove text-error
                                if (element.closest('span').hasClass('text-danger')) {
                                    element
                                        .closest(".text-danger")
                                        .remove();
                                    element
                                        .closest('.form-group')
                                        .addClass('has-success');
                                } else {
                                    isValid = true;
                                }
                            } // /else
                        }
                    );

                    if (isValid == true) {
                        $('#createEventBtn').attr('disabled', 'disabled');
                        $('.up_msg').text('Uploading in progress...');
                        var form = $(this);
                        var formData = new FormData(this);

                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: formData,
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            xhr: function () {
                                var xhr = new window.XMLHttpRequest();
                                xhr
                                    .upload
                                    .addEventListener("progress", function (evt) {
                                        if (evt.lengthComputable) {
                                            var percentComplete = evt.loaded / evt.total;
                                            percentComplete = parseInt(percentComplete * 100);
                                            $('.myprogress').text(percentComplete + '%');
                                            $('.myprogress').css('width', percentComplete + '%');
                                        }
                                    }, false);
                                return xhr;
                            },
                            success: function (response) {

                                // submit loading button
                                $("#createEventBtn").removeAttr('disabled');
                                $('.up_msg').text(response.messages);

                                // reload the manage student table
                                manageEventTable
                                    .ajax
                                    .reload(null, true);

                                // remove text-error
                                $(".text-danger").remove();
                                // remove from-group error
                                $(".form-group")
                                    .removeClass('has-error')
                                    .removeClass('has-success');
                            } // /success
                        }); // /ajax
                    } // if

                    return false;
                }); // /submit Image form function

        });

});

function viewEvent(Event_id = null) {
    if (Event_id) {
        $('.myprogress').css('width', '0');
        $('.up_msg').text('');
        // remove the form-error
        $('.form-group')
            .removeClass('has-error')
            .removeClass('has-success');
        // modal loading
        $('.modal-loading').removeClass('div-hide');
        // modal result
        $('.view-Image-result').addClass('div-hide');
        // modal footer
        $('.viewEventFooter').addClass('div-hide');

        $.ajax({
            url: 'event/get_single_event',
            type: 'post',
            data: {
                event_id: Event_id
            },
            dataType: 'json',
            success: function (response) {

                // modal loading
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.view-Image-result').removeClass('div-hide');
                // modal footer
                $('.viewEventFooter').removeClass('div-hide');
                // setting the Event name value

                var formattedStartDate = formatDate(response['event_start']);
                var formattedEndDate = formatDate(response['event_end']);

                $('.view_event_data').html(
                    '<div class="row"><div class="col-md-6"> <p><b> Title : </b>' +
                    response['event_name'] + ' </p> <p><b>Start : </b>' + formattedStartDate +
                    ' </p><p><b>End : </b>' + formattedEndDate +
                    ' </p><p><b>Class Name : </b>' + response['event_classname'] +
                    ' </p><p><b>Icon : </b>' + response['event_icon'] +
                    ' </p> <p><b>Description : </b>' + response['event_desc'] +
                    ' </p><p><b>Event Type : </b>' + response['event_type'] +
                    ' </p> <p><b>Location : </b>' + response['event_location'] + ' </p> </div> <div class="co' +
                    'l-md-6"><img style="width:150px;height:auto;" src="' + response['event_path'] + '"> </div></div>'
                );
            } // /success
        }); // ajax function

    } else {
        alert('error!! Refresh the page again');
    }
}

// Function to format date as dd-mm-yy HH:mm
function formatDate(inputDateTime) {
    var dateTime = new Date(inputDateTime);
    var day = dateTime.getDate();
    var month = dateTime.getMonth() + 1;
    var year = dateTime.getFullYear();
    var hours = dateTime.getHours();
    var minutes = dateTime.getMinutes();

    // Pad single-digit day, month, hours, and minutes with leading zero
    day = day < 10 ? '0' + day : day;
    month = month < 10 ? '0' + month : month;
    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '0' + minutes : minutes;

    return day + '-' + month + '-' + year + ' ' + hours + ':' + minutes;
}


function editEvent(Event_id = null) {
    if (Event_id) {

        $("#editEventForm")[0].reset();
        $("#updateEventForm")[0].reset();

        $('.myprogress').css('width', '0');
        $('.up_msg').text('');

        $("#event_id").remove();
        // remove text-error
        $(".text-danger").remove();
        // remove from-group error
        $(".form-group")
            .removeClass('has-error')
            .removeClass('has-success');
        // modal spinner
        $('.div-loading').removeClass('div-hide');
        // modal result
        $('.div-result').addClass('div-hide');
        // modal footer
        $('.editEventImageFooter').addClass('div-hide');

        $.ajax({
            url: 'event/get_single_event',
            type: 'post',
            data: {
                event_id: Event_id
            },
            dataType: 'json',
            success: function (response) {

                // modal loading
                $('.div-loading').addClass('div-hide');
                // modal result
                $('.div-result').removeClass('div-hide');
                // modal footer
                $('.editEventImageFooter').removeClass('div-hide');
                // setting the Image status value

                $("#getEventImage").attr('src', response['event_path']);

                $("#edit_event_path").fileinput({});

                // Image id
                $(".editEventImageFooter").after(
                    '<input type="hidden" name="event_id_1" id="event_id_1" value="' + Event_id +
                    '" />'
                );
                // Galllery id
                $(".editEventFooter").append(
                    '<input type="hidden" name="event_id_2" id="event_id_2" value="' + Event_id +
                    '" />'
                );
                if(!(response['event_type'] == null || response['event_type'] == '-')){
					$('select[name="edit_event_type"] option[value="'+response['event_type']+'"]').attr("selected","selected");
					$('select[name="edit_event_type"]').selectpicker("refresh");	
				}else{
					$('select[name="edit_event_type"] option:selected').each(function () {
						$(this).removeAttr('selected'); 
					});
					$('select[name="edit_event_type"]').selectpicker("refresh");	
				}

                $("#edit_event_name").val(response['event_name']);
                $("#edit_event_start").val(response['event_start']);
                $("#edit_event_end").val(response['event_end']);
                $("#edit_event_classname").val(response['event_classname']);
                $("#edit_event_icon").val(response['event_icon']);
                CKEDITOR.instances['edit_event_desc'].setData(response['event_desc']);
				$("#edit_event_type").val(response['event_type']);
				$("#edit_event_location").val(response['event_location']);

                $("#editEventForm").find('input').each(function () {
                        if ($(this).val()) {
                            $(this).parent(".nk-int-st").addClass("nk-toggled");
                        }
                    });

                // update the Student data function
                $("#editEventForm")
                    .unbind('submit')
                    .bind('submit', function () {

                        var isValid = true;

                        $('#editEventForm input').each(function () {
                            var element = $(this);
                            if (element.val() == "") {
                                isValid = false;
                                element
                                    .closest('.form-group')
                                    .append('<span class="text-danger"> This field is required </span>');
                                element
                                    .closest('.form-group')
                                    .addClass('has-error');
                            } else {
                                // remove text-error
                                if (element.closest('span').hasClass('text-danger')) {
                                    element
                                        .closest(".text-danger")
                                        .remove();
                                    element
                                        .closest('.form-group')
                                        .addClass('has-success');
                                } else {
                                    isValid = true;
                                }
                            } // /else
                        }); 

                        if (isValid == true) {
                            // submit loading button
                            $("#editEventBtn").attr('disabled', 'disabled');

                            var form = $(this);
                            var formData = new FormData(this);

                            $.ajax({
                                url: form.attr('action'),
                                type: form.attr('method'),
                                data: formData,
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (response) {

                                    console.log(response);
                                    // submit loading button
                                    $("#editEventBtn").removeAttr('disabled');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                        scrollTop: '0'
                                    }, 100);

                                    // shows a successful message after operation
                                    $('#edit-Event-messages').html(
                                        '<div class="alert alert-' + response.status + '"><button type="button" class="' +
                                        'close" data-dismiss="alert">&times;</button><strong><i class="glyphicon glyphi' +
                                        'con-ok-sign"></i></strong> ' + response.messages + '</div>'
                                    );

                                    // remove the mesages
                                    $(".alert-" + response.status)
                                        .delay(500)
                                        .show(10, function () {
                                            $(this)
                                                .delay(3000)
                                                .hide(10, function () {
                                                    $(this).remove();
                                                });
                                        }); // /.alert

                                    // reload the manage student table
                                    manageEventTable
                                        .ajax
                                        .reload(null, true);

                                    // remove text-error
                                    $(".text-danger").remove();
                                    // remove from-group error
                                    $(".form-group")
                                        .removeClass('has-error')
                                        .removeClass('has-success');

                                } // /success function
                            }); // /ajax function
                        } // /if validation is ok

                        return false;
                    }); // update the Student data function

                // update the Student image
                $("#updateEventForm")
                    .unbind('submit')
                    .bind('submit', function () {
                        // form validation
                        var EventImage = $("#edit_event_path").val();

                        console.log(EventImage);

                        if (EventImage == "") {
                            $("#edit_event_path")
                                .closest('.center-block')
                                .after('<p class="text-danger">event Image field is required</p>');
                            $('#edit_event_path')
                                .closest('.form-group')
                                .addClass('has-error');
                        } else {
                            // remov error text field
                            $("#edit_event_path")
                                .find('.text-danger')
                                .remove();
                            // success out for form
                            $("#edit_event_path")
                                .closest('.form-group')
                                .addClass('has-success');
                        } // /else

                        if (EventImage) {
                            // submit loading button
                            $("#editEventImageBtn").attr('disabled', 'disabled');

                            var form = $(this);
                            var formData = new FormData(this);

                            var filedata = $('#edit_event_path')[0].files[0];
                            formData.append('event_path', filedata);                        
                            formData.append('event_id', $('#event_id_1').val());

                            $.ajax({
                                url: form.attr('action'),
                                type: form.attr('method'),
                                data: formData,
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (response) {

                                    console.log(response);

                                    // submit loading button
                                    $("#editEventImageBtn").removeAttr('disabled');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                        scrollTop: '0'
                                    }, 100);

                                    // shows a successful message after operation
                                    $('#edit-Image-Event-messages').html(
                                        '<div class="alert alert-' + response.status + '"><button type="button" class="' +
                                        'close" data-dismiss="alert">&times;</button><strong><i class="glyphicon glyphi' +
                                        'con-ok-sign"></i></strong> ' + response.messages + '</div>'
                                    );

                                    // remove the mesages
                                    $(".alert-" + response.status)
                                        .delay(500)
                                        .show(10, function () {
                                            $(this)
                                                .delay(3000)
                                                .hide(10, function () {
                                                    $(this).remove();
                                                });
                                        }); // /.alert

                                    // reload the manage student table
                                    manageEventTable.ajax.reload(null, true);

                                    $(".fileinput-remove-button").click();

                                    $.ajax({
                                        url: 'event/get_single_event',
                                        data: {
                                            event_id: Event_id
                                        },
                                        type: 'post',
                                        success: function (response_img) {

                                            console.log(response_img);

                                            $("#getEventImage").attr('src', response_img['event_path']);
                                        }
                                    });

                                    // remove text-error
                                    $(".text-danger").remove();
                                    // remove from-group error
                                    $(".form-group")
                                        .removeClass('has-error')
                                        .removeClass('has-success');

                                } // /success function
                            }); // /ajax function
                        } // /if validation is ok

                        return false;
                    }); // /update the Student image
            } // /success
        }); // ajax function
    } else {
        alert('error!! Refresh the page again');
    }
} // /edit Images function

function removeEvent(Event_id = null) {
    if (Event_id) {
        $('#removeEvent_id').remove();

        // click on remove button to remove the Image
        $("#removeEventBtn")
            .unbind('click')
            .bind('click', function () {
                // button loading
                $("#removeEventBtn").attr('disabled', 'disabled');

                $.ajax({
                    url: 'event/remove_event',
                    type: 'post',
                    data: {
                        event_id: Event_id
                    },
                    dataType: 'json',
                    success: function (response) {

                        // button loading
                        $("#removeEventBtn").removeAttr('disabled');
                        // hide the remove modal
                        $('#removeEventModal').modal('hide');

                        // reload the Image table
                        manageEventTable
                            .ajax
                            .reload(null, false);

                        $('.remove-messages').html(
                            '<div class="alert alert-' + response.status + '"><button type="button" class="' +
                            'close" data-dismiss="alert">&times;</button><strong><i class="glyphicon glyphi' +
                            'con-ok-sign"></i></strong> ' + response.messages + '</div>'
                        );

                        $('.alert-' + response.status)
                            .delay(500)
                            .show(10, function () {
                                $(this)
                                    .delay(3000)
                                    .hide(10, function () {
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