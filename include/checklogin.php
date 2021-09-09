<?php
    function check_login(){
        if(strlen($_SESSION['login'])==0) {
            $host = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra="login.php";
            header("Location: http://$host$uri/$extra");
        }
    }

    function check_session(){
        if(strlen($_SESSION['login'])!=0) {
            $host = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra="dashboard.php";
            header("Location: http://$host$uri/$extra");
        }
    }
?>