<?php

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $uid = $_POST['mobile'];
    $name = $_POST['name'];
    $amount = $_POST['ammount'];
    $txn = $_POST['txn'];
    $date = $_POST['date'];
     date_default_timezone_set("Asia/Calcutta");
    $txndate=date("d-m-Y | h:i:s a");

    
    $paytmNumber = $_POST['paytmNumber'];
    $amount = $_POST['amount'];

    require_once 'connect.php';

    $sql = "INSERT INTO `WALLET` (`ID`, `username`, `mobile`, `amount`, `status`, `txn`, `date`) VALUES ('NULL', '', '$mobile', '$amount', '$txn', '$txn', '$txndate')";

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