
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
                    <h4 class="page-title">Bus Type</h4>
                    <p class="text-muted page-title-alt">Add or Edit the bus type information!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-xs-center">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" method="post">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">From</label>
                                <div class="col-md-10">
                                    <select name="route_from" class="form-control" data-style="btn-white">
                                        <option value="Davao">Davao</option>
                                        <option value="Tagum">Tagum</option>
                                        <option value="New Bataan">New Bataan</option>
                                        <option value="Maragusan">Maragusan</option>
                                        <option value="Nabunturan">Nabunturan</option>
                                        <option value="Laak">Laak</option>
                                        <option value="Monkayo">Monkayo</option>
                                        <option value="Compostela">Compostela</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">To</label>
                                <div class="col-md-10">
                                    <select name="route_from" class="form-control" data-style="btn-white">
                                        <option value="Davao">Davao</option>
                                        <option value="Tagum">Tagum</option>
                                        <option value="New Bataan">New Bataan</option>
                                        <option value="Maragusan">Maragusan</option>
                                        <option value="Nabunturan">Nabunturan</option>
                                        <option value="Laak">Laak</option>
                                        <option value="Monkayo">Monkayo</option>
                                        <option value="Compostela">Compostela</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Name Alias</label>
                                <div class="col-md-10">
                                    <input type="text" id="name_alias" name="name_alias" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer modal-footer-detail">
                                <div class="button-modal-list">
                                    <a href="<?= base_url('superadmin/types/') ?>" id="demo-btn-addrow" class="btn btn-danger m-b-20 text-right"><i class="fa fa-remove m-r-5"></i> Cancel</a>
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
