
<?php
    $this->load->view('layout/head');
    $this->load->view('layout/topbar_dispatcher');
    //$this->load->view('layout/leftbar');
?>
<link href="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

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
                        <h4 class="page-title">Torno</h4>
                        <p class="text-muted page-title-alt"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="row">

                        <a href="<?= base_url(); ?>dispatcher/dashboard/view/0">
                            <div class="col-md-6 col-lg-3">
                                <div class="widget-bg-color-icon card-box fadeInDown animated">
                                    <div class="bg-icon bg-icon-info pull-left">
                                        <i class="md  md-filter-list text-info"></i>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark"><b class="counter"><?= $waiting; ?></b></h3>
                                        <p class="text-muted">Waiting</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </a>

                        <a href="<?= base_url(); ?>dispatcher/dashboard/view/1">
                            <div class="col-md-6 col-lg-3">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-pink pull-left">
                                        <i class="fa fa-bus text-pink"></i>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark"><b class="counter"><?= $torno; ?></b></h3>
                                        <p class="text-muted">On Torno</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </a>

                        <a href="<?= base_url(); ?>dispatcher/dashboard/view/2">
                        <div class="col-md-6 col-lg-3">
                            <div class="widget-bg-color-icon card-box">
                                <div class="bg-icon bg-icon-purple pull-left">
                                    <i class="fa fa-road  text-purple"></i>
                                </div>
                                <div class="text-right">
                                    <h3 class="text-dark"><b class="counter"><?= $on_road; ?></b></h3>
                                    <p class="text-muted">On Road</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        </a>

                        <!--<div class="col-md-6 col-lg-3">
                            <div class="widget-bg-color-icon card-box">
                                <div class="bg-icon bg-icon-success pull-left">
                                    <i class="fa fa-bus text-success"></i>
                                </div>
                                <div class="text-right">
                                    <h3 class="text-dark"><b class="counter"><?= $arrived; ?></b></h3>
                                    <p class="text-muted">Arrived</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>-->

                        <a href="<?= base_url(); ?>dispatcher/dashboard/incoming">
                            <div class="col-md-6 col-lg-3">
                                <div class="widget-bg-color-icon card-box">
                                    <div class="bg-icon bg-icon-success pull-left">
                                        <i class="fa fa-bus text-success"></i>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-dark"><b class="counter"><?= $incoming; ?></b></h3>
                                        <p class="text-muted">Incoming</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </a>
                    </div>
               </div>
            </div> <!-- container -->
        </div> <!-- content -->
        <?php $this->load->view('layout/footer'); ?>
    </div>

<?php $this->load->view('layout/foot'); ?>

<!--FooTable-->
<script src="<?= base_url(); ?>assets/plugins/footable/js/footable.all.min.js"></script>

<script src="<?= base_url(); ?>assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>

<!--FooTable Example-->
<script src="<?= base_url(); ?>assets/pages/jquery.footable.js"></script>

<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable({

        });
    } );
</script>
