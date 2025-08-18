<?php $this->load->view('common/header'); ?>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area">
            <div class="ht__bradcaump__container py-60">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 text-center">
							<h1>Parent Testimonial</h1>
							<nav class="bradcaump-inner">
								<a class="breadcrumb-item" href="index.html">Home</a>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active">About Us</span>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active">Parent Testimonial</span>
							  </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->

			<!-- Start Testimonial Area -->
	<section class="junior__testimonial__area bg-image--2 py-60" style="margin-top:-10px;">
		<div class="container">
			<div class="row">
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
									$videoIcon = '<a class="video parent_vid_icon" href="'.$row->t_path_two.'" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-play"></i></a>';
								}

								echo '
								<div class="testimonial__bg testi_border mx-3 ' . $activeClass . '">
									<!-- Start Single Testimonial -->
									<span>'.$row->t_design.'</span>
									<p class="mt-3">'.$row->t_msg.'</p><br>
									<div>
										<span class="fa fa-star text-warning"></span>
										<span class="fa fa-star text-warning"></span>
										<span class="fa fa-star text-warning"></span>
										<span class="fa fa-star text-warning"></span>
										<span class="fa fa-star text-warning"></span>
									</div>
									'.$videoIcon.'
									<h4><a href="#" onclick="return false;">-'.$row->t_name.'</a></h4>
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
												<source src="'.$row->t_path_two.'">
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
