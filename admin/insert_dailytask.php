<?php include("includes/connection.php");
      include("includes/session_check.php"); 
 date_default_timezone_set("Asia/Calcutta");
  //$date=date("d-m-Y | h:i:s a");
   $date=strtotime("now");
  // print_r($_POST);exit;
if($_POST['status_active_id'])
  {
     // echo('hii');exit;
     $addTimer=$_POST['addtimer'];
     // alert("done4me");exit;
     // $data = array('status'  => 'PAID','verified_date'=>$date,'remarks'=>$addTimer);

      $id=$_POST['status_active_id'];
    // $refmobile=$_POST['mobile'];
    
  // $edit_status=Update('PAYMENT_VERIFICATION', $data, "WHERE id = $id ");

     $query= "  UPDATE `PAYMENT_VERIFICATION` SET `status` = 'PAID',`verified_date`=$date,`remarks`= '$addTimer' WHERE id = $id ";


               
                   
                  //  print_r($query);exit;
                 

              if(mysqli_query($mysqli, $query)) 
              {

                if(mysqli_affected_rows($mysqli)>=1)
              { 
     //$users_result=mysqli_query($mysqli,$edit_status);
     //print_r($edit_status);exit;
      // print_r(mysqli_affected_rows( $mysqli));exit;
     
     
        
      /*if($edit_status != 0)
              {*/
                $cat_id=mysqli_affected_rows($mysqli);
                $res=array('status'=>'200','msg'=>' Data Updated successfully ! ','id'=>$cat_id);  
              echo json_encode($res);exit;
    
                }else{
                   $res=array('status'=>'201','msg'=>' Data Updation Failed ! ','id'=>$cat_id);  
                    echo json_encode($res);exit;
                }

            }else {
                echo "Error inserting record: " . $mysqli->error;
                $res=array('status'=>'201','msg'=>'Details Updation Failed ! '.$mysqli->error);  
                    echo json_encode($res);exit;
              }
             
  }
?>


