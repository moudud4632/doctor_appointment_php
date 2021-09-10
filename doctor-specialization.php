<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$_SESSION['user_details']=user_details();
$_SESSION['active_menu']='doctor-specilization';
$con = connection();
if(isset($_POST['create']))
{
    $sql=mysqli_query($con,"insert into specialization(name) values('".$_POST['name']."')");
    $_SESSION['msg']="Doctor Specialization added successfully !!";
    header('location: doctor-specialization.php');
}

if(isset($_POST['update']))
{
    $sql=mysqli_query($con,"update specialization set name='".$_POST['name']."' where id='".$_GET['id']."'");
    $_SESSION['msg']="Doctor Specialization successfully updated!!";
    header('location: doctor-specialization.php');
}

if(isset($_GET['action']) && $_GET['action']=='delete')
{
    mysqli_query($con,"delete from specialization where id = '".$_GET['id']."'");
    $_SESSION['msg']="Data deleted !!";
    header('location: doctor-specialization.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Specialization</title>

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
                        <h1 class="m-0">Doctor Specialization</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="manage-doctor.php">Specialization</a></li>
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
                        <p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></p>
                        <?php if(isset($_GET['action']) && $_GET['action']='edit'){ ?>
                            <?php
                                $get=mysqli_query($con,"select * from specialization where id='".$_GET['id']."'");
                                $sql_data = mysqli_fetch_array($get);
                            ?>
                            <form role="form" method="post" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Doctor Specialization</label><br/>
                                    <input type="text" name="name" class="form-control" value="<?php echo $sql_data['name']; ?>" placeholder="Enter Doctor Specialization" style="width: 89%; float: left;">
                                    <button type="submit" name="update" class="btn btn-o btn-primary" style="width: 10%; float: right;">Update</button>
                                </div>
                            </form>
                        <?php }else{ ?>
                            <form role="form" method="post" >
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Doctor Specialization</label><br/>
                                    <input type="text" name="name" class="form-control"  placeholder="Enter Doctor Specialization" style="width: 89%; float: left;">
                                    <button type="submit" name="create" class="btn btn-o btn-primary" style="width: 10%; float: right;">Submit</button>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover" id="datatable">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Specialization</th>
                                <th class="hidden-xs">Creation Date</th>
                                <th>Updation Date</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql=mysqli_query($con,"select * from specialization");
                            $cnt=1;
                            while($row=mysqli_fetch_array($sql))
                            {
                                ?>
                                <tr>
                                    <td class="center m-0 p-0"><?php echo $cnt;?></td>
                                    <td class="hidden-xs m-0 p-0"><?php echo $row['name'];?></td>
                                    <td class="m-0 p-0"><?php echo $row['created_at'];?></td>
                                    <td class="m-0 p-0"><?php echo $row['updated_at'];?></td>
                                    <td class="m-0 p-0">
                                        <a href="doctor-specialization.php?id=<?php echo $row['id']?>&action=edit" onClick="return confirm('Are you sure you want to edit?')" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                        <a href="doctor-specialization.php?id=<?php echo $row['id']?>&action=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>

                                <?php
                                $cnt=$cnt+1;
                            }?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
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
