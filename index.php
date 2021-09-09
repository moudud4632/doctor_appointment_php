<?php
    include_once('include/config.php');
    include_once('include/session.php');
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo strtoupper(app('name')) ?></title>
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/responsiveslides.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/responsiveslides.min.js"></script>
        <script>
            // You can also use "$(window).load(function() {"
            $(function () {
                // Slideshow 1
                $("#slider1").responsiveSlides({
                    maxwidth: 1600,
                    speed: 600
                });
            });
        </script>
	</head>
	<body>
		<!--start-wrap-->
			<!--start-header-->
		<div class="header">
            <div class="wrap" style="width: 100%; background-color: #3391E7;">
                <!--start-logo-->
                <div class="logo" style="margin: 25px 0 0 22px;">
                    <a href="index.php" style="font-size: 24px; color: white !important;"><?php echo strtoupper(app('name')) ?></a>
                </div>
				<!--end-logo-->
				<!--start-top-nav-->
				<div class="top-nav">
                    <ul>
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="#">Blood Bank</a></li>
                        <li><a href="#">Shop</a></li>
                    </ul>
				</div>
				<div class="clear"></div>
				<!--end-top-nav-->
			</div>
			<!--end-header-->
		</div>
		<div class="clear"></div>
        <!--start-image-slider---->
        <div class="image-slider">
            <!-- Slideshow 1 -->
            <ul class="rslides" id="slider1">
              <li><img src="images/slider-image5.jpg" alt=""></li>
              <li><img src="images/slider-image4.jpg" alt=""></li>
              <li><img src="images/slider-image5.jpg" alt=""></li>
            </ul>
             <!-- Slideshow 2 -->
        </div>
        <!--End-image-slider---->
        <div class="clear"> </div>
        <div class="content-grids">
            <div class="wrap">
                <div class="section group">
                    <div class="listview_1_of_3 images_1_of_3">
                        <div class="listimg listimg_1_of_2">
                              <img src="images/grid-img3.png">
                        </div>
                        <div class="text list_1_of_2">
                              <h3>Patients</h3>
                              <p>Register & Book Appointment</p>
                              <div class="button"><span><a href="login.php">Click Here</a></span></div>
                        </div>
                    </div>
                    <div class="listview_1_of_3 images_1_of_3">
                        <div class="listimg listimg_1_of_2">
                              <img src="images/grid-img1.png">
                        </div>
                        <div class="text list_1_of_2">
                            <h3>Doctors Login</h3>
                            <p>Login & Appointment History</p>
                            <div class="button"><span><a href="login.php">Click Here</a></span></div>
                        </div>
                    </div>
                    <div class="listview_1_of_3 images_1_of_3">
                        <div class="listimg listimg_1_of_2">
                              <img src="images/grid-img2.png">
                        </div>
                        <div class="text list_1_of_2">
                            <h3>Admin Login</h3>
                            <p>Login & Manage User</p>
                            <div class="button"><span><a href="login.php">Click Here</a></span></div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
		<!--end-wrap-->
	</body>
</html>

