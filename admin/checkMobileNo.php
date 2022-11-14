<?php
require_once 'connect.php';
$phone = $_GET['phone'];
    //$allow = $_POST['allow'];
    $device_id = $_GETT['device_id'];
$sql2="SELECT * FROM `USER_DETAILS` WHERE `mobile`='$phone' OR `device_id`='$device_id'";
$result1=mysqli_query($conn, $sql2);
$num= mysqli_num_rows($result1);
echo $numr;
if($num > 0)
{

        $result["success"] = "5";
        $result["message"] = "success";

        echo json_encode($result);
        mysqli_close($conn);
}
?>