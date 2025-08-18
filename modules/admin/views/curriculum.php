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
                                    <h2>Curriculum Record</h2>
                                    <p>View All added Curriculum data</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                        <div class="breadcomb-report">
                            <button
                                id="addCurriculumModalBtn"
                                class="btn wave-effect"
                                data-toggle="modal"
                                data-target="#addCurriculumModal">
                                <i class="notika-icon notika-form"></i>
                                Add Curriculum</button>
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
                <h2>Curriculum Table</h2>
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
                                    class="form-control datepicker"
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
                                    class="form-control datepicker"
                                    placeholder="Max Date"
                                    required="required">
                            </div>
                        </div>
                    </div>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="manageCurriculumTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Curriculum Date</th>
                            <th>Description</th>
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
id="addCurriculumModal"
tabindex="-1"
role="dialog">
<div class="modal-dialog modal-large">
<div class="modal-content">
    <form
        class="form-horizontal"
        id="submitCurriculumForm"
        action="curriculum/add_curriculum"
        method="POST"
        enctype="multipart/form-data">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">
                <i class="notika-icon notika-form"></i>
                Add Curriculum</h4>
            <hr/>
        </div>
        <div class="modal-body">
            <div id="add-Curriculum-messages"></div>

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
                                            id="c_path"
                                            placeholder="Image / Thumbnail"
                                            name="c_path"
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
                                        class="nk-int-st <?= isset($_POST['c_title']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="c_title"
                                            id="c_title"
                                            class="form-control"
                                            value="<?= isset($_POST['c_title']) ? $_POST['c_title'] : '' ?>">
                                        <label class="nk-label">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['c_select_date']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="curriculum_datee"
                                            id="curriculum_datee"
                                            class="form-control datepicker"
                                            value="<?= isset($_POST['curriculum_datee']) ? $_POST['curriculum_datee'] : '' ?>">
                                        <label class="nk-label">Curriculum Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['c_desc']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="c_desc" id="c_desc" class="form-control ckeditor"><?= isset($_POST['c_desc']) ? $_POST['c_desc'] : '' ?></textarea>
                                        <label class="nk-label">Description</label>
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
                id="createCurriculumBtn"
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
id="editCurriculumModal"
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
                    <a data-toggle="tab" href="#photo">Curriculum Image</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#CurriculumInfo">Information</a>
                </li>
            </ul>
            <div class="tab-content tab-custom-st">
                <div id="photo" class="tab-pane fade in active">
                    <div class="tab-ctn">

                        <div id="edit-Image-Curriculum-messages"></div>

                        <form
                            action="Curriculum/edit_image_only"
                            method="POST"
                            id="updateCurriculumForm"
                            class="form-horizontal"
                            enctype="multipart/form-data">
                            <br>

                            <div class="form-group">
                                <label for="edit_c_path" class="col-sm-3 control-label">Curriculum Image:
                                </label>
                                <label class="col-sm-1 control-label">:
                                </label>
                                <div class="col-sm-8">
                                    <img
                                        src=""
                                        id="getCurriculumImage"
                                        class="thumbnail"
                                        style="width:200px; height:auto;"/>
                                </div>
                            </div>
                            <!-- /form-group-->

                            <div class="form-group">
                                <label for="edit_c_path" class="col-sm-3 control-label">Select Photo:
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
                                            id="edit_c_path"
                                            placeholder="Curriculum Image"
                                            name="edit_c_path"
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

                            <div class="modal-footer editCurriculumImageFooter">
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
                <div id="CurriculumInfo" class="tab-pane fade">
                    <div class="tab-ctn">

                        <div id="edit-Curriculum-messages"></div>

                        <form
                            action="curriculum/edit_curriculum_data"
                            method="POST"
                            id="editCurriculumForm"
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
                                                            class="nk-int-st <?= isset($_POST['edit_c_title']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_c_title"
                                                                id="edit_c_title"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_c_title']) ? $_POST['edit_c_title'] : '' ?>">
                                                            <label class="nk-label">Title</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_c_select_date']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_curriculum_datee"
                                                                id="edit_curriculum_datee"
                                                                class="form-control datepicker"
                                                                value="<?= isset($_POST['edit_curriculum_datee']) ? $_POST['edit_curriculum_datee'] : '' ?>">
                                                            <label class="nk-label">Curriculum Date</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_c_desc']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_c_desc" id="edit_c_desc" class="form-control ckeditor"><?= isset($_POST['edit_c_desc']) ? $_POST['edit_c_desc'] : '' ?></textarea>
                                                            <label class="nk-label">Designation</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer editCurriculumFooter">
                                <button
                                    type="button"
                                    class="btn notika-btn-red btn-button-mg waves-effect"
                                    data-dismiss="modal">
                                    <i class="notika-icon notika-close"></i>
                                    Close</button>
                                <button
                                    type="submit"
                                    class="btn notika-btn-green btn-button-mg waves-effect"
                                    id="editCurriculumBtn"
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
<!-- /edit Curriculum -->

<!-- view Curriculum -->
<div
class="modal animated shake"
id="viewCurriculumModal"
tabindex="-1"
role="dialog">
<div class="modal-dialog modal-large">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
            <i class="notika-icon notika-form"></i>
            View Curriculum</h4>
        <hr/>
    </div>
    <div class="modal-body">
        <div class="view_curriculum_data"></div>
    </div>
    <div class="modal-footer viewCurriculumFooter">
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
<div class="modal fade" tabindex="-1" role="dialog" id="removeCurriculumModal">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
            <i class="glyphicon glyphicon-trash"></i>
            Remove Curriculum</h4>
    </div>
    <div class="modal-body"> 
        <p>Do you really want to remove ?</p>
    </div>
    <div class="modal-footer removeCurriculumFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="glyphicon glyphicon-remove-sign"></i>
            Close</button>
        <button
            type="button"
            class="btn btn-primary"
            id="removeCurriculumBtn"
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
<script src="<?= base_url(); ?>assets/admin/custom/js/curriculum.js"></script>