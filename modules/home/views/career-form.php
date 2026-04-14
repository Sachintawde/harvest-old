<?php $this->load->view('common/header'); ?>

        <!-- Start Bradcaump area -->

        <div class="ht__bradcaump__area">

            <div class="ht__bradcaump__container py-60">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-lg-12 text-center">

							<h1>Career form</h1>

							<nav class="bradcaump-inner">

								<a class="breadcrumb-item" href="index.html">Home</a>

								<span class="brd-separetor">/</span>

								<span class="breadcrumb-item active">Our Program</span>

								<span class="brd-separetor">/</span>

								<span class="breadcrumb-item active">Career form</span>

							  </nav>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- End Bradcaump area -->

        <!-- Start parent testimonial -->

        <section class="jnr__blog_area contact__box py-40">

			<div class="container">

                <div class="row">

					<div class="col-lg-12 col-sm-12 col-md-12">

						<div class="section__title text-center blockquote">

							<h4 class="title__line mb-3">Opening For Montessori Toddler and Primary Lead Teachers</h4>

						</div>

					</div>

				</div>

                <div class="row mt-5">

					<div class="col-lg-7 col-md-12">

						<p class="my-3">Harvest Green Montessori located in Richmond (near Sugar Land, Texas) is looking for an experienced Montessori Toddler and Primary teachers.<br> Job Type: Full-time</p>

                        <h4>Requirements: </h4>

                        <p class="my-3"><span class="fa fa-star text-danger"></span> Must have Associate degree or Higher Education in Early Childhood, Child care Administration or similar</p>

                        <p class="my-3"><span class="fa fa-star text-success"></span> 2 years of Montessori experience as a lead teacher.</p>

                        <p class="my-3"><span class="fa fa-star text-primary"></span> Montessori certification AMS/AMI.</p>

                        <p class="my-3"><span class="fa fa-star text-warning"></span> Must be able to sit on the floor and lift minimum of 35 pounds.</p>

                        <p class="my-3"><span class="fa fa-star text-danger"></span> Should have current CPR / First Aid training completed.</p>

                        <p class="my-3"><span class="fa fa-star text-success"></span> 24 hours Pre-Service Training.</p>

                        <p class="my-3"><span class="fa fa-star text-primary"></span> Understanding of Texas Minimum Standards</p>

                        <h4>Job responsibilities as described below, but is not limited to</h4>

                        <p class="my-3"><span class="fa fa-star text-danger"></span>Ability to teach in a manner consistent with Montessori philosophy and goals, and plan activities that will encourage each child’s growth in the areas of emotional, social, cognitive, and physical development.</p>

                        <p class="my-3"><span class="fa fa-star text-success"></span>Maintaining a weekly parent newsletter and daily reporting /logs.</p>

                        <p class="my-3"><span class="fa fa-star text-primary"></span>Being aware and executing Montessori lessons in chronological order, delivering lessons with the aim of promoting coordination, concentration and independence.</p>

                        <p class="my-3"><span class="fa fa-star text-warning"></span>Plan and conduct parent teacher conferences maintain child development records.</p>

                        <p class="my-3"><span class="fa fa-star text-danger"></span>Must attend all staff meetings and programs sponsored by the school.</p>

                        <p class="my-3"><span class="fa fa-star text-success"></span>Responsible and maintain safe learning environment in the class.</p>

                        <p class="my-3"><span class="fa fa-star text-primary"></span>Maintaining strict confidentiality regarding children and their families.</p>

                        <p class="my-3"><span class="fa fa-star text-warning"></span>Share information and materials appropriately with other Center staff members and maintain the records that are required by center policy.</p>

                        <p class="my-3"><span class="fa fa-star text-danger"></span>Maintain proper staff child ratio at all times.</p>

                        <p class="my-3">Interested applicants should email their cover letter, resume, salary expectations, and references. Background clearance required.</p>

					</div>

        			<div class="col-lg-5">

						<h2 class="text-center">APPLICATION FOR CAREER</h2>

    					<div class="contact-form-wrap mt-3 custom_form">

                        <?php         

                            if($this->session->flashdata('post_data')){

                                $post_data = $this->session->flashdata('post_data');

                            }                  

                            if($this->session->flashdata('msg')){

                            echo '<div class="msg text-center">

                                <div class="alert alert-'.$this->session->flashdata('class').' alert-dismissible fade show" role="alert">

                                    <h3>'.$this->session->flashdata('head').'!</h3> '.$this->session->flashdata('msg').'.

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                        <span aria-hidden="true">&times;</span>

                                    </button>

                                </div>

                            </div>';

                            // $this->session->unset_flashdata('msg','head','class');

                        }

                            ?>

                        <!-- Career Form -->

                            <form action="<?= base_url() ?>Career_form/add_career" method="post" enctype="multipart/form-data">

                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label for="e_name">First Name<span class="label">*</span></label>

                                        <input type="text" name="e_name" id="e_name" class="form-control" placeholder="First Name*" value="<?= isset($post_data['e_name']) ? $post_data['e_name'] : '' ?>" required>

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label for="e_lname">Last Name<span class="label">*</span></label>

                                        <input type="text" name="e_lname" id="e_lname" class="form-control" placeholder="Last Name*" value="<?= isset($post_data['e_lname']) ? $post_data['e_lname'] : '' ?>" required>

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label for="e_mail">Email<span class="label">*</span></label>

                                        <input type="email" name="e_mail" id="e_mail" class="form-control" placeholder="Email*" value="<?= isset($post_data['e_mail']) ? $post_data['e_mail'] : '' ?>" required>

                                    </div>

                                     <div class="form-group col-md-6">

                                        <label for="e_mob">Phone<span class="label">*</span></label>

                                        <input type="number" name="e_mob" id="e_mob" class="form-control" placeholder="Phone*" value="<?= isset($post_data['e_mob']) ? $post_data['e_mob'] : '' ?>" required pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/g, '');">

                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-12">

                                        <label for="e_prog">Position To Apply<span class="label">*</span></label>

                                        <select class="form-control" name="e_prog" id="e_prog">

                                            <?php

                                            if (isset($post_data['e_prog'])) {

                                                echo '<option value="' . $post_data['e_prog'] . '" selected>' . $post_data['e_prog'] . '</option>';

                                            } else {

                                                echo '<option disabled selected>Position To Apply</option>';

                                            }

                                            ?>

                                            <option value="Infant">Infant Teacher</option>

                                            <option value="Toddler">Toddler Teacher</option>

                                            <option value="Toddler">School Age Teacher</option>

                                            <option value="Primary_Teacher">Primary Teacher</option>

                                            <option value="Assistant_Teacher">Assistant Teacher</option>

                                            <option value="Toddler">Floater</option>

                                            <option value="Toddler">Substitute</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group col-md-12">

                                    <label for="e_addrs">Address<span class="label">*</span></label>

                                    <textarea name="e_addrs" class="form-control" placeholder="Address" required><?= isset($post_data['e_addrs']) ? $post_data['e_addrs'] : '' ?></textarea>

                                </div>

                                <div class="form-group col-md-12">

                                    <label for="e_msg">Message</label>

                                    <textarea name="e_msg" class="form-control" placeholder="Message" required><?= isset($post_data['e_msg']) ? $post_data['e_msg'] : '' ?></textarea>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-12">

                                        <label for="e_resume">Resume (PDF or Word document)<span class="label">*</span></label>

                                        <input type="file" name="e_resume" id="e_resume" class="form-control" required>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="g-recaptcha" data-sitekey="<?= getenv('RECAPTCHA_SITE_KEY_CAREER') ?>"></div>

                                </div>

                                <button type="submit" class="button color-2">Submit</button>

                            </form>

                        </div> 

                        <div class="form-output">

                            <p class="form-messege"></p>

                        </div>

        			</div>

				</div>

			</div>

		</section>

        <!-- End parent testimonial -->

<?php $this->load->view('common/footer'); ?>

