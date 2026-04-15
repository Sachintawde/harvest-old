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
		
<!-- SMTP Settings (Microsoft Outlook — single provider) -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-element-list">
				<div class="basic-tb-hd">
					<h2>Email SMTP Settings <small style="font-size:13px;color:#777;">(Microsoft Outlook — smtp.office365.com)</small></h2>
					<p>Single outgoing mail server used for all email channels: admin notifications, applicant confirmations, and ICS attachments.</p>
				</div>
				<div class="smtpMessages"></div>
				<form action="setting/update_smtp" method="post" class="form-horizontal" id="smtpForm">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="text" name="MAIL_HOST" id="MAIL_HOST" class="form-control" value="<?= htmlspecialchars($smtp['MAIL_HOST']) ?>">
									<label class="nk-label">SMTP Host</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="number" name="MAIL_PORT" id="MAIL_PORT" class="form-control" value="<?= htmlspecialchars($smtp['MAIL_PORT']) ?>">
									<label class="nk-label">SMTP Port</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="text" name="MAIL_USERNAME" id="MAIL_USERNAME" class="form-control" value="<?= htmlspecialchars($smtp['MAIL_USERNAME']) ?>">
									<label class="nk-label">SMTP Username (Outlook Email)</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="password" name="MAIL_PASSWORD" id="MAIL_PASSWORD" class="form-control" value="<?= htmlspecialchars($smtp['MAIL_PASSWORD']) ?>">
									<label class="nk-label">SMTP Password / App Password</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<select name="MAIL_ENCRYPTION" id="MAIL_ENCRYPTION" class="form-control">
										<option value="tls" <?= $smtp['MAIL_ENCRYPTION'] === 'tls' ? 'selected' : '' ?>>TLS (recommended for Outlook port 587)</option>
										<option value="ssl" <?= $smtp['MAIL_ENCRYPTION'] === 'ssl' ? 'selected' : '' ?>>SSL</option>
										<option value="" <?= $smtp['MAIL_ENCRYPTION'] === '' ? 'selected' : '' ?>>None</option>
									</select>
									<label class="nk-label">Encryption</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="email" name="MAIL_FROM_ADDRESS" id="MAIL_FROM_ADDRESS" class="form-control" value="<?= htmlspecialchars($smtp['MAIL_FROM_ADDRESS']) ?>">
									<label class="nk-label">From Address</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="text" name="MAIL_FROM_NAME" id="MAIL_FROM_NAME" class="form-control" value="<?= htmlspecialchars($smtp['MAIL_FROM_NAME']) ?>">
									<label class="nk-label">From Name</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group ic-cmp-int float-lb floating-lb">
								<div class="form-ic-cmp"><i class="notika-icon notika-support"></i></div>
								<div class="nk-int-st nk-toggled">
									<input type="email" name="ADMIN_MAIL_TO" id="ADMIN_MAIL_TO" class="form-control" value="<?= htmlspecialchars($smtp['ADMIN_MAIL_TO']) ?>">
									<label class="nk-label">Admin Notification Recipient</label>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-danger notika-btn-danger" id="smtpSaveBtn">
									<i class="glyphicon glyphicon-ok-sign"></i> Save SMTP Settings
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
