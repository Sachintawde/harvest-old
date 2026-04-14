<?php $this->load->view('common/header'); ?>

<!-- file input -->

<link rel="stylesheet" href="<?= base_url(); ?>assets/admin/plugins/fileinput/css/fileinput.min.css">



<!-- Breadcomb area Start-->

<div class="breadcomb-area">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="remove-messages"></div>

                <div class="breadcomb-list">

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                            <div class="breadcomb-wp">

                                <div class="breadcomb-icon">

                                    <i class="notika-icon notika-windows"></i>

                                </div>

                                <div class="breadcomb-ctn">

                                    <h2>Contact Record</h2>

                                    <p>View All added contact data</span></p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Breadcomb area End-->

<!-- Data Table area Start-->

<div class="data-table-area">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="data-table-list">

                    <div class="basic-tb-hd">

                        <h2>Contact Table</h2>

                        <p>One one of them to see their details also action button to the modificatoin in database.</p>

                        <span class="pull-right show_date">

                            <div class="nk-int-st date-range">

                                <div class="form-group nk-datapk-ctm form-elet-mg">

                                    <div class="input-group date nk-int-st">

                                        <span class="input-group-addon"></span>

                                        <input

                                            type="text"

                                            id="min"

                                            name="min"

                                            class="form-control"

                                            placeholder="Min Date"

                                            required="required">

                                    </div>

                                </div>

                            </div>

                            <div class="nk-int-st date-range">

                                <div class="form-group nk-datapk-ctm form-elet-mg">

                                    <div class="input-group date nk-int-st">

                                        <span class="input-group-addon"></span>

                                        <input

                                            type="text"

                                            id="max"

                                            name="max"

                                            class="form-control"

                                            placeholder="Max Date"

                                            required="required">

                                    </div>

                                </div>

                            </div>

                        </span>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-striped" id="manageContactTable">

                            <thead>

                                <tr>

                                    

                                    <th>First Name</th>

                                    <th>Last Name</th>

                                    <th>Email</th>

                                    <th>Phone</th>

                                    <th>Program of Interest</th>

                                    <th>Date</th>

                                    <th style="width:15%;">Options</th>

                                </tr>

                            </thead>

                        </table>

                        <!-- /table -->

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- view Contact -->

<div class="modal animated shake" id="viewContactModal" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-large">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">

                    <i class="notika-icon notika-form"></i>

                View Contact</h4>

                <hr/>

            </div>

            <div class="modal-body">

                <div class="view_contact_data"></div>

            </div>

            <div class="modal-footer viewContactFooter">

                <button type="button" class="btn btn-default" data-dismiss="modal">

                    <i class="glyphicon glyphicon-remove-sign"></i>

                    Close</button>

            </div>

        </div>

<!-- /.modal-content -->

    </div>

<!-- /.modal-dialog -->

</div>

<!-- /.modal -->

<!-- /view Image -->



<!-- remove Image -->

<div class="modal fade" tabindex="-1" role="dialog" id="removeContactModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

                <h4 class="modal-title">

                    <i class="glyphicon glyphicon-trash"></i>

                Remove Contact

                </h4>

            </div>

            <div class="modal-body">

                <p>Do you really want to remove ?</p>

            </div>

    <div class="modal-footer removeContactFooter">

        <button type="button" class="btn btn-default" data-dismiss="modal">

            <i class="glyphicon glyphicon-remove-sign"></i>

            Close</button>

        <button type="button" class="btn btn-primary" id="removeContactBtn" data-loading-text="Loading...">

            <i class="glyphicon glyphicon-ok-sign"></i>

            Save changes

        </button>

    </div>

</div>

</div>

</div>



<?php $this->load->view('common/footer'); ?>

<script src="<?= base_url(); ?>assets/admin/custom/js/contact.js"></script>