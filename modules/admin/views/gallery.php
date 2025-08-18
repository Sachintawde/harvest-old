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
                                    <h2>Gallery Record</h2>
                                    <p>View All added gallery data</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                        <div class="breadcomb-report">
                            <button
                                id="addImageModalBtn"
                                class="btn wave-effect"
                                data-toggle="modal"
                                data-target="#addImageModal">
                                <i class="notika-icon notika-form"></i>
                                Add Gallery</button>
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
                <h2>Gallery Table</h2>
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
                <table class="table table-striped" id="manageImageTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Date</th>
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
id="addImageModal"
tabindex="-1"
role="dialog">
<div class="modal-dialog modal-large">
<div class="modal-content">
    <form
        class="form-horizontal"
        id="submitImageForm"
        action="gallery/add_image"
        method="POST"
        enctype="multipart/form-data">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">
                <i class="notika-icon notika-form"></i>
                Add Image</h4>
            <hr/>
        </div>
        <div class="modal-body">
            <div id="add-Image-messages"></div>

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
                                            id="img_path"
                                            placeholder="Image / Thumbnail"
                                            name="img_path"
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
                                        class="bootstrap-select fm-cmp-mg nk-int-st <?= isset($_POST['img_cat']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled"
                                        :=":"
                                        ''
                                        ?="?">
                                        <select class="selectpicker" name="img_cat" id="img_cat">
                                        <?php
														if(isset($_POST['img_cat'])){
															echo '<option value="'.$_POST['img_cat'].'"  selelcted>'.$_POST['img_cat'].'</option>';
														}else{
															echo '<option disabled selected>Select Type</option>';
														} 
													?>
                                            <option value="Image">Photo Gallery</option>
                                            <option value="Banner">Banner Image</option>
                                            <option value="Award">Award</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="bootstrap-select fm-cmp-mg nk-int-st <?= isset($_POST['img_sub']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled"
                                        :=":"
                                        ''
                                        ?="?">
                                        <select class="selectpicker" name="img_sub" id="img_sub">
                                        <?php
														if(isset($_POST['img_sub'])){
															echo '<option value="'.$_POST['img_sub'].'"  selelcted>'.$_POST['img_sub'].'</option>';
														}else{
															echo '<option disabled selected>Select Category</option>';
														} 
													?>
                                            <optgroup label="Classes">
                                                <!-- <option value="All">All</option> -->
                                                <option value="Admission">Admission</option>
                                                <option value="Event">Event</option>
                                                <option value="Guest_visit">Guest Visit</option>
                                                <option value="Result">Result</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="ytb_space" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['ytb_link']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled"
                                        :=":"
                                        ''
                                        ?="?">
                                        <input
                                            type="text"
                                            name="ytb_link"
                                            id="ytb_link"
                                            class="form-control"
                                            value="<?= isset($_POST['ytb_link']) ? $_POST['ytb_link'] : '' ?>">
                                        <label class="nk-label">Youtube Link</label>
                                    </div>
                                </div>
                            </div>
                            <div id="ext_space" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['ext_link']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled"
                                        :=":"
                                        ''
                                        ?="?">
                                        <input
                                            type="text"
                                            name="ext_link"
                                            id="ext_link"
                                            class="form-control"
                                            value="<?= isset($_POST['ext_link']) ? $_POST['ext_link'] : '' ?>">
                                        <label class="nk-label">External Link</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['img_title']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled"
                                        :=":"
                                        ''
                                        ?="?">
                                        <input
                                            type="text"
                                            name="img_title"
                                            id="img_title"
                                            class="form-control"
                                            value="<?= isset($_POST['img_title']) ? $_POST['img_title'] : '' ?>">
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
                                        class="nk-int-st <?= isset($_POST['img_desc']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled"
                                        :=":"
                                        ''
                                        ?="?">
                                        <input
                                            type="text"
                                            name="img_desc"
                                            id="img_desc"
                                            class="form-control"
                                            value="<?= isset($_POST['img_desc']) ? $_POST['img_desc'] : '' ?>">
                                        <label class="nk-label">Short Info.</label>
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
                id="createImageBtn"
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
id="editImageModal"
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
                    <a data-toggle="tab" href="#photo">Gallery Image</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#ImageInfo">Information</a>
                </li>
            </ul>
            <div class="tab-content tab-custom-st">
                <div id="photo" class="tab-pane fade in active">
                    <div class="tab-ctn">

                        <div id="edit-Image-Gallery-messages"></div>

                        <form
                            action="gallery/edit_image_only"
                            method="POST"
                            id="updateGalleryImageForm"
                            class="form-horizontal"
                            enctype="multipart/form-data">
                            <br>

                            <div class="form-group">
                                <label for="edit_img_path" class="col-sm-3 control-label">Gallery Image:
                                </label>
                                <label class="col-sm-1 control-label">:
                                </label>
                                <div class="col-sm-8">
                                    <img
                                        src=""
                                        id="getGalleryImage"
                                        class="thumbnail"
                                        style="width:200px; height:auto;"/>
                                </div>
                            </div>
                            <!-- /form-group-->

                            <div class="form-group">
                                <label for="edit_img_path" class="col-sm-3 control-label">Select Photo:
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
                                            id="edit_img_path"
                                            placeholder="Gallery Image"
                                            name="edit_img_path"
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

                            <div class="modal-footer editGalleryImageFooter">
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
                <div id="ImageInfo" class="tab-pane fade">
                    <div class="tab-ctn">

                        <div id="edit-Image-messages"></div>

                        <form
                            action="gallery/edit_image_data"
                            method="POST"
                            id="editImageForm"
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
                                                            <i class="notika-icon notika-edit"></i>
                                                        </div>
                                                        <div
                                                            class="bootstrap-select fm-cmp-mg nk-int-st <?= isset($_POST['edit_img_cat']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled"
                                                            :=":"
                                                            ''
                                                            ?="?">
                                                            <select class="selectpicker" name="edit_img_cat" id="edit_img_cat">
                                                            <?php
																			if(isset($_POST['edit_img_cat'])){
																				echo '<option value="'.$_POST['edit_img_cat'].'"  selelcted>'.$_POST['edit_img_cat'].'</option>';
																			}else{
																				echo '<option value="" disabled selected>Select Category</option>';
																			} 
																		?>
                                                                <option value="Image">Image Gallery</option>
                                                                <option value="Banner">Banner Image</option>
                                                                <option value="Award">Award</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </div>
                                                        <div
                                                            class="bootstrap-select fm-cmp-mg nk-int-st <?= isset($_POST['edit_img_sub']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled"
                                                            :=":"
                                                            ''
                                                            ?="?">
                                                            <select class="selectpicker" name="edit_img_sub" id="edit_img_sub">
                                                            <?php
																			if(isset($_POST['edit_img_sub'])){
																				echo '<option value="'.$_POST['edit_img_sub'].'"  selelcted>'.$_POST['edit_img_sub'].'</option>';
																			}else{
																				echo '<option value="" disabled selected>Select Category</option>';
																			} 
																		?>
                                                                <optgroup label="Classes">
                                                                    <!-- <option value="All">All</option> -->
                                                                    <option value="Admission">Admission</option>
                                                                    <option value="Event">Event</option>
                                                                    <option value="Guest_visit">Guest Visit</option>
                                                                    <option value="Result">Result</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="edit_ytb_space" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_ytb_link']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled"
                                                            :=":"
                                                            ''
                                                            ?="?">
                                                            <input
                                                                type="text"
                                                                name="edit_ytb_link"
                                                                id="edit_ytb_link"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_ytb_link']) ? $_POST['edit_ytb_link'] : '' ?>">
                                                            <label class="nk-label">Youtube Link</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="edit_ext_space" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_ext_link']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled"
                                                            :=":"
                                                            ''
                                                            ?="?">
                                                            <input
                                                                type="text"
                                                                name="edit_ext_link"
                                                                id="edit_ext_link"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_ext_link']) ? $_POST['edit_ext_link'] : '' ?>">
                                                            <label class="nk-label">External Link</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_img_title']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled"
                                                            :=":"
                                                            ''
                                                            ?="?">
                                                            <input
                                                                type="text"
                                                                name="edit_img_title"
                                                                id="edit_img_title"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_img_title']) ? $_POST['edit_img_title'] : '' ?>">
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
                                                            class="nk-int-st <?= isset($_POST['edit_img_desc']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled"
                                                            :=":"
                                                            ''
                                                            ?="?">
                                                            <input
                                                                type="text"
                                                                name="edit_img_desc"
                                                                id="edit_img_desc"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_img_desc']) ? $_POST['edit_img_desc'] : '' ?>">
                                                            <label class="nk-label">Short Info.</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer editGalleryFooter">
                                <button
                                    type="button"
                                    class="btn notika-btn-red btn-button-mg waves-effect"
                                    data-dismiss="modal">
                                    <i class="notika-icon notika-close"></i>
                                    Close</button>
                                <button
                                    type="submit"
                                    class="btn notika-btn-green btn-button-mg waves-effect"
                                    id="editGalleryImageBtn"
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
<!-- /edit Gallery -->

<!-- view Image -->
<div
class="modal animated shake"
id="viewImageModal"
tabindex="-1"
role="dialog">
<div class="modal-dialog modal-large">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
            <i class="notika-icon notika-form"></i>
            View Gallery</h4>
        <hr/>
    </div>
    <div class="modal-body">
        <div class="view_Image_data"></div>
    </div>
    <div class="modal-footer viewImageFooter">
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
<div class="modal fade" tabindex="-1" role="dialog" id="removeImageModal">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
            <i class="glyphicon glyphicon-trash"></i>
            Remove Image</h4>
    </div>
    <div class="modal-body">
        <p>Do you really want to remove ?</p>
    </div>
    <div class="modal-footer removeImageFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="glyphicon glyphicon-remove-sign"></i>
            Close</button>
        <button
            type="button"
            class="btn btn-primary"
            id="removeImageBtn"
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
<script src="<?= base_url(); ?>assets/admin/custom/js/gallery.js"></script>