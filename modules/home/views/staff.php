<?php $this->load->view('common/header'); ?>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area">
            <div class="ht__bradcaump__container py-60">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 text-center">
							<h1>Our Staff</h1>
							<nav class="bradcaump-inner">
								<a class="breadcrumb-item" href="index.html">Home</a>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active">About Us</span>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active">Our Staff</span>
							  </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Class Details -->
        <section class="page-class-details bg--white mb-5">
		<div class="shape-mockup movingX z-index-negative d-none d-xl-block" style="top: 45%; right: 5%;"><img src="<?= base_url(); ?>assets/home/images/others/bee-2.png" alt="shapes"></div>
        	<div class="container">
				<div class="row mt-5">
					<div class="col-lg-5">
						<img src="<?= base_url(); ?>assets/home/images/others/staff.jpg" alt="about" class="img-fluid img-thumbnail radius_two">
					</div>
					<div class="col-lg-7">
						<h2>HGM brings experienced and passionate teachers with outstanding education qualifications and Montessori Knowledge.</h2>
						<p class="my-3"><span class="fa fa-star text-danger"></span> Our teachers enhance your child’s learning experience and foster their inclusive growth with physical, emotional, intellectual and social development.</p>
						<p class="my-3"><span class="fa fa-star text-success"></span> Each classroom teacher is aided with an assistant as needed, based on classroom ratio to provide personal care for each child.</p>
						<p class="my-3"><span class="fa fa-star text-primary"></span> Montessori trained, experienced/certified teachers.</p>
					</div>
				</div>
        	</div>
        </section>
        <!-- End Class Details -->
		<!-- animation section  -->
		<style>
			.marquee-wrapper { overflow: hidden; white-space: nowrap; padding-bottom: 10px; }
			.marquee-track { display: inline-block; animation: marquee-scroll 15s linear infinite; }
			@keyframes marquee-scroll { 0% { transform: translateX(100vw); } 100% { transform: translateX(-100%); } }
		</style>
		<section class="home-content" style="background-color: #ffc000;padding-top: 30px">
			<div class="marquee-wrapper">
				<div class="marquee-track">
					<img src="<?= base_url(); ?>assets/home/images/others/bus.png">
				</div>
			</div>
		</section>
		<!-- ---------End Home gallery------- -->

<?php $this->load->view('common/footer'); ?>
