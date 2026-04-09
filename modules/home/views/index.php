<?php $this->load->view('common/header'); ?>
<style>
    .lead { font-size: 1.5rem; font-weight: 300; }
</style>
		<!-- Strat Slider Area -->
		<div class="slide__carosel owl-carousel owl-theme">
			<?php 
			foreach($gallery as $row){
				echo'
				<div class="slider__area  d-flex fullscreen justify-content-start align-items-center" style="  background-image: url('.img_url($row->img_path).');
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center center;">
			</div>';
			}
			?>
		</div>
		<!-- End Slider Area -->

		<!-- Start Welcame Area -->
		<section class="junior__welcome__area bg-pngimage--2 py-60">
			<div class="container">
			<div class="shape-mockup movingX z-index-negative d-none d-xl-block style_animated_icon1"><img src="<?= base_url(); ?>assets/home/images/others/buterfly-2.png" alt="shapes"></div>
				<div class="row jn__welcome__wrapper align-items-center">
					<div class="col-md-12 col-lg-7 col-sm-12">
						<div class="welcome__juniro__inner">
							<h3 class="text-center">Schedule A Tour</h3>
							<p class="wow flipInX"><b>We are happy to meet with you!</b></p>
							<p class="wow flipInX mt-3">Are you wondering if Harvest Green Montessori is right for your child? We would love to give you a tour around our school so that you can meet our certified and experienced staff. The tour will also help you to learn about Montessori philosophy and how we will help nurture your child.</p>
							<p class="wow flipInX mt-3">We are offering these tours while making sure to maintain social distancing guidelines. Tours will be available after business hours. To book a slot, please select a time. You will be asked for some details to confirm your appointment, and we will be in touch with you to coordinate details.</p>
							<div class="wel__btn" style="margin-bottom:30px;">
								<a href="<?= base_url(); ?>Schedule_a_tour" class="button color-1 d_flex">Schedule A Tour</a>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-5 col-sm-12 md-mt-40 sm-mt-40">
						<div class="jnr__Welcome__thumb wow fadeInRight">
							<img src="<?= base_url(); ?>assets/home/images/others/book.png" alt="<?= base_url(); ?>assets/home/images" class="video_border w-100">
							<a class="play__btn" href="https://www.youtube.com/watch?v=AHCybo_rhcY&t=7s"><i class="fa fa-play"></i></a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Welcame Area -->

		<section class="dcare__service__area py-80 pb-0">
			<div class="container">
				<div class="row">
					<!-- Start Single Service -->
					<div class="col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="service--3">
							<div class="service__thumb">
								<img src="<?= base_url(); ?>assets/home/images/others/1.png" alt="service images">
							</div>
							<div class="service__inner">
								<h4><a href="single-service.html">Learning & Fun</a></h4>
								<p>A balanced combination of learning and fun activities to engage the child constantly. A unique approach that keeps kids happy and builds their curiosity for learning.</p>
								<div class="service__btn">
									<a href="<?= base_url(); ?>Curriculum" class="button color-3">Details</a>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single Service -->
					<!-- Start Single Service -->
					<div class="col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="service--3">
							<div class="service__thumb">
								<img src="<?= base_url(); ?>assets/home/images/others/2.png" alt="service images">
							</div>
							<div class="service__inner">
								<h4><a href="single-service.html">Healthy Meal</a></h4>
								<p>A fresh and nutritious meal is offered daily for the children’s growing minds and bodies. Daily meals are packed with a balance of fruits and veggies.</p>
								<div class="service__btn">
									<a href="<?= base_url(); ?>Lunch" class="button color-3">Details</a>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single Service -->
					<!-- Start Single Service -->
					<div class="col-lg-4 col-md-4 col-sm-6 col-12">
						<div class="service--3">
							<div class="service__thumb">
								<img src="<?= base_url(); ?>assets/home/images/others/3.png" alt="service images">
							</div>
							<div class="service__inner">
								<h4><a href="single-service.html">Our Staff</a></h4>
								<p>Harvest Green Montessori brings experienced and passionate teachers with outstanding education qualifications and Montessori Knowledge.</p>
								<div class="service__btn">
									<a href="<?= base_url(); ?>Staff" class="button color-3">Details</a>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</section>

		<!-- Start our Class Area -->
		<section class="junior__classes__area section-lg-padding--top py-80 bg--white">
			<div class="container">
			<div class="shape-mockup movingX z-index-negative d-none d-xl-block style_animated_icon2"><img src="<?= base_url(); ?>assets/home/images/others/bee-2.png" alt="shapes"></div>
				<div class="row">
					<!-- Start Single Classes -->
					<div class="col-lg-4 col-sm-6">
						<div class="junior__classes bg-white radius">
							<div class="classes__thumb">
								<a href="class-details.html">
									<img src="<?= base_url(); ?>assets/home/images/others/home_about.png" alt="class images" class="radius">
								</a>
							</div>
							<div class="classes__inner">
								<div class="class__details">
									<h4><a href="class-details.html" class="f-36">About Us</a></h4>
									<div class="p-3 text-justify">
										<p>The Harvest Green Montessori (HGM) Team has a strong professional background with more than 20+ years of collective Montessori experience. The philosophy and methodology of Dr. Maria Montessori is the primary basis of establishing HGM. As Montessori Educators, we believe each child has potential that can be nurtured through a caring and systematic process.</p>
										<div class="class__btn mt-4">
											<a href="<?= base_url(); ?>About" class="button color-2">Details</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single Classes -->
					<!-- Start Single Classes -->
					<div class="col-lg-4 col-sm-6">
						<div class="junior__classes bg-white radius">
							<div class="classes__thumb">
								<a href="class-details.html">
									<img src="<?= base_url(); ?>assets/home/images/others/our_benifit.png" alt="class images" class="radius">
								</a>
							</div>
							<div class="classes__inner">
								<div class="class__details">
									<h4><a href="class-details.html" class="f-36">Our Benefits</a></h4>
									<ul class="class__time px-3 text-justify">
										<li><span class="fa fa-star text-primary"></span> Organized, fun, and safe environment</li>
										<li><span class="fa fa-star text-success"></span> Certified / experienced Montessori teachers</li>
										<li><span class="fa fa-star text-warning"></span> Montessori materials</li>
										<li><span class="fa fa-star text-danger"></span> Tested and proven learning methods</li>
										<li><span class="fa fa-star text-primary"></span> Indoor and outdoor playground</li>
										<li><span class="fa fa-star text-success"></span> Inspiration for life-long learning</li>
										<li><span class="fa fa-star text-warning"></span> Creative self-paced learning / Enrichment Program</li>
										<li><span class="fa fa-star text-danger"></span> Focused on hands-on learning</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single Classes -->
										<!-- Start Single Classes -->
										<div class="col-lg-4 col-sm-6">
						<div class="junior__classes bg-success radius">
							<div class="classes__inner">
								<div class="class__details">
									<h4 class="text-white mb-3">Working Hours</h4>
									<p class="text-white text-center mb-3">School will be operating from 6:30 AM - 6.30 PM</p>
									<h4 class="text-white mb-3">Monthly Events</h4>
										<div id="accordion" class="mb-4">
											<?php
												foreach($event as $row){ 
													echo '
												<div class="card m-2 radius">
													<div class="card-header clr-4 radius" id="headingOne">
														<h5 class="mb-0">
														<button class="btn btn-link text-white text-truncate" data-toggle="collapse" data-target="#'.$row->event_id.'" aria-expanded="true" aria-controls="collapseOne">
														'.date("F j",strtotime($row->event_start)).'<br>
														'.$row->event_name.'
														</button>
														</h5>
													</div>									  
													<div id="'.$row->event_id.'" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
														<div class="card-body">'.$row->event_desc.'</div>
													</div>
												</div>';
													}
												?>
									  	</div>
									<div class="class__btn">
										<a href="<?= base_url(); ?>Contact" class="button color-4">Contact Us</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single Classes -->
				</div>
			</div>
		</section>
		<!-- End our Class Area -->

		<!-- event show section -->
		<section class="jnr__call__to__action call__to__action--2 event-show mt-5 py-120 d-none d-lg-flex">
			<div class="container">
			<div class="shape-mockup movingX d-none d-sm-block style_animated_icon3"><img src="<?= base_url(); ?>assets/home/images/others/butterfly.png" alt="shapes"></div>
				<div class="row d-flex justify-content-center align-items-center">
					<div class="col-lg-8 msg">
						<div class="star-image"></div>
						<h2 class="f-36"><?= $event_daily[0]->event_name; ?></h2>
						<p><?= date("F d",strtotime($event_daily[0]->event_start)) ?></p>
						
					</div>
					<div class="col-lg-4">
						<img src="<?= img_url($event_daily[0]->event_path); ?>" alt="" class="w-100 event-img">
					</div>
				</div>
			</div>
		</section>
		<!-- event show section end -->


		<!-- Start our Class Area -->
		<section class="junior__classes__area py-60 bg--white">
		<div class="shape-mockup d-none d-sm-block style_animated_icon4"><img src="<?= base_url(); ?>assets/home/images/others/bush.png" alt="shapes"></div>
			<div class="container">				
				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12">
						<div class="section__title text-center">
							<h2 class="title__line">Our School</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- Start Single Classes -->
					<div class="col-lg-4 col-sm-6">
						<div class="junior__classes radius">
							<div class="classes__thumb">
								<a href="class-details.html">
									<img src="<?= base_url(); ?>assets/home/images/others/Saftey_first.png" alt="class images" class="radius_top">
								</a>
							</div>
							<div class="classes__inner">
								<div class="class__details">
									<h4><a href="class-details.html" class="text-dark">Safety First</a></h4>
									<div class="p-3">
										<p class="mb--30 h-110">Maintaining proper student-to-teacher ratios is an important characteristic at Harvest Green Montessori School to help give your child the care that is needed from their teachers.</p>
										<div class="class__btn mt-3">
											<a href="<?= base_url(); ?>Safety_first" class="button color-1">Know More</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single Classes -->
					<!-- Start Single Classes -->
					<div class="col-lg-4 col-sm-6">
						<div class="junior__classes radius">
							<div class="classes__thumb">
								<a href="class-details.html">
									<img src="<?= base_url(); ?>assets/home/images/others/Enrichment.png" alt="class images" class="radius_top">
								</a>
							</div>
							<div class="classes__inner">
								<div class="class__details">
									<h4><a href="class-details.html" class="text-dark">Enrichment</a></h4>
									<div class="p-3">
										<p class="mb--30 h-110">Besides educating your child using the Montessori Method, we strive to promote an all-rounded development for each child…</p>
										<div class="class__btn mt-3">
											<a href="<?= base_url(); ?>program/enrichment" class="button color-1">Know More</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single Classes -->
					<!-- Start Single Classes -->
					<div class="col-lg-4 col-sm-6">
						<div class="junior__classes radius">
							<div class="classes__thumb">
								<a href="class-details.html">
									<img src="<?= base_url(); ?>assets/home/images/others/Before&After.png" alt="class images" class="radius_top">
								</a>
							</div>
							<div class="classes__inner">
								<div class="class__details">
									<h4><a href="<?= base_url(); ?>program/school-age" class="text-dark">School Age</a></h4>
									<div class="p-3">
										<p class="mb--30 h-110">Our After-School educational program offers a safe, enriching, and exciting environment for children ages 5-12 years...</p>
										<div class="class__btn mt-3">
											<a href="<?= base_url(); ?>program/school-age" class="button color-1">Know More</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single Classes -->
				</div>
			</div>
		</section>
		<!-- End our Class Area -->

		<!-- our program section start  -->
		<section class="our_program">
			<div class="cart-main-area py-40">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-lg-12 col-sm-12">
							<div class="section__title text-center">
								<h2 class="title__line text-white">Our Programs</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ol-lg-12">
							<div class="table-content table-responsive radius" style="border: 1px solid;">
								<table>
									<thead>
										<tr class="title-top">
											<th class="product-thumbnail">Infant</th>
											<th class="product-name">Toddler/<br>Transition</th>
											<th class="product-price">Primary</th>
											<th class="product-quantity">Kindergarten/<br>First grade</th>
											<th class="product-subtotal">School Age</th>
											<th class="product-subtotal">Summer Camp</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="product-subtotal clr-1">Full Day<br>6:30 am – 6:30 pm</td>
											<td class="product-subtotal clr-2">Full Day<br>6:30 am – 6:30 pm</td>
											<td class="product-subtotal clr-3">Full Day<br>6:30 am – 6:30 pm</td>
											<td class="product-subtotal clr-4">Full Day<br>6:30 am – 6:30 pm</td>
											<td class="product-subtotal clr-1">Before School<br>6:30 am – 7:30 am</td>
											<td class="product-subtotal clr-2">Full Day<br>6:30am - 6:30pm</td>
										</tr>
										
										<tr>
											<td class="product-subtotal clr-4"></td>
											<td class="product-subtotal clr-1">School Day<br>	8:30 am – 3:00 pm</td>
											<td class="product-subtotal clr-2">School Day<br>	8:30 am – 3:00 pm</td>
											<td class="product-subtotal clr-3">School Day<br>	8:30 am – 3:00 pm</td>
											<td class="product-subtotal clr-4">After School<br>3:30pm - 6:30pm</td>
											<td class="product-subtotal clr-1">School Day<br>8:30am - 3:00pm</td>
										</tr>
										<tr>
											<td class="product-subtotal clr-1"></td>
											<td class="product-subtotal clr-4">Half Day<br>8:30 am – 12:00 pm</td>
											<td class="product-subtotal clr-1">Half Day<br>8:30 am – 12:00 pm</td>
											<td class="product-subtotal clr-2"></td>
											<td class="product-subtotal clr-3"></td>
											<td class="product-subtotal clr-4"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<div class="shapePulse rotate z-index-negative" style="top: 19%; right: 21%;width:11%;"><img src="<?= base_url(); ?>assets/home/images/others/flower.png" alt="shapes"></div>
				</div>  
			</div>
		</section>
		<!-- our program section end  -->

		<section class="dcare__shop__grid  py-40 bg--white">
        	<div class="container-fluid">
        		<div class="row">
        			<!-- Shop Grid -->
        			<div class="col-lg-12">
        				<div class="row shop-grid-page">
							<!-- Start Single Product -->
							<div class="col-lg-3 col-md-6 col-sm-6 col-12">
								<div class="product--2 product__grid radius clr-1">
									<div class="product__imges m-3">
										<a href="<?= base_url(); ?>program/infant">
											<img src="<?= base_url(); ?>assets/home/images/others/Infant_home.png" alt="product images" class="radius mt-3">
										</a>
									</div>
									<div class="product__inner">
										<div class="pro__title">
											<h2><a href="<?= base_url(); ?>program/infant" style="color:#fff;">Infant</a></h2>
											<b style="font-size: 16px; color:#fff;">"FIRST STEPS TO A BRIGHT FUTURE"</b>
										</div>
										<div class="pro__prize px-2">
											<p class="text-white infant">At HGM, we make every day a wonderful adventure & encourage the infants to explore the world around them. We provide a safe and trusting environment that will allow the child to develop a bond with the teacher.</p>
										</div>
									</div>
								</div>
							</div>
							<!-- End Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-3 col-md-6 col-sm-6 col-12">
								<div class="product--2 product__grid radius clr-3">
									<div class="product__imges m-3">
										<a href="<?= base_url(); ?>program/toddler">
											<img src="<?= base_url(); ?>assets/home/images/others/toddler.png" alt="product images" class="radius mt-3">
										</a>
									</div>
									<div class="product__inner">
										<div class="pro__title">
											<h2><a href="<?= base_url(); ?>program/toddler" style="color:#fff;">Toddler</a></h2>
											<b style="font-size: 16px; color:#fff;">"FIRST STEPS TOWARDS INDEPENDENCE"</b>
										</div>
										<div class="pro__prize px-2">
											<p class="text-white toddler">The program is designed to take advantage of the toddler's natural drive to act independently. HGM advances each child's growth and development through a rich and well-prepared environment made just for toddlers.</p>
										</div>
									</div>
								</div>
							</div>
							<!-- End Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-3 col-md-6 col-sm-6 col-12">
								<div class="product--2 product__grid radius clr-2">
									<div class="product__imges m-3">
										<a href="<?= base_url(); ?>program/primary">
											<img src="<?= base_url(); ?>assets/home/images/others/Primary.png" alt="product images" class="radius mt-3">
										</a>
									</div>
									<div class="product__inner">
										<div class="pro__title">
											<h2><a href="<?= base_url(); ?>program/primary" style="color:#fff;">Primary</a></h2>
											<b style="font-size: 16px; color:#fff;">"DEVELOP SOCIAL BEHAVIOR"</b>
										</div>
										<div class="pro__prize px-2">
											<p class="text-white primary">At HGM, we recognize this as the beginning of control and coordination of mind and body. In the process, children acquire language (s), develop motor and cognitive skills, copy the social skills of the adults around them and acquire expectations about how the world will treat them.</p>
										</div>
									</div>
								</div>
							</div>
							<!-- End Single Product -->
							<!-- Start Single Product -->
							<div class="col-lg-3 col-md-6 col-sm-6 col-12">
								<div class="product--2 product__grid radius clr-5">
									<div class="product__imges m-3">
										<a href="<?= base_url(); ?>program/summer-camp">
											<img src="<?= base_url(); ?>assets/home/images/others/after_care.png" alt="product images" class="radius mt-3">
										</a>
									</div>
									<div class="product__inner">
										<div class="pro__title">
											<h2><a href="<?= base_url(); ?>program/summer-camp" style="color:#fff;">Summer Camp</a></h2>
											<b style="font-size: 16px; color:#fff;">"DEVELOP TEAM BUILDING"</b>
										</div>
										<div class="pro__prize px-2">
											<p class="text-white summer_camp">At our Montessori summer camp, children aged 5-12 embark on a vibrant adventure blending learning and play. Nature exploration, arts and crafts, and collaborative projects foster creativity and teamwork. Engaging activities, guided by experienced educators, ensure a connected experience, nurturing curiosity, independence, and a love for lifelong learning in a joyful environment.</p>
										</div>
									</div>
								</div>
							</div>
							<!-- End Single Product -->
        				</div>
        			</div>
        			<!-- End Shop Grid -->
        		</div>
        	</div>
        </section>

	    	<!-- Start Our Gallery Area -->
<section>
	<div class="junior__gallery__area photo_gallery gallery-page-one gallery__masonry__activation gallery--3 py-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-md-12">
					<div class="section__title text-center">
						<h2 class="title__line text-white">Photo Gallery</h2>
					</div>
				</div>
			</div>
			<div class="row galler__wrap masonry__wrap mt--40 h-400px">
				<!-- Start Single Gallery -->
				<?php
				foreach($gallery_image as $row){
					echo '
				<div class="col-lg-3 col-md-4 col-sm-6 col-6 gallery__item '.$row->img_sub.'">
					<div class="gallery p-1">
						<div class="gallery__thumb">
							<a href="#">
								<img src="'.img_url($row->img_path).'" alt="gallery images" class="img-thumbnail">
							</a>
						</div>
						<div class="gallery__hover__inner"> 
							<div class="gallery__hover__action">
								<ul class="gallery__zoom">
									<li><a href="'.img_url($row->img_path).'" data-lightbox="grportimg" data-title="'.$row->img_desc.'"><i class="fa fa-crosshairs"></i></a></li>
								</ul>
								<h4 class="gallery__title"><a href="#">'.$row->img_title.'</a></h4>
							</div>
						</div>
					</div>	
				</div>';
			}
		?>	
				<!-- End Single Gallery -->
			</div>	
		</div>
		<div class="class__btn mt-5 text-center">
			<a href="<?= base_url(); ?>Gallery" class="button color-4">View More</a>
		</div>
	</div>
</section>
	<!-- End Our Gallery Area -->
	<!-- Start Testimonial Area -->
	<section class="junior__testimonial__area bg-image--2 py-60">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h2 class="text-white">Testimonials</h2>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="testimonial__container">
						<div class="tes__activation--1 owl-carousel owl-theme">
							<?php
							$firstItem = true; // Flag to track the first item 

							foreach ($testimonial as $row) {
								$activeClass = ($firstItem) ? 'active' : ''; // Add 'active' class to the first item

								// Check if video path is available
								$videoIcon = '';
								if (!empty($row->t_path_two)) {
									$videoIcon = '<a class="video" href="'.img_url($row->t_path_two).'" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-play"></i></a>';
								}

								echo '
								<div class="testimonial__bg ' . $activeClass . '">
									<!-- Start Single Testimonial -->
									<div class="testimonial text-center testi_border">
										<div class="testimonial__inner">
<div class="test__icon" style="  background-image: url('.img_url($row->t_path).');
											background-repeat: no-repeat;
											background-size: cover;
											background-position: center center;
											border-radius:50%;
											border:4px solid #ffffff7d;">
												
											</div>
											<div class="client__details">
												<p class="lead demo-3">'.$row->t_msg.'</p>
												<div class="client__info">
													<h5>'.$row->t_name.'</h5>
													<span>'.$row->t_design.'</span>
												</div>
												<div>
													<span class="fa fa-star text-warning"></span>
													<span class="fa fa-star text-warning"></span>
													<span class="fa fa-star text-warning"></span>
													<span class="fa fa-star text-warning"></span>
													<span class="fa fa-star text-warning"></span>
												</div>
												'.$videoIcon.'
											</div>
										</div>
									</div>
									<!-- End Single Testimonial -->
								</div>
								';

								$firstItem = false; // Reset the flag for subsequent items
							}
							?>
						</div>
						<?php 
						foreach ($testimonial as $row) {
							// Check if video path is available before showing the modal
							if (!empty($row->t_path_two)) {
								echo'
								<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<video width="100%" controls>
											<source src="'.img_url($row->t_path_two).'">
											</video>
										</div>
									</div>
								</div>';
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Testimonial Area -->



		
<?php $this->load->view('common/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    window.addEventListener("load", (event) => {
        Swal.fire({
            title: "<?= $popup[0]->popup_name ?>",
            showCloseButton: true,
            imageWidth: 400,
            imageAlt: "Custom image",
            html: `
                <div>
                    <?= $popup[0]->popup_desc ?><br>
                </div>
            `,
            footer: `
                <a href="<?= base_url(); ?>Schedule_a_tour" class="button color-1 d_flex">Schedule A Tour</a>
            `
        });
    });
</script>




<script>
	const close = document.querySelector('.modal-dialog');
	document.querySelectorAll('.carousel-item .video').forEach(vid => {
		vid.onclick = () =>{
			document.querySelector('.modal .modal-content video').src = vid.getAttribute('href');
		}
	});
		$('.modal').on('hidden.bs.modal', function () {
		$('.modal .modal-content video').attr({
		src: '', 
		});
	});
</script>