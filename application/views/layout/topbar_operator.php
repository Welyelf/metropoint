<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="#" class="logo">
                <i class="md  md-directions-bus icon-c-logo"></i><span>M-P<i class="md md-album"></i>INT</span></a>
        </div>

    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left">
                        <i class="ion-navicon"></i>
                    </button>
                    <span class="text-white">
                        <?= strtoupper($_SESSION['user']->username); ?>
                    </span>
                </div>
                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="hidden-xs">
                        <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                            <img src="<?= base_url(); ?>assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= base_url('operator/dashboard/'); ?>"><i class="ti-dashboard m-r-5"></i> Dashboard</a></li>
                            <li><a href="<?= base_url('operator/users/'); ?>"><i class="fa fa-users m-r-5"></i>Users</a></li>
                            <li><a href="<?= base_url('operator/torno/'); ?>"><i class="fa fa-road m-r-5"></i>Torno</a></li>
                            <li><a href="<?= base_url('auth/logout/'); ?>"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- Top Bar End -->