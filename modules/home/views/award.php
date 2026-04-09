<?php $this->load->view('common/header'); ?>

        <!-- Start Bradcaump area -->

        <div class="ht__bradcaump__area">

            <div class="ht__bradcaump__container py-60">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-lg-12 text-center">

							<h1>Awards</h1>

							<nav class="bradcaump-inner">

								<a class="breadcrumb-item" href="index.html">Home</a>

								<span class="brd-separetor">/</span>

								<span class="breadcrumb-item active">Resources</span>

								<span class="brd-separetor">/</span>

								<span class="breadcrumb-item active">Awards</span>

							  </nav>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- End Bradcaump area -->



		<!-- Start Our Gallery Area -->

		<div class="junior__gallery__area gallery-page-one gallery__masonry__activation gallery--3">

			<div class="container">

				<div class="row galler__wrap masonry__wrap">

					<!-- Start Single Gallery -->

					<?php

					foreach($gallery as $row){

						echo'

					<div class="col-lg-3 col-md-4 col-sm-6 col-6 gallery__item '.$row->img_sub.'">

						<div class="gallery p-1">

							<div class="gallery__thumb">

								<a href="#">

									<img src="'.img_url($row->img_path).'" alt="gallery images">

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

				</div>	

			</div>

		</div>

		<!-- End Our Gallery Area -->

<?php $this->load->view('common/footer'); ?>