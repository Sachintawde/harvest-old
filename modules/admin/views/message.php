<?php $this->load->view('common/header'); ?>

<!-- Breadcomb area Start-->
<div class="breadcomb-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="breadcomb-list">
                    <div class="breadcomb-wp">
                        <div class="breadcomb-icon">
                            <i class="notika-icon notika-windows"></i>
                        </div>
                        <div class="breadcomb-ctn">
                            <h2>Message Request</h2>
                            <p>View All Message Request Records</span></p>
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
						<h2>Message Table</h2>
                        <p>One one of them to see their details also action button to the modificatoin in database.</p>
                        <div class="remove-messages"></div>                        
						<span class="pull-right show_date">
							<div class="nk-int-st date-range">
								<div class="form-group nk-datapk-ctm form-elet-mg">
									<div class="input-group date nk-int-st">
										<span class="input-group-addon"></span>
										<input type="text" id="min" name="min" class="form-control"
											placeholder="Min Date" required>
									</div>
								</div>
							</div>
							<div class="nk-int-st date-range">
								<div class="form-group nk-datapk-ctm form-elet-mg">
									<div class="input-group date nk-int-st">
										<span class="input-group-addon"></span>
										<input type="text" id="max" name="max" class="form-control"
											placeholder="Max Date" required>
									</div>
								</div>
							</div>
						</span>
					</div>
					<div class="table-responsive">
						<table id="manageMessageTable" class="table table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>Mail Id</th>
									<th>Contact</th>
                                    <th width="30%">Message</th>
                                    <th>Date</th>
                                    <th>Options</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- view Message -->
<div class="modal animated shake" id="viewMessageModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-large">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class="notika-icon notika-form"></i> View Message</h4>
				<hr />
			</div>
			<div class="modal-body">
				<div class="view_Message_data"></div>
			</div>
			<div class="modal-footer viewMessageFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal"> <i
						class="glyphicon glyphicon-remove-sign"></i> Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /view Message -->

<!-- remove Message -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMessageModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Message</h4>
			</div>
			<div class="modal-body">
				<div class="removeMessageMessages"></div>
				<p>Do you really want to remove ?</p>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<div class="up_msg"></div>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer removeMessageFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal"> <i
						class="glyphicon glyphicon-remove-sign"></i> Close</button>
				<button type="button" class="btn btn-primary" id="removeMessageBtn" data-loading-text="Loading..."> <i
						class="glyphicon glyphicon-ok-sign"></i> Confirm Delete</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove Message -->

<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/admin/custom/js/msg_request.js"></script>
