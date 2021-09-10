<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$_SESSION['user_details']=user_details();
$_SESSION['active_menu']='book-appointment';
$con = connection();

if(isset($_POST['submit']))
{
    $doctor_specialization=$_POST['doctor_specialization'];
    $doctor_id=$_POST['doctor_id'];
    $patient_id=$_SESSION['user_details']['id'];
    $fees=$_POST['fees'];
    $symptoms=$_POST['symptoms'];
    $appointment_datetime=$_POST['appointment_datetime'];
    $query=mysqli_query($con,"insert into appointment(doctor_specialization, doctor_id, patient_id, fees, symptoms, appointment_datetime) values('$doctor_specialization', '$doctor_id', '$patient_id', '$fees', '$symptoms', '$appointment_datetime')");
    if($query){
        echo "<script>alert('Your appointment successfully booked');</script>";
        header('location: appointment-history.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Appointment</title>

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
                        <h1 class="m-0">Book Appointment</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="book-appointment.php">Book Appointment</a></li>
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
                        <form role="form" name="book" method="post" >
                            <div class="form-group">
                                <label>Doctor Specialization</label>
                                <select name="doctor_specialization" class="form-control" onChange="getDoctor($(this).val())" required="required">
                                    <option value="">Select Specialization</option>
                                    <?php
                                        $ret=mysqli_query($con,"select * from specialization");
                                        while($row=mysqli_fetch_array($ret)){
                                    ?>
                                        <option value="<?php echo htmlentities($row['name']);?>"><?php echo htmlentities($row['name']);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Doctors</label>
                                <select name="doctor_id" class="form-control" id="doctor" onChange="getFees($(this).val())" required="required">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Consultancy Fees</label>
                                <input type="text" class="form-control" id="fees" name="fees"  required="">
                            </div>
                            <div class="form-group">
                                <label>Symptoms</label>
                                <textarea class="form-control" name="symptoms" required=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Appointment Date</label>
                                <input type="date" class="form-control" name="appointment_date"  required="required">
                            </div>
                            <div class="form-group">
                                <label>Appointment Slots</label>
                                <select name="appointment_time_slot" class="form-control" required="required">
                                    <option value="">Select Slot</option>
                                    <option value="10:00AM - 12:00AM">10:00AM - 12:00AM</option>
                                    <option value="3:00PM - 5:00PM">3:00PM - 5:00PM</option>
                                    <option value="8:00PM - 11:00PM">8:00PM - 11:00PM</option>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-o btn-primary">Submit</button>
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

<script>
    function getDoctor(val) {
        $.ajax({
            type: "POST",
            url: "get_doctor_fees.php",
            data:'specialization='+val,
            success: function(data){
                console.log(data);
                $("#doctor").html(data);
                $("#fees").val(0);
            }
        });
    }

    function getFees(val) {
        $.ajax({
            type: "POST",
            url: "get_doctor_fees.php",
            data:'doctor_id='+val,
            success: function(data){
                console.log(data);
                $("#fees").val(data);
            }
        });
    }
</script>
</body>
</html>
