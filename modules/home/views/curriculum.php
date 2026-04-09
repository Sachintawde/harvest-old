<?php $this->load->view('common/header'); ?>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area">
            <div class="ht__bradcaump__container py-60">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 text-center">
							<h1>Curriculum</h1>
							<nav class="bradcaump-inner">
								<a class="breadcrumb-item" href="index.html">Home</a>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active">About Us</span>
								<span class="brd-separetor">/</span>
								<span class="breadcrumb-item active">Curriculum</span>
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
					<div class="col-lg-4">
						<img src="<?= base_url(); ?>assets/home/images/others/curriculum.png" alt="about" class="img-fluid radius_two">
					</div>
					<div class="col-lg-8 d_flex">
						<h2 class="f-36">Curriculum Program</h2>
						<p class="my-3">The Montessori Curriculum is an innovative learning framework that incorporates specific learning outcomes and knowledge skills that align with children’s developmental needs and interests. There are five main areas of learning: practical life, sensorial, mathematics, language, and culture. As children progress through the Montessori curriculum, they encounter more challenging learning materials that are appropriate to both their age and skill levels. In this way, the Montessori Curriculum emphasizes learning as a process that cannot be determined through a child’s age.</p>
					</div>
				</div>
				<?php
                    $i = 0;
                    foreach($curriculum as $row){
                        $class="";
                        if($i%2 != 0){
							echo '
							<div class="row d_flex mt-4 px-40 py-3" style="background-color: #f8f8fc; border-radius: 15px;">
								<div class="col-lg-10">
									<h2 class="f-24">'.$row->c_title.'</h2>
									<p class="my-3">'.$row->c_desc.'</p>
								</div>
								<div class="col-lg-2">
									<img src="'.img_url($row->c_path).'" alt="about" class="rounded-circle">
								</div>
							</div>';
                        }
						else{
							echo '
							<div class="row d_flex mt-4 px-40 py-3" style="background-color: #f8f8fc; border-radius: 15px;">
								<div class="col-lg-2">
									<img src="'.img_url($row->c_path).'" alt="about" class="rounded-circle">
								</div>
								<div class="col-lg-10">
									<h2 class="f-24">'.$row->c_title.'</h2>
									<p class="my-3">'.$row->c_desc.'</p>
								</div>
							</div>';
							
						}                      
							$i++;
						
								}
						?>
				<div class="row mt-5 px-40 py-3 cutom_width">
					<div class="col-lg-3 my-3">
                        <a href="<?= base_url(); ?>Enroll" class="button color-3">Enroll Now</a>
					</div>
					<div class="col-lg-3 my-3">
						<a href="<?= base_url(); ?>Schedule_a_tour" class="button color-1">Schedule A Tour</a>                    
					</div>
					<div class="col-lg-3 my-3">
						<a href="<?= base_url(); ?>contact" class="button color-2">Contact Us</a>
					</div>
					<div class="col-lg-3 my-3">
						<a href="<?= base_url(); ?>About" class="button color-4">Know More About Us</a>
					</div>
				</div>
        	</div>
        </section>
        <!-- End Class Details -->
<?php $this->load->view('common/footer'); ?>
