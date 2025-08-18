<?php $this->load->view('common/header'); ?>
<!-- file input -->
<link
    rel="stylesheet"
    href="<?= base_url(); ?>assets/admin/plugins/fileinput/css/fileinput.min.css">

<!-- Breadcomb area Start-->
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="remove-messages"></div>
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-windows"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Testimonial Record</h2>
                                    <p>View All added Testimonial data</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                        <div class="breadcomb-report">
                            <button
                                id="addTestimonialModalBtn"
                                class="btn wave-effect"
                                data-toggle="modal"
                                data-target="#addTestimonialModal">
                                <i class="notika-icon notika-form"></i>
                                Add Testimonial</button>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Breadcomb area End-->
<!-- Data Table area Start-->
<div class="data-table-area">
<div class="container">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="data-table-list">
            <div class="basic-tb-hd">
                <h2>Testimonial Table</h2>
                <p>One one of them to see their details also action button to the modificatoin
                    in database.</p>
                <span class="pull-right show_date">
                    <div class="nk-int-st date-range">
                        <div class="form-group nk-datapk-ctm form-elet-mg">
                            <div class="input-group date nk-int-st">
                                <span class="input-group-addon"></span>
                                <input
                                    type="text"
                                    id="min"
                                    name="min"
                                    class="form-control"
                                    placeholder="Min Date"
                                    required="required">
                            </div>
                        </div>
                    </div>
                    <div class="nk-int-st date-range">
                        <div class="form-group nk-datapk-ctm form-elet-mg">
                            <div class="input-group date nk-int-st">
                                <span class="input-group-addon"></span>
                                <input
                                    type="text"
                                    id="max"
                                    name="max"
                                    class="form-control"
                                    placeholder="Max Date"
                                    required="required">
                            </div>
                        </div>
                    </div>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="manageTestimonialTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Designation</th>
                            <th style="width:15%;">Options</th>
                        </tr>
                    </thead>
                </table>
                <!-- /table -->
            </div> 
        </div>
    </div>
</div>
</div>
</div>

<!-- add Image -->
<div
class="modal animated shake"
id="addTestimonialModal"
tabindex="-1"
role="dialog">
<div class="modal-dialog modal-large">
<div class="modal-content">
    <form
        class="form-horizontal"
        id="submitTestimonialForm"
        action="testimonial/add_testimonial"
        method="POST"
        enctype="multipart/form-data">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">
                <i class="notika-icon notika-form"></i>
                Add Testimonial</h4>
            <hr/>
        </div>
        <div class="modal-body">
            <div id="add-Testimonial-messages"></div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-element-list" id="form_info">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <!-- the avatar markup -->
                                    <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                                    <div class="kv-avatar center-block">
                                        <input
                                            type="file"
                                            class="file-loading"
                                            id="t_path"
                                            placeholder="Image / Thumbnail"
                                            name="t_path"
                                            style="width:auto;"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['t_name']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="t_name"
                                            id="t_name"
                                            class="form-control"
                                            value="<?= isset($_POST['t_name']) ? $_POST['t_name'] : '' ?>">
                                        <label class="nk-label">Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['t_design']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="t_design"
                                            id="t_design"
                                            class="form-control"
                                            value="<?= isset($_POST['t_design']) ? $_POST['t_design'] : '' ?>">
                                        <label class="nk-label">Designation</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['t_msg']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="t_msg"
                                            id="t_msg"
                                            class="form-control"
                                            value="<?= isset($_POST['t_msg']) ? $_POST['t_msg'] : '' ?>">
                                        <label class="nk-label">Message</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div class="bootstrap-select fm-cmp-mg nk-int-st <?= isset($_POST['t_gender']) ? "nk-toggled" : '' ?>"="nk-toggled" :=":" '' ?="?">
                                        <select class="selectpicker" name="t_gender" id="t_gender" onchange="toggleSubCategory(this.value)">
                                            <?php
                                                if(isset($_POST['t_gender'])){
                                                    echo '<option value="'.$_POST['t_gender'].'"  selected>'.$_POST['t_gender'].'</option>';
                                                }else{
                                                    echo '<option disabled selected>Select Gender</option>';
                                                } 
                                            ?>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <b>Testimonial Video</b>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <!-- the avatar markup -->
                                    <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                                    <div class="kv-avatar center-block">
                                        <input
                                            type="file"
                                            class="file-loading"
                                            id="t_path_two"
                                            placeholder="Image / Thumbnail"
                                            name="t_path_two"
                                            style="width:auto;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="progress">
                                        <div
                                            class="progress-bar progress-bar-success myprogress"
                                            role="progressbar"
                                            style="width:0%">0%</div>
                                    </div>
                                    <div class="up_msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button
                type="submit"
                class="btn btn-primary"
                name="submit"
                id="createTestimonialBtn"
                data-loading-text="Loading...">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>
</div>
</div>

<!-- edit Profile -->
<div
class="modal animated shake"
id="editTestimonialModal"
tabindex="-1"
role="dialog">
<div class="modal-dialog modal-large">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <i class="notika-icon notika-close"></i>
        </button>
    </div>
    <div class="modal-body">
        <div class="div-loading">
            <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </div>
        <div class="widget-tabs-list">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#photo">Testimonial Image</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#TestimonialInfo">Information</a>
                </li>
            </ul>
            <div class="tab-content tab-custom-st">
                <div id="photo" class="tab-pane fade in active">
                    <div class="tab-ctn">

                        <div id="edit-Image-Testimonial-messages"></div>

                        <form
                            action="Testimonial/edit_image_only"
                            method="POST"
                            id="updateTestimonialForm"
                            class="form-horizontal"
                            enctype="multipart/form-data">
                            <br>

                            <div class="form-group">
                                <label for="edit_t_path" class="col-sm-3 control-label">Testimonial Image:
                                </label>
                                <label class="col-sm-1 control-label">:
                                </label>
                                <div class="col-sm-8">
                                    <img
                                        src=""
                                        id="getTestimonialImage"
                                        class="thumbnail"
                                        style="width:200px; height:auto;"/>
                                </div>
                            </div>
                            <!-- /form-group-->

                            <div class="form-group">
                                <label for="edit_t_path" class="col-sm-3 control-label">Select Photo:
                                </label>
                                <label class="col-sm-1 control-label">:
                                </label>
                                <div class="col-sm-8">
                                    <!-- the avatar markup -->
                                    <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                                    <div class="kv-avatar center-block">
                                        <input
                                            type="file"
                                            class="file-loading"
                                            id="edit_t_path"
                                            placeholder="Testimonial Image"
                                            name="edit_t_path"
                                            style="width:auto;"/>
                                    </div>

                                </div>
                            </div>
                            <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit_t_path_two" class="col-sm-3 control-label">Testimonial Video:
                                </label>
                                <label class="col-sm-1 control-label">:
                                </label>
                                <div class="col-sm-8">
                                    <img
                                        src=""
                                        id="getTestimonialImageTwo"
                                        class="thumbnail"
                                        style="width:200px; height:auto;"/>
                                </div>
                            </div>
                            <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit_t_path_two" class="col-sm-3 control-label">Select Video:
                                </label>
                                <label class="col-sm-1 control-label">:
                                </label>
                                <div class="col-sm-8">
                                    <!-- the avatar markup -->
                                    <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                                    <div class="kv-avatar center-block">
                                        <input
                                            type="file"
                                            class="file-loading"
                                            id="edit_t_path_two"
                                            placeholder="Testimonial Video"
                                            name="edit_t_path_two"
                                            style="width:auto;"/>
                                    </div>

                                </div>
                            </div>
                            <!-- /form-group-->

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="progress">
                                            <div
                                                class="progress-bar progress-bar-success myprogress"
                                                role="progressbar"
                                                style="width:0%">0%</div>
                                        </div>
                                        <div class="up_msg"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer editTestimonialImageFooter">
                                <button
                                    type="button"
                                    data-dismiss="modal"
                                    class="btn notika-btn-red btn-button-mg waves-effect">
                                    <i class="notika-icon notika-next"></i>
                                    Close</button>
                            </div>
                            <!-- /modal-footer -->
                        </form>

                    </div>
                </div>
                <div id="TestimonialInfo" class="tab-pane fade">
                    <div class="tab-ctn">

                        <div id="edit-Testimonial-messages"></div>

                        <form
                            action="testimonial/edit_testimonial_data"
                            method="POST"
                            id="editTestimonialForm"
                            class="form-horizontal"
                            enctype="multipart/form-data"><br/>

                            <div class="editInfoContent">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-element-list" id="form_info">
                                            <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_t_name']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_t_name"
                                                                id="edit_t_name"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_t_name']) ? $_POST['edit_t_name'] : '' ?>">
                                                            <label class="nk-label">Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_t_design']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_t_design"
                                                                id="edit_t_design"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_t_design']) ? $_POST['edit_t_design'] : '' ?>">
                                                            <label class="nk-label">Designation</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_t_msg']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_t_msg"
                                                                id="edit_t_msg"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_t_msg']) ? $_POST['edit_t_msg'] : '' ?>">
                                                            <label class="nk-label">Message</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </div>
                                                        <div
                                                            class="bootstrap-select fm-cmp-mg nk-int-st <?= isset($_POST['edit_t_gender']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled"
                                                            :=":"
                                                            ''
                                                            ?="?">
                                                            <select class="selectpicker" name="edit_t_gender" id="edit_t_gender">
                                                            <?php
																	if(isset($_POST['edit_t_gender'])){
																		echo '<option value="'.$_POST['edit_t_gender'].'"  selelcted>'.$_POST['edit_t_gender'].'</option>';
																	}else{
																		echo '<option value="" disabled selected>Select Gender</option>';
																	} 
																?>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer editTestimonialFooter">
                                <button
                                    type="button"
                                    class="btn notika-btn-red btn-button-mg waves-effect"
                                    data-dismiss="modal">
                                    <i class="notika-icon notika-close"></i>
                                    Close</button>
                                <button
                                    type="submit"
                                    class="btn notika-btn-green btn-button-mg waves-effect"
                                    id="editTestimonialBtn"
                                    data-loading-text="Loading...">
                                    <i class="notika-icon notika-next"></i>
                                    Save Changes</button>
                            </div>
                            <!-- /modal-footer -->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal-body -->
</div>
<!-- /modal-content -->
</div>
<!-- /modal-dailog -->
</div>
<!-- /edit Testimonial -->

<!-- view Testimonial -->
<div
class="modal animated shake"
id="viewTestimonialModal"
tabindex="-1"
role="dialog">
<div class="modal-dialog modal-large">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
            <i class="notika-icon notika-form"></i>
            View Testimonial</h4>
        <hr/>
    </div>
    <div class="modal-body">
        <div class="view_testimonial_data"></div>
    </div>
    <div class="modal-footer viewTestimonialFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="glyphicon glyphicon-remove-sign"></i>
            Close</button>
    </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /view Image -->

<!-- remove Image -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeTestimonialModal">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
            <i class="glyphicon glyphicon-trash"></i>
            Remove Testimonial</h4>
    </div>
    <div class="modal-body"> 
        <p>Do you really want to remove ?</p>
    </div>
    <div class="modal-footer removeTestimonialFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="glyphicon glyphicon-remove-sign"></i>
            Close</button>
        <button
            type="button"
            class="btn btn-primary"
            id="removeTestimonialBtn"
            data-loading-text="Loading...">
            <i class="glyphicon glyphicon-ok-sign"></i>
            Save changes</button>
    </div>
</div>
<!-- /.modal-content -->
</div> 
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /remove Image -->

<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/admin/custom/js/testimonial.js"></script>