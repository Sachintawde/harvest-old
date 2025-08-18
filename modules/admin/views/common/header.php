<?php
$this->recent_book=[];
$this->recent_msg=[];
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Harvest Green Montessori &#124; Admin panel</title>
        <meta
            name="viewport"
            content="width=device-width,initial-scale=1.0,maximum-scale=1"/>
        <meta name="author" content="Konale Classes"/>
        <meta
            name="description"
            content="Best Wedding&#44; Pre-wedding Photographers Nanded&#44; Pune&#44; Mumbai, Candid Photographers Nanded&#44; Pune&#44; Mumbai, Wedding Photography Nanded&#44; Pune&#44; Mumbai, Pre Wedding Shoot Nanded&#44; Pune&#44; Mumbai, Professional Photographers Nanded&#44; Pune&#44; Mumbai, Wedding Photography Nanded&#44; Pune&#44; Mumbai, Cenematography Nanded&#44; Pune&#44; Mumbai">
        <meta
            name="keywords"
            content="CP Photgraphy, Chetan Pawar Photgraphy, Best wedding photgrapher Nanded, Best wedding photgrapher Pune, Best wedding photgrapher Mumbai, Best wedding photographer 2020, Modelling Photgraphy nanded, Cenematography nanded, Product photgraphy, modelling shoot, baby photography, event management nanded">

        <link rel="canonical" href="http://www.cpphotography.in">
        <!-- favicon -->
        <link
            rel="shortcut icon"
            href="<?= base_url(); ?>assets/home/images/logo/harvest.png"> 
        <!-- Bootstrap CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/bootstrap.min.css">
        <!-- font awesome CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/font-awesome.min.css">
        <!-- owl.carousel CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/owl.carousel.css">
        <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/owl.theme.css">
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/owl.transitions.css">
        <!-- meanmenu CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/meanmenu/meanmenu.min.css">
        <!-- animate CSS ============================================ -->
        <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/animate.css">
        <!-- summernote CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/summernote/summernote.css">
        <!-- Range Slider CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/themesaller-forms.css">
        <!-- normalize CSS ============================================ -->
        <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/normalize.css">
        <!-- mCustomScrollbar CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/scrollbar/jquery.mCustomScrollbar.min.css">
        <!-- Notika icon CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/notika-custom-icon.css">
        <!-- bootstrap select CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/bootstrap-select/bootstrap-select.css">
        <!-- datapicker CSS ============================================ -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <!-- Color Picker CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/color-picker/farbtastic.css">
        <!-- main CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/chosen/chosen.css">
        <!-- notification CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/notification/notification.css">
        <!-- dropzone CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/dropzone/dropzone.css">
        <!-- wave CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/wave/waves.min.css">
        <!-- wave CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url();?>assets/admin/css/wave/waves.min.css">
        <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/wave/button.css">

        <!-- main CSS ============================================ -->
        <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/main.css">
        <!-- style CSS ============================================ -->
        <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/style.css">
        <!-- custom CSS ============================================ -->
        <link
            rel="stylesheet"
            href="<?= base_url(); ?>assets/admin/custom/css/custom.css">
        <!-- responsive CSS ============================================ -->
        <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/responsive.css">
        <!-- file input -->
        <link
            rel="stylesheet"
            href="<?= base_url(); ?>assets/admin/plugins/fileinput/css/fileinput.min.css">

        <!-- Data-table -->
        <link
            rel="stylesheet"
            href="<?= base_url(); ?>assets/admin/plugins/datatables/datatables.min.css">
        <link
            rel="stylesheet"
            href="<?= base_url(); ?>assets/admin/plugins/jquery-ui/jquery-ui.min.css">

        <!-- jquery ============================================ -->
        <script src="<?= base_url(); ?>assets/admin/js/vendor/jquery-1.12.4.min.js"></script>

        <!-- modernizr JS ============================================ -->
        <script src="<?= base_url();?>assets/admin/js/vendor/modernizr-2.8.3.min.js"></script>

    </head>

</body>

<?php 

      $this->load->view("common/message");

    //   if (!$this->session->userdata("admin_logged_in"))
    //   {
    //     echo '<div class="error-page-area">
    //         <div class="error-page-wrap">
    //             <i class="notika-icon notika-close"></i>
    //             <h2>ERROR <span class="counter">500</span></h2>
    //             <p>Sorry, but you can\'t access this page untill u logged in.</p>
    //             <a href="'.base_url().'" class="btn">Home Page</a>
    //             <a href="'.base_url().'admin" class="btn error-btn-mg">Login</a>
    //         </div>
    //     </div>
    //     ';
    //     exit();
    //   }
    ?>

    <!-- <div id="spinner-wrapper">
      <div class="spinner">
        <img src="<?= base_url(); ?>assets/admin/images/loader.gif" class="loader img-responsive" alt="">
      </div>
    </div> -->

    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="logo-area mg-t-10">
                        <a href="<?= base_url(); ?>/admin/dashboard"><img src="<?= base_url(); ?>assets/home/images/logo/harvest.png" alt="" /></a> 
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"> 
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            <li class="nav-item dropdown">                                
                                <a href="<?= base_url(); ?>/admin/contact" title="Message" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-mail"></i></span><div class="spinner4 spinner-4"></div><div class="ntd-ctn"><?= count($this->con_msg); ?></div></a>
                                <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Messages</h2> 
                                    </div>
                                    <div class="hd-message-info">
                                    <?php 
                                      if(count($this->con_msg)){
                                        foreach ($this->con_msg as $rec_msg) {
                                          echo '
                                              <a href="message">
                                                  <div class="hd-message-sn" style="border-bottom:1px solid rgba(0,0,0,0.2)">
                                                      <div class="hd-mg-ctn">
                                                          <h3><span><i class="notika-icon notika-support"></i></span> '.$rec_msg->con_name.' <span style="position:absolute; right:20px; font-size:12px;"><i class="notika-icon notika-calendar"></i> '.$rec_msg->con_date.'</span></h3>
                                                          <p><span><i class="notika-icon notika-mail"></i></span> '.$rec_msg->con_msg.'</p>                                                          
                                                      </div>
                                                  </div>
                                              </a>';
                                        }
                                      } 
                                    ?>

                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="<?= base_url(); ?>/admin/contact">View All</a>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                              <a href="<?= base_url(); ?>/admin/tour" title="Schedule A Tour" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-alarm"></i></span><div class="spinner4 spinner-4"></div><div class="ntd-ctn"><?= count($this->con_tour); ?></div></a>
                                <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Schedule A Tour</h2>
                                    </div> 
                                    <div class="hd-message-info">
                                    <?php
                                      if(count($this->con_tour)){
                                        foreach ($this->con_tour as $rec_book) {
                                          echo '
                                              <a href="'.base_url().'/admin/tour">
                                                  <div class="hd-message-sn" style="border-bottom:1px solid rgba(0,0,0,0.2)">
                                                      <div class="hd-mg-ctn">
                                                          <h3><span><i class="notika-icon notika-support"></i></span> '.$rec_book->t_fname.' <span style="position:absolute; right:20px; font-size:12px;"><i class="notika-icon notika-calendar"></i> '.$rec_book->t_date.'</span></h3>
                                                          <p><span><i class="notika-icon notika-mail"></i></span> '.$rec_book->t_childname.'</p>                                                          
                                                      </div>
                                                  </div>
                                              </a>';
                                        }
                                      }
                                    ?>

                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="<?= base_url(); ?>/admin/tour">View All</a>
                                    </div>
                                </div>
                          
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->

    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                  <li class="navDashboard"><a href="<?= base_url(); ?>/admin/dashboard">Home</a></li>
                                  <li class="navBlog"><a href="<?= base_url(); ?>/admin/blog">Blog</a></li>
                                  <li class="navCareer"><a href="<?= base_url(); ?>/admin/career">Career</a></li>
                                  <li class="navContact"><a href="<?= base_url(); ?>/admin/contact">Contact</a></li>
                                  <li class="navCurriculum"><a href="<?= base_url(); ?>/admin/curriculum">Curriculum</a></li>
                                  <li class="navEnroll"><a href="<?= base_url(); ?>/admin/Enroll">Enroll</a></li>
                                  <li class="navEvent"><a href="<?= base_url(); ?>/admin/event">Event</a></li>
                                  <li class="navGallery"><a href="<?= base_url(); ?>/admin/gallery">Gallery</a></li>
                                  <li class="navPopup"><a href="<?= base_url(); ?>/admin/popup">Popup</a></li>
                                  <li class="navProgram"><a href="<?= base_url(); ?>/admin/program">Program</a></li>
                                  <li class="navTour"><a href="<?= base_url(); ?>/admin/tour">Schedule A Tour</a></li>
                                  <li class="navTestimonial"><a href="<?= base_url(); ?>/admin/testimonial">Testimonial</a></li>
                                  <li class="navTour"><a href="<?= base_url(); ?>/admin/tour/calendar">Tour Calendar</a></li>
                                  <li class="navSetting">
                                    <a data-toggle="collapse" data-target="#Pagemob" href="#"><?= $this->session->userdata("u_name") ?></a>
                                    <ul id="Pagemob" class="collapse dropdown-header-top">
                                      <li id="topNavSetting"><a href="<?= base_url(); ?>/admin/setting">Setting</a></li>                                    
                                      <li id="topNavLogout"><a href="<?= base_url(); ?>/admin/logout">Logout</a></li>
                                    </ul>
                                  </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
      <div class="container">
        <div class="row"> 
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                <li class="navDashboard"><a href="<?= base_url(); ?>/admin/dashboard"><i class="notika-icon notika-house"></i> Home</a></li>
                <li class="navBlog"><a href="<?= base_url(); ?>/admin/blog"><i class="notika-icon notika-picture"></i>Blog</a></li>
                <li class="navCareer"><a href="<?= base_url(); ?>/admin/career"><i class="notika-icon notika-edit"></i>Career</a></li>
                <li class="navContact"><a href="<?= base_url(); ?>/admin/contact"><i class="notika-icon notika-phone"></i>Contact</a></li>
                <li class="navCurriculum"><a href="<?= base_url(); ?>/admin/curriculum"><i class="notika-icon notika-social"></i>Curriculum</a></li>
                <li class="navEnroll"><a href="<?= base_url(); ?>/admin/Enroll"><i class="notika-icon notika-form"></i>Enroll</a></li>
                <li class="navEvent"><a href="<?= base_url(); ?>/admin/event"><i class="notika-icon notika-star"></i>Event</a></li>
                <li class="navGallery"><a href="<?= base_url(); ?>/admin/gallery"><i class="notika-icon notika-picture"></i>Gallery</a></li>
                <li class="navPopup"><a href="<?= base_url(); ?>/admin/popup"><i class="notika-icon notika-windows"></i>Popup</a></li>
                <li class="navProgram"><a href="<?= base_url(); ?>/admin/program"><i class="notika-icon notika-app"></i>Program</a></li>
                <li class="navTour"><a href="<?= base_url(); ?>/admin/tour"><i class="notika-icon notika-travel"></i>Schedule A Tour</a></li>
                <li class="navTour"><a href="<?= base_url(); ?>/admin/tour/calendar"><i class="notika-icon notika-travel"></i>Tour Calendar</a></li>
                <li class="navTestimonial"><a href="<?= base_url(); ?>/admin/testimonial"><i class="notika-icon notika-support"></i>Testimonial</a></li>
                <li class="navSetting"><a data-toggle="tab" href="#user"><i class="notika-icon notika-support"></i>Admin</a></li>
            </ul> 
    
            <div class="tab-content custom-menu-content">
                <div id="user" class="tab-pane notika-tab-menu-bg animated flipInX">
                  <ul class="notika-main-menu-dropdown">
                    <li class="topNavSetting"><a href="<?= base_url(); ?>/admin/setting">Setting</a></li>                                    
                    <li class="topNavLogout"><a href="<?= base_url(); ?>/admin/logout">Logout</a></li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Main Menu area End-->
