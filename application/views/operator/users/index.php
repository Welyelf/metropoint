
<?php
    $this->load->view('layout/head');
    $this->load->view('layout/topbar_operator');
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
                        <h4 class="page-title">Users</h4>
                        <p class="text-muted page-title-alt">Lists of Users!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-xs-center">
                        <div class="form-group">
                            <a href="<?= base_url('operator/users/add') ?>" id="demo-btn-addrow" class="btn btn-default m-b-20"><i class="fa fa-plus m-r-5"></i> Add New User</a>
                        </div>
                    </div>
                    <table id="datatable" class="table table-striped table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Base Terminal</th>
                            <th>User Type</th>
                            <th>Contact No</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user->firstname.' '.$user->lastname ?></td>
                                <td><?= $user->username ?></td>
                                <td><?= $user->name ?></td>
                                <td><?= user_types($user->user_type); ?></td>
                                <td><?= $user->contact_no ?></td>
                                <td><?= employment_status($user->status); ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('superadmin/users/edit/'.$user->user_id);  ?>" id="demo-btn-addrow" class="btn btn-primary m-b-20">
                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                    </a>
                                    <a id="<?=$user->id;?>" class="btn btn-primary m-b-20 remove_user">
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
        $('#datatable').dataTable({
            'order' : []
        });
        $(".remove_user").on( "click", function( event ) {
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
                        url: "<?= base_url() ?>admin/users/delete_user",
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
        })
    } );
</script>
