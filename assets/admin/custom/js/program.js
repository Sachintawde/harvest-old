var manageProgramTable;

$(document).ready(function () {
    // top bar active
    $('.navProgram').addClass('active');

    // manage Image table
    manageProgramTable = $("#manageProgramTable").DataTable({
        'ajax': 'program/get_all_program',
        'image': [],
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            {
                extend: 'pdf',
                title: 'harvest Image List',
                filename: 'harvest_program_pdf',
                exportOptions: {
                    columns: [0, ':visible']
                }
            }, {
                extend: 'excel',
                title: 'harvest Image List',
                filename: 'harvest_program_excel',
                exportOptions: {
                    columns: [0, ':visible']
                }
            }, {
                extend: 'print',
                title: 'harvest Image List',
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
        });

    $("#min").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        changeMonth: true,
        changeYear: true
    }).on('changeDate', function () {
        manageProgramTable.draw();
    });
    $("#max").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        changeMonth: true,
        changeYear: true
    }).on('changeDate', function () {
        manageProgramTable.draw();
    });
    // Program listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function () {
        manageProgramTable.draw();
    });

    // add product modal btn clicked
    $("#addProgramModalBtn")
        .unbind('click')
        .bind('click', function () {
            //  product form reset 
            $("#submitProgramForm")[0].reset();
            $('.myprogress').css('width', '0');
            $('.up_msg').text('');

            // remove text-error
            $(".text-danger").remove();
            // remove from-group error
            $(".form-group")
                .removeClass('has-error')
                .removeClass('has-success');

            $("#program_path").fileinput({

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
            $("#program_path_two").fileinput({

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
            $("#submitProgramForm")
                .unbind('submit')
                .bind('submit', function () {

                    $('.form-group')
                        .removeClass('has-error')
                        .removeClass('has-success');
                    $('.text-danger').remove();
                    $('.myprogress').css('width', '0');
                    $('.up_msg').text('');
                    var isValid = true;

                    $('#submitProgramForm input[type="text"], #submitProgramForm input[type="file"]').each(
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
                        $('#createProgramBtn').attr('disabled', 'disabled');
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
                                $("#createProgramBtn").removeAttr('disabled');
                                $('.up_msg').text(response.messages);

                                // reload the manage student table
                                manageProgramTable
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

function viewProgram(Program_id = null) {
    if (Program_id) {
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
        $('.viewProgramFooter').addClass('div-hide');

        $.ajax({
            url: 'program/get_single_program',
            type: 'post',
            data: {
                program_id: Program_id
            },
            dataType: 'json',
            success: function (response) {

                // modal loading
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.view-Image-result').removeClass('div-hide');
                // modal footer
                $('.viewProgramFooter').removeClass('div-hide');
                // setting the Program name value

                $('.view_program_data').html(
                    '<b>Section 1</b><hr><div class="row"><div class="col-md-6"><p><b>Program Name : </b>' + response['program_name'] +' </p> <p><b>Program Title : </b>' + response['program_title_five'] +' </p>  <p><b>Description : </b>' + response['program_desc'] +' </p> </div> <div class="co' +
                    'l-md-6"><img style="width:150px;height:auto;" src="' + response['program_path'] + '"> </div></div><b>Section 2</b><hr><div class="row"><div class="col-md-6"> <p><b>Program Title : </b>' + response['program_title_six'] +' </p> <p><b>Description : </b>' + response['program_desc_two'] +' </p> </div> <div class="co' +
                    'l-md-6"><img style="width:150px;height:auto;" src="' + response['program_path_two'] + '"> </div></div><b>Curriculum</b><hr><div class="row"><div class="col-md-6"><p><b>Title 1 : </b>' + response['program_title'] +' </p>  <p><b>Description : </b>' + response['program_desc_four'] +' </p> </div></div><div class="row"><div class="col-md-6"><p><b>Title 2 : </b>' + response['program_title_two'] +' </p>  <p><b>Description : </b>' + response['program_desc_five'] +' </p> </div></div><div class="row"><div class="col-md-6"><p><b>Title 3 : </b>' + response['program_title_three'] +' </p>  <p><b>Description : </b>' + response['program_desc_six'] +' </p> </div></div><div class="row"><div class="col-md-6"><p><b>Title 4 : </b>' + response['program_title_four'] +' </p>  <p><b>Description : </b>' + response['program_desc_seven'] +' </p><p><b>Title 5 : </b>' + response['program_title_seven'] +' </p>  <p><b>Description : </b>' + response['program_desc_three'] +' </p><p><b>Title 6 : </b>' + response['program_title_eight'] +' </p>  <p><b>Description : </b>' + response['program_desc_eight'] +' </p><p><b>Title 7 : </b>' + response['program_title_nine'] +' </p>  <p><b>Description : </b>' + response['program_desc_nine'] +' </p><p><b>Title 8 : </b>' + response['program_title_ten'] +' </p>  <p><b>Description : </b>' + response['program_desc_ten'] +' </p><p><b>Title 9 : </b>' + response['program_title_eleven'] +' </p>  <p><b>Description : </b>' + response['program_desc_eleven'] +' </p> </div></div>'
                );
            } // /success
        }); // ajax function

    } else {
        alert('error!! Refresh the page again');
    }
} // /edit Images function

function editProgram(Program_id = null) {
    if (Program_id) {

        $("#editProgramForm")[0].reset();
        $("#updateProgramForm")[0].reset();

        $('.myprogress').css('width', '0');
        $('.up_msg').text('');

        $("#program_id").remove();
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
        $('.editProgramImageFooter').addClass('div-hide');

        $.ajax({
            url: 'program/get_single_program',
            type: 'post',
            data: {
                program_id: Program_id
            },
            dataType: 'json',
            success: function (response) {

                // modal loading
                $('.div-loading').addClass('div-hide');
                // modal result
                $('.div-result').removeClass('div-hide');
                // modal footer
                $('.editProgramImageFooter').removeClass('div-hide');
                // setting the Image status value

                $("#getProgramImage").attr('src', response['program_path']);
                $("#getProgramImageTwo").attr('src', response['program_path_two']);


                $("#edit_program_path").fileinput({});
                $("#edit_program_path_two").fileinput({});


                // Image id
                $(".editProgramImageFooter").after(
                    '<input type="hidden" name="program_id_1" id="program_id_1" value="' + Program_id +
                    '" />'
                );
                // Galllery id
                $(".editProgramFooter").append(
                    '<input type="hidden" name="program_id_2" id="program_id_2" value="' + Program_id +
                    '" />'
                );

                $("#edit_program_name").val(response['program_name']);
                $("#edit_program_title").val(response['program_title']);
                $("#edit_program_title_two").val(response['program_title_two']);
                $("#edit_program_title_three").val(response['program_title_three']);
                $("#edit_program_title_four").val(response['program_title_four']);
                $("#edit_program_title_five").val(response['program_title_five']);
                $("#edit_program_title_six").val(response['program_title_six']);
                $("#edit_program_title_seven").val(response['program_title_seven']);
                $("#edit_program_title_eight").val(response['program_title_eight']);
                $("#edit_program_title_nine").val(response['program_title_nine']);
                $("#edit_program_title_ten").val(response['program_title_ten']);
                $("#edit_program_title_eleven").val(response['program_title_eleven']);

                $("#edit_program_desc").val(response['program_desc']);
                $("#edit_program_desc_two").val(response['program_desc_two']);
                $("#edit_program_desc_three").val(response['program_desc_three']);
                $("#edit_program_desc_four").val(response['program_desc_four']);
                $("#edit_program_desc_five").val(response['program_desc_five']);
                $("#edit_program_desc_six").val(response['program_desc_six']);
                $("#edit_program_desc_seven").val(response['program_desc_seven']);
                $("#edit_program_desc_eight").val(response['program_desc_eight']);
                $("#edit_program_desc_nine").val(response['program_desc_nine']);
                $("#edit_program_desc_ten").val(response['program_desc_ten']);
                $("#edit_program_desc_eleven").val(response['program_desc_eleven']);

                $("#edit_program_display").val(response['program_display']);
                $("#edit_program_display_two").val(response['program_display_two']);
                $("#edit_program_display_three").val(response['program_display_three']);
                $("#edit_program_display_four").val(response['program_display_four']);
                $("#edit_program_display_five").val(response['program_display_five']);
                $("#edit_program_display_six").val(response['program_display_six']);
                $("#edit_program_display_seven").val(response['program_display_seven']);
                $("#edit_program_display_eight").val(response['program_display_eight']);
                $("#edit_program_display_nine").val(response['program_display_nine']);


                $("#editProgramForm").find('input').each(function () {
                        if ($(this).val()) {
                            $(this).parent(".nk-int-st").addClass("nk-toggled");
                        }
                    });

                // update the Student data function
                $("#editProgramForm")
                    .unbind('submit')
                    .bind('submit', function () {

                        var isValid = true;

                        $('#editProgramForm input').each(function () {
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
                            $("#editProgramBtn").attr('disabled', 'disabled');

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
                                    $("#editProgramBtn").removeAttr('disabled');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                        scrollTop: '0'
                                    }, 100);

                                    // shows a successful message after operation
                                    $('#edit-Program-messages').html(
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
                                    manageProgramTable
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
                $("#updateProgramForm")
                    .unbind('submit')
                    .bind('submit', function () {
                        // form validation
                        var ProgramImage = $("#edit_program_path").val();
                        var ProgramImageTwo = $("#edit_program_path_two").val();


                        console.log(ProgramImage);

                        if (ProgramImage == "") {
                            $("#edit_program_path")
                                .closest('.center-block')
                                .after('<p class="text-danger">program Image field is required</p>');
                            $('#edit_program_path')
                                .closest('.form-group')
                                .addClass('has-error');
                        } else {
                            // remov error text field
                            $("#edit_program_path")
                                .find('.text-danger')
                                .remove();
                            // success out for form
                            $("#edit_program_path")
                                .closest('.form-group')
                                .addClass('has-success');
                        } // /else

                        if (ProgramImage) {
                            // submit loading button
                            $("#editProgramImageBtn").attr('disabled', 'disabled');

                            var form = $(this);
                            var formData = new FormData(this);

                            var filedata = $('#edit_program_path')[0].files[0];
                            formData.append('program_path', filedata);                        
                            formData.append('program_id', $('#program_id_1').val());
                            

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
                                    $("#editProgramImageBtn").removeAttr('disabled');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                        scrollTop: '0'
                                    }, 100);

                                    // shows a successful message after operation
                                    $('#edit-Image-Program-messages').html(
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
                                    manageProgramTable.ajax.reload(null, true);

                                    $(".fileinput-remove-button").click();

                                    $.ajax({
                                        url: 'program/get_single_program',
                                        data: {
                                            program_id: Program_id
                                        },
                                        type: 'post',
                                        success: function (response_img) {

                                            console.log(response_img);

                                            $("#getProgramImage").attr('src', response_img['program_path']);
                                            $("#getProgramImageTwo").attr('src', response_img['program_path_two']);

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

function removeProgram(Program_id = null) {
    if (Program_id) {
        $('#removeProgram_id').remove();

        // click on remove button to remove the Image
        $("#removeProgramBtn")
            .unbind('click')
            .bind('click', function () {
                // button loading
                $("#removeProgramBtn").attr('disabled', 'disabled');

                $.ajax({ 
                    url: 'program/remove_program',
                    type: 'post',
                    data: {
                        program_id: Program_id
                    },
                    dataType: 'json',
                    success: function (response) {

                        // button loading
                        $("#removeProgramBtn").removeAttr('disabled');
                        // hide the remove modal
                        $('#removeProgramModal').modal('hide');

                        // reload the Image table
                        manageProgramTable
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