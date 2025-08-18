var manageBlogTable;

$(document).ready(function () {
    // top bar active
    $('.navBlog').addClass('active');

    // manage Image table
    manageBlogTable = $("#manageBlogTable").DataTable({
        'ajax': 'blog/get_all_blog',
        'image': [],
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            {
                extend: 'pdf',
                title: 'Harvest Image List',
                filename: 'harvest_blog_pdf',
                exportOptions: {
                    columns: [0, ':visible']
                }
            }, {
                extend: 'excel',
                title: 'Harvest Image List',
                filename: 'harvest_blog_excel',
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
        manageBlogTable.draw();
    });
    $("#max").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        changeMonth: true,
        changeYear: true
    }).on('changeDate', function () {
        manageBlogTable.draw();
    });
    // Blog listener to the two range filtering inputs to redraw on input
    $('#min, #max').change(function () {
        manageBlogTable.draw();
    });

    // add product modal btn clicked
    $("#addBlogModalBtn")
        .unbind('click')
        .bind('click', function () {
            //  product form reset
            $("#submitBlogForm")[0].reset();
            $('.myprogress').css('width', '0');
            $('.up_msg').text('');

            // remove text-error
            $(".text-danger").remove();
            // remove from-group error
            $(".form-group")
                .removeClass('has-error')
                .removeClass('has-success');

            $("#blog_path").fileinput({

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
            $("#submitBlogForm")
                .unbind('submit')
                .bind('submit', function () {

                    $('.form-group')
                        .removeClass('has-error')
                        .removeClass('has-success');
                    $('.text-danger').remove();
                    $('.myprogress').css('width', '0');
                    $('.up_msg').text('');
                    var isValid = true;

                    $('#submitBlogForm input[type="text"], #submitBlogForm input[type="file"]').each(
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
                        $('#createBlogBtn').attr('disabled', 'disabled');
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
                                $("#createBlogBtn").removeAttr('disabled');
                                $('.up_msg').text(response.messages);

                                // reload the manage student table
                                manageBlogTable
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

function viewBlog(Blog_id = null) {
    if (Blog_id) {
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
        $('.viewBlogFooter').addClass('div-hide');

        $.ajax({
            url: 'blog/get_single_blog',
            type: 'post',
            data: {
                blog_id: Blog_id
            },
            dataType: 'json',
            success: function (response) {
                // modal loading
                $('.modal-loading').addClass('div-hide');
                // modal result
                $('.view-Image-result').removeClass('div-hide');
                // modal footer
                $('.viewBlogFooter').removeClass('div-hide');
                // setting the Blog name value
                var formattedDate = formatDate(response['blog_datee']);

                $('.view_blog_data').html(
                    '<div class="row"><div class="col-md-6"> <p><b> Title : </b>' +
                    response['blog_name'] + ' </p> <p><b>Date : </b>' + formattedDate +
                    ' </p> <p><b>Description : </b>' + response['blog_desc'] +
                    ' </p> </div> <div class="col-md-6"><img style="width:150px;height:auto;" src="' + response['blog_path'] + '"> </div></div>'
                );
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


function editBlog(Blog_id = null) {
    if (Blog_id) {

        $("#editBlogForm")[0].reset();
        $("#updateBlogForm")[0].reset();

        $('.myprogress').css('width', '0');
        $('.up_msg').text('');

        $("#blog_id").remove();
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
        $('.editBlogImageFooter').addClass('div-hide');


        $.ajax({
            url: 'blog/get_single_blog',
            type: 'post',
            data: {
                blog_id: Blog_id
            },
            dataType: 'json',
            success: function (response) {

                // modal loading
                $('.div-loading').addClass('div-hide');
                // modal result
                $('.div-result').removeClass('div-hide');
                // modal footer
                $('.editBlogImageFooter').removeClass('div-hide');
                // setting the Image status value

                $("#getBlogImage").attr('src', response['blog_path']);

                $("#edit_blog_path").fileinput({});

                // Image id
                $(".editBlogImageFooter").after(
                    '<input type="hidden" name="blog_id_1" id="blog_id_1" value="' + Blog_id +
                    '" />'
                );
                // Galllery id
                $(".editBlogFooter").append(
                    '<input type="hidden" name="blog_id_2" id="blog_id_2" value="' + Blog_id +
                    '" />'
                );

                $("#edit_blog_name").val(response['blog_name']);
                $("#edit_blog_datee").val(response['blog_datee']);
                CKEDITOR.instances['edit_blog_desc'].setData(response['blog_desc']);

                $("#editBlogForm").find('input').each(function () {
                        if ($(this).val()) {
                            $(this).parent(".nk-int-st").addClass("nk-toggled");
                        }
                    });

                // update the Student data function
                $("#editBlogForm")
                    .unbind('submit')
                    .bind('submit', function () {

                        var isValid = true;

                        $('#editBlogForm input').each(function () {
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
                            $("#editBlogBtn").attr('disabled', 'disabled');

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
                                    $("#editBlogBtn").removeAttr('disabled');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                        scrollTop: '0'
                                    }, 100);

                                    // shows a successful message after operation
                                    $('#edit-Blog-messages').html(
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
                                    manageBlogTable
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
                $("#updateBlogForm")
                    .unbind('submit')
                    .bind('submit', function () {
                        // form validation
                        var BlogImage = $("#edit_blog_path").val();

                        console.log(BlogImage);

                        if (BlogImage == "") {
                            $("#edit_blog_path")
                                .closest('.center-block')
                                .after('<p class="text-danger">blog Image field is required</p>');
                            $('#edit_blog_path')
                                .closest('.form-group')
                                .addClass('has-error');
                        } else {
                            // remov error text field
                            $("#edit_blog_path")
                                .find('.text-danger')
                                .remove();
                            // success out for form
                            $("#edit_blog_path")
                                .closest('.form-group')
                                .addClass('has-success');
                        } // /else

                        if (BlogImage) {
                            // submit loading button
                            $("#editBlogImageBtn").attr('disabled', 'disabled');

                            var form = $(this);
                            var formData = new FormData(this);

                            var filedata = $('#edit_blog_path')[0].files[0];
                            formData.append('blog_path', filedata);                        
                            formData.append('blog_id', $('#blog_id_1').val());

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
                                    $("#editBlogImageBtn").removeAttr('disabled');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                        scrollTop: '0'
                                    }, 100);

                                    // shows a successful message after operation
                                    $('#edit-Image-Blog-messages').html(
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
                                    manageBlogTable.ajax.reload(null, true);

                                    $(".fileinput-remove-button").click();

                                    $.ajax({
                                        url: 'blog/get_single_blog',
                                        data: {
                                            blog_id: Blog_id
                                        },
                                        type: 'post',
                                        success: function (response_img) {

                                            console.log(response_img);

                                            $("#getBlogImage").attr('src', response_img['blog_path']);
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

function removeBlog(Blog_id = null) {
    if (Blog_id) {
        $('#removeBlog_id').remove();

        // click on remove button to remove the Image
        $("#removeBlogBtn")
            .unbind('click')
            .bind('click', function () {
                // button loading
                $("#removeBlogBtn").attr('disabled', 'disabled');

                $.ajax({
                    url: 'blog/remove_blog',
                    type: 'post',
                    data: {
                        blog_id: Blog_id
                    },
                    dataType: 'json',
                    success: function (response) {

                        // button loading
                        $("#removeBlogBtn").removeAttr('disabled');
                        // hide the remove modal
                        $('#removeBlogModal').modal('hide');

                        // reload the Image table
                        manageBlogTable
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