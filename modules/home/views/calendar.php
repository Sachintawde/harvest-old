<?php $this->load->view('common/header'); ?>

    <!-- calendar css  -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/home/css/calendar.css">



<!-- Start Bradcaump area -->

<div class="ht__bradcaump__area">

    <div class="ht__bradcaump__container py-60">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12 text-center">

      <h1>Calendar</h1>

      <nav class="bradcaump-inner">

        <a class="breadcrumb-item" href="index.html">Home</a>

        <span class="brd-separetor">/</span>

        <span class="breadcrumb-item active">Resources</span>

        <span class="brd-separetor">/</span>

        <span class="breadcrumb-item active">Calendar</span>

        </nav>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- End Bradcaump area -->



<section class="tf-section calendar my-5">

    <div class="container">

        <div class="row">

            <div class="col-12">

              <div class="card">

                <div class="card-body p-0">

                  <div id="calendar"></div>

                </div>

              </div>

                    <!-- calendar modal -->

              <div id="modal-view-event" class="modal modal-top fade calendar-modal">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                      <div class="modal-header">

                      <h4 class="modal-title"><span class="event-title"></span></h4>



                      </div>

                        <div class="modal-body"> 

                            <div class="event-body"></div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                        </div>

                    </div>

                </div>

              </div>

              <div id="modal-view-event-add" class="modal modal-top fade calendar-modal">

                <div class="modal-dialog modal-dialog-centered">

                  <div class="modal-content">

                    <form id="add-event">

                      <div class="modal-body">

                      <h4>Add Event Detail</h4>        

                        <div class="form-group">

                          <label>Event name</label>

                          <input type="text" class="form-control" name="ename">

                        </div>

                        <div class="form-group">

                          <label>Event Date</label>

                          <input type='text' class="datetimepicker form-control" name="edate">

                        </div>        

                        <div class="form-group">

                          <label>Event Description</label>

                          <textarea class="form-control" name="edesc"></textarea>

                        </div>

                        <div class="form-group">

                          <label>Event Color</label>

                          <select class="form-control" name="ecolor">

                            <option value="fc-bg-default">fc-bg-default</option>

                            <option value="fc-bg-blue">fc-bg-blue</option>

                            <option value="fc-bg-lightgreen">fc-bg-lightgreen</option>

                            <option value="fc-bg-pinkred">fc-bg-pinkred</option>

                            <option value="fc-bg-deepskyblue">fc-bg-deepskyblue</option>

                          </select>

                        </div>

                        <div class="form-group">

                          <label>Event Icon</label>

                          <select class="form-control" name="eicon">

                            <option value="circle">circle</option>

                            <option value="cog">cog</option>

                            <option value="group">group</option>

                            <option value="suitcase">suitcase</option>

                            <option value="calendar">calendar</option>

                          </select>

                        </div>        

                    </div>

                      <div class="modal-footer">

                      <button type="submit" class="btn btn-primary" >Save</button>

                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>        

                    </div>

                    </form>

                  </div>

                </div>

              </div>

            </div>

        </div>

    </div>

</section>

<section class="my-5">

  <div class="container">    

    <div class="row">

      <div class="col-lg-12 text-center">

        <a href="<?= base_url(); ?>assets/home/images/others/Calendar 2024-2025.pdf" target="_blank" class="button color-1">Yearly Calendar</a>

      </div>

    </div>

  </div>

</section>



<?php $this->load->view('common/footer'); ?> 



          <!-- calendar js  -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.js"></script>



    <script src="<?= base_url(); ?>assets/home/js/calendar.js"></script>

