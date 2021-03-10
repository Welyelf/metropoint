
<?php
$this->load->view('layout/head');
$this->load->view('layout/topbar');
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
                    <h4 class="page-title">Users</h4>
                    <p class="text-muted page-title-alt">Add or Edit the user information!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-xs-center">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" method="post">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Bus Number</label>
                                <div class="col-md-10">
                                    <select id="trip_bus_id" name="trip_bus_id" class="form-control" data-style="btn-white" required>
                                        <option value="">Select Bus</option>
                                        <?php foreach ($buses as $bus): ?>
                                        <option value="<?= $bus->id; ?>"><?= $bus->bus_number; ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Trip Number</label>
                                <div class="col-md-10">
                                    <input type="text" id="trip_no" name="trip_no" class="form-control" readonly value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Assigned Driver</label>
                                <div class="col-md-10">
                                    <select id="trip_driver" name="trip_driver" class="form-control" data-style="btn-white">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Assigned Conductor</label>
                                <div class="col-md-10">
                                    <select id="trip_conductor" name="trip_conductor" class="form-control" data-style="btn-white">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Bus Type</label>
                                <div class="col-md-10">
                                    <input type="text" id="bus_type" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Seater Cap</label>
                                <div class="col-md-10">
                                    <input type="text" id="seater_cap" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">From Terminal</label>
                                <div class="col-md-10">
                                    <select id="trip_from" name="trip_from" class="form-control" data-style="btn-white">
                                        <?php foreach ($terminals as $terminal): ?>
                                            <option value="<?= $terminal->name; ?>"><?= $terminal->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">To Terminal</label>
                                <div class="col-md-10">
                                    <select  id="trip_to" name="trip_to" class="form-control" data-style="btn-white">
                                        <?php foreach ($terminals_to as $terminal): ?>
                                            <option value="<?= $terminal->name; ?>"><?= $terminal->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer modal-footer-detail">
                                <div class="button-modal-list">
                                    <a href="<?= base_url('operator/torno/') ?>" class="btn btn-danger m-b-20 text-right"><i class="fa fa-remove m-r-5"></i> Cancel</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var now =moment().format('dmmYYYYhmmss');
        console.log(now);
        $("#trip_bus_id").on( 'change', function () {
            var busId = this.value;
            if(busId !== ""){
                $.ajax({
                    type: "POST",
                    url: "/operator/torno/getBusSelected",
                    data: {id : busId}, // serializes the form's elements.
                    success: function(data) {
                        var bus_data = JSON.parse(data);
                        $('#trip_no').val(bus_data.bus_type_alias + '-' + now);
                        $('#bus_type').val(bus_data.bus_type);
                        $('#seater_cap').val(bus_data.seat_capacity);
                        get_driver_assigned(bus_data.assigned_driver,'trip_driver');
                        get_driver_assigned(bus_data.assigned_conductor,'trip_conductor');
                        console.log(bus_data);
                    }
                });
            }
        });

        function get_driver_assigned(id,htmlId){
            if(id !== ""){
                $.ajax({
                    type: "POST",
                    url: "/operator/torno/getUserData",
                    data: {id : id}, // serializes the form's elements.
                    success: function(data) {
                        var user_data = JSON.parse(data);
                        $('#'+htmlId).append('<option value='+user_data.id+'>'+user_data.firstname + ' ' + user_data.lastname +'</option>');
                        //console.log(user_data);
                    }
                });
            }
        }
    });
</script>
