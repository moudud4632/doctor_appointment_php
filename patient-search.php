<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$_SESSION['user_details']=user_details();
$_SESSION['active_menu']='patient-search';
$con = connection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Patient</title>

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
                        <h1 class="m-0">Search Patient</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Add</li>
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" method="post" name="search">

                                    <div class="form-group">
                                        <label for="doctorname">
                                            Search by Name/Mobile No.
                                        </label>
                                        <input type="text" name="searchdata" id="searchdata" class="form-control" value="" required='true'>
                                    </div>

                                    <button type="submit" name="search" id="submit" class="btn btn-o btn-primary">
                                        Search
                                    </button>
                                </form>
                                <?php
                                if(isset($_POST['search']))
                                {

                                $sdata=$_POST['searchdata'];
                                ?>
                                <h4 align="center">Result against "<?php echo $sdata;?>" keyword </h4>

                                <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Patient Name</th>
                                        <th>Mobile Number</th>
                                        <th>Gender </th>
                                        <th>Creation Date </th>
                                        <th>Update Date </th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql=mysqli_query($con,"select * from users where fullName like '%$sdata%'|| mobile_number like '%$sdata%' AND role='patient'");
                                    $num=mysqli_num_rows($sql);
                                    if($num>0){
                                        $cnt=1;
                                        while($row=mysqli_fetch_array($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td class="center"><?php echo $cnt;?>.</td>
                                                <td class="hidden-xs"><?php echo $row['fullName'];?></td>
                                                <td><?php echo $row['mobile_number'];?></td>
                                                <td><?php echo ucfirst($row['gender']);?></td>
                                                <td><?php echo $row['created_at'];?></td>
                                                <td><?php echo $row['updated_at'];?>
                                                </td>
                                                <td>
                                                    <a target="_blank" href="view.php?id=<?php echo $row['id'];?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                    <a target="_blank" href="edit-patient.php?id=<?php echo $row['id'];?>" class="btn btn-primary btn-sm"><i class="fa fa-user-edit"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $cnt=$cnt+1;
                                        } } else { ?>
                                        <tr>
                                            <td colspan="8"> No record found against this search</td>

                                        </tr>

                                    <?php }} ?></tbody>
                                </table>
                            </div>
                        </div>
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
