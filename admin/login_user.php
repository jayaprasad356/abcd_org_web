<?php

if ($_SERVER['REQUEST_METHOD'] =='POST'){
date_default_timezone_set("Asia/Calcutta");
    $email = $_POST['email'];
    $password = $_POST['password'];
    //$joining_date=date("d-m-Y | h:i:s a");
   // $password = password_hash($password, PASSWORD_DEFAULT);

    require_once 'connect.php';

   $sql = "SELECT * FROM `USER_DETAILS` WHERE `mobile`='$email'";
   $result1=mysqli_query($conn, $sql);
   $row2=mysqli_fetch_assoc($result1);
   $usercount= mysqli_num_rows($result1);
    if ($usercount== 0 || $usercount== '') {
        $result["success"] = "0";
        $result["message"] = "Mobile not registered..!";
        
        echo json_encode($result);
        mysqli_close($conn);

    }elseif($row2['mobile']==$email && $row2['password']==$password) {
        
        $result["success"] = "1";
        $result["message"] = "success";
        $result["email"] = $row2['email'];
        echo json_encode($result);
        mysqli_close($conn);
    }
    
    else {

        $result["success"] = "2";
        $result["message"] = "Incorrect password...!";

        echo json_encode($result);
        mysqli_close($conn);
    }
}

?>