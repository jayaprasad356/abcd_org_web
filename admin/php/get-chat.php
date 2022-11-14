<?php 

  //print_r($sql);exit;
 //include("../includes/header.php");
    include("../includes/connection.php");
  
    include("../includes/function.php");
    include("../language/language.php"); 
    session_start();
    if(isset($_SESSION['ticket_id'])){
       // print_r("hello");exit;
       // include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
       // print_r( $outgoing_id );exit;

        $ticket_id = $_SESSION['ticket_id'];
        $incoming_id = mysqli_real_escape_string($mysqli, $_POST['incoming_id']);
        $output = "";



        $sql = "SELECT * FROM  `CHATS` AS M INNER JOIN `USER_DETAILS` AS N   WHERE ( M.user_id='$outgoing_id' AND N.mobile='$outgoing_id' AND ticket_id='$ticket_id') ";

      //  print_r($sql);exit;

        $query = mysqli_query($mysqli, $sql);

        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                
                if($row['send_by'] != $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['message'] .'</p>
                                </div>
                                </div>';
                                $_SESSION['name'] = $row['name'];
                }else{
                   /* $output .= '<div class="chat incoming">
                                <img src="../admin/images/user.png" alt="">
                                <div class="details">
                                    <p>'. $row['message'] .'</p>
                                </div>
                                </div>';*/

                                 $output .= '<div class="chat incoming">
                               
                                <div class="details">
                                    <p>'. $row['message'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>