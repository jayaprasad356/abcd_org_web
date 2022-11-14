<?php

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $uid = $_POST['uid'];
    
    $paytmNumber = $_POST['paytmNumber'];
    $amount = $_POST['amount'];

    require_once 'connect.php';

    $sql = "INSERT INTO withdraw_table (uid, paytmNumber, amount) VALUES ('$uid', '$paytmNumber', '$amount')";

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