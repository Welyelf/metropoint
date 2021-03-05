
<?php
    $this->load->view('layout/head');
    $this->load->view('layout/topbar_admin');
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
                        <h4 class="page-title">Engine</h4>
                        <p class="text-muted page-title-alt">Lists of Engines!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-xs-center">
                        <div class="form-group">
                            <a href="<?= base_url('admin/engine/add') ?>" id="demo-btn-addrow" class="btn btn-default m-b-20"><i class="fa fa-plus m-r-5"></i> Add New Engine</a>
                        </div>
                    </div>
                    <table id="datatable" class="table table-striped table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($engines as $engine): ?>
                            <tr>
                                <td><?= $engine->name; ?></td>
                                <td><?= $engine->description; ?></td>
                                <td><?= date('m/d/Y', strtotime($engine->datetime)); ?></td>
                                <td>
                                    <a href="<?= base_url('admin/engine/edit/'.$engine->id);  ?>" id="demo-btn-addrow" class="btn btn-primary m-b-20">
                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                    </a>
                                    <a id="<?= $engine->id  ?>" class="btn btn-primary m-b-20 remove_engine">
                                        <i class="fa fa-trash-o m-r-5"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
        <?php $this->load->view('layout/footer'); ?>
    </div>

<?php $this->load->view('layout/foot'); ?>
<script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable(
            {

            });
        $(".remove_engine").on( "click", function( event ) {
            var ID=this.id;
            // alert(ID);
            Swal.fire({
                title: 'Continue to REMOVE this data?',
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
                        url: "<?= base_url() ?>superadmin/engine/delete_engine",
                        data: {id : ID}, // serializes the form's elements.
                        success: function(data)
                        {
                            if(data === "1"){
                                window.location.reload();
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
