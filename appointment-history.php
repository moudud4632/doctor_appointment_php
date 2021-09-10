<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$_SESSION['user_details']=user_details();
$_SESSION['active_menu']='appointment-history';
$con = connection();
if(isset($_GET['action']) && $_GET['action']!='' && $_GET['id']!='')
{
    if($_GET['action']=='delete'){
        mysqli_query($con,"delete from appointment where id = '".$_GET['id']."'");
    }else{
        mysqli_query($con,"update appointment set status='".$_GET['action']."' where id = '".$_GET['id']."'");
    }
    header('location: appointment-history.php');
}

if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $mobile_number = $_POST['mobile_number'];
    $meeting_info = $_POST['meeting_info'];
//    echo "<script>alert('".$meeting_info."');</script>";
    if($meeting_info!=''){
        $query=mysqli_query($con,"UPDATE appointment SET meeting_info='$meeting_info', status='link_shared' where id='$id'");
    }else{
        $query=mysqli_query($con,"UPDATE appointment SET meeting_info='$meeting_info', status='pending' where id='$id'");
    }
    if($query){
        if($meeting_info!=''){
            $text = urlencode($meeting_info);
            file_get_contents("http://66.45.237.70/api.php?username=01795031446&password=A83FCVSX&number=$mobile_number&message=$text");
        }
        echo "<script>alert('Meeting information shared via SMS.');</script>";
    }else{
        echo "<script>alert('Execution Failed.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment History</title>

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
                        <h1 class="m-0">Appointment History</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="appointment-history.php">Appointment History</a></li>
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
                                    <th>Fees</th>
                                <?php } ?>
                                <th>Symptoms</th>
                                <th>Date</th>
                                <th>Slot</th>
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
                                        <td class="p-0 m-0"><?php echo $doctor_row['fullName']; ?></td>
                                        <td class="p-0 m-0"><?php echo $doctor_row['mobile_number']; ?></td>
                                        <td class="p-0 m-0"><?php echo $row['doctor_specialization']; ?></td>
                                    <?php } ?>
                                    <?php if(isset($_SESSION['user_details']['role']) && $_SESSION['user_details']['role']=='admin' || $_SESSION['user_details']['role']=='doctor'){ ?>
                                        <?php
                                        $patient_id = $row['patient_id'];
                                        $patient=mysqli_query($con,"select * from users where id='$patient_id'");
                                        $patient_row=mysqli_fetch_array($patient);
                                        ?>
                                        <td class="p-0 m-0"><?php echo $patient_row['fullName']; ?></td>
                                        <td class="p-0 m-0"><?php echo $patient_row['mobile_number']; ?></td>
                                        <td class="p-0 m-0"><?php echo $row['fees']; ?></td>
                                    <?php } ?>
                                    <td class="p-0 m-0"><?php echo $row['symptoms']; ?></td>
                                    <td class="p-0 m-0"><?php echo $row['appointment_date']; ?></td>
                                    <td class="p-0 m-0"><?php echo $row['appointment_time_slot']; ?></td>
                                    <td class="p-0 m-0"><?php if($row['status']=='pending'){echo '<span class="badge badge-warning">Pending</span>';}else if($row['status']=='link_shared'){ echo '<span class="badge badge-primary">Schedule Confirmed</span>';}else if($row['status']=='done'){ echo '<span class="badge badge-success">Done</span>';}else{ echo '<span class="badge badge-danger">Canceled</span>';}; ?></td>
                                    <td class="p-0 m-0">
                                        <?php if($row['status']=='pending' || $row['status']=='link_shared'){ ?>
                                            <?php if($_SESSION['user_details']['role']=='doctor'){ ?>
                                                <a href="appointment-history.php?id=<?php echo $row['id']?>&action=done" onClick="return confirm('Are you sure you want to complete?')" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
                                                <a href="javascript:void(0)" onClick="linkShared('<?php echo $row['id']?>')" class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i></a>
                                            <?php } ?>
                                            <a href="appointment-history.php?id=<?php echo $row['id']?>&action=canceled" onClick="return confirm('Are you sure you want to canceled?')" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                            <a href="appointment-history.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        <?php } ?>
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

    <div class="modal" id="link_shared" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share Link With Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="input-group">
                            <lebel class="text-bold" style="width: 100%;">Patient Mobile Number</lebel>
                            <br/>
                            <input class="form-control" name="mobile_number" id="mobile_number" placeholder="Patient Mobile Number...." readonly style="100%;"/>
                        </div>
                        <br/>
                        <div class="input-group">
                            <lebel class="text-bold">SMS Body</lebel>
                            <textarea class="form-control" name="meeting_info" id="meeting_info" placeholder="Enter Meeting Links...." style="width: 100%; height: 200px;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="aId" name="id" value="" required/>
                        <button type="submit" name="submit" class="btn btn-success">Save & Send Via SMS</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

    function linkShared(id){
        if(id>0){
            $.ajax({
                type: "POST",
                url: "get-appointment-data.php",
                data:'id='+id,
                dataType:'JSON',
                success: function(data){
                    $('#mobile_number').val(data.mobile_number);
                    $('#meeting_info').text(data.meeting_info);
                    $('#aId').val(id);
                    $('#link_shared').modal('show');
                }
            });
        }
    }
</script>
</body>
</html>
