<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$_SESSION['user_details']=user_details();
$_SESSION['active_menu']='appointment-history';
$con = connection();
if(isset($_GET['del']))
{
    mysqli_query($con,"delete from users where id = '".$_GET['id']."'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Patient</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
                        <h1 class="m-0">Manage Patient</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="manage-patient.php">Manage Patient</a></li>
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
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <?php if(isset($_GET['id']) && $_SESSION['id']){ ?><div class="alert alert-success">Successfully doctor deleted!</div><?php } ?>
                        <table class="table table-hover" id="datatable">
                            <thead>
                            <tr>
                                <?php if(isset($_SESSION['user_details']['role']) && $_SESSION['user_details']['role']=='admin' || $_SESSION['user_details']['role']=='patient'){ ?>
                                    <th>Doctor</th>
                                    <th>Doctor Phone</th>
                                    <th>Specialization</th>
                                <?php } ?>
                                <?php if(isset($_SESSION['user_details']['role']) && $_SESSION['user_details']['role']=='admin' || $_SESSION['user_details']['role']=='doctor'){ ?>
                                    <th>Patient</th>
                                    <th>Patient Phone</th>
                                    <th>Consultancy Fee</th>
                                <?php } ?>
                                <th>Symptoms</th>
                                <th>Appointment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(isset($_SESSION['user_details']['role']) && $_SESSION['user_details']['role']=='admin'){
                                    $sql=mysqli_query($con,"select * from appointment");
                                }else if(isset($_SESSION['user_details']['role']) && $_SESSION['user_details']['role']=='doctor'){
                                    $sql=mysqli_query($con,"select * from appointment where doctor_id='".$_SESSION['user_details']['id']."'");
                                }else{
                                    $sql=mysqli_query($con,"select * from appointment where patient_id='".$_SESSION['user_details']['id']."'");
                                }
                                $cnt=1;
                                while($row=mysqli_fetch_array($sql))
                                {
                            ?>
                                <tr>
                                    <?php if(isset($_SESSION['user_details']['role']) && $_SESSION['user_details']['role']=='admin' || $_SESSION['user_details']['role']=='patient'){ ?>
                                        <?php
                                            $doctor_id = $row['doctor_id'];
                                            $doctor=mysqli_query($con,"select * from users where id='$doctor_id'");
                                            $doctor_row=mysqli_fetch_array($doctor);
                                        ?>
                                        <td><?php echo $doctor_row['fullName']; ?></td>
                                        <td><?php echo $doctor_row['mobile_number']; ?></td>
                                        <td><?php echo $row['doctor_specialization']; ?></td>
                                    <?php } ?>
                                    <?php if(isset($_SESSION['user_details']['role']) && $_SESSION['user_details']['role']=='admin' || $_SESSION['user_details']['role']=='doctor'){ ?>
                                        <?php
                                        $patient_id = $row['patient_id'];
                                        $patient=mysqli_query($con,"select * from users where id='$patient_id'");
                                        $patient_row=mysqli_fetch_array($patient);
                                        ?>
                                        <td><?php echo $patient_row['fullName']; ?></td>
                                        <td><?php echo $patient_row['mobile_number']; ?></td>
                                        <td><?php echo $row['fees']; ?></td>
                                    <?php } ?>
                                    <td><?php echo $row['symptoms']; ?></td>
                                    <td><?php echo $row['appointment_datetime']; ?></td>
                                    <td><?php echo ucfirst($row['status']); ?></td>
                                    <td class="p-0 m-0">
                                        <a href="view.php?id=<?php echo $row['id']?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="edit-patient.php?id=<?php echo $row['id']?>" onClick="return confirm('Are you sure you want to edit?')" class="btn btn-primary btn-sm"><i class="fa fa-user-edit"></i></a>
                                        <a href="manage-patient.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->

<script>
    $(function () {
        $('#datatable').DataTable();
    });
</script>
</body>
</html>
