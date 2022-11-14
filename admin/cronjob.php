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


 {
        $refrCodead="SELECT `admin_refer_code` FROM `ADMIN_ROLE` ";
         $resultcoad = mysqli_query($mysqli,$refrCodead);
           // $rowcoad = mysqli_fetch_assoc($resultcoad);
            $rowcountcoad=mysqli_num_rows($resultcoad);
             //print_r($rowcoad);
               //exit;
            
               $i = 0;
                $count=1;
                while ($rowcoad = mysqli_fetch_assoc($resultcoad)) {
                     // print_r($rowcoad);
                   $refferCodeme =${"admincode$count"};
                    ${"admincode$count"} = $rowcoad['admin_refer_code'];
                    $reffered_by=$rowcoad['admin_refer_code'];
              //   echo "king";
                    if($reffered_by!="")
                    {

                      //  print_r($reffered_by);exit;
                      
                      
                      $sql3=" INSERT INTO `ADMINS1_DATA` (`id`, `admin_user_id`, `admin_refer_code`, `today_app_joining`, `today_joining_paid_no`, `total_jpaid_amnt`, `today_payment_request`, `today_payment_done`, `today_total_transaction`, `today_date`) VALUES (NULL, (SELECT `admin_user_id` FROM `ADMIN_ROLE` WHERE `id`='$count'),'$reffered_by', '', '', '', '', '', '', '$date')";

                    $result3=mysqli_query($mysqli, $sql3);

                     //print_r($refferCode);
                   
                     $i++;
                    $count++;
                }
        
      
              /* if( $reffered_by==""){
                    $refferCode =createUserCode($admincode1);
                }else if (strpos($reffered_by,$admincode1) !== false) 
             
                    {
                   //  $refferCode =$admincode1.rand(1000,9999);
                      $refferCode =createUserCode($admincode1);
                     //echo $refferCode;
                    }
                else if  (strpos($reffered_by,$admincode2) !== false) 
             
                    {
                        $refferCode =createUserCode($admincode2);
                    // $refferCode =$admincode2.rand(1000,9999);
                     //echo $refferCode;
                    } 
                else if  (strpos($reffered_by,$admincode3) !== false) 
             
                    {
                         $refferCode =createUserCode($admincode3);
                    // $refferCode =$admincode3.rand(1000,9999);
                    // echo $refferCode;
                    } else
                    
                    {
                         $refferCode =createUserCode($admincode);
                       //  $refferCode ="DBAA".rand(1000,9999);
                          echo $refferCode;
                    }*/
                   // echo $refferCode;
                   // print_r($refferCode);exit;
        $qry1="INSERT INTO `USER_DETAILS` (`id`, `mobile`, `password`, `name`, `city`, `email`, `wallet`,`bonus_balance`, `total_qr_generation`, `correct_qr_generation`, `total_paid`, `user_referal_code`, `reffered_by`, `total_referals`, `reffered_paid`, `joining_paid`, `allow`, `device_id`, `profile_pic`, `active_date`, `onesignal_playerid`, `onesignal_pushtoken`, `joining_time`) VALUES ('0', '$phone', '$password', '$name', '$city', '$email', '0',(SELECT `joining_bonus` FROM `ADMIN` WHERE `id`=1), '0', '0', '0', '$refferCode', '$reffered_by', '$total_refferals', '', '$joining_paid', '$allow', '$device_id', '', '$reg_date', '$onesignalplayerid', '$onesignalpushtoken', '$joining_date')";
        
       // print_r($qry1);exit;
             $result1=mysqli_query($mysqli,$qry1);
      
      if(mysqli_insert_id($mysqli)>0)
      
         {
        
         
 
        $set['abcdapp'][]=array('msg' => "Registration successflly...! \n click ok To Continue ",'success'=>'1'); 
        
           }

      


       

    
    
        }


}
?>
