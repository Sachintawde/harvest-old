<?php $this->load->view('common/header'); ?>

<!-- Breadcomb area Start-->
<div class="breadcomb-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="remove-messages"></div>
				<div class="breadcomb-list">
					<div class="row">
						<div class="breadcomb-wp">
							<div class="breadcomb-icon">
								<i class="notika-icon notika-windows"></i>
							</div>
							<div class="breadcomb-ctn">
								<h2>Admin Setting</h2>
								<p>View All Important Setting</span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Breadcomb area End-->

<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-element-list" id="form_info">
			<div class="basic-tb-hd">
				<h2>Change User Mail Id</h2>
				<p>Privacy setting</p>
				<h2 id="summary"></h2>
			</div>
			<div class="changeUsenrameMessages"></div>
				<form action="setting/update_mail" method="post" class="form-horizontal" id="changeUsermailForm">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp">
									<i class="notika-icon notika-support"></i>
								</div>
								<div class="nk-int-st nk-toggled">
									<input type="email" name="u_mail" id="u_mail" class="form-control" value="<?= $this->session->userdata("u_mail") ?>">
									<label class="nk-label">User Mail</label>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<input type="hidden" name="u_id" id="u_m_id" value="<?= $this->session->userdata("u_id") ?>" />
								<button type="submit" class="btn btn-danger notika-btn-danger" data-loading-text="Loading..." id="changeUsermailBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
							</div>
						</div>					
					</div>
				</form>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form action="setting/update_pswd" method="post" class="form-horizontal" id="changeUserPasswordForm">
				<div class="form-element-list" id="form_info">
					<div class="basic-tb-hd">
						<h2>Change Password</h2>
						<p>privacy setting</p>
						<h2 id="summary"></h2>
					</div>
					<div class="changeUserPasswordMessage"></div>			

					<div class="row">
						<div class="col-md-6 col-md-offset-6 col-md-pull-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp">
									<i class="notika-icon notika-support"></i>
								</div>
								<div class="nk-int-st nk-toggled">
									<input type="password" name="password" id="password" class="form-control">
									<label class="nk-label">Current Password</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp">
									<i class="notika-icon notika-support"></i>
								</div>
								<div class="nk-int-st nk-toggled">
									<input type="password" name="npassword" id="npassword" class="form-control">
									<label class="nk-label">New Password</label>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<input type="hidden" name="u_id" id="u_p_id" value="<?= $this->session->userdata("u_id") ?>" />
								<button type="submit" class="btn btn-danger notika-btn-danger" data-loading-text="Loading..." id="changeUserPasswordBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
							</div>
						</div>					

						<div class="col-md-6 col-md-offset-6 col-md-pull-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp">
									<i class="notika-icon notika-support"></i>
								</div>
								<div class="nk-int-st nk-toggled">
									<input type="password" name="cpassword" id="cpassword" class="form-control">
									<label class="nk-label">Confirm Password</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
		
<!-- Admin SMTP Settings (Gmail) -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-element-list">
				<div class="basic-tb-hd">
					<h2>Admin Email SMTP <small style="font-size:13px;color:#777;">(Gmail — sends form details + ICS to admin)</small></h2>
					<p>Outgoing mail server used to notify the admin when a tour is scheduled</p>
				</div>
				<div class="adminSmtpMessages"></div>
				<form action="setting/update_admin_smtp" method="post" class="form-horizontal" id="adminSmtpForm">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="text" name="ADMIN_MAIL_HOST" id="ADMIN_MAIL_HOST" class="form-control" value="<?= htmlspecialchars($admin_smtp['ADMIN_MAIL_HOST']) ?>">
									<label class="nk-label">SMTP Host</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="number" name="ADMIN_MAIL_PORT" id="ADMIN_MAIL_PORT" class="form-control" value="<?= htmlspecialchars($admin_smtp['ADMIN_MAIL_PORT']) ?>">
									<label class="nk-label">SMTP Port</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="text" name="ADMIN_MAIL_USERNAME" id="ADMIN_MAIL_USERNAME" class="form-control" value="<?= htmlspecialchars($admin_smtp['ADMIN_MAIL_USERNAME']) ?>">
									<label class="nk-label">SMTP Username</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="password" name="ADMIN_MAIL_PASSWORD" id="ADMIN_MAIL_PASSWORD" class="form-control" value="<?= htmlspecialchars($admin_smtp['ADMIN_MAIL_PASSWORD']) ?>">
									<label class="nk-label">SMTP Password / App Password</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<select name="ADMIN_MAIL_ENCRYPTION" id="ADMIN_MAIL_ENCRYPTION" class="form-control">
										<option value="tls" <?= $admin_smtp['ADMIN_MAIL_ENCRYPTION'] === 'tls' ? 'selected' : '' ?>>TLS</option>
										<option value="ssl" <?= $admin_smtp['ADMIN_MAIL_ENCRYPTION'] === 'ssl' ? 'selected' : '' ?>>SSL</option>
										<option value="" <?= $admin_smtp['ADMIN_MAIL_ENCRYPTION'] === '' ? 'selected' : '' ?>>None</option>
									</select>
									<label class="nk-label">Encryption</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="email" name="ADMIN_MAIL_FROM_ADDRESS" id="ADMIN_MAIL_FROM_ADDRESS" class="form-control" value="<?= htmlspecialchars($admin_smtp['ADMIN_MAIL_FROM_ADDRESS']) ?>">
									<label class="nk-label">From Address</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="text" name="ADMIN_MAIL_FROM_NAME" id="ADMIN_MAIL_FROM_NAME" class="form-control" value="<?= htmlspecialchars($admin_smtp['ADMIN_MAIL_FROM_NAME']) ?>">
									<label class="nk-label">From Name</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="email" name="ADMIN_MAIL_TO" id="ADMIN_MAIL_TO" class="form-control" value="<?= htmlspecialchars($admin_smtp['ADMIN_MAIL_TO']) ?>">
									<label class="nk-label">Admin Notification Email (Recipient)</label>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-danger notika-btn-danger" id="adminSmtpSaveBtn">
									<i class="glyphicon glyphicon-ok-sign"></i> Save Admin SMTP Settings
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Applicant SMTP Settings (cPanel) -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-element-list">
				<div class="basic-tb-hd">
					<h2>Applicant Email SMTP <small style="font-size:13px;color:#777;">(cPanel — sends thank-you to parent)</small></h2>
					<p>Outgoing mail server used to send tour confirmation emails to applicant parents</p>
				</div>
				<div class="applicantSmtpMessages"></div>
				<form action="setting/update_applicant_smtp" method="post" class="form-horizontal" id="applicantSmtpForm">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="text" name="APPLICANT_MAIL_HOST" id="APPLICANT_MAIL_HOST" class="form-control" value="<?= htmlspecialchars($applicant_smtp['APPLICANT_MAIL_HOST']) ?>">
									<label class="nk-label">SMTP Host</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="number" name="APPLICANT_MAIL_PORT" id="APPLICANT_MAIL_PORT" class="form-control" value="<?= htmlspecialchars($applicant_smtp['APPLICANT_MAIL_PORT']) ?>">
									<label class="nk-label">SMTP Port</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="text" name="APPLICANT_MAIL_USERNAME" id="APPLICANT_MAIL_USERNAME" class="form-control" value="<?= htmlspecialchars($applicant_smtp['APPLICANT_MAIL_USERNAME']) ?>">
									<label class="nk-label">SMTP Username</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="password" name="APPLICANT_MAIL_PASSWORD" id="APPLICANT_MAIL_PASSWORD" class="form-control" value="<?= htmlspecialchars($applicant_smtp['APPLICANT_MAIL_PASSWORD']) ?>">
									<label class="nk-label">SMTP Password</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<select name="APPLICANT_MAIL_ENCRYPTION" id="APPLICANT_MAIL_ENCRYPTION" class="form-control">
										<option value="ssl" <?= $applicant_smtp['APPLICANT_MAIL_ENCRYPTION'] === 'ssl' ? 'selected' : '' ?>>SSL</option>
										<option value="tls" <?= $applicant_smtp['APPLICANT_MAIL_ENCRYPTION'] === 'tls' ? 'selected' : '' ?>>TLS</option>
										<option value="" <?= $applicant_smtp['APPLICANT_MAIL_ENCRYPTION'] === '' ? 'selected' : '' ?>>None</option>
									</select>
									<label class="nk-label">Encryption</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="email" name="APPLICANT_MAIL_FROM_ADDRESS" id="APPLICANT_MAIL_FROM_ADDRESS" class="form-control" value="<?= htmlspecialchars($applicant_smtp['APPLICANT_MAIL_FROM_ADDRESS']) ?>">
									<label class="nk-label">From Address</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="text" name="APPLICANT_MAIL_FROM_NAME" id="APPLICANT_MAIL_FROM_NAME" class="form-control" value="<?= htmlspecialchars($applicant_smtp['APPLICANT_MAIL_FROM_NAME']) ?>">
									<label class="nk-label">From Name</label>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-danger notika-btn-danger" id="applicantSmtpSaveBtn">
									<i class="glyphicon glyphicon-ok-sign"></i> Save Applicant SMTP Settings
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/admin/custom/js/setting.js"></script>
