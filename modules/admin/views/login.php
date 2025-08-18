<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Harvest Green Montessori | Admin Panel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/home/images/logo/harvest.png"> 
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/bootstrap.min.css">
    <!-- font awesome CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/font-awesome.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/normalize.css">
    <!-- Notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/notika-custom-icon.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/main.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/responsive.css">
    <!-- jquery
		============================================ -->
    <script src="<?= base_url();?>assets/admin/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- modernizr JS
		============================================ -->
    <script src="<?= base_url();?>assets/admin/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Login Register area Start-->
    <?php $this->load->view('common/message.php'); ?>

    <div class="login-content">
      <!-- Login -->
      <div class="nk-block toggled" id="l-login">
        <?php echo validation_errors(); ?>
        <?php echo form_open('admin/auth','class="nk-form"'); ?>
              <div class="input-group">
                  <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                  <div class="nk-int-st">
                      <input type="text" class="form-control" name="u_mail" value="<?= set_value("u_mail"); ?>" placeholder="User Email">
                      <?= form_error("u_mail"); ?>
                  </div>
              </div>
              <div class="input-group mg-t-15">
                  <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                  <div class="nk-int-st">
                      <input type="password" class="form-control" name="u_pswd" value="<?= set_value("u_pswd"); ?>" placeholder="Password">
                      <?= form_error("u_pswd"); ?>
                  </div>
              </div>
              <div class="fm-checkbox">
                    <label><input type="checkbox" class="i-checks"> <i></i> Keep me signed in</label>
                </div>

              <button type="submit" class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow right-arrow-ant"></i></button>
          </div>
        <?php echo form_close(); ?>
      </div>
    </div>
    <!-- Login Register area End-->

    <!-- bootstrap JS
		============================================ -->
    <script src="<?= base_url();?>assets/admin/js/bootstrap.min.js"></script>
    <!--  notification JS
		============================================ -->
    <script src="<?= base_url();?>assets/admin/js/notification/bootstrap-growl.min.js"></script>
    <script src="<?= base_url();?>assets/admin/js/notification/notification-active.js"></script>
    <script src="<?= base_url();?>assets/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    
    <!-- Login JS
		============================================ -->
    <script src="<?= base_url();?>assets/admin/js/login/login-action.js"></script>
</body>
</html>
