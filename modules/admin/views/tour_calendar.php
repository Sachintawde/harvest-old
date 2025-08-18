<?php $this->load->view('common/header'); ?>
    <!-- calendar css  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/home/css/calendar.css">


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

<?php $this->load->view('common/footer'); ?> 
