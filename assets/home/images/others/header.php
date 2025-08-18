<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Harvest Green Montessori School</title>
	<meta name="description" content="">
    <meta name="author" content="harvestgreenmontessori.com">
    <meta name="keywords" content=" Harvest Green Montessori, Montessori primary school, Montessori summer school ,Montessori education , Montessori education children, harvest green Montessori school, Montessori learning outcomes, Montessori certification Texas, Montessori uniform, Montessori school uniforms, Montessori materials, Montessori teachers, Montessori Admission ,Montessori learning , Montessori education, harvest green Montessori tuition, , best day care in richmond, katy and sugarland, best Montessori school in richmond, infant, toddler, Transition, Kindergarten , primary, Enrichment,  summer school program, healthy food"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/icon.png">
	<!-- Google font (font-family: 'Lobster', Open+Sans;) -->
	<link href="https://fonts.googleapis.com/css?family=Baloo" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,700" rel="stylesheet">
	<link href="https://www.dafontfree.net/embed/bXVzZW8tMzAwJmRhdGEvNTAvbS8yODY5Ny9NdXNlbzMwMC1SZWd1bGFyLm90Zg" rel="stylesheet" type="text/css"/>

	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?= base_url(); ?>assets/home/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/home/css/plugins.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/home/css/style.css">

	<!-- Cusom css -->
   <link rel="stylesheet" href="<?= base_url(); ?>assets/home/css/custom.css">

	<!-- Modernizer js -->
	<script src="<?= base_url(); ?>assets/home/js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<body>
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<!-- Add your site or application content here -->
	
	<!-- <div class="fakeloader"></div> -->

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- header 2  -->
		<header id="header" class="jnr__header header--3 clearfix">
			<div class="top-hrader" style="background-color: #5dba3b;">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 d-flex justify-content-around align-items-center p-1">
							<p class="text-white">Welcome to Harvest Green Montessori !</p>
							<ul class="dacre__social__link--2 d-flex justify-content-start">
								<li class="facebook"><a href="https://www.facebook.com/HGMMontessoriSchool" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<li class="twitter"><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<li class="pinterest"><a href="https://instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- Start Header Top Area -->
			<div class="junior__header__top bg--white d-none d-lg-flex">
				<div class="container">
					<div class="row menu__separator">
						<div class="col-md-7 d-none d-lg-block col-lg-3 col-sm-12">
							<div class="jun__header__top__left">
								<div class="logo">
									<a href="<?= base_url(); ?>">
										<img src="<?= base_url(); ?>assets/home/images/logo/harvest.png" alt="logo images">
									</a>
								</div>
							</div>
						</div>
						<div class="col-md-9 col-lg-7 col-sm-12 col-12">
							<div class="jun__header__top__right">
								<p><span class="fa fa-map-marker text-warning"></span><br><a href="#">4100 Harvest Corner  Dr<br> Richmond, TX 77406</a></p>
								<p><span class="fa fa-envelope-open-o text-danger"></span><br><a href="#">info@harvestgreenmontessori.com</a></p>
								<p><span class="fa fa-phone text-success"></span><br><a href="#">281-819-PLAY (7529)</a> </p>
							</div>
						</div>
						<div class="col-md-3 col-lg-2 col-sm-12 col-12 d-none d-lg-flex">
							<a href="<?= base_url(); ?>Schedule_a_tour" class="button color-1">Schedule A Tour</a>
						</div>
					</div>
				</div>
			</div>

			<!-- End Header Top Area -->
			<!-- Start Mainmenu Area -->
			<div class="mainmenu__wrapper bg--white sticky__header">
				<div class="container">
					<div class="row d-none d-lg-flex">
						<div class="col-sm-12 col-md-12 col-lg-12 order-3 order-lg-2">
							<div class="mainmenu__wrap">
								<nav class="mainmenu__nav" style="display: block;">
                                    <ul class="mainmenu">
                                        <li><a href="<?= base_url(); ?>">Home</a></li>
                                        <li class="drop"><a href="#" onclick="return false;">About Us</a>
                                            <ul class="dropdown__menu">
                                                <li><a href="<?= base_url(); ?>Why_montessori">Why Montessori</a></li>
                                                <li><a href="<?= base_url(); ?>Mission_vision">Mission/Vision</a></li>
                                                <li><a href="<?= base_url(); ?>Staff">Staff</a></li>
                                                <li><a href="<?= base_url(); ?>Curriculum">Curriculum</a></li>
                                                <li><a href="<?= base_url(); ?>Montessori_vs_traditional">Montessori Vs. Traditional</a></li>
                                                <li><a href="<?= base_url(); ?>Parent_testimonial">Parent Testimonials</a></li>
                                            </ul>
                                        </li> 
                                        <li class="drop"><a href="#" onclick="return false;">Our Program</a>
                                            <ul class="dropdown__menu">
											<?php
												foreach($this->program as $row){
													echo'<li>
													<a href="'.base_url().'program/'.strtolower(str_replace(" ","-",$row->program_name)).'">'.$row->program_name.'</a>
													</li>';
												}
											?>
                                            </ul>
                                        </li>
                                        <li><a href="<?= base_url(); ?>Gallery/award">Awards</a></li>
                                        <li class="drop"><a href="<?= base_url(); ?>Admission">Admission</a></li>
                                        <li class="drop"><a href="#" onclick="return false;">Resources</a>
                                            <ul class="dropdown__menu">
                                                <li><a href="<?= base_url(); ?>Calendar">Calendar</a></li>
                                                <li><a href="<?= base_url(); ?>Gallery">Picture Gallery</a></li>
                                                <li><a href="<?= base_url(); ?>Uniform">Uniform</a></li>
                                                <li><a href="<?= base_url(); ?>Lunch">Lunch</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="<?= base_url(); ?>Career">Careers</a></li>
                                        <li><a href="<?= base_url(); ?>Blog">Blog</a></li>
                                        <li><a href="<?= base_url(); ?>contact">Contact Us</a></li>
                                    </ul>
                                </nav>
							</div>
						</div>
					</div>
					<!-- Mobile Menu -->
                    <div class="mobile-menu d-block d-lg-none">
                    	<div class="logo">
                    		<a href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/home/images/logo/harvest.png" alt="logo"></a>
                    	</div>
                    </div>
                    <!-- Mobile Menu -->
				</div>
			</div>
			<!-- End Mainmenu Area -->
		</header>
		<!-- header 2  -->