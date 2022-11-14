<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    date_default_timezone_set("Asia/Calcutta");
    $coins = $_POST['coins'];
    $mobile = $_POST['mobile'];
    $txn=$_POST['type'];
    $status="CREDIT";
    $name=$_POST['name'];
    $date=date("d-m-Y | h:i:s a");

    require_once 'connect.php';

    $sql = "INSERT INTO `WALLET`(`ID`, `username`, `mobile`, `amount`, `status`, `txn`, `date`) VALUES (NULL,'$name','$mobile','$coins','$status','$txn','$date')";
  
    if(mysqli_query($conn, $sql)) {

        
    if($txn=="MathQuiz")
    {
        $hour=(date("H")*60)+date("i");
        $sql_quiz="UPDATE `DAILY` SET `quiz_hour`='$hour',`date`='$date' WHERE `mobile`='$mobile'";
        mysqli_query($conn, $sql_quiz);
    }


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


