<?php $this->load->view('common/header'); ?>

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
                                    <h2>FAQ Record</h2>
                                    <p>Manage all Frequently Asked Questions</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <button
                                    id="addFaqModalBtn"
                                    class="btn wave-effect"
                                    data-toggle="modal"
                                    data-target="#addFaqModal">
                                    <i class="notika-icon notika-form"></i>
                                    Add FAQ
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
                        <h2>FAQ Table</h2>
                        <p>Click action to edit or remove a FAQ entry.</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="manageFaqTable">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th style="width:15%;">Options</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Data Table area End-->

<!-- Add FAQ Modal -->
<div class="modal animated shake" id="addFaqModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="notika-icon notika-form"></i> Add FAQ</h4>
                <hr/>
            </div>
            <div class="modal-body">
                <div id="add-faq-messages"></div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-element-list">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Question <span class="text-danger">*</span></label>
                                        <input type="text" id="add_faq_question" class="form-control" placeholder="Enter question">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Order</label>
                                        <input type="number" id="add_faq_order" class="form-control" placeholder="0" value="0" min="0">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Header BG Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="padding:4px 8px;">
                                                <input type="color" id="add_faq_bg_color_picker" value="#f7f7f7" style="width:28px;height:28px;border:none;padding:0;cursor:pointer;">
                                            </span>
                                            <input type="text" id="add_faq_bg_color" class="form-control" value="#f7f7f7" maxlength="7" placeholder="#f7f7f7">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Title Text Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="padding:4px 8px;">
                                                <input type="color" id="add_faq_title_color_picker" value="#3d3d3d" style="width:28px;height:28px;border:none;padding:0;cursor:pointer;">
                                            </span>
                                            <input type="text" id="add_faq_title_color" class="form-control" value="#3d3d3d" maxlength="7" placeholder="#3d3d3d">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Answer <span class="text-danger">*</span></label>
                                        <textarea id="add_faq_answer" name="add_faq_answer" class="form-control ckeditor" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitAddFaqBtn">Save FAQ</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit FAQ Modal -->
<div class="modal animated shake" id="editFaqModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="notika-icon notika-edit"></i> Edit FAQ</h4>
                <hr/>
            </div>
            <div class="modal-body">
                <div id="edit-faq-messages"></div>
                <input type="hidden" id="edit_faq_id">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-element-list">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Question <span class="text-danger">*</span></label>
                                        <input type="text" id="edit_faq_question" class="form-control" placeholder="Enter question">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Order</label>
                                        <input type="number" id="edit_faq_order" class="form-control" placeholder="0" min="0">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Header BG Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="padding:4px 8px;">
                                                <input type="color" id="edit_faq_bg_color_picker" value="#f7f7f7" style="width:28px;height:28px;border:none;padding:0;cursor:pointer;">
                                            </span>
                                            <input type="text" id="edit_faq_bg_color" class="form-control" value="#f7f7f7" maxlength="7" placeholder="#f7f7f7">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Title Text Color</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="padding:4px 8px;">
                                                <input type="color" id="edit_faq_title_color_picker" value="#3d3d3d" style="width:28px;height:28px;border:none;padding:0;cursor:pointer;">
                                            </span>
                                            <input type="text" id="edit_faq_title_color" class="form-control" value="#3d3d3d" maxlength="7" placeholder="#3d3d3d">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Answer <span class="text-danger">*</span></label>
                                        <textarea id="edit_faq_answer" name="edit_faq_answer" class="form-control ckeditor" rows="6"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="edit_faq_status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitEditFaqBtn">Update FAQ</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Remove FAQ Modal -->
<div class="modal animated shake" id="removeFaqModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="notika-icon notika-trash"></i> Remove FAQ</h4>
            </div>
            <div class="modal-body">
                <div id="remove-faq-messages"></div>
                <input type="hidden" id="remove_faq_id">
                <p>Are you sure you want to delete this FAQ? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="submitRemoveFaqBtn">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('common/footer'); ?>

<script>
var base_url = '<?= base_url(); ?>';

// DataTable
var faqTable = $('#manageFaqTable').DataTable({
    processing: true,
    ajax: {
        url: base_url + 'admin/faq/get_all_faq',
        type: 'GET'
    },
    columns: [
        { data: 0, width: '5%' },
        { data: 1 },
        { data: 2, render: function(data) { return data.length > 80 ? data.substring(0, 80) + '...' : data; } },
        { data: 3 },
        { data: 4, width: '10%' },
        { data: 5, orderable: false, width: '15%' }
    ],
    order: [[0, 'asc']]
});

// Add FAQ
$('#submitAddFaqBtn').on('click', function() {
    var question = $.trim($('#add_faq_question').val());
    var answer   = CKEDITOR.instances.add_faq_answer ? CKEDITOR.instances.add_faq_answer.getData() : $('#add_faq_answer').val();
    var order    = $.trim($('#add_faq_order').val());

    if (!question || !$.trim(answer)) {
        $('#add-faq-messages').html('<div class="alert alert-warning">Question and Answer are required.</div>');
        return;
    }

    $.ajax({
        url: base_url + 'admin/faq/add_faq',
        type: 'POST',
        data: { faq_question: question, faq_answer: answer, faq_order: order, faq_bg_color: $('#add_faq_bg_color').val(), faq_title_color: $('#add_faq_title_color').val() },
        success: function(res) {
            var r = JSON.parse(res);
            if (r.status === 'success') {
                $('#add-faq-messages').html('<div class="alert alert-success">' + r.messages + '</div>');
                faqTable.ajax.reload();
                $('#add_faq_question').val('');
                if (CKEDITOR.instances.add_faq_answer) { CKEDITOR.instances.add_faq_answer.setData(''); }
                $('#add_faq_order').val('0');
                $('#add_faq_bg_color').val('#f7f7f7'); $('#add_faq_bg_color_picker').val('#f7f7f7');
                $('#add_faq_title_color').val('#3d3d3d'); $('#add_faq_title_color_picker').val('#3d3d3d');
                setTimeout(function() { $('#addFaqModal').modal('hide'); $('#add-faq-messages').html(''); }, 1200);
            } else {
                $('#add-faq-messages').html('<div class="alert alert-warning">' + r.messages + '</div>');
            }
        }
    });
});

// Load edit modal
function editFaq(faq_id) {
    $('#edit-faq-messages').html('');
    $.ajax({
        url: base_url + 'admin/faq/get_single_faq',
        type: 'POST',
        data: { faq_id: faq_id },
        success: function(res) {
            var r = JSON.parse(res);
            $('#edit_faq_id').val(r.faq_id);
            $('#edit_faq_question').val(r.faq_question);
            if (CKEDITOR.instances.edit_faq_answer) {
                CKEDITOR.instances.edit_faq_answer.setData(r.faq_answer);
            } else {
                $('#edit_faq_answer').val(r.faq_answer);
            }
            $('#edit_faq_order').val(r.faq_order);
            $('#edit_faq_status').val(r.faq_status);
            var bg = r.faq_bg_color || '#f7f7f7';
            var tc = r.faq_title_color || '#3d3d3d';
            $('#edit_faq_bg_color').val(bg); $('#edit_faq_bg_color_picker').val(bg);
            $('#edit_faq_title_color').val(tc); $('#edit_faq_title_color_picker').val(tc);
        }
    });
}

// Submit edit
$('#submitEditFaqBtn').on('click', function() {
    var question = $.trim($('#edit_faq_question').val());
    var answer   = CKEDITOR.instances.edit_faq_answer ? CKEDITOR.instances.edit_faq_answer.getData() : $('#edit_faq_answer').val();
    var order    = $.trim($('#edit_faq_order').val());
    var status   = $('#edit_faq_status').val();
    var faq_id   = $('#edit_faq_id').val();

    if (!question || !$.trim(answer)) {
        $('#edit-faq-messages').html('<div class="alert alert-warning">Question and Answer are required.</div>');
        return;
    }

    $.ajax({
        url: base_url + 'admin/faq/edit_faq',
        type: 'POST',
        data: { faq_id: faq_id, faq_question: question, faq_answer: answer, faq_order: order, faq_status: status, faq_bg_color: $('#edit_faq_bg_color').val(), faq_title_color: $('#edit_faq_title_color').val() },
        success: function(res) {
            var r = JSON.parse(res);
            if (r.status === 'success') {
                $('#edit-faq-messages').html('<div class="alert alert-success">' + r.messages + '</div>');
                faqTable.ajax.reload();
                setTimeout(function() { $('#editFaqModal').modal('hide'); $('#edit-faq-messages').html(''); }, 1200);
            } else {
                $('#edit-faq-messages').html('<div class="alert alert-warning">' + r.messages + '</div>');
            }
        }
    });
});

// Load remove modal
function removeFaq(faq_id) {
    $('#remove-faq-messages').html('');
    $('#remove_faq_id').val(faq_id);
}

// Submit remove
$('#submitRemoveFaqBtn').on('click', function() {
    var faq_id = $('#remove_faq_id').val();
    $.ajax({
        url: base_url + 'admin/faq/remove_faq',
        type: 'POST',
        data: { faq_id: faq_id },
        success: function(res) {
            var r = JSON.parse(res);
            if (r.status === 'success') {
                $('#remove-faq-messages').html('<div class="alert alert-success">' + r.messages + '</div>');
                faqTable.ajax.reload();
                setTimeout(function() { $('#removeFaqModal').modal('hide'); $('#remove-faq-messages').html(''); }, 1200);
            } else {
                $('#remove-faq-messages').html('<div class="alert alert-warning">' + r.messages + '</div>');
            }
        }
    });
});

// Highlight active nav
$('.navFaq').addClass('active');

// Color picker <-> text input sync (Add modal)
$('#add_faq_bg_color_picker').on('input change', function() {
    $('#add_faq_bg_color').val($(this).val());
});
$('#add_faq_bg_color').on('input', function() {
    if (/^#[0-9A-Fa-f]{6}$/.test($(this).val())) { $('#add_faq_bg_color_picker').val($(this).val()); }
});
$('#add_faq_title_color_picker').on('input change', function() {
    $('#add_faq_title_color').val($(this).val());
});
$('#add_faq_title_color').on('input', function() {
    if (/^#[0-9A-Fa-f]{6}$/.test($(this).val())) { $('#add_faq_title_color_picker').val($(this).val()); }
});

// Color picker <-> text input sync (Edit modal)
$('#edit_faq_bg_color_picker').on('input change', function() {
    $('#edit_faq_bg_color').val($(this).val());
});
$('#edit_faq_bg_color').on('input', function() {
    if (/^#[0-9A-Fa-f]{6}$/.test($(this).val())) { $('#edit_faq_bg_color_picker').val($(this).val()); }
});
$('#edit_faq_title_color_picker').on('input change', function() {
    $('#edit_faq_title_color').val($(this).val());
});
$('#edit_faq_title_color').on('input', function() {
    if (/^#[0-9A-Fa-f]{6}$/.test($(this).val())) { $('#edit_faq_title_color_picker').val($(this).val()); }
});
</script>
