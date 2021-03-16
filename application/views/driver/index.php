
<?php
$this->load->view('layout/head');
$this->load->view('layout/topbar_driver');
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
                    <h4 class="page-title">My Location</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                        <b><?= $trip->trip_no; ?></b><br>
                        <small>From : <b><?= $trip->trip_from; ?></b></small><br>
                        <small>To : <b><?= $trip->trip_to; ?></b></small><br><br>
                    <span class="label label-table label-success"><?= trip_status($trip->trip_status); ?></span><br><br>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <div id="mapid"></div>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
    <?php $this->load->view('layout/footer'); ?>
</div>
<style>
    .leaflet-routing-alternatives-container{
        display: none !important;
    }
    #mapid { height: 300px; }
</style>
<?php $this->load->view('layout/foot'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        var mymap = L.map('mapid').setView([7.3575577, 125.7035372], 15);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid3JoaXN1bGEiLCJhIjoiY2tqdjAzNjhwMnF1czJxcXVheG5zM2Z0dyJ9.ADUJmb8cso0RObOix5SzOQ', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'your.mapbox.access.token'
        }).addTo(mymap);

        //var marker = L.marker([7.353216, 125.702407]).addTo(mymap);

        var current_position, current_accuracy;

        function onLocationFound(e) {
            // if position defined, then remove the existing position marker and accuracy circle from the map
            if (current_position) {
                mymap.removeLayer(current_position);
                mymap.removeLayer(current_accuracy);
            }
            // console.log(e);
            //var currentpos = L.marker([e.latlng.lng,e.latlng.lat]).addTo(mymap);

            var radius = e.accuracy / 2;
            current_position = L.marker(e.latlng).addTo(mymap)
            //.bindPopup("You are within " + radius + " meters from this point").openPopup();
                .bindPopup("Your Location").openPopup();
            current_accuracy = L.circle(e.latlng, radius).addTo(mymap);
             console.log(e.latlng);
            $.ajax({
                type: "POST",
                url: "/driver/dashboard/update_trip_coordinates/",
                data: {id : <?= $trip->trip_id; ?>,lat : e.latlng.lat, long : e.latlng.lng}, // serializes the form's elements.
                success: function(data)
                {
                    console.log(data);
                }
            });
        }
        function onLocationError(e) {
            console.log(e.message);
        }
        mymap.on('locationfound', onLocationFound);
        mymap.on('locationerror', onLocationError);
        function locate() {
            mymap.locate({setView: true, maxZoom: 16});
        }
        locate();
        setInterval(locate, 50000);
    });
</script>


