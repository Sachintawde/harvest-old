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
                                    <h2>Program Record</h2>
                                    <p>View All added Program data</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                        <div class="breadcomb-report">
                            <button
                                id="addProgramModalBtn"
                                class="btn wave-effect"
                                data-toggle="modal"
                                data-target="#addProgramModal">
                                <i class="notika-icon notika-form"></i>
                                Add Program</button>
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
                <h2>Program Table</h2>
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
                <table class="table table-striped" id="manageProgramTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Program Name</th>
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
id="addProgramModal"
tabindex="-1"
role="dialog">
<div class="modal-dialog modal-large">
<div class="modal-content">
    <form
        class="form-horizontal"
        id="submitProgramForm"
        action="program/add_program"
        method="POST"
        enctype="multipart/form-data">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">
                <i class="notika-icon notika-form"></i>
                Add Program</h4>
            <hr/>
        </div>
        <div class="modal-body">
            <div id="add-Program-messages"></div>

            <div class="row">
                <b>Section 1</b>
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
                                            id="program_path"
                                            placeholder="Image / Thumbnail"
                                            name="program_path"
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
                                        class="nk-int-st <?= isset($_POST['program_name']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_name"
                                            id="program_name"
                                            class="form-control"
                                            value="<?= isset($_POST['program_name']) ? $_POST['program_name'] : '' ?>">
                                        <label class="nk-label">Program Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_title_five']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_title_five"
                                            id="program_title_five"
                                            class="form-control"
                                            value="<?= isset($_POST['program_title_five']) ? $_POST['program_title_five'] : '' ?>">
                                        <label class="nk-label">Top Lines</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_desc']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="program_desc" id="program_desc" class="form-control"><?= isset($_POST['program_desc']) ? $_POST['program_desc'] : '' ?></textarea>
                                        <label class="nk-label">Description</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <b>Section 2</b>
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
                                            id="program_path_two"
                                            placeholder="Image / Thumbnail"
                                            name="program_path_two"
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
                                        class="nk-int-st <?= isset($_POST['program_title_six']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_title_six"
                                            id="program_title_six"
                                            class="form-control"
                                            value="<?= isset($_POST['program_title_six']) ? $_POST['program_title_six'] : '' ?>">
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
                                        class="nk-int-st <?= isset($_POST['program_desc_two']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="program_desc_two" id="program_desc_two" class="form-control"><?= isset($_POST['program_desc_two']) ? $_POST['program_desc_two'] : '' ?></textarea>
                                        <label class="nk-label">Description</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <b>Curriculum</b>
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_title']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_title"
                                            id="program_title"
                                            class="form-control"
                                            value="<?= isset($_POST['program_title']) ? $_POST['program_title'] : '' ?>">
                                        <label class="nk-label">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_desc_four']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="program_desc_four" id="program_desc_four" class="form-control"><?= isset($_POST['program_desc_four']) ? $_POST['program_desc_three'] : '' ?></textarea>
                                        <label class="nk-label">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_title_two']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_title_two"
                                            id="program_title_two"
                                            class="form-control"
                                            value="<?= isset($_POST['program_title_two']) ? $_POST['program_title_two'] : '' ?>">
                                        <label class="nk-label">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_desc_five']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="program_desc_five" id="program_desc_five" class="form-control"><?= isset($_POST['program_desc_five']) ? $_POST['program_desc_three'] : '' ?></textarea>
                                        <label class="nk-label">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_title_three']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_title_three"
                                            id="program_title_three"
                                            class="form-control"
                                            value="<?= isset($_POST['program_title_three']) ? $_POST['program_title_two'] : '' ?>">
                                        <label class="nk-label">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_desc_six']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="program_desc_six" id="program_desc_six" class="form-control"><?= isset($_POST['program_desc_six']) ? $_POST['program_desc_three'] : '' ?></textarea>
                                        <label class="nk-label">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_title_four']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_title_four"
                                            id="program_title_four"
                                            class="form-control"
                                            value="<?= isset($_POST['program_title_four']) ? $_POST['program_title_four'] : '' ?>">
                                        <label class="nk-label">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_desc_seven']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="program_desc_seven" id="program_desc_seven" class="form-control"><?= isset($_POST['program_desc_seven']) ? $_POST['program_desc_three'] : '' ?></textarea>
                                        <label class="nk-label">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_title_seven']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_title_seven"
                                            id="program_title_seven"
                                            class="form-control"
                                            value="<?= isset($_POST['program_title_seven']) ? $_POST['program_title_seven'] : '' ?>">
                                        <label class="nk-label">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_desc_three']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="program_desc_three" id="program_desc_three" class="form-control"><?= isset($_POST['program_desc_three']) ? $_POST['program_desc_three'] : '' ?></textarea>
                                        <label class="nk-label">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_title_eight']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_title_eight"
                                            id="program_title_eight"
                                            class="form-control"
                                            value="<?= isset($_POST['program_title_eight']) ? $_POST['program_title_eight'] : '' ?>">
                                        <label class="nk-label">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_desc_eight']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="program_desc_eight" id="program_desc_eight" class="form-control"><?= isset($_POST['program_desc_eight']) ? $_POST['program_desc_eight'] : '' ?></textarea>
                                        <label class="nk-label">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_title_nine']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_title_nine"
                                            id="program_title_nine"
                                            class="form-control"
                                            value="<?= isset($_POST['program_title_nine']) ? $_POST['program_title_nine'] : '' ?>">
                                        <label class="nk-label">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_desc_nine']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="program_desc_nine" id="program_desc_nine" class="form-control"><?= isset($_POST['program_desc_nine']) ? $_POST['program_desc_nine'] : '' ?></textarea>
                                        <label class="nk-label">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_title_ten']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_title_ten"
                                            id="program_title_ten"
                                            class="form-control"
                                            value="<?= isset($_POST['program_title_ten']) ? $_POST['program_title_ten'] : '' ?>">
                                        <label class="nk-label">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_desc_ten']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="program_desc_ten" id="program_desc_ten" class="form-control"><?= isset($_POST['program_desc_ten']) ? $_POST['program_desc_ten'] : '' ?></textarea>
                                        <label class="nk-label">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_title_eleven']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_title_eleven"
                                            id="program_title_eleven"
                                            class="form-control"
                                            value="<?= isset($_POST['program_title_eleven']) ? $_POST['program_title_eleven'] : '' ?>">
                                        <label class="nk-label">Title</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_desc_eleven']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <textarea name="program_desc_eleven" id="program_desc_eleven" class="form-control"><?= isset($_POST['program_desc_eleven']) ? $_POST['program_desc_eleven'] : '' ?></textarea>
                                        <label class="nk-label">Description</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <b>Display</b>
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_display']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_display"
                                            id="program_display"
                                            class="form-control"
                                            value="<?= isset($_POST['program_display']) ? $_POST['program_display'] : '' ?>">
                                        <label class="nk-label">Display One</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_display_two']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_display_two"
                                            id="program_display_two"
                                            class="form-control"
                                            value="<?= isset($_POST['program_display_two']) ? $_POST['program_display_two'] : '' ?>">
                                        <label class="nk-label">Display Two</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_display_three']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_display_three"
                                            id="program_display_three"
                                            class="form-control"
                                            value="<?= isset($_POST['program_display_three']) ? $_POST['program_display_three'] : '' ?>">
                                        <label class="nk-label">Display Three</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_display_four']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_display_four"
                                            id="program_display_four"
                                            class="form-control"
                                            value="<?= isset($_POST['program_display_four']) ? $_POST['program_display_four'] : '' ?>">
                                        <label class="nk-label">Display Four</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_display_five']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_display_five"
                                            id="program_display_five"
                                            class="form-control"
                                            value="<?= isset($_POST['program_display_five']) ? $_POST['program_display_five'] : '' ?>">
                                        <label class="nk-label">Display Five</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_display_six']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_display_six"
                                            id="program_display_six"
                                            class="form-control"
                                            value="<?= isset($_POST['program_display_six']) ? $_POST['program_display_six'] : '' ?>">
                                        <label class="nk-label">Display Six</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_display_seven']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_display_seven"
                                            id="program_display_seven"
                                            class="form-control"
                                            value="<?= isset($_POST['program_display_seven']) ? $_POST['program_display_seven'] : '' ?>">
                                        <label class="nk-label">Display Seven</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_display_eight']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_display_eight"
                                            id="program_display_eight"
                                            class="form-control"
                                            value="<?= isset($_POST['program_display_eight']) ? $_POST['program_display_eight'] : '' ?>">
                                        <label class="nk-label">Display Eight</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group ic-cmp-int float-lb floating-lb">
                                    <div class="form-ic-cmp">
                                        <i class="notika-icon notika-edit"></i>
                                    </div>
                                    <div
                                        class="nk-int-st <?= isset($_POST['program_display_nine']) ? "
                                        nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                        <input
                                            type="text"
                                            name="program_display_nine"
                                            id="program_display_nine"
                                            class="form-control"
                                            value="<?= isset($_POST['program_display_nine']) ? $_POST['program_display_nine'] : '' ?>">
                                        <label class="nk-label">Display Nine</label>
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
                id="createProgramBtn"
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
id="editProgramModal"
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
                    <a data-toggle="tab" href="#photo">Program Image</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#ProgramInfo">Information</a>
                </li>
            </ul>
            <div class="tab-content tab-custom-st">
                <div id="photo" class="tab-pane fade in active">
                    <div class="tab-ctn">

                        <div id="edit-Image-Program-messages"></div>

                        <form
                            action="program/edit_image_only"
                            method="POST"
                            id="updateProgramForm"
                            class="form-horizontal"
                            enctype="multipart/form-data">
                            <br>

                            <div class="form-group">
                                <label for="edit_program_path" class="col-sm-3 control-label">Main Image:
                                </label>
                                <label class="col-sm-1 control-label">:
                                </label>
                                <div class="col-sm-8">
                                    <img
                                        src=""
                                        id="getProgramImage"
                                        class="thumbnail"
                                        style="width:200px; height:auto;"/>
                                </div>
                            </div>
                            <!-- /form-group-->

                            <div class="form-group">
                                <label for="edit_program_path" class="col-sm-3 control-label">Select Photo:
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
                                            id="edit_program_path"
                                            placeholder="program Image"
                                            name="edit_program_path"
                                            style="width:auto;"/>
                                    </div>

                                </div>
                            </div>
                            <!-- /form-group-->

                            <div class="form-group">
                                <label for="edit_program_path_two" class="col-sm-3 control-label">Detail Image:
                                </label>
                                <label class="col-sm-1 control-label">:
                                </label>
                                <div class="col-sm-8">
                                    <img
                                        src=""
                                        id="getProgramImageTwo"
                                        class="thumbnail"
                                        style="width:200px; height:auto;"/>
                                </div>
                            </div>
                            <!-- /form-group-->
                            <div class="form-group">
                                <label for="edit_program_path_two" class="col-sm-3 control-label">Select Photo:
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
                                            id="edit_program_path_two"
                                            placeholder="program Image"
                                            name="edit_program_path_two"
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

                            <div class="modal-footer editProgramImageFooter"> 
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
                <div id="ProgramInfo" class="tab-pane fade">
                    <div class="tab-ctn">

                        <div id="edit-Program-messages"></div>

                        <form
                            action="program/edit_program_data"
                            method="POST"
                            id="editProgramForm"
                            class="form-horizontal"
                            enctype="multipart/form-data"><br/>

                            <div class="editInfoContent">
                                <div class="row">
                                <b>Section 1</b>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-element-list" id="form_info">
                                            <div class="row">

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_name']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_name"
                                                                id="edit_program_name"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_name']) ? $_POST['edit_program_name'] : '' ?>">
                                                            <label class="nk-label">Program Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_title_five']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_title_five"
                                                                id="edit_program_title_five"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_title_five']) ? $_POST['edit_program_title_five'] : '' ?>">
                                                            <label class="nk-label">Top Lines</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_desc']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_program_desc" id="edit_program_desc" class="form-control"><?= isset($_POST['edit_program_desc']) ? $_POST['edit_program_desc'] : '' ?></textarea>
                                                            <label class="nk-label">Description</label>
                                                        </div>
                                                    </div>
                                                </div> 

                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <b>Section 2</b>
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_title_six']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_title_six"
                                                                id="edit_program_title_six"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_title_six']) ? $_POST['edit_program_title_six'] : '' ?>">
                                                            <label class="nk-label">Title</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_desc_two']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_program_desc_two" id="edit_program_desc_two" class="form-control"><?= isset($_POST['edit_program_desc_two']) ? $_POST['edit_program_desc_two'] : '' ?></textarea>
                                                            <label class="nk-label">Description</label>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <b>Curriculum</b>
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_title']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_title"
                                                                id="edit_program_title"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_title']) ? $_POST['edit_program_title'] : '' ?>">
                                                            <label class="nk-label">Title</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_desc_four']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_program_desc_four" id="edit_program_desc_four" class="form-control"><?= isset($_POST['edit_program_desc_four']) ? $_POST['edit_program_desc_four'] : '' ?></textarea>
                                                            <label class="nk-label">Description</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_title_two']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_title_two"
                                                                id="edit_program_title_two"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_title_two']) ? $_POST['edit_program_title_two'] : '' ?>">
                                                            <label class="nk-label">Title</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_desc_five']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_program_desc_five" id="edit_program_desc_five" class="form-control"><?= isset($_POST['edit_program_desc_five']) ? $_POST['edit_program_desc_five'] : '' ?></textarea>
                                                            <label class="nk-label">Description</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_title_three']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_title_three"
                                                                id="edit_program_title_three"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_title_three']) ? $_POST['edit_program_title_three'] : '' ?>">
                                                            <label class="nk-label">Title</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_desc_six']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_program_desc_six" id="edit_program_desc_six" class="form-control"><?= isset($_POST['edit_program_desc_six']) ? $_POST['edit_program_desc_six'] : '' ?></textarea>
                                                            <label class="nk-label">Description</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_title_four']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_title_four"
                                                                id="edit_program_title_four"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_title_four']) ? $_POST['edit_program_title_four'] : '' ?>">
                                                            <label class="nk-label">Title</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_desc_seven']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_program_desc_seven" id="edit_program_desc_seven" class="form-control"><?= isset($_POST['edit_program_desc_seven']) ? $_POST['edit_program_desc_seven'] : '' ?></textarea>
                                                            <label class="nk-label">Description</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_title_seven']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_title_seven"
                                                                id="edit_program_title_seven"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_title_seven']) ? $_POST['edit_program_title_seven'] : '' ?>">
                                                            <label class="nk-label">Title</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_desc_three']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_program_desc_three" id="edit_program_desc_three" class="form-control"><?= isset($_POST['edit_program_desc_three']) ? $_POST['edit_program_desc_three'] : '' ?></textarea>
                                                            <label class="nk-label">Description</label>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_title_eight']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_title_eight"
                                                                id="edit_program_title_eight"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_title_eight']) ? $_POST['edit_program_title_eight'] : '' ?>">
                                                            <label class="nk-label">Title</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_desc_eight']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_program_desc_eight" id="edit_program_desc_eight" class="form-control"><?= isset($_POST['edit_program_desc_eight']) ? $_POST['edit_program_desc_eight'] : '' ?></textarea>
                                                            <label class="nk-label">Description</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_title_nine']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_title_nine"
                                                                id="edit_program_title_nine"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_title_nine']) ? $_POST['edit_program_title_nine'] : '' ?>">
                                                            <label class="nk-label">Title</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_desc_nine']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_program_desc_nine" id="edit_program_desc_nine" class="form-control"><?= isset($_POST['edit_program_desc_nine']) ? $_POST['edit_program_desc_nine'] : '' ?></textarea>
                                                            <label class="nk-label">Description</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_title_ten']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_title_ten"
                                                                id="edit_program_title_ten"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_title_ten']) ? $_POST['edit_program_title_ten'] : '' ?>">
                                                            <label class="nk-label">Title</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_desc_ten']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_program_desc_ten" id="edit_program_desc_ten" class="form-control"><?= isset($_POST['edit_program_desc_ten']) ? $_POST['edit_program_desc_ten'] : '' ?></textarea>
                                                            <label class="nk-label">Description</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-edit"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_title_eleven']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_title_eleven"
                                                                id="edit_program_title_eleven"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_title_eleven']) ? $_POST['edit_program_title_eleven'] : '' ?>">
                                                            <label class="nk-label">Title</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_desc_eleven']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <textarea name="edit_program_desc_eleven" id="edit_program_desc_eleven" class="form-control"><?= isset($_POST['edit_program_desc_eleven']) ? $_POST['edit_program_desc_eleven'] : '' ?></textarea>
                                                            <label class="nk-label">Description</label>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <hr>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <b>display</b>
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_display']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_display"
                                                                id="edit_program_display"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_display']) ? $_POST['edit_program_display'] : '' ?>">
                                                            <label class="nk-label">Display One</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_display_two']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_display_two"
                                                                id="edit_program_display_two"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_display_two']) ? $_POST['edit_program_display_two'] : '' ?>">
                                                            <label class="nk-label">Display Two</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_display_three']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_display_three"
                                                                id="edit_program_display_three"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_display_three']) ? $_POST['edit_program_display_three'] : '' ?>">
                                                            <label class="nk-label">Display three</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_display_four']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_display_four"
                                                                id="edit_program_display_four"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_display_four']) ? $_POST['edit_program_display_four'] : '' ?>">
                                                            <label class="nk-label">Display FOur</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_display_five']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_display_five"
                                                                id="edit_program_display_five"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_display_five']) ? $_POST['edit_program_display_five'] : '' ?>">
                                                            <label class="nk-label">Display FIve</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_display_six']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_display_six"
                                                                id="edit_program_display_six"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_display_six']) ? $_POST['edit_program_display_six'] : '' ?>">
                                                            <label class="nk-label">Display Six</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_display_seven']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_display_seven"
                                                                id="edit_program_display_seven"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_display_seven']) ? $_POST['edit_program_display_seven'] : '' ?>">
                                                            <label class="nk-label">Display Seven</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_display_eight']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_display_eight"
                                                                id="edit_program_display_eight"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_display_eight']) ? $_POST['edit_program_display_eight'] : '' ?>">
                                                            <label class="nk-label">Display Eight</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group ic-cmp-int float-lb floating-lb">
                                                        <div class="form-ic-cmp">
                                                            <i class="notika-icon notika-support"></i>
                                                        </div>
                                                        <div
                                                            class="nk-int-st <?= isset($_POST['edit_program_display_nine']) ? "
                                                            nk-toggled" : '' ?>"="nk-toggled" : '' ?>
                                                            <input
                                                                type="text"
                                                                name="edit_program_display_nine"
                                                                id="edit_program_display_nine"
                                                                class="form-control"
                                                                value="<?= isset($_POST['edit_program_display_nine']) ? $_POST['edit_program_display_nine'] : '' ?>">
                                                            <label class="nk-label">Display Nine</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer editProgramFooter">
                                <button
                                    type="button"
                                    class="btn notika-btn-red btn-button-mg waves-effect"
                                    data-dismiss="modal">
                                    <i class="notika-icon notika-close"></i>
                                    Close</button>
                                <button
                                    type="submit"
                                    class="btn notika-btn-green btn-button-mg waves-effect"
                                    id="editProgramBtn"
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
<!-- /edit Program -->

<!-- view Program -->
<div
class="modal animated shake"
id="viewProgramModal"
tabindex="-1"
role="dialog">
<div class="modal-dialog modal-large">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
            <i class="notika-icon notika-form"></i>
            View Program</h4>
        <hr/>
    </div>
    <div class="modal-body">
        <div class="view_program_data"></div>
    </div>
    <div class="modal-footer viewProgramFooter">
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
<div class="modal fade" tabindex="-1" role="dialog" id="removeProgramModal">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
            <i class="glyphicon glyphicon-trash"></i>
            Remove Program</h4>
    </div>
    <div class="modal-body">
        <p>Do you really want to remove ?</p>
    </div>
    <div class="modal-footer removeProgramFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="glyphicon glyphicon-remove-sign"></i>
            Close</button>
        <button
            type="button"
            class="btn btn-primary"
            id="removeProgramBtn"
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
<script src="<?= base_url(); ?>assets/admin/custom/js/program.js"></script>