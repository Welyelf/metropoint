
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
                    <h4 class="page-title">TRIPS</h4>
                    <p class="text-muted page-title-alt">
                        <?php
                            if($this->uri->segment(4) == 0){
                                echo 'Bus Waiting on Queue.';
                            }else if($this->uri->segment(4) == 1 && $this->uri->segment(3) == 'view'){
                                echo 'Buses that are departed to this terminal.';
                            }else if($this->uri->segment(4) == 1 && $this->uri->segment(3) == 'incoming'){
                                echo 'Buses that are incoming to this terminal.';
                            }else if($this->uri->segment(4) == 2){
                                echo 'Incoming Buses.';
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-boxs">
                        <p class="text-muted m-b-30 font-13">

                        </p>
                        <table id="demo-foo-filtering" class="table table-striped toggle-circle m-b-0 table-responsive" data-page-size="7">
                            <thead>
                            <tr>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($trips as $trip):
                                $driver_data = get_driver($trip->dri_id);
                                $conductor_data = get_conductor($trip->con_id);
                                ?>
                                <tr>
                                    <td>
                                        <div class="col-lg-3">
                                            <div class="card-box">
                                                <div class="widget-chart text-center">
                                                    <h4 class="text-muted"><?= $trip->bus_no ?></h4>
                                                    <h3 class="font-600"><?= $trip->trip_no ?></h3>
                                                    <span class="label label-table label-success"><?= trip_status($trip->trip_status); ?></span>
                                                    <ul class="list-inline m-t-15">
                                                        <li>
                                                            <h5 class="text-muted m-t-20">Driver</h5>
                                                            <h4 class="m-b-0"><?= $driver_data->l_name; ?></h4>
                                                        </li>

                                                        <li>
                                                            <h5 class="text-muted m-t-20">Conductor</h5>
                                                            <h4 class="m-b-0"><?= $conductor_data->l_name; ?></h4>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <center>
                                                    <?php if($trip->trip_status == 0) :  ?>
                                                        <a id="<?=$trip->trip_id;?>" class="btn btn-default btn-sm m-b-20 on_torno">
                                                            <i class="md md-filter-list m-r-5"></i> Depart
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if($trip->trip_status == 1 && $this->uri->segment(3) == 'incoming') :  ?>
                                                        <a id="<?=$trip->trip_id;?>" class="btn btn-default btn-sm m-b-20 on_road">
                                                            <i class="md  md-directions-bus m-r-5"></i> Arrived
                                                        </a>
                                                    <?php endif; ?>
                                                </center>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">
                                    <div class="text-right">
                                        <ul class="pagination pagination-split m-t-30 m-b-0"></ul>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
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
        $(".on_torno").on( "click", function( event ) {
            var ID=this.id;
            // alert(ID);
            Swal.fire({
                title: 'Depart this Bus?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>dispatcher/dashboard/change_status_depart",
                        data: {id : ID , status : 1}, // serializes the form's elements.
                        success: function(data)
                        {
                            if(data === "1"){
                                window.location.href='<?= base_url() ?>dispatcher/dashboard/';
                            }else{
                                alert(data);
                            }
                        }
                    });
                }
            });
        });

        $(".on_road").on( "click", function( event ) {
            var ID=this.id;
            // alert(ID);
            Swal.fire({
                title: 'Bus has been arrived?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>dispatcher/dashboard/change_status",
                        data: {id : ID , status : 4}, // serializes the form's elements.
                        success: function(data)
                        {
                            if(data === "1"){
                                window.location.href='<?= base_url() ?>dispatcher/dashboard/';
                            }else{
                                alert(data);
                            }
                        }
                    });
                }
            });
        });
    } );
</script>
