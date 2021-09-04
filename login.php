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
            $_SESSION['login']=$_POST['username'];
            $uip=$_SERVER['REMOTE_ADDR'];
            $status=0;
            mysqli_query($con,"insert into userlog(username,userip,status) values('".$_SESSION['login']."','$uip','$status')");
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
    <link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
</head>
<body>
<!--start-wrap-->

<!--start-header-->
<div class="header">
    <div class="wrap">
        <!--start-logo-->
        <div class="logo">
            <a href="index.php" style="font-size: 30px;"><?php echo strtoupper(app('name')) ?></a>
        </div>
        <!--end-logo-->
        <!--start-top-nav-->
        <div class="top-nav">
            <ul>
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
<div style="width: 100%; height: 100%; background-color: white;">
    <div style="width: 40%; margin: 0 auto; padding-top: 100px;">
        <div class="box-login">
            <form class="form-login" method="post">
                <fieldset>
                    <legend>Sign in to your account</legend>
                    <?php if(isset($_SESSION['errmsg']) && $_SESSION['errmsg']!=''){ ?>
                        <p><span style="color:red;"><?php echo $_SESSION['errmsg']; ?></span></p>
                    <?php } ?>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>
                    <div class="form-group form-actions">
                        <span class="input-icon">
                            <input type="password" class="form-control password" name="password" placeholder="Password">
                            <i class="fa fa-lock"></i>
                        </span>
                        <a href="forgot_password.php">Forgot Password ?</a>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary pull-left" name="submit">Login <i class="fa fa-arrow-circle-right"></i></button>
                        <div class="text-right pull-right" style="margin-top: 10px;">
                            Don't have an account yet?
                            <a href="registration.php">
                                Create an account
                            </a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!--end-wrap-->

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>

    <script src="assets/js/main.js"></script>

    <script src="assets/js/login.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            Login.init();
        });
    </script>
</body>
</html>

