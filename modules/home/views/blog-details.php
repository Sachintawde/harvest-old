<?php $this->load->view('common/header'); ?>
		<!-- Start Bradcaump area -->
		<div class="ht__bradcaump__area">
			<div class="ht__bradcaump__container py-60">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 text-center">
							<h1><?= $blog['blog_name'] ?></h1>
							<nav class="bradcaump-inner">
								<a class="breadcrumb-item" href="index.html">Home</a>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active">Resources</span>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active"><?= $blog['blog_name'] ?></span>
								</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Bradcaump area -->
        <!-- Start Blog Grid Area -->
        <div class="dcare__blog__list bg--white py-80">
        	<div class="container">
        		<div class="row">
        			<!-- Start BLog Details -->
        			<div class="col-lg-9">
        				<div class="page__blog__details">
        					<article class="dacre__blog__details">
        						<div class="blog__thumb">
        							<img src="<?= img_url($blog['blog_path']) ?>" alt="blog images">
        						</div>
        						<div class="blog__inner">
        							<h2><?= $blog['blog_name'] ?></h2>
        							<ul>
        								<li><?= $blog['blog_datee'] ?></li>
        							</ul>

        							<p><?= $blog['blog_desc'] ?></p>
        						</div>
        					</article>
        				</div>
        			</div>
        			<!-- End BLog Details -->
        			<!-- Start Sidebar -->
        			<div class="col-lg-3">
        				<div class="sidebar__widgets sidebar--right">
        					<!-- Single Widget -->
        					<div class="single__widget recent__post">
        						<h4>Recent Blog</h4>
								<ul>
								<?php
                                foreach($latest as $row){ 
                                    echo '
									<li>
									<a href="'.base_url().'blog/details/'.strtolower(str_replace(" ","_",$row->blog_name)).'"><img src="'.img_url($row->blog_path).'" alt="blog images"></a>
										<div class="post__content">
											<h6><a href="'.base_url().'blog/details/'.strtolower(str_replace(" ","_",$row->blog_name)).'">'.$row->blog_name.'</a></h6>
											<span class="date"><i class="fa fa-calendar"></i>'.$row->blog_datee.'</span>
										</div>
									</li>';
                                }
                            ?>
								</ul>
        					</div>
        					<!-- End Widget -->
        				</div>
        			</div>
        			<!-- End Sidebar -->
        		</div>
        	</div>
        </div>
        <!-- End Blog Grid Area -->        
<?php $this->load->view('common/footer'); ?>
