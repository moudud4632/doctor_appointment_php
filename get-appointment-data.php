<?php
include('include/config.php');
$con = connection();
if(!empty($_POST["id"]))
{
    $appointment = mysqli_query($con,"select * from appointment where id='".$_POST['id']."'");
    $row=mysqli_fetch_array($appointment);
    $doctor = mysqli_query($con,"select * from users where id='".$row['doctor_id']."'");
    $doctor_row=mysqli_fetch_array($doctor);
    $patient = mysqli_query($con,"select * from users where id='".$row['patient_id']."'");
    $patient_row=mysqli_fetch_array($patient);
    $output = array();
    $output['mobile_number'] = $patient_row['mobile_number'];
//    $output['meeting_info'] = $row['meeting_info'];
    if($row['meeting_info']==''){
        $output['meeting_info'] = 'Dear '.$patient_row['fullName'].', Your appointment has been confirmed with '.$doctor_row['fullName'].' at '.$row["appointment_date"].' ('.$row["appointment_time_slot"].'). Please join with this link https://example.com. Powered by '.app('name');
    }else{
        $output['meeting_info'] = $row['meeting_info'];
    }

    echo json_encode($output);
}
?>