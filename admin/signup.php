<?php

if ($_SERVER['REQUEST_METHOD'] =='POST'){
    require_once 'connect.php';
date_default_timezone_set("Asia/Calcutta");
    $uid = $_POST['uni'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $coins = $_POST['coins'];
	$spins = $_POST['spins'];
    //$referCode = $_POST['referCode'];
    $referCode ="C2C".rand(1000,9999);
    $isRefered = $_POST['isRefered'];
    $phone = $_POST['phone'];
    $allow = $_POST['allow'];
    $joining_date=date("d-m-Y | h:i:s a");
   // $password = password_hash($password, PASSWORD_DEFAULT);

    

    $sql = "INSERT INTO `USER_DETAILS`(`id`, `mobile`, `password`, `name`, `city`, `email`, `wallet`,`total_paid` `user_referal_code`, `reffered_by`,`total_referals`, `allow`, `device_id`, `profile_pic`, `active date`, `uid`, `joining_time`) VALUES (NULL,'$phone','$password','$name','India','$email','15','','$referCode','$isRefered','','YES','','','0','$uid','$joining_date');";


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

?>