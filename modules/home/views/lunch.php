<?php $this->load->view('common/header'); ?>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area">
	<div class="ht__bradcaump__container py-60">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h1>Lunch</h1>
					<nav class="bradcaump-inner">
						<a class="breadcrumb-item" href="index.html">Home</a>
						<span class="brd-separetor">/</span>
						<span class="breadcrumb-item active">Resources</span>
						<span class="brd-separetor">/</span>
						<span class="breadcrumb-item active">Lunch</span>
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
				<img src="<?= base_url(); ?>assets/home/images/others/Lunch.png" alt="about" class="img-fluid img-thumbnail radius_two">
			</div>
			<div class="col-lg-7">
				<h2>Breakfast and Snacks</h2>
				<p class="my-3">Snacks are offered daily while children are in attendance and included in the tuition. Breakfast is included and offered for Extended care only.</p>
				<h2>Lunch Program</h2>
				<ul class="ml-3">
					<li style="list-style: disc;" class="my-3">Catered Lunch (Monthly Basis) - HGM offers catered lunches Monday through Friday for parents who would like a hot vegetarian or non-vegetarian meal for their child. Parents may sign up for any or all lunches on The Simply Fresh Kitchen website by clicking on their link <a href="https://www.thesimplyfreshkitchen.com/" class="text-primary" target="_blank">TheSimplyFreshKitchen</a></li>
					<li style="list-style: disc;" class="my-3">Lunch from Home - Children are welcome to bring their lunch from home in a lunch box. We are nut free school.</li>
					<li style="list-style: disc;" class="my-3">Combination - Parents have the option of using our catering service occasionally as well as sending lunches from home on the other days. Parents will still have to fill out the monthly signup sheet.</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!-- End Class Details -->
<!-- animation section  -->
<section class="home-content" style="background-color: #ffc000;padding-top: 30px">
	<marquee behavior="" direction="" >
	<img src="<?= base_url(); ?>assets/home/images/others/bus.png" >
</marquee>
</section>
<!-- ---------End Home gallery------- -->
<?php $this->load->view('common/footer'); ?>
