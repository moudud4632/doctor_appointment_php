<?php
    function connection(){
        define('DB_SERVER','localhost');
        define('DB_USER','root');
        define('DB_PASS' ,'@Moudud123');
        define('DB_NAME', 'doctor_appointment');
        $connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }else{
            return $connection;
        }
    }

    function app($token){
        $data = [
            'name' => "Doctors Appointment & Blood Bank",
            'short_name' => "HMS ERP",
            'developer' => "Moudud Ahamed",
            'developer_url' => "https://e3techno.com",
        ];
        if($token){
            return $data[$token];
        }
    }

    function user_details(){
        if(strlen($_SESSION['login'])!=0) {
            $con = connection();
            $result=mysqli_query($con,"SELECT * FROM users WHERE id=".$_SESSION['id']);
            return $data = mysqli_fetch_array($result);
//            mysqli_close($con);
//            return $data;
        }
    }
?>