<?php
include('include/config.php');
$con = connection();
if(!empty($_POST["specialization"]))
{
    $sql=mysqli_query($con,"select * from users where specialization='".$_POST['specialization']."'");
    $output = '<option selected="selected">Select Doctor</option>';
    while($row=mysqli_fetch_array($sql)){
        $output .= '<option value="'.$row['id'].'">'.$row['fullName'].'</option>';
    }
    echo $output;
}

if(!empty($_POST["doctor_id"]))
{
    $output=mysqli_query($con,"select * from users where id='".$_POST['doctor_id']."'");
    while($row=mysqli_fetch_array($output)){
        echo $row['fees'];
    }
}
?>