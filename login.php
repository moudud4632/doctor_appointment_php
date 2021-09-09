<?php
    include_once('include/config.php');
    include_once('include/checklogin.php');
    session_start();
    error_reporting(0);
    check_session();
    if(isset($_POST['submit'])) {
        $con = connection();
        $ret=mysqli_query($con,"SELECT * FROM users WHERE email='".$_POST['username']."' and password='".md5($_POST['password'])."'");
        $num=mysqli_fetch_array($ret);
        if($num>0) {
            $extra="dashboard.php";//
            $_SESSION['login']=$_POST['username'];
            $_SESSION['id']=$num['id'];
            $host=$_SERVER['HTTP_HOST'];
            $uip=$_SERVER['REMOTE_ADDR'];
            $status=1;
            // For stroing log if user login successfull
            $log=mysqli_query($con,"insert into userlog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['login']."','$uip','$status')");
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            exit();
        }else{
            // For stroing log if user login unsuccessfull
            $_SESSION['login']='';
            $uip=$_SERVER['REMOTE_ADDR'];
            $status=0;
            mysqli_query($con,"insert into userlog(username,userip,status) values('".$_POST['username']."','$uip','$status')");
            $_SESSION['errmsg']="Invalid username or password";
            $extra="login.php";
            $host  = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            exit();
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Login</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body style="background-color: white;">
<!--start-wrap-->

<!--start-header-->
<div class="header">
    <div class="wrap" style="width: 100%; background-color: #3391E7;">
        <!--start-logo-->
        <div class="logo" style="margin: 25px 0 0 22px;">
            <a href="index.php" style="font-size: 22px; color: white !important;"><?php echo strtoupper(app('name')) ?></a>
        </div>
        <!--end-logo-->
        <!--start-top-nav-->
        <div class="top-nav">
            <ul style="font-size: 16px;">
                <li><a href="index.php">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="#">Blood Bank</a></li>
                <li><a href="#">Shop</a></li>
            </ul>
        </div>
        <div class="clear"> </div>
        <!--end-top-nav-->
    </div>
    <!--end-header-->
</div>
<div class="clear"> </div>
<div style="width: 100%; height: 100%;">
    <div class="login-box" style="margin: 0 auto; margin-top: 20px;">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php if(isset($_SESSION['errmsg']) && $_SESSION['errmsg']!=''){ ?>
                    <p><span style="color:red;"><?php echo $_SESSION['errmsg']; ?></span></p>
                <?php } ?>
                <form method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" class="form-control" name="username" placeholder="Email">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-1">
                    <a href="forgot_password.php">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="registration.php" class="text-center">Register as a new patient</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
<!--end-wrap-->
<script>
    jQuery(document).ready(function() {
        Main.init();
        Login.init();
    });
</script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

