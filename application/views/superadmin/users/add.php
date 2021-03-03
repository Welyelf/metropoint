
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
                                <label class="col-md-2 control-label">User Type</label>
                                <div class="col-md-10">
                                    <select name="user_type" class="form-control" data-style="btn-white">
                                        <option value="1">Admin</option>
                                        <!--<option value="4">Conductor</option>
                                        <option value="5">Driver</option>-->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Base Terminal</label>
                                <div class="col-md-10">
                                    <select id="base_terminal" name="base_terminal" class="form-control" data-style="btn-white">
                                        <?php foreach ($terminals as $terminal): ?>
                                            <option value="<?= $terminal->id; ?>"><?= $terminal->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Username</label>
                                <div class="col-md-10">
                                    <input type="text" id="username" name="username" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Password</label>
                                <div class="col-md-10">
                                    <input type="password" id="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Firstname</label>
                                <div class="col-md-10">
                                    <input type="text" id="firstname" name="firstname" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Lastname</label>
                                <div class="col-md-10">
                                    <input type="text" id="lastname" name="lastname" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Middile Initial</label>
                                <div class="col-md-10">
                                    <input type="text" id="mi" name="mi" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Suffix</label>
                                <div class="col-md-10">
                                    <input type="text" id="suffix" name="suffix" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Sex</label>
                                <div class="col-md-10">
                                    <select class="form-control" data-style="btn-white">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Contact Number</label>
                                <div class="col-md-10">
                                    <input type="text" id="contact_no" name="contact_no" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Status</label>
                                <div class="col-md-10">
                                    <select name="status" class="form-control" data-style="btn-white">
                                        <option value="0">Regular</option>
                                        <option value="1">Casual</option>
                                        <option value="2">Termindated</option>
                                        <option value="3">Suspended</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Employment Date</label>
                                <div class="col-md-10">
                                    <input type="text" id="employment_date" name="employment_date" class="form-control" placeholder="Optional...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Driver License</label>
                                <div class="col-md-10">
                                    <input type="text" id="driver_license" name="driver_license" class="form-control" placeholder="Optional...">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">License Experience Date</label>
                                <div class="col-md-10">
                                    <input type="text" id="license_exp_date" name="license_exp_date" class="form-control" placeholder="Optional...">
                                </div>
                            </div>
                            <div class="modal-footer modal-footer-detail">
                                <div class="button-modal-list">
                                    <a href="<?= base_url('superadmin/users/') ?>" class="btn btn-danger m-b-20 text-right"><i class="fa fa-remove m-r-5"></i> Cancel</a>
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
