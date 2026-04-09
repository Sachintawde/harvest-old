<?php $this->load->view('common/header'); ?>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area">
            <div class="ht__bradcaump__container py-60">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 text-center">
							<h1>Career</h1>
							<nav class="bradcaump-inner">
								<a class="breadcrumb-item" href="index.html">Home</a>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active">Resources</span>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active">Career</span>
							  </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Class Details -->
        <section class="page-class-details bg--white mb-5">
        	<div class="container">
				<div class="row mt-5">
					<div class="col-lg-5 mb-3">
						<img src="<?= base_url(); ?>assets/home/images/others/employement.png" alt="about" class="img-fluid img-thumbnail radius_two">
					</div>
					<div class="col-lg-7">
						<h2 class="f-24">“Our care of the child should be governed, not by the desire to make him learn things, but by the endeavor always to keep burning within him that light which is called intelligence.” ~Maria Montessori</h2>
						<h2 class="my-4">Employment Opportunities</h2>
						<p class="my-3">We are looking for experienced Montessori-certified lead teachers and assistant teachers. Candidates must be passionate about working with young children. Applicants interested in working with our Infant, Toddler, Primary, Kindergarten, and after-school programs, email your resume to director@harvestgreenmontessori.com.</p>
					</div>
				</div>
				<div class="row mt-5 px-40 py-3" style="background-color: #f8f8fc; border-radius: 15px;">
					<div class="col-lg-2">
						<img src="<?= base_url(); ?>assets/home/images/others/Apply_for_positions.png" alt="about" class="rounded-circle">
					</div>
					<div class="col-lg-10 py-3">
						<h2 class="f-24">Apply for <span class="text-highlight">Positions</span></h2>
						<p class="my-4">Harvest Green Montessori School welcomes quality educators!<br>
                            Are you passionate about making a difference in the lives of young children? If you value the importance of early childhood education, we invite you to learn more. Whether you are new to Montessori education or have prior experience, we are always looking for caring, passionate, dedicated staff who may be perfect candidates for joining our team! If you are interested in applying, please call us to schedule a time to visit.</p>
                            <a href="<?= base_url(); ?>Career_form" class="button color-4">Apply</a>
					</div>
				</div>
				<div class="row mt-5 px-40 py-3" style="background-color: #f8f8fc; border-radius: 15px;">
					<div class="col-lg-10">
						<h2 class="f-24">Top Reasons to Work for <span class="text-highlight">HGM</span></h2>
						<p class="my-3">We value our staff just as we value each of our students. We know each teacher in our HGM family plays an integral role in the implementation of a quality program and our commitment to the development of the whole child.</p>
						<p class="my-3">HGM staff enjoy opportunities for ongoing professional development training and benefits.</p>
					</div>
					<div class="col-lg-2">
						<img src="<?= base_url(); ?>assets/home/images/others/why.png" alt="about" class="rounded-circle">
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
