<?php
    session_start();
    error_reporting(0);
    include('include/config.php');
    include('include/checklogin.php');
    check_login();
    $_SESSION['user_details']=user_details();
    $_SESSION['active_menu']='dashboard';
    $con = connection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ucfirst($_SESSION['user_details']['role']); ?> | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <?php include('include/nav.php'); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include('include/menu.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"><?php echo ucfirst($_SESSION['user_details']['role']); ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <?php if($_SESSION['user_details']['role']=='admin'){ ?>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    <?php
                                        $query = mysqli_query($con, "select COUNT(*) as count from users where role='admin'");
                                        $result = mysqli_fetch_array($query);
                                        echo $result['count'];
                                    ?>
                                </h3>
                                <p>Total Admin</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="manage-admin.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- ./col -->
                    <?php if($_SESSION['user_details']['role']=='admin'){ ?>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $query = mysqli_query($con, "select COUNT(*) as count from users where role='doctor'");
                                    $result = mysqli_fetch_array($query);
                                    echo $result['count'];
                                    ?>
                                </h3>
                                <p>Total Doctor</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="manage-doctor.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- ./col -->
                    <?php if($_SESSION['user_details']['role']=='admin' || $_SESSION['user_details']['role']=='doctor'){ ?>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $query = mysqli_query($con, "select COUNT(*) as count from users where role='patient'");
                                    $result = mysqli_fetch_array($query);
                                    echo $result['count'];
                                    ?>
                                </h3>
                                <p>Total Patient</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="manage-patient.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>
                                    <?php
                                    if ($_SESSION['user_details']['role'] == 'admin') {
                                        $query = mysqli_query($con, "select COUNT(*) as count from appointment");
                                    }else  if ($_SESSION['user_details']['role'] == 'doctor'){
                                        $query = mysqli_query($con, "select COUNT(*) as count from appointment where doctor_id='".$_SESSION['user_details']['id']."'");
                                    }else {
                                        $query = mysqli_query($con, "select COUNT(*) as count from appointment where patient_id='".$_SESSION['user_details']['id']."'");
                                    }
                                    $result = mysqli_fetch_array($query);
                                    echo $result['count'];
                                    ?>
                                </h3>
                                <p>Total Appointment</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="appointment-history.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    <?php
                                    if ($_SESSION['user_details']['role'] == 'admin') {
                                        $query = mysqli_query($con, "select COUNT(*) as count from appointment where status='pending'");
                                    } else if ($_SESSION['user_details']['role'] == 'doctor') {
                                        $query = mysqli_query($con, "select COUNT(*) as count from appointment where status='pending' AND doctor_id='" . $_SESSION['user_details']['id'] . "'");
                                    } else {
                                        $query = mysqli_query($con, "select COUNT(*) as count from appointment where status='pending' AND patient_id='" . $_SESSION['user_details']['id'] . "'");
                                    }
                                    $result = mysqli_fetch_array($query);
                                    echo $result['count'];
                                    ?>
                                </h3>
                                <p>Pending Appointment</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="appointment-history.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    <?php
                                    if($_SESSION['user_details']['role'] == 'admin') {
                                        $query = mysqli_query($con, "select COUNT(*) as count from appointment where status='link_shared'");
                                    }else if($_SESSION['user_details']['role'] == 'doctor'){
                                        $query = mysqli_query($con, "select COUNT(*) as count from appointment where status='link_shared' AND doctor_id='" . $_SESSION['user_details']['id'] . "'");
                                    }else{
                                        $query = mysqli_query($con, "select COUNT(*) as count from appointment where status='link_shared' AND patient_id='" . $_SESSION['user_details']['id'] . "'");
                                    }
                                    $result = mysqli_fetch_array($query);
                                    echo $result['count'];
                                    ?>
                                </h3>
                                <p>Schedule Confirmed</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="appointment-history.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <?php if($_SESSION['user_details']['role']=='admin'){ ?>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $query = mysqli_query($con, "select COUNT(*) as count from tblcontactus");
                                    $result = mysqli_fetch_array($query);
                                    echo $result['count'];
                                    ?>
                                </h3>
                                <p>Total Queries</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="contact-us-queries.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- ./col -->
                    <?php if($_SESSION['user_details']['role']=='admin'){ ?>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>
                                    <?php
                                        $query = mysqli_query($con, "select COUNT(*) as count from tblcontactus where created_at='".date('y-m-d')."'");
                                        $result = mysqli_fetch_array($query);
                                        echo $result['count'];
                                    ?>
                                </h3>
                                <p>Today's Queries</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="contact-us-queries.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include('include/footer.php'); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
