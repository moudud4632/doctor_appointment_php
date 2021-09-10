<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$_SESSION['user_details']=user_details();
$con = connection();
$result = mysqli_query($con,"select * from users where id = '".$_GET['id']."'");
$details = mysqli_fetch_array($result);
$_SESSION['active_menu']='manage-'.$details['role'];

if($details['role']=='patient'){
    if(isset($_POST['submit']))
    {
        $patient_id=$_GET['id'];
        $blood_pressure=$_POST['blood_pressure'];
        $blood_sugar=$_POST['blood_sugar'];
        $weight=$_POST['weight'];
        $temperature=$_POST['temperature'];
        $medical_pres=$_POST['medical_pres'];
        $query = mysqli_query($con, "insert into medical_history(patient_id, blood_pressure, blood_sugar, weight, temperature, medical_pres)value('$patient_id', '$blood_pressure', '$blood_sugar', '$weight', '$temperature', '$medical_pres')");
        if($query) {
            echo '<script>alert("Medical history has been added.")</script>';
        }else{
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View <?php echo ucfirst($details['role']); ?></title>

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
                        <h1 class="m-0">View <?php echo ucfirst($details['role']); ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">View</li>
                            <li class="breadcrumb-item"><a href="manage-admin.php">Manage <?php echo ucfirst($details['role']); ?></a></li>
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
                        <table border="1" class="table table-bordered">
                            <tr align="center">
                                <td colspan="4" style="font-size:20px;color:blue"><?php echo ucfirst($details['role']); ?> Details</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td><?php  echo $details['fullName'];?></td>
                                <th>Role</th>
                                <td><?php  echo ucfirst($details['role']);?></td>
                            </tr>
                            <?php if($details['role']=='doctor'){ ?>
                                <tr>
                                    <th>Specialization</th>
                                    <td><?php  echo $details['specialization'];?></td>
                                    <th>Fees</th>
                                    <td><?php  echo $details['fees'];?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th>Mobile Number</th>
                                <td><?php  echo $details['mobile_number'];?></td>
                                <th>E-mail</th>
                                <td><?php  echo $details['email'];?></td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td><?php  echo $details['city'];?></td>
                                <th>Address</th>
                                <td><?php  echo $details['address'];?></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td><?php  echo ucfirst($details['gender']);?></td>
                                <th>Age</th>
                                <td><?php  echo $details['age'];?></td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td><?php  echo $details['created_at'];?></td>
                                <th>Updated At</th>
                                <td><?php  echo $details['updated_at'];?></td>
                            </tr>
                        </table>

                        <?php if($details['role']=='patient'){ ?>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <tr align="center">
                                    <th colspan="8" >Medical History</th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Blood Pressure</th>
                                    <th>Weight</th>
                                    <th>Blood Sugar</th>
                                    <th>Body Temperature</th>
                                    <th>Medical Prescription</th>
                                    <th>Visit Date</th>
                                </tr>
                                <?php
                                    $cnt=1;
                                    $pid = $details['id'];
                                    $ret = mysqli_query($con, "select * from medical_history  where patient_id='$pid'");
                                    while ($row=mysqli_fetch_array($ret)) {
                                ?>
                                    <tr>
                                        <td><?php echo $cnt;?></td>
                                        <td><?php  echo $row['blood_pressure'];?></td>
                                        <td><?php  echo $row['weight'];?></td>
                                        <td><?php  echo $row['blood_sugar'];?></td>
                                        <td><?php  echo $row['temperature'];?></td>
                                        <td><?php  echo $row['medical_pres'];?></td>
                                        <td><?php  echo $row['created_at'];?></td>
                                    </tr>
                                <?php $cnt=$cnt+1;} ?>
                            </table>
                            <br/>
                            <p align="center"><button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Add Medical History</button></p>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Medical History</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" name="submit">
                                            <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">
                                                    <tr>
                                                        <th class="p-0 m-0">Blood Pressure:</th>
                                                        <td class="p-0 m-0"><input name="blood_pressure" placeholder="Blood Pressure" class="form-control wd-450" required=""></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="p-0 m-0">Blood Sugar:</th>
                                                        <td class="p-0 m-0"><input name="blood_sugar" placeholder="Blood Sugar" class="form-control wd-450" required=""></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="p-0 m-0">Weight:</th>
                                                        <td class="p-0 m-0"><input name="weight" placeholder="Weight" class="form-control wd-450" required=""></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="p-0 m-0">Body Temperature:</th>
                                                        <td class="p-0 m-0"><input name="temperature" placeholder="Body Temperature" class="form-control wd-450" required=""></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="p-0 m-0">Medical Prescription:</th>
                                                        <td class="p-0 m-0"><textarea name="medical_pres" placeholder="Medical Prescription" rows="12" cols="14" class="form-control wd-450" required=""></textarea></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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
