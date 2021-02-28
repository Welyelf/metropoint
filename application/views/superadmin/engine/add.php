
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
                    <h4 class="page-title">Engine</h4>
                    <p class="text-muted page-title-alt">Add or Edit the engine information!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-xs-center">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" method="post">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Name</label>
                                <div class="col-md-10">
                                    <input type="text" id="name" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="example-email">Description</label>
                                <div class="col-md-10">
                                    <textarea id="description" name="description" class="form-control" maxlength="225" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer modal-footer-detail">
                                <div class="button-modal-list">
                                    <a href="<?= base_url('superadmin/engine/') ?>" id="demo-btn-addrow" class="btn btn-danger m-b-20 text-right"><i class="fa fa-remove m-r-5"></i> Cancel</a>
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
