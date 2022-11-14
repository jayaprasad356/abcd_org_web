<?php
// require_once 'connect.php';
 include("includes/connection.php");
date_default_timezone_set("Asia/Calcutta");
$date=date("d-m-Y | h:i:s a");

$id=$_GET['id'];
if($id=='DSXk1BylpHOkvg78cwM')
{
/*if($date!="")
{
//$sql="UPDATE `DAILY` SET `spin`='0',`watch`='0',`scratch`='0',`quiz`='0',`spin_hour`='0',`quiz_hour`='0',`scratch_hour`='0',`watch_hour`='0',`date`='$date'";

$sql=" INSERT INTO `ADMINS1_DATA` (`id`, `admin_user_id`, `admin_refer_code`, `today_app_joining`, `today_joining_paid_no`, `total_jpaid_amnt`, `today_payment_request`, `today_payment_done`, `today_total_transaction`, `today_date`) VALUES (NULL, (SELECT `admin_user_id` FROM `ADMIN_ROLE` WHERE `id`='1'), (SELECT `admin_refer_code` FROM `ADMIN_ROLE` WHERE `id`='1'), '', '', '', '', '', '', '$date')";

$result=mysqli_query($mysqli, $sql);
 //print_r($result1);exit;
 
  if(mysqli_insert_id($mysqli)>0)
  
      
         {
  
  $sql1=" INSERT INTO `ADMINS1_DATA` (`id`, `admin_user_id`, `admin_refer_code`, `today_app_joining`, `today_joining_paid_no`, `total_jpaid_amnt`, `today_payment_request`, `today_payment_done`, `today_total_transaction`, `today_date`) VALUES (NULL, (SELECT `admin_user_id` FROM `ADMIN_ROLE` WHERE `id`='2'), (SELECT `admin_refer_code` FROM `ADMIN_ROLE` WHERE `id`='2'), '', '', '', '', '', '', '$date')";

$result1=mysqli_query($mysqli, $sql1);
 //print_r($result1);exit;
 
 
   if(mysqli_insert_id($mysqli)>0)
  
      
         {
             
             
     $sql2=" INSERT INTO `ADMINS1_DATA` (`id`, `admin_user_id`, `admin_refer_code`, `today_app_joining`, `today_joining_paid_no`, `total_jpaid_amnt`, `today_payment_request`, `today_payment_done`, `today_total_transaction`, `today_date`) VALUES (NULL, (SELECT `admin_user_id` FROM `ADMIN_ROLE` WHERE `id`='3'), (SELECT `admin_refer_code` FROM `ADMIN_ROLE` WHERE `id`='3'), '', '', '', '', '', '', '$date')";

          $result2=mysqli_query($mysqli, $sql2);
       
            if(mysqli_insert_id($mysqli)>0)
      
         {
             
             
     $sql3=" INSERT INTO `ADMINS1_DATA` (`id`, `admin_user_id`, `admin_refer_code`, `today_app_joining`, `today_joining_paid_no`, `total_jpaid_amnt`, `today_payment_request`, `today_payment_done`, `today_total_transaction`, `today_date`) VALUES (NULL, (SELECT `admin_user_id` FROM `ADMIN_ROLE` WHERE `id`='4'), (SELECT `admin_refer_code` FROM `ADMIN_ROLE` WHERE `id`='4'), '', '', '', '', '', '', '$date')";

          $result3=mysqli_query($mysqli, $sql3);
         
  
         }
         }
}
        mysqli_close($mysqli);
echo "cronjob has been done on ".$date;  
}

else{
    echo "cronjob has been failed on ".$date;
}
*/


 
        $refrCodead="SELECT `admin_refer_code` FROM `ADMIN_ROLE` ";
         $resultcoad = mysqli_query($mysqli,$refrCodead);
           // $rowcoad = mysqli_fetch_assoc($resultcoad);
           // $rowcountcoad=mysqli_num_rows($resultcoad);
            // print_r($resultcoad);exit;
               //exit;
            
               $i = 0;
                $count=1;
                while ($rowcoad =mysqli_fetch_assoc($resultcoad)) {
                     // print_r($rowcoad);
                  /* $refferCodeme =${"admincode$count"};
                    ${"admincode$count"} = $rowcoad['admin_refer_code'];*/
                    $reffered_by=$rowcoad['admin_refer_code'];
              //   echo "king";
                    if($reffered_by!="")
                    {

                       //print_r($reffered_by);exit;
                      
                      
                      $sql3=" INSERT INTO `ADMINS1_DATA` (`id`, `admin_user_id`, `admin_refer_code`, `today_app_joining`, `today_joining_paid_no`, `total_jpaid_amnt`, `today_payment_request`, `today_payment_done`, `today_total_transaction`, `today_date`) VALUES (NULL, (SELECT `admin_user_id` FROM `ADMIN_ROLE` WHERE `admin_refer_code`='$reffered_by'),'$reffered_by', '', '', '', '', '', '', '$date')";

                    $result3=mysqli_query($mysqli, $sql3);

                     //print_r($refferCode);
                   
                     
                }
                     $i++;
                    $count++;
            }
        
      
              


}
?>
