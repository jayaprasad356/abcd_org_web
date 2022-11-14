<?php 
    session_start();
     include("../includes/connection.php");
  
    include("../includes/function.php");
    include("../language/language.php"); 

      
    if(isset($_SESSION['unique_id'])){
       
   
        $outgoing_id = $_SESSION['unique_id'];
        $mobile=$outgoing_id;
         $ticket_id = $_SESSION['ticket_id'];
        $incoming_id = mysqli_real_escape_string($mysqli, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($mysqli, $_POST['message']);
         $message1 = $_POST['message'];

        if(!empty($message)){
           /* $sql = mysqli_query($mysqli, "INSERT INTO `CHATS` (`id`, `ticket_id`, `message`, `date`, `sender_name`, `recieverName`, `user_id`, `artist_id`, `send_by`, `send_at`, `chat_type`, `image`, `status`, `msglive`) VALUES (NULL, '0', '$message', '', 'KINGSON KAPOOR', 'Admin', '8251941210', '0', '8251941210', '', '1', '', '1', '1')") or die();*/


     $data = array(      
              'user_id'  =>  $_SESSION['unique_id'],    
              'ticket_id'  =>  $_SESSION['ticket_id'],   
              'message'  =>  $_POST['message'],
              'sender_name'  =>  "Admin",
              'recieverName'  =>  $_SESSION['name'],
              'artist_id'  => "Admin",
              'send_by'  =>  "Admin",
               'chat_type'  =>  '1',
              'image'  =>  "",
              'send_by'  => "Admin",
               'status'  =>  '1',
                'date'  =>  $date,
               'send_at'  =>  $date,
               'msglive'  =>  '1',
                          );

//print_r($data);exit;
     $qry=Insert('CHATS', $data);
    // firebase_notification("1",$send_by,$user_id, "Chat" ,$message1,CHAT_NOTIFICATION);
     /*  $user_id='8251941210';
      $send_by='8251941210';
      $message="";
firebase_notification("1",$send_by,$user_id, "Chat" ,$message,CHAT_NOTIFICATION);*/
 $user_id=$outgoing_id;
        $send_by="Admin";
 // print_r('hello');exit;
   
     if($qry!=""){
   
firebase_notification("1",$send_by,$user_id, $ticket_id ,$message1,CHAT_NOTIFICATION);

     }
     //print_r("hello");exit;

    /* INSERT INTO `CHATS` (`id`, `ticket_id`, `message`, `date`, `sender_name`, `recieverName`, `user_id`, `artist_id`, `send_by`, `send_at`, `chat_type`, `image`, `status`, `msglive`) VALUES (NULL, '0', 'Ndnxn', '', 'KINGSON KAPOOR', 'Admin', '8251941210', '0', '8251941210', '', '1', '', '1', '1')*/

        }
    }else{
        header("location: ../login.php");
    }


    
?>