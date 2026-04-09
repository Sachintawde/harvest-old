<?php $this->load->view('common/header'); ?>
		<!-- Start Bradcaump area -->
		<div class="ht__bradcaump__area">
			<div class="ht__bradcaump__container py-60">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 text-center">
							<h1>Blog</h1>
							<nav class="bradcaump-inner">
								<a class="breadcrumb-item" href="index.html">Home</a>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active">Resources</span>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active">Blog</span>
								</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Bradcaump area -->
		<!-- Start Blog Area -->
		<section class="dcare__blog__area py-80 bg--white">
			<div class="container">
				<div class="row blog-page"> 
					<!-- Start Single Blog -->
					<?php
                foreach($blog as $row){ 
                    echo '
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="blog__2 radius_two">
							<div class="blog__thumb">
								<a href="'.base_url().'blog/details/'.strtolower(str_replace(" ","_",$row->blog_name)).'">
									<img src="'.img_url($row->blog_path).'" alt="blog images">
								</a>
							</div>
							<div class="blog__inner">
								<div class="blog__hover__inner lim-text">
									<h2><a href="'.base_url().'blog/details/'.strtolower(str_replace(" ","_",$row->blog_name)).'">'.$row->blog_name.'</a></h2>
									<div class="bl__meta">
										<p>'.$row->blog_datee.'</p>
									</div>
									<div class="bl__details lim-text">
										<p>'.$row->blog_desc.'</p>
									</div>
									<div class="blog__btn">
										<a class="bl__btn" href="'.base_url().'blog/details/'.strtolower(str_replace(" ","_",$row->blog_name)).'">Read More</a>
									</div>
								</div>
							</div>
						</div>
					</div>';
				}
			?>
				</div>
			</div>
		</section>
		<!-- End Blog Area -->
<?php $this->load->view('common/footer'); ?>

