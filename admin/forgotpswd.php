<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //$name = $_POST['name'];
    $uid = $_POST['uid'];
    $password = $_POST['password'];
     $mobile = $_POST['mobile'];
   // $email = $_POST['email'];
   // $city = $_POST['city'];
   // $profile_pic = $_POST['profile_pic'];

    require_once 'connect.php';

    
   $sql = "UPDATE `USER_DETAILS` SET `password`='$password' WHERE `mobile`='$mobile' ";

    if(mysqli_query($conn, $sql)) {

          $result["success"] = "1";
          $result["message"] = "success";

          echo json_encode($result);
          mysqli_close($conn);
      }
  }

else{

   $result["success"] = "0";
   $result["message"] = "error!";
   echo json_encode($result);

   mysqli_close($conn);
}

?>


