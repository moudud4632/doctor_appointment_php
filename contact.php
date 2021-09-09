<?php
    include_once('include/config.php');
    include_once('include/session.php');
    if(isset($_POST['submit'])) {
        $name=$_POST['fullname'];
        $email=$_POST['emailid'];
        $mobileno=$_POST['mobileno'];
        $description=$_POST['description'];
        $conn = connection();
        $query=mysqli_query($conn, "insert into tblcontactus(fullname,email,contactno,message) value('$name','$email','$mobileno','$description')");
        echo "<script>alert('Information successfully submitted');</script>";
        echo "<script>window.location.href ='contact.php'</script>";
    }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Contact</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
	</head>
	<body style="background-color: white;">
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
                        <li><a href="index.php">Home</a></li>
                        <li class="active"><a href="contact.php">Contact</a></li>
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
		   <div class="wrap">
		   	<div class="contact">
		   	<div class="section group">				
				<div class="col span_1_of_3">
					
      			<div class="company_address">
				     	<h2>Care Address  :</h2>
						    	<p>4/7 Sobhanbag Mirpur Road Dhaka</p>
						   		<p>1207</p>
						   		<p>Bangladesh</p>
				   		<p>Phone:+8660194587652</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span>info@diu.edu.bd</span></p>
				   	
				   </div>
				</div>				
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h2>Contact Us</h2>
					    <form name="contactus" method="post">
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input type="text" name="fullname" required="true" value=""></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="email" name="emailid" required="ture" value=""></span>
						    </div>
						    <div>
						     	<span><label>MOBILE.NO</label></span>
						    	<span><input type="text" name="mobileno" required="true" value=""></span>
						    </div>
						    <div>
						    	<span><label>Description</label></span>
						    	<span><textarea name="description" required="true"> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" name="submit" value="Submit"></span>
						  </div>
					    </form>
				    </div>
  				</div>				
			  </div>
	</div>
			</div>
		<!--end-wrap-->
	</body>
</html>

