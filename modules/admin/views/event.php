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
                                    <h2>Event Record</h2>
                                    <p>View All added Event data</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                        <div class="breadcomb-report">
                            <button
                                id="addEventModalBtn"
                                class="btn wave-effect"
                                data-toggle="modal"
                                data-target="#addEventModal">
                                <i class="notika-icon notika-form"></i>
                                Add Event</button>
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
                <h2>Event Table</h2>
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
                <table class="table table-striped" id="manageEventTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Event Type</th>
                            <th>Title</th>
                            <th>Start</th>
                            <th>End</th>
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
id="addEventModal"
tabindex="-1"
role="dialog">
<div class="modal-dialog modal-large">
<div class="modal-content">
    <form
        class="form-horizontal"
        id="submitEventForm"
        action="event/add_event"
        method="POST"
        enctype="multipart/form-data">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">
                <i class="notika-icon notika-form"></i>
                Add Event</h4>
            <hr/>
        </div>
        <div class="modal-body">
            <div id="add-Event-messages"></div>

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
                                            id="event_path"
                                            placeholder="Image / Thumbnail"
                                            name="event_path"
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
                                        class="bootstrap-select fm-cmp-mg nk-int-st <?= isset($_POST['event_type']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled"
                                        :=":"
                                        ''
                                        ?="?">
                                        <select class="selectpicker" name="event_type" id="event_type">
                                        <?php
														if(isset($_POST['event_type'])){
															echo '<option value="'.$_POST['event_type'].'"  selelcted>'.$_POST['event_type'].'</option>';
														}else{
															echo '<option disabled selected>Select Event Type</option>';
														} 
													?>
                                                <option value="Early Dismissal Day for all students">Early Dismissal Day for all students</option>
                                                <option value="School Closed">School Closed</option>
                                                <option value="Parent Teacher Conf.">Parent Teacher Conf.</option>
                                                <option value="Special Events">Special Events</option>
                                                <option value="Picture Days">Picture Days</option>
                                                <option value="First & Last Day of School">First & Last Day of School</option>
                                                <option value="APC/Academic program closed! Full-time students only">APC/Academic program closed! Full-time students only</option>
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
                                        class="nk-int-st <?= isset($_POST['event_name']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="event_name"
                                            id="event_name"
                                            class="form-control"
                                            value="<?= isset($_POST['event_name']) ? $_POST['event_name'] : '' ?>">
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
                                        class="nk-int-st <?= isset($_POST['event_start']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text" onfocus="(this.type = 'date')"
                                            name="event_start"
                                            id="event_start"
                                            class="form-control"
                                            value="<?= isset($_POST['event_start']) ? $_POST['event_start'] : '' ?>">
                                        <label class="nk-label">Start</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['event_end']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text" onfocus="(this.type = 'date')"
                                            name="event_end"
                                            id="event_end"
                                            class="form-control"
                                            value="<?= isset($_POST['event_end']) ? $_POST['event_end'] : '' ?>">
                                        <label class="nk-label">End</label>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['event_classname']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text""
                                            name="event_classname"
                                            id="event_classname"
                                            class="form-control"
                                            value="<?= isset($_POST['event_classname']) ? $_POST['event_classname'] : '' ?>">
                                        <label class="nk-label">Class Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['event_icon']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text""
                                            name="event_icon"
                                            id="event_icon"
                                            class="form-control"
                                            value="<?= isset($_POST['event_icon']) ? $_POST['event_icon'] : '' ?>">
                                        <label class="nk-label">Icon</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-support"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['event_location']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="event_location"
                                            id="event_location"
                                            class="form-control"
                                            value="<?= isset($_POST['event_location']) ? $_POST['event_location'] : '' ?>">
                                        <label class="nk-label">Location</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['event_desc']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="event_desc" id="event_desc" class="form-control ckeditor"><?= isset($_POST['event_desc']) ? $_POST['event_desc'] : '' ?></textarea>
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
                id="createEventBtn"
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
id="editEventModal"
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
                    <a data-toggle="tab" href="#photo">Event Image</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#EventInfo">Information</a>
                </li>
            </ul>
            <div class="tab-content tab-custom-st">
                <div id="photo" class="tab-pane fade in active">
                    <div class="tab-ctn">

                        <div id="edit-Image-Event-messages"></div>

                        <form
                            action="Event/edit_image_only"
                            method="POST"
                            id="updateEventForm"
                            class="form-horizontal"
                            enctype="multipart/form-data">
                            <br>

                            <div class="form-group">
                                <label for="edit_event_path" class="col-sm-3 control-label">Event Image:
                                </label>
                                <label class="col-sm-1 control-label">:
                                </label>
                                <div class="col-sm-8">
                                    <img
                                        src=""
                                        id="getEventImage"
                                        class="thumbnail"
                                        style="width:200px; height:auto;"/>
                                </div>
                            </div>
                            <!-- /form-group-->

                            <div class="form-group">
                                <label for="edit_event_path" class="col-sm-3 control-label">Select Photo:
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
                                            id="edit_event_path"
                                            placeholder="event Image"
                                            name="edit_event_path"
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

                            <div class="modal-footer editEventImageFooter">
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
                <div id="EventInfo" class="tab-pane fade">
                    <div class="tab-ctn">

                        <div id="edit-Event-messages"></div>

                        <form
                            action="event/edit_event_data"
                            method="POST"
                            id="editEventForm"
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
                                                            class="bootstrap-select fm-cmp-mg nk-int-st <?= isset($_POST['edit_event_type']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled"
                                                            :=":"
                                                            ''
                                                            ?="?">
                                                            <select class="selectpicker" name="edit_event_type" id="edit_event_type">
                                                            <?php
                                                                            if(isset($_POST['edit_event_type'])){
                                                                                echo '<option value="'.$_POST['edit_event_type'].'"  selelcted>'.$_POST['edit_event_type'].'</option>';
                                                                            }else{
                                                                                echo '<option value="" disabled selected>Select Event Type</option>';
                                                                            } 
                                                                        ?>
                                                                                                           <option value="Early Dismissal Day for all students">Early Dismissal Day for all students</option>
                                                                <option value="School Closed">School Closed</option>
                                                                <option value="Parent Teacher Conf.">Parent Teacher Conf.</option>
                                                                <option value="Special Events">Special Events</option>
                                                                <option value="Picture Days">Picture Days</option>
                                                                <option value="First & Last Day of School">First & Last Day of School</option>
                                                                <option value="APC/Academic program closed! Full-time students only">APC/Academic program closed! Full-time students only</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_event_name']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_event_name"
                                                                id="edit_event_name"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_event_name']) ? $_POST['edit_event_name'] : '' ?>">
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
                                                            class="nk-int-st <?= isset($_POST['edit_event_start']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text" onfocus="(this.type = 'date')"
                                                                name="edit_event_start"
                                                                id="edit_event_start"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_event_start']) ? $_POST['edit_event_start'] : '' ?>">
                                                            <label class="nk-label">Start</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_event_end']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text" onfocus="(this.type = 'date')"
                                                                name="edit_event_end"
                                                                id="edit_event_end"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_event_end']) ? $_POST['edit_event_end'] : '' ?>">
                                                            <label class="nk-label">End</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_event_classname']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_event_classname"
                                                                id="edit_event_classname"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_event_classname']) ? $_POST['edit_event_classname'] : '' ?>">
                                                            <label class="nk-label">Class Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_event_icon']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_event_icon"
                                                                id="edit_event_icon"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_event_icon']) ? $_POST['edit_event_icon'] : '' ?>">
                                                            <label class="nk-label">Icon</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_event_location']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_event_location"
                                                                id="edit_event_location"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_event_location']) ? $_POST['edit_event_location'] : '' ?>">
                                                            <label class="nk-label">Location</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_event_desc']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_event_desc" id="edit_event_desc" class="form-control ckeditor"><?= isset($_POST['edit_event_desc']) ? $_POST['edit_event_desc'] : '' ?></textarea>
                                                            <label class="nk-label">Description</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer editEventFooter">
                                <button
                                    type="button"
                                    class="btn notika-btn-red btn-button-mg waves-effect"
                                    data-dismiss="modal">
                                    <i class="notika-icon notika-close"></i>
                                    Close</button>
                                <button
                                    type="submit"
                                    class="btn notika-btn-green btn-button-mg waves-effect"
                                    id="editEventBtn"
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
<!-- /edit Event -->

<!-- view Event -->
<div
class="modal animated shake"
id="viewEventModal"
tabindex="-1"
role="dialog">
<div class="modal-dialog modal-large">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
            <i class="notika-icon notika-form"></i>
            View Event</h4>
        <hr/>
    </div>
    <div class="modal-body">
        <div class="view_event_data"></div>
    </div>
    <div class="modal-footer viewEventFooter">
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
<div class="modal fade" tabindex="-1" role="dialog" id="removeEventModal">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
            <i class="glyphicon glyphicon-trash"></i>
            Remove Event</h4>
    </div>
    <div class="modal-body">
        <p>Do you really want to remove ?</p>
    </div>
    <div class="modal-footer removeEventFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="glyphicon glyphicon-remove-sign"></i>
            Close</button>
        <button
            type="button"
            class="btn btn-primary"
            id="removeEventBtn"
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
<!--fileinput.min JS -->
<script
src="<?= base_url(); ?>assets/admin/plugins/fileinput/js/fileinput.min.js"></script>
<script src="<?= base_url(); ?>assets/admin/custom/js/event.js"></script>