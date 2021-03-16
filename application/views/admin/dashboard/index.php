
<?php
    $this->load->view('layout/head');
    $this->load->view('layout/topbar_admin');
    //$this->load->view('layout/leftbar');
?>
<link href="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<style>
    #mapid { height: 300px; }
    .dashboard_row{
        display: flex !important;
    }
    .dashboard_column{
        flex: 1;
    }
</style>
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
                        <h4 class="page-title">Dashboard</h4>
                        <p class="text-muted page-title-alt">Welcome to Metropoint!</p>
                    </div>
                </div>

                <div class="row dashboard_row">
                    <div class="col-lg-6 dashboard_row">
                        <div class="card-box dashboard_column">
                            <h4 class="text-dark header-title m-t-0">Departure</h4>
                            <p class="text-muted m-b-30 font-13"></p>
                            <div class="table-responsives">
                                <table id="datatable" class="table table-actions-bar m-b-0">
                                    <thead>
                                    <tr>
                                        <th>Trip #</th>
                                        <th>Bus #</th>
                                        <th>Seat Cap</th>
                                        <th>To</th>
                                        <th>Date Time</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($departures as $departure): ?>
                                        <tr>
                                            <td><?= $departure->trip_no; ?></td>
                                            <td><?= $departure->bus_number ?></td>
                                            <td><?= $departure->seat_capacity; ?></td>
                                            <td><?= $departure->trip_to; ?></td>
                                            <td><?= $departure->trip_datetime; ?></td>
                                            <td><span class="label label-table label-success"><?= trip_status($departure->trip_status); ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6 dashboard_row">
                        <div class="card-box dashboard_column">
                            <h4 class="text-dark header-title m-t-0">MAP</h4>
                            <div id="mapid"></div>
                        </div>
                    </div>
                </div>

                <div class="row dashboard_row">
                    <div class="col-lg-6 dashboard_row">
                        <div class="card-box dashboard_column">
                            <h4 class="text-dark header-title m-t-0">Arrival</h4>
                            <p class="text-muted m-b-30 font-13">
                            </p>
                            <div class="table-responsives">
                                <table id="datatable_arrival" class="table table-actions-bar m-b-0">
                                    <thead>
                                        <tr>
                                            <th>Trip #</th>
                                            <th>Bus #</th>
                                            <th>Seat Cap</th>
                                            <th>To</th>
                                            <th>Date Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($arrivals as $arrival): ?>
                                        <tr>
                                            <td><?= $arrival->trip_no; ?></td>
                                            <td><?= $arrival->bus_number ?></td>
                                            <td><?= $arrival->seat_capacity; ?></td>
                                            <td><?= $arrival->trip_to; ?></td>
                                            <td><?= $arrival->trip_datetime; ?></td>
                                            <td><span class="label label-table label-success"><?= trip_status($arrival->trip_status); ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6 dashboard_row">
                        <div class="card-box dashboard_column">
                            <h4 class="text-dark header-title m-t-0">Terminal: <b>TAGUM</b></h4>
                            <p class="text-muted m-b-30 font-13">
                                Buses
                            </p>

                            <div class="table-responsives">
                                <table id="datatable" class="table table-actions-bar m-b-0">
                                    <thead>
                                    <tr>
                                        <th>Travelling</th>
                                        <th>TORNO</th>
                                        <th>TOTAL</th>
                                        <th>ACTIVE</th>
                                        <th>STOCK</th>
                                        <th>ON-SHOP</th>
                                        <th>RENTED</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?= count($arrivals); ?></td>
                                        <td><?= count($departures); ?></td>
                                        <td><?= $buses; ?></td>
                                        <td><?= $bus_active ?></td>
                                        <td><?= $bus_inactive ?></td>
                                        <td><?= $bus_onshop ?></td>
                                        <td><?= $bus_rental ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget-panel widget-style-2 bg-white">
                            <i class="fa fa-user text-primary"></i>
                            <h2 class="m-0 text-dark counter font-600"><?= $bus_no_driver ?></h2>
                            <div class="text-muted m-t-5">Bus without Driver</div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget-panel widget-style-2 bg-white">
                            <i class="fa fa-user text-primary"></i>
                            <h2 class="m-0 text-dark counter font-600"><?= $bus_no_conductor ?></h2>
                            <div class="text-muted m-t-5">Bus without Conductor</div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget-panel widget-style-2 bg-white">
                            <i class="fa fa-bus text-primary"></i>
                            <h2 class="m-0 text-dark counter font-600"><?= count($arrivals); ?></h2>
                            <div class="text-muted m-t-5">Arrived Bus</div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget-panel widget-style-2 bg-white">
                            <i class="fa fa-bus text-primary"></i>
                            <h2 class="m-0 text-dark counter font-600"><?= count($departures); ?></h2>
                            <div class="text-muted m-t-5">Departed Bus</div>
                        </div>
                    </div>
                </div>


            </div> <!-- container -->

        </div> <!-- content -->


        <?php $this->load->view('layout/footer'); ?>
    </div>

<style>
    body{
        position:fixed !important;
        top:0 !important;
        bottom:0 !important;
        left:0 !important;
        right:0 !important;
    }
</style>
<?php $this->load->view('layout/foot'); ?>
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        var mymap = L.map('mapid').setView([7.3575577, 125.7035372], 8);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid3JoaXN1bGEiLCJhIjoiY2tqdjAzNjhwMnF1czJxcXVheG5zM2Z0dyJ9.ADUJmb8cso0RObOix5SzOQ', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'your.mapbox.access.token'
        }).addTo(mymap);

        //var marker = L.marker([7.353216, 125.702407]).addTo(mymap);

        var count=0;
        <?php foreach ($arrivals as $coordinate) : ?>
            var name = 'marker'+count;
            name = L.marker([<?= $coordinate->trip_latitude ?>, <?= $coordinate->trip_longitude ?>]).addTo(mymap);
            name.bindPopup("<?= '<b>'.$coordinate->bus_number.'</b>' ?>").openPopup();
            count++;
        <?php endforeach; ?>
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable({
            'order' : [],
            'lengthChange' : false,
            'searching' :false
        });
        $('#datatable_arrival').dataTable({
            'order' : [],
            'lengthChange' : false,
            'searching' :false,
            'ordering' :false
        });
    });
</script>
