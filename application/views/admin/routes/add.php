
<?php
$this->load->view('layout/head');
$this->load->view('layout/topbar_admin');
//$this->load->view('layout/leftbar');
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Routes</h4>
                    <p class="text-muted page-title-alt">Add or Edit the route information!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-xs-center">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" method="post">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">From</label>
                                <div class="col-md-10">
                                    <?php $place = routes(); ?>
                                    <select name="route_from" class="form-control" data-style="btn-white">
                                        <?php for($x=0;$x<routes(TRUE);$x++) { ?>
                                            <option  value="<?= $place[$x] ?>"><?= $place[$x] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">To</label>
                                <div class="col-md-10">
                                    <select name="route_to" class="form-control" data-style="btn-white">
                                        <?php for($x=0;$x<routes(TRUE);$x++) { ?>
                                            <option  value="<?= $place[$x] ?>"><?= $place[$x] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Start Time</label>
                                <div class="col-md-10">
                                    <div class="input-group m-b-15">
                                        <div class="bootstrap-timepicker">
                                            <input id="timepicker" type="text" name="start_time" class="form-control">
                                        </div>
                                        <span class="input-group-addon bg-custom b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                                    </div><!-- input-group -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">End Time</label>
                                <div class="col-md-10">
                                    <div class="input-group m-b-15">
                                        <div class="bootstrap-timepicker">
                                            <input id="timepicker2" type="text" name="end_time" class="form-control ">
                                        </div>
                                        <span class="input-group-addon bg-custom b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                                    </div><!-- input-group -->
                                </div>
                            </div>
                            <div class="modal-footer modal-footer-detail">
                                <div class="button-modal-list">
                                    <a href="<?= base_url('admin/routes/') ?>" id="demo-btn-addrow" class="btn btn-danger m-b-20 text-right"><i class="fa fa-remove m-r-5"></i> Cancel</a>
                                    <button type="submit" class="btn btn-default m-b-20 text-right"><i class="fa fa-paper-plane-o m-r-5"></i> Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
    <?php $this->load->view('layout/footer'); ?>
</div>

<?php $this->load->view('layout/foot'); ?>
<script>
    jQuery(document).ready(function() {
        // Time Picker
        jQuery('#timepicker').timepicker({
            defaultTIme : false
        });
        jQuery('#timepicker2').timepicker({
            defaultTIme : false
        });
  });
</script>
