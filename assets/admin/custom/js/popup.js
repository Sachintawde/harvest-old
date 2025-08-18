var managePopupTable;

$(document).ready(function () {
    // top bar active
    $('.navPopup').addClass('active');

    // manage Image table
    managePopupTable = $("#managePopupTable").DataTable({
        'ajax': 'popup/get_all_popup',
        'image': [],
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            {
                extend: 'pdf',
                title: 'Harvest Image List',
                filename: 'harvest_popup_pdf',
                exportOptions: {
                    columns: [0, ':visible']
                }
            }, {
                extend: 'excel',
                title: 'Harvest Image List',
                filename: 'harvest_popup_excel',
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
            managePopupTable.draw();
        },
        changeMonth: true,
        changeYear: true
    });
    $("#max").datepicker({
        onSelect: function () {
            managePopupTable.draw();
        },
        changeMonth: true,
        changeYear: true
    });
    // Popup listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function () {
        managePopupTable.draw();
    });

    // add product modal btn clicked
    $("#addPopupModalBtn")
        .unbind('click')
        .bind('click', function () {
            //  product form reset
            $("#submitPopupForm")[0].reset();
            $('.myprogress').css('width', '0');
            $('.up_msg').text('');

            // remove text-error
            $(".text-danger").remove();
            // remove from-group error
            $(".form-group")
                .removeClass('has-error')
                .removeClass('has-success');

            $("#popup_path").fileinput({

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
            $("#submitPopupForm")
                .unbind('submit')
                .bind('submit', function () {

                    $('.form-group')
                        .removeClass('has-error')
                        .removeClass('has-success');
                    $('.text-danger').remove();
                    $('.myprogress').css('width', '0');
                    $('.up_msg').text('');
                    var isValid = true;

                    $('#submitPopupForm input[type="text"], #submitPopupForm input[type="file"]').each(
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
                        $('#createPopupBtn').attr('disabled', 'disabled');
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
                                $("#createPopupBtn").removeAttr('disabled');
                                $('.up_msg').text(response.messages);

                                // reload the manage student table
                                managePopupTable
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

function viewPopup(Popup_id = null) {
    if (Popup_id) {
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
        $('.viewPopupFooter').addClass('div-hide');

        $.ajax({
            url: 'popup/get_single_popup',
            type: 'post',
            data: {
                popup_id: Popup_id
            },
            dataType: 'json',
            success: function (response) {

                // modal loading
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.view-Image-result').removeClass('div-hide');
                // modal footer
                $('.viewPopupFooter').removeClass('div-hide');
                // setting the Popup name value

                $('.view_popup_data').html(
                    '<div class="row"><div class="col-md-6"> <p><b> Title : </b>' +
                    response['popup_name'] + ' </p> <p><b>Description : </b>' + response['popup_desc'] +
                    ' </p> </div> <div class="co' +
                    'l-md-6"><img style="width:150px;height:auto;" src="' + response['popup_path'] + '"> </div></div>'
                );
            } // /success
        }); // ajax function

    } else {
        alert('error!! Refresh the page again');
    }
} // /edit Images function

function editPopup(Popup_id = null) {
    if (Popup_id) {

        $("#editPopupForm")[0].reset();
        $("#updatePopupForm")[0].reset();

        $('.myprogress').css('width', '0');
        $('.up_msg').text('');

        $("#popup_id").remove();
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
        $('.editPopupImageFooter').addClass('div-hide');


        $.ajax({
            url: 'popup/get_single_popup',
            type: 'post',
            data: {
                popup_id: Popup_id
            },
            dataType: 'json',
            success: function (response) {

                // modal loading
                $('.div-loading').addClass('div-hide');
                // modal result
                $('.div-result').removeClass('div-hide');
                // modal footer
                $('.editPopupImageFooter').removeClass('div-hide');
                // setting the Image status value

                $("#getPopupImage").attr('src', response['popup_path']);

                $("#edit_popup_path").fileinput({});

                // Image id
                $(".editPopupImageFooter").after(
                    '<input type="hidden" name="popup_id_1" id="popup_id_1" value="' + Popup_id +
                    '" />'
                );
                // Galllery id
                $(".editPopupFooter").append(
                    '<input type="hidden" name="popup_id_2" id="popup_id_2" value="' + Popup_id +
                    '" />'
                );

                $("#edit_popup_name").val(response['popup_name']);
                $("#edit_popup_desc").val(response['popup_desc']);

                $("#editPopupForm").find('input').each(function () {
                        if ($(this).val()) {
                            $(this).parent(".nk-int-st").addClass("nk-toggled");
                        }
                    });

                // update the Student data function
                $("#editPopupForm")
                    .unbind('submit')
                    .bind('submit', function () {

                        var isValid = true;

                        $('#editPopupForm input').each(function () {
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
                            $("#editPopupBtn").attr('disabled', 'disabled');

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
                                    $("#editPopupBtn").removeAttr('disabled');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                        scrollTop: '0'
                                    }, 100);

                                    // shows a successful message after operation
                                    $('#edit-Popup-messages').html(
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
                                    managePopupTable
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
                $("#updatePopupForm")
                    .unbind('submit')
                    .bind('submit', function () {
                        // form validation
                        var PopupImage = $("#edit_popup_path").val();

                        console.log(PopupImage);

                        if (PopupImage == "") {
                            $("#edit_popup_path")
                                .closest('.center-block')
                                .after('<p class="text-danger">popup Image field is required</p>');
                            $('#edit_popup_path')
                                .closest('.form-group')
                                .addClass('has-error');
                        } else {
                            // remov error text field
                            $("#edit_popup_path")
                                .find('.text-danger')
                                .remove();
                            // success out for form
                            $("#edit_popup_path")
                                .closest('.form-group')
                                .addClass('has-success');
                        } // /else

                        if (PopupImage) {
                            // submit loading button
                            $("#editPopupImageBtn").attr('disabled', 'disabled');

                            var form = $(this);
                            var formData = new FormData(this);

                            var filedata = $('#edit_popup_path')[0].files[0];
                            formData.append('popup_path', filedata);                        
                            formData.append('popup_id', $('#popup_id_1').val());

                            // var redirect = form.attr('action');
                            // $.redirect(redirect, formData, "POST", "_blank");

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
                                    $("#editPopupImageBtn").removeAttr('disabled');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                        scrollTop: '0'
                                    }, 100);

                                    // shows a successful message after operation
                                    $('#edit-Image-Popup-messages').html(
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
                                    managePopupTable.ajax.reload(null, true);

                                    $(".fileinput-remove-button").click();

                                    $.ajax({
                                        url: 'popup/get_single_popup',
                                        data: {
                                            popup_id: Popup_id
                                        },
                                        type: 'post',
                                        success: function (response_img) {

                                            console.log(response_img);

                                            $("#getPopupImage").attr('src', response_img['popup_path']);
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

function removePopup(Popup_id = null) {
    if (Popup_id) {
        $('#removePopup_id').remove();

        // click on remove button to remove the Image
        $("#removePopupBtn")
            .unbind('click')
            .bind('click', function () {
                // button loading
                $("#removePopupBtn").attr('disabled', 'disabled');

                $.ajax({
                    url: 'popup/remove_popup',
                    type: 'post',
                    data: {
                        popup_id: Popup_id
                    },
                    dataType: 'json',
                    success: function (response) {

                        // button loading
                        $("#removePopupBtn").removeAttr('disabled');
                        // hide the remove modal
                        $('#removePopupModal').modal('hide');

                        // reload the Image table
                        managePopupTable
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