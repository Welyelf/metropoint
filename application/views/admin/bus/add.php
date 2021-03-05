
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
                    <h4 class="page-title">Add Bus</h4>
                    <p class="text-muted page-title-alt">Add bus information!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-xs-center">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" method="post">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Driver</label>
                                <div class="col-md-10">
                                    <select name="assigned_driver" class="form-control" data-style="btn-white">
                                        <option value="0">Select Driver</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Conductor</label>
                                <div class="col-md-10">
                                    <select name="assigned_conductor" class="form-control" data-style="btn-white">
                                        <option value="0">Select Conductor</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Bus Number</label>
                                <div class="col-md-10">
                                    <input type="text" id="bus_number" name="bus_number" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Plate Number</label>
                                <div class="col-md-10">
                                    <input type="text" id="plate_number" name="plate_number" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Bus Type</label>
                                <div class="col-md-10">
                                    <select name="bus_type_id" class="form-control" data-style="btn-white" required>
                                        <?php foreach ($bus_types as $bus_type): ?>
                                            <option value="<?= $bus_type->id; ?>"><?= $bus_type->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Engine Type</label>
                                <div class="col-md-10">
                                    <select name="engine_type_id" class="form-control" data-style="btn-white">
                                        <?php foreach ($engine_types as $engine_type): ?>
                                            <option value="<?= $engine_type->id; ?>"><?= $engine_type->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Sap Code</label>
                                <div class="col-md-10">
                                    <input type="text" id="sap_code" name="sap_code" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Seat Capacity</label>
                                <div class="col-md-10">
                                    <input type="number" id="seat_capacity" name="seat_capacity" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Status</label>
                                <div class="col-md-10">
                                    <select name="status" class="form-control" data-style="btn-white" required>
                                        <option value="0">Active</option>
                                        <option value="1">InActive</option>
                                        <option value="2">OnShop</option>
                                        <option value="3">Rental</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer modal-footer-detail">
                                <div class="button-modal-list">
                                    <a href="<?= base_url('admin/bus/') ?>" class="btn btn-danger m-b-20 text-right"><i class="fa fa-remove m-r-5"></i> Cancel</a>
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
