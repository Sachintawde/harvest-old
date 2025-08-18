<?php $this->load->view('common/header'); ?>

    <!-- Start Status area -->
    <div class="notika-status-area">
        <div class="container">
            <div class="row">                
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                        <h2><span class="counter"><?= $this->db->get('blog',['blog_status'=>'1'])->num_rows();?></span></h2>
                            <p>Blog</p>
                        </div> 
                        <div class="sparkline-bar-stats3">4,2,8,2,5,6,3,8,3,5,9,5</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                        <h2><span class="counter"><?= $this->db->get('contact')->num_rows();?></span></h2>
                            <p>Messages</p>
                        </div> 
                        <div class="sparkline-bar-stats3">4,2,8,2,5,6,3,8,3,5,9,5</div>
                    </div>
                </div>                
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                        <h2><span class="counter"><?= $this->db->get('career')->num_rows();?></span></h2>
                            <p>Career</p>
                        </div> 
                        <div class="sparkline-bar-stats3">4,2,8,2,5,6,3,8,3,5,9,5</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"><?= $this->db->get_where('event',['event_status'=>'1'])->num_rows();?></span></h2>
                            <p>Event</p>
                        </div>
                        <div class="sparkline-bar-stats1">9,4,8,6,5,6,4,8,3,5,9,5</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                        <h2><span class="counter"><?= $this->db->get_where('tour')->num_rows();?></span></h2>
                            <p>Schedule A Tour</p>
                        </div>
                        <div class="sparkline-bar-stats2">1,4,8,3,5,6,4,8,3,3,9,5</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <?php
                                // Read the current value of our counter file
                                $counter_name = APPPATH."logs/counter.txt";
                                $f = fopen($counter_name,"r");
                                $counterVal = fread($f, filesize($counter_name));
                                fclose($f);
                            ?>
                            <h2><span class="counter"><?= $counterVal ?></span></h2>
                            <p>Total Visitors</p>
                        </div>
                        <div class="sparkline-bar-stats4">2,4,8,4,5,7,4,7,3,5,7,5</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Status area-->


<?php $this->load->view('common/footer'); ?>

<script type="text/javascript">
	$(function () {
		// top bar active
		$('.navDashboard').addClass('active');
	});
</script>
