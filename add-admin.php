<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$_SESSION['user_details']=user_details();
$_SESSION['active_menu']='add-admin';
$con = connection();

if(isset($_POST['submit']))
{
    $fullName=$_POST['fullName'];
    $mobile_number=$_POST['mobile_number'];
    $email=$_POST['email'];
    $city=$_POST['city'];
    $address=$_POST['address'];
    $gender=$_POST['gender'];
    $age=$_POST['age'];
    $password=md5($_POST['password']);
    $sql=mysqli_query($con,"insert into users(fullName, mobile_number, email, city, address, gender, age, password, role) values('$fullName', '$mobile_number', '$email', '$city', '$address', '$gender', '$age', '$password', 'admin')");
    if($sql)
    {
        echo "<script>alert('Admin Successfully Created');</script>";
        header('location:manage-admin.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Admin</title>

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
                        <h1 class="m-0">Add Admin</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Add</li>
                            <li class="breadcrumb-item"><a href="manage-admin.php">Manage Admin</a></li>
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
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="fullName" class="form-control"  value="" required="">
                            </div>
                            <div class="form-group">
                                <label>Contact Number <span class="text-danger">*</span></label>
                                <input type="number" name="mobile_number" class="form-control"  value="" required="" maxlength="11" pattern="[0-9]+">
                            </div>
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input name="email" class="form-control"  value="" required=''>
                            </div>
                            <div class="form-group">
                                <label>City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="city" value="" required="">
                            </div>
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" required=""></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Gender  <span class="text-danger">*</span></label><br/>
                                <label>
                                    <input type="radio" name="gender" id="gender" value="male"> Male
                                    <input type="radio" name="gender" id="gender" value="female"> Female
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Age  <span class="text-danger">*</span></label>
                                <input type="number" name="age" class="form-control"  value="" required="">
                            </div>
                            <div class="form-group">
                                <label>Password  <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control"  value="" required="">
                            </div>
                            <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">Update</button>
                        </form>
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
</body>
</html>
