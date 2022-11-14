  
<?php include("includes/connection.php");
      include("includes/session_check.php"); 
 date_default_timezone_set("Asia/Calcutta");
  //$date=date("d-m-Y | h:i:s a");
   $date=strtotime("now");

   // print_r($_POST);exit;
   if($_POST["id"]){


    if($_POST["id"] != 'new')  
           {  //print_r($_POST);exit;
   
             $output = '';  
             $message = '';  
             $adminName =$_POST["adminName"];
             $adminEmail =$_POST["adminEmail"];
             $adminMobile =$_POST["adminMobile"];
             $adminUserid =$_POST["adminUserid"];
             $admin_refer_code=$_POST["adminRcode"];
             $adminPassword = $_POST["adminPassword"];
             $status = $_POST["status"];
             $manageUserList=$_POST["userDetailsA"];
             $manageWithdrawal =$_POST["withdrawalMa"];
             $managePaymentV =$_POST["managePaymentV"];
             $manageSupportList =$_POST["manageSupportList"];
             $manageRewardP=$_POST["manageRewardP"];
             $mtc =$_POST["mtc"];
             $manageUploadT = $_POST["manageUploadT"];
             $manageNotification = $_POST["msn"];
             $manageAppSettings = $_POST["manageAppSetting"];
             $manageAdminList=$_POST["adminDetailsA"];   
             $id = $_POST["id"];
            
          /* $query="update dmm2user set name='$name', where username='".$_POST["employee_id"]."'";*/
               $query = "  
                UPDATE `ADMIN_ROLE` SET 
                `admin_user_id` = '$adminUserid',`admin_refer_code`='$admin_refer_code',`admin_password`='$adminPassword',`admin_name`='$adminName',`admin_email`='$adminEmail',`admin_mobile`='$adminMobile',`admin_status`='$status',`manageUserList`='$manageUserList',`managePaymentV`='$managePaymentV',`manageSupportList`='$manageSupportList',`manageWithdrawal`='$manageWithdrawal',`manageRewardP`='$manageRewardP', `manageTotalTransaction`='$mtc',`manageNotification`='$manageNotification',`manageAppSettings`='$manageAppSettings',`manageUploadT`='$manageUploadT',`manageAdminList`='$manageAdminList' WHERE `id`='".$_POST["id"]."'";
                 
                
                  //print_r($query);exit;   
                    
                 
                 if(mysqli_query($mysqli, $query)) 
              {

                if(mysqli_affected_rows($mysqli)>=1)
              { 
                $cat_id=mysqli_affected_rows($mysqli);
                $res=array('status'=>'200','msg'=>'Admin Data Updated successfully ! ','id'=>$cat_id);  
              echo json_encode($res);exit;
    
                }else{
                   $res=array('status'=>'201','msg'=>'Admin Data Updation Failed ! ','id'=>$cat_id);  
                    echo json_encode($res);exit;
                }
              } 
            
             else {
                echo "Error inserting record: " . $mysqli->error;
                $res=array('status'=>'201','msg'=>'Details Updation Failed ! '.$mysqli->error);  
                    echo json_encode($res);exit;
              }    

        } else  if($_POST["id"] == 'new')  
  
  {

             $output = '';  
             $message = '';  
             $adminName =$_POST["adminName"];
             $adminEmail =$_POST["adminEmail"];
             $adminMobile =$_POST["adminMobile"];
             $adminUserid =$_POST["adminUserid"];
              $admin_refer_code=$_POST["adminRcode"];
             $adminPassword = $_POST["adminPassword"];
             $status = $_POST["status"];
             $manageUserList=$_POST["userDetailsA"];
             $manageWithdrawal =$_POST["withdrawalMa"];
             $managePaymentV =$_POST["managePaymentV"];
             $manageRewardP=$_POST["manageRewardP"];
             $manageSupportList =$_POST["manageSupportList"];
             $mtc =$_POST["mtc"];
             $manageUploadT = $_POST["manageUploadT"];
             $manageNotification = $_POST["msn"];
             $manageAppSettings = $_POST["manageAppSetting"];
             $manageAdminList=$_POST["adminDetailsA"];   
             $id = $_POST["id"];  

         
                
                   
                $query = "INSERT INTO `ADMIN_ROLE` (`id`, `admin_user_id`, `admin_refer_code`, `admin_password`, `admin_name`, `admin_email`, `admin_mobile`, `profileImg`, `device_token`, `admin_status`, `manageUserList`, `manageWithdrawal`, `managePaymentV`, `manageSupportList`, `manageRewardP`, `manageTotalTransaction`, `manageUploadT`, `manageNotification`, `manageAppSettings`, `manageAdminList`, `admin_login_date`, `admin_joining_date`) VALUES (NULL, '$adminUserid','$adminRcode', '$adminPassword', '$adminName', '$adminEmail', '$adminMobile','','', '$status', '$manageUserList', '$manageWithdrawal', ' $managePaymentV', '$manageSupportList', '$manageRewardP', '$mtc', '$manageUploadT', ' $manageNotification', '$manageAppSettings', '$manageAdminList', '$date', '$date')";      


                 //print_r($query);exit;  

                 if(mysqli_query($mysqli, $query))  
              { 
               if(mysqli_insert_id($mysqli)>=1)
              { 
                $cat_id=mysqli_affected_rows($mysqli);
                $res=array('status'=>'200','msg'=>'Admin Data Added successfully ! ','id'=>$cat_id);  
              echo json_encode($res);exit;
    
                }else{
                   $res=array('status'=>'201','msg'=>'Admin Data Insertion Failed ! ','id'=>$cat_id);  
                    echo json_encode($res);exit;
                }
              } 
            
             else {
                echo "Error inserting record: " . $mysqli->error;
                $res=array('status'=>'201','msg'=>'Details Updationf Failed ! '.$mysqli->error.$query);  
                    echo json_encode($mysqli->error);exit;
              }

            }

          }

              else if($_POST["userMobile"] != '')  
           { // print_r($_POST);exit;
   
             $output = '';  
             $message = '';  
             $adminName =$_POST["adminName"];
             $adminMobile =$_POST["userMobile"];
             $adminUserid =$_POST["adminUserid"];
             $addcodestouser = $_POST["addcodestouser"];
             //$idad = $_POST["idad"];
             $amount=$addcodestouser*PER_QRCOIN;
             //$amount=100;
     // print_r($amount);exit;
            
          /* $query="update dmm2user set name='$name', where username='".$_POST["employee_id"]."'";*/
               /*$query = "  
                UPDATE `ADMIN_ROLE` SET 
                `admin_user_id` = '$adminUserid',`admin_password`='$adminPassword',`admin_name`='$adminName',`admin_email`='$adminEmail',`admin_mobile`='$adminMobile',`admin_status`='$status' WHERE `id`='".$_POST["id"]."'";*/
                 
               $query= " INSERT INTO `WALLET` (`ID`, `username`, `user_id`, `mobile`, `amount`, `status`, `txn`, `refer_id`, `date`) VALUES (NULL, '$adminName', '$adminUserid', '$adminMobile', '$amount', 'CREDIT', 'Codes Added By Admin', '', '$date')";
                   
                   // print_r($query);exit;
                 

              if(mysqli_query($mysqli, $query)) 
              {

                if(mysqli_affected_rows($mysqli)>=1)
              { 
                $cat_id=mysqli_affected_rows($mysqli);
                $res=array('status'=>'200','msg'=>' Data Updated successfully ! ','id'=>$cat_id);  
              echo json_encode($res);exit;
    
                }else{
                   $res=array('status'=>'201','msg'=>' Data Updation Failed ! ','id'=>$cat_id);  
                    echo json_encode($res);exit;
                }
              } 
            
             else {
                echo "Error inserting record: " . $mysqli->error;
                $res=array('status'=>'201','msg'=>'Details Updation Failed ! '.$mysqli->error);  
                    echo json_encode($res);exit;
              }
                    

        }
           else if($_POST["adddatabal"] != '')  
           { //print_r($_POST);exit;
   
             $output = '';  
             $message = '';  
             $adminName =$_POST["userrName"];
             $adminMobile =$_POST["userrMobile"];
             $adminUserid =$_POST["userUserid"];
             $addcodestouser = $_POST["adddatabal"];
             //$idad = $_POST["idad"];
            // $amount=$addcodestouser*PER_QRCOIN;
             $amount=$_POST["adddatabal"];
     // print_r($amount);exit;
            
          /* $query="update dmm2user set name='$name', where username='".$_POST["employee_id"]."'";*/
               /*$query = "  
                UPDATE `ADMIN_ROLE` SET 
                `admin_user_id` = '$adminUserid',`admin_password`='$adminPassword',`admin_name`='$adminName',`admin_email`='$adminEmail',`admin_mobile`='$adminMobile',`admin_status`='$status' WHERE `id`='".$_POST["id"]."'";*/
                 
               $query= " INSERT INTO `WALLET` (`ID`, `username`, `user_id`, `mobile`, `amount`, `status`, `txn`, `refer_id`, `date`) VALUES (NULL, '$adminName', '$adminUserid', '$adminMobile', '$amount', 'CREDIT', 'Balance Added By Admin', '', '$date')";
                   
                   // print_r($query);exit;
                 

              if(mysqli_query($mysqli, $query)) 
              {

                if(mysqli_affected_rows($mysqli)>=1)
              { 
                $cat_id=mysqli_affected_rows($mysqli);
                $res=array('status'=>'200','msg'=>' Data Updated successfully ! ','id'=>$cat_id);  
              echo json_encode($res);exit;
    
                }else{
                   $res=array('status'=>'201','msg'=>' Data Updation Failed ! ','id'=>$cat_id);  
                    echo json_encode($res);exit;
                }
              } 
            
             else {
                echo "Error inserting record: " . $mysqli->error;
                $res=array('status'=>'201','msg'=>'Details Updation Failed ! '.$mysqli->error);  
                    echo json_encode($res);exit;
              }
                    

        }else if($_POST["addtimer"] !='' )  
           { //print_r($_POST);exit;
   
             $output = '';  
             $message = '';  
             $noDays =$_POST["addays"];
             $timerSec =$_POST["addtimer"];
           
            

           


               $query= "  UPDATE `USER_DETAILS` SET `codegenTimer` = '$timerSec' WHERE `USER_DETAILS`.`total_qr_generation` > '$noDays' ";


               
                   
                   // print_r($query);exit;
                 

              if(mysqli_query($mysqli, $query)) 
              {

                if(mysqli_affected_rows($mysqli)>=1)
              { 
                $cat_id=mysqli_affected_rows($mysqli);
                $res=array('status'=>'200','msg'=>' Data Updated successfully ! ','id'=>$cat_id);  
              echo json_encode($res);exit;
    
                }else{
                   $res=array('status'=>'201','msg'=>' Data Updation Failed ! ','id'=>$cat_id);  
                    echo json_encode($res);exit;
                }
              } 
            
             else {
                echo "Error inserting record: " . $mysqli->error;
                $res=array('status'=>'201','msg'=>'Details Updation Failed ! '.$mysqli->error);  
                    echo json_encode($res);exit;
              }
                    

        }
      else if($_POST["disableAfter"] !='' )  
           { //print_r($_POST);exit;
   
             $output = '';  
             $message = '';  
             $noDays =$_POST["disableAfter"];
             
           
            

           


               $query= "  UPDATE `USER_DETAILS` SET `code_gen_allow` = '2' WHERE `USER_DETAILS`.`total_qr_generation` > '$noDays' ";


               
                   
                   // print_r($query);exit;
                 

              if(mysqli_query($mysqli, $query)) 
              {

                if(mysqli_affected_rows($mysqli)>=1)
              { 
                $cat_id=mysqli_affected_rows($mysqli);
                $res=array('status'=>'200','msg'=>' Data Updated successfully ! ','id'=>$cat_id);  
              echo json_encode($res);exit;
    
                }else{
                   $res=array('status'=>'201','msg'=>' Data Updation Failed ! ','id'=>$cat_id);  
                    echo json_encode($res);exit;
                }
              } 
            
             else {
                echo "Error inserting record: " . $mysqli->error;
                $res=array('status'=>'201','msg'=>'Details Updation Failed ! '.$mysqli->error);  
                    echo json_encode($res);exit;
              }
                    

        }
      
      
 ?>
 
