<?php
    function connection(){
        define('DB_SERVER','localhost');
        define('DB_USER','root');
        define('DB_PASS' ,'');
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
            'name' => "Care",
            'short_name' => "Care",
            'developer' => "Team Care",
            'developer_url' => "https://teamcare.com",
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