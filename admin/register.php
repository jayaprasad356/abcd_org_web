
<?php
include 'connect.php';
if ($_SERVER['REQUEST_METHOD'] =='POST')
{
    require_once 'connect.php';
date_default_timezone_set("Asia/Calcutta");
    $uid = $_POST['uid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $coins = $_POST['coins'];
    $spins = $_POST['spins'];
    //$referCode = $_POST['referCode'];
    $referCode ="SPT".rand(1000,9999);
    $isRefered = $_POST['isRefered'];
    $phone = $_POST['phone'];
    $allow = $_POST['allow'];
    $device_id = $_POST['device_id'];
    $onesignalplayerid=$_POST['onesignalplayerid'];
    $onesignalpushtoken=$_POST['onesignalpushtoken'];
    $joining_date=date("d-m-Y | h:i:s a");
   // $password = password_hash($password, PASSWORD_DEFAULT);
   
   // Query for validation of username and email-id
//$num=0;
$sql="SELECT * FROM `USER_DETAILS` WHERE `mobile`='$phone' OR `device_id`='$device_id'";
$result1=mysqli_query($conn, $sql);
$num= mysqli_num_rows($result1);
if($num > 0)
{

        $result["success"] = "5";
        $result["message"] = "success";

        echo json_encode($result);
        mysqli_close($conn);
}
else{

    $sql = "INSERT INTO `USER_DETAILS`(`id`, `unique_id`, `mobile`, `password`, `name`, `city`, `email`, `wallet`, `total_paid`, `user_referal_code`, `reffered_by`, `total_referals`, `allow`, `device_id`, `profile_pic`, `active_date`, `onesignal_playerid`, `onesignal_pushtoken`, `joining_time`) VALUES (NULL,'$uid','$phone','$password','$name','India','$email','15','0','$referCode','$isRefered','0','$allow','$device_id','','','$onesignalplayerid','$onesignalpushtoken','$joining_date')";


    if ( mysqli_query($conn, $sql) ) {
        $result["success"] = "1";
        $result["message"] = "success";

        echo json_encode($result);
        mysqli_close($conn);

    } else {

        $result["success"] = "0";
        $result["message"] = "error";

        echo json_encode($result);
        mysqli_close($conn);
    }
    

}
}
?>