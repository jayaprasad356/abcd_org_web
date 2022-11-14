<?php

 //include("../includes/connection.php");
 include("../includes/function.php");

date_default_timezone_set("Asia/Calcutta");
    $dated=date("d-m-Y");
  $dated1=$date;
  $date=time();
   $date1=time();
   //print_r('hello');exit;



  $dateString=time();
   $dateString=strtotime("-7 days");

	if( isset($_SERVER['HTTPS'] ) ) {

        $file_path = 'https://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/';
        // $delay=rand('1','4');
         //sleep(rand('1','4'));

        //if($user_id=='8282828282'){ sleep($delay);}


    }
    else
    {
        $file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/';
       
      //  $delay=rand('1','4');
      //  sleep(rand('1','4'));
       // sleep($delay);
        //if($user_id=='8282828282'){ sleep($delay);}

    }


	function createRandomCode()
    {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
        while ($i <= 7)
        {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }



 if(isset($_GET['check_user']))
{

  //print_r($_POST);exit;

    $mobile = $_POST['mobile'];
    $device_id = $_POST['device_id'];
    $otp=$_POST['otp'];
    $type=$_POST['type'];
    $message="Hello User Your OTP for Abcd App is ".$otp;
   // 
    

   

     $idUsername2= checkUser('USER_DETAILS',$mobile,$device_id, " WHERE  mobile = '$mobile'");

     //print_r($idUsername2);exit;

    if($type=="register"){

    if($idUsername2['success']=='0'){


         if(sentOtp($mobile,$message)=="true")
         {

         $set['abcdapp']=array('title' =>' Otp Sent !','msg' =>'Please Verify Otp!','success'=>'11');
         }  
    } else{
      $set['abcdapp']=$idUsername2;
    }

    }else 
     
     if($type=="forgot_pass"){
    if($idUsername2['success']=='1'){
        //print_r($idUsername2);exit;
    // $otp=sentOtp($mobile,$message);
      // print_r(sentOtp($mobile,$message));exit;
      if(sentOtp($mobile,$message)=="true"){

         $set['abcdapp']=array('title' =>' Otp Sent !','msg' =>'Please Verify Otp!','success'=>'11');
      }
    }else{
        $set['abcdapp']=$idUsername2;
    }
  }
   
   


 header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
   

}




else if(isset($_GET['user_register']))
{
     //print_r('hello');exit;
   //print_r($_POST['email']);exit;
    
    
    $phone =$_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $coins = $_POST['coins'];
    $spins = $_POST['spins'];
    $city = $_POST['city'];
    //$referCode = $_POST['referCode'];
    //$refferCode ="SPT".rand(1000,9999);
    $reffered_by = $_POST['reffered_by'];
    $allow = "1";
    $joining_paid="1";
    $device_id = $_POST['device_id'];
    $total_refferals="0";
    $joining_bonus = $_POST['joining_bonus'];
    $onesignalplayerid=$_POST['onesignalplayerid'];
    $onesignalpushtoken=$_POST['onesignalpushtoken'];
    $joining_date=$date;
    $bonus_balance="3000";


   
 date_default_timezone_set("Asia/Calcutta");
    $registration_reward=API_REGISTRATION_REWARD;
    $reg_date = $date;

    $qry = "SELECT * FROM `USER_DETAILS` WHERE `mobile`= $phone ";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);
    $rowcount=mysqli_num_rows($result);
   // print_r($qry);exit;
    // echo "Hello world!"; exit;

         if($rowcount != 0)
         {
            // print_r("hello");exit;
           //  echo "Hello world!";
               // $set['abcdapp'][]=array('msg' => "Mobile Number  already used!",'success'=>'0');
                
                 if($row['mobile']== $phone and $row['device_id']!= $device_id)
                 {
                    
                   $set['abcdapp'][]=array('message' => "Mobile Number  already used!",'success'=>'0');
                  }
                  else if($row['device_id']==$device_id and $row['mobile'] != $phone)
                 {
                  $set['abcdapp'][]=array('message' => "This Device Is   already used!",'success'=>'0');
                  }
                  else if($row['device_id']== $device_id and $row['mobile']== $phone)
                  {
                       $set['abcdapp'][]=array('message' => "This Device with This Mobile Number Is already used!",'success'=>'0');
                  }
   
        }

        else
        {
        $refrCodead="SELECT * FROM `ADMIN_ROLE` ";
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
              //   echo "king";
                    if($reffered_by!="")
                    {

                      //  print_r($reffered_by);exit;
                      
                      
                     if (strpos($reffered_by,${"admincode$count"}) !== false) 
             
                        {
                        
                          $refferCode =createUserCode(${"admincode$count"});
                         // print_r($refferCode);exit;
                         break;
                       // echo $refferCode;
                         
                        }
                     
                     }else{
                        $refferCode =createUserCode(${"admincode$count"});
                          break;
                     }

                     //print_r($refferCode);
                   
                     $i++;
                    $count++;
                }
     
        $qry1="INSERT INTO `USER_DETAILS` (`id`, `mobile`, `password`, `name`, `city`, `email`, `wallet`,`bonus_balance`, `total_qr_generation`, `correct_qr_generation`, `total_paid`, `user_referal_code`, `reffered_by`, `total_referals`, `reffered_paid`, `joining_paid`, `allow`, `device_id`, `profile_pic`, `active_date`, `onesignal_playerid`, `onesignal_pushtoken`, `joining_time`) VALUES ('0', '$phone', '$password', '$name', '$city', '$email', '0',(SELECT `joining_bonus` FROM `ADMIN` WHERE `id`=1), '0', '0', '0', '$refferCode', '$reffered_by', '$total_refferals', '', '$joining_paid', '$allow', '$device_id', '', '$reg_date', '$onesignalplayerid', '$onesignalpushtoken', '$joining_date')";
        
       // print_r($qry1);exit;
             $result1=mysqli_query($mysqli,$qry1);
      
      if(mysqli_insert_id($mysqli)>0)
      
         {
        
         
 
       /* $set['abcdapp']=array('msg' => "Registration successflly...! \n click ok To mysqlitinue ",'success'=>'1'); */

       $set['abcdapp'][] =array('success'=>'1','message'=>'Registration successflly...! \n click ok To Continue ','status'=>'1');

    
        
           }

      


       

    
    
        }

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();



}

else if(isset($_GET['user_register2']))
{
     //print_r('hello');exit;
   //print_r($_POST['email']);exit;
    
    
    $phone =$_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $coins = $_POST['coins'];
    $spins = $_POST['spins'];
    $city = $_POST['city'];
    //$referCode = $_POST['referCode'];
    //$refferCode ="SPT".rand(1000,9999);
    $reffered_by = $_POST['reffered_by'];
    $allow = "1";
    $joining_paid="1";
    $device_id = $_POST['device_id'];
    $total_refferals="0";
    $joining_bonus = $_POST['joining_bonus'];
    $onesignalplayerid=$_POST['onesignalplayerid'];
    $onesignalpushtoken=$_POST['onesignalpushtoken'];
    $joining_date=$date;
    $bonus_balance="3000";


   
     date_default_timezone_set("Asia/Calcutta");
    $registration_reward=API_REGISTRATION_REWARD;
    $reg_date = $date;

    $qry = "SELECT * FROM `USER_DETAILS` WHERE `mobile`= $phone ";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);
    $rowcount=mysqli_num_rows($result);
   // print_r($qry);exit;
    // echo "Hello world!"; exit;

         if($rowcount != 0)
         {
            
           //  echo "Hello world!";
               // $set['abcdapp'][]=array('msg' => "Mobile Number  already used!",'success'=>'0');
                
                 if($row['mobile']== $phone and $row['device_id']!= $device_id)
                 {
                    
                   $set['abcdapp']=array('title'=>'','message' => "Mobile Number  already used!",'success'=>'0');
                  }
                  else if($row['device_id']==$device_id and $row['mobile'] != $phone)
                 {
                  $set['abcdapp']=array('title'=>'','message' => "This Device Is   already used!",'success'=>'0');
                  }
                  else if($row['device_id']== $device_id and $row['mobile']== $phone)
                  {
                       $set['abcdapp']=array('title'=>'','message' => "This Device with This Mobile Number Is already used!",'success'=>'0');
                  }
   
        }

        else
        {
            // print_r("hello");exit;
        $refrCodead="SELECT * FROM `ADMIN_ROLE` ";
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
              //   echo "king";
                    if($reffered_by!="")
                    {

                      //  print_r($reffered_by);exit;
                      
                      
                     if (strpos($reffered_by,${"admincode$count"}) !== false) 
             
                        {
                        
                          $refferCode =createUserCode1(${"admincode$count"});
                         // print_r($refferCode);exit;
                         break;
                       // echo $refferCode;
                         
                        }
                     
                     }else{
                        $refferCode =createUserCode1(${"admincode$count"});
                          break;
                     }

                   //  print_r($refferCode);
                   
                     $i++;
                    $count++;
                }
     
        $qry1="INSERT INTO `USER_DETAILS` (`id`, `mobile`, `password`, `name`, `city`, `email`, `wallet`,`bonus_balance`, `total_qr_generation`, `correct_qr_generation`, `total_paid`, `user_referal_code`, `reffered_by`, `total_referals`, `reffered_paid`, `joining_paid`, `allow`, `device_id`, `profile_pic`, `active_date`, `onesignal_playerid`, `onesignal_pushtoken`, `joining_time`) VALUES ('0', '$phone', '$password', '$name', '$city', '$email', '0',(SELECT `joining_bonus` FROM `ADMIN` WHERE `id`=1), '0', '0', '0', '$refferCode', '$reffered_by', '$total_refferals', '', '$joining_paid', '$allow', '$device_id', '', '$reg_date', '$onesignalplayerid', '$onesignalpushtoken', '$joining_date')";
        
      //  print_r($qry1);exit;
             $result1=mysqli_query($mysqli,$qry1);
      
      if(mysqli_insert_id($mysqli)>0)
      
         {
        
         

        $set['abcdapp']=array('title' =>' Registration successflly !','message' =>'Registration successflly...! \n click ok To Continue','success'=>'1');

        
           }

      


       

    
    
        }

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();



}

else if(isset($_GET['users_login']))
{
 $profile = array();
    $mobile = $_POST['phone'];
    $password = $_POST['password'];
    $device_id = $_POST['device_id'];
   // print_r($_POST);exit;

    $qry = "SELECT * FROM  `USER_DETAILS` WHERE  mobile = '$mobile'  ";
    $result = mysqli_query($mysqli,$qry);
    $result2 = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
  
    if ($num_rows >0)
    {   
      // print_r("hello");exit;
         if($row['device_id']==$device_id ||$row['device_id']=="5178" )
         
       { 
             
         
                if($row['password']==$password ){
                    
                            if($row['allow']=='2')
                            { 
                              
                                 $set['abcdapp']=array('title' =>' Account blocked!','message' =>'Your account blocked!','success'=>'0');
                               
                            }else
                             if($row['allow']=='1')
                                
                            {

                                $jsonObj= array();

                              while($data = mysqli_fetch_assoc($result2))
                              {
                                // print_r("hello");exit;
                                //print_r($data);
                               // $row1=$data;
                                //array_push($jsonObj,$data);
                                $profile=$data;
                              }

                                /*$set['darwinbarkk'][]=array('unique_id' => $row['unique_id'],'user_code'=>$row['user_referal_code'],'name'=>$row['name'],'email'=>$row['email'],'phone'=>$row['mobile'],'wallet'=>$row['wallet'],'success'=>'1'); */
                              $set['abcdapp']=array('success'=>'1','message'=>'hiui','Results' =>$profile);
                            }
                
                 }else{
                 $set['abcdapp']=array('title' =>' Login Failed!','message' =>'Your Password Was Incorrect!','success'=>'0');
                 }
                
            }
                else
                {

                    $set['abcdapp']=array('title' =>' Login Failed!','message' =>'Login with The same Device You have Registered!','success'=>'0');
                 }


    }
    else
    {

        //$set['darwinbarkk'][]=array('msg' =>'Login failed','success'=>'0');
        $set['abcdapp']=array('title' =>' User Doesnt Exist!','message' =>'Given Mobile number Is not Registered!','success'=>'0');

    }


 header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
   

}


else if(isset($_GET['users_profile_update']))
{/*
    $mobile = $_POST['mobile'];
    $name = $_POST['name'];
    $user_id = $_GET['user_id'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $profile_pic = $_POST['profile_pic'];
*/
  
   $data = array(
                'mobile' => $_POST['userMobile'],
                'onesignal_pushtoken' => $_POST['device_token'],
                 'name' => $_POST['name'],
                 'password' => $_POST['password'],
                 'email' => $_POST['email'],
                 'city' => $_POST['city'],
                 'profile_pic' => $_POST['profile_pic'],
               
                  );
            $sql=Update('USER_DETAILS', $data, " WHERE mobile = '".$_POST["userMobile"]."'");

         


    
   /*$sql = "UPDATE `USER_DETAILS` SET `password`='$password',`name`='$name',`city`='$city',`email`='$email',`profile_pic`='$profile_pic' WHERE `mobile`='$mobile' ";
*/
    if($sql) {

          $result["success"] = "1";
          $result["message"] = "success";

         /* echo json_encode($result);
          mysqli_close($mysqli);*/

          $set['abcdapp'] =array('success'=>'1','title'=>'Updated Successfully..!','message'=>'Profile Updated Successfully..!','status'=>1,'Results' =>$sql);

   

          
      }else{

         $data1 = array(
                'title' => 'Updation Failed..!',
                'message' =>'Please Try Again ..!',
                 'success' =>'0',
                 'Results' =>$sql
                  );

         $set['abcdapp']=$data1 ;

 
}

 header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

  
}
if(isset($_GET['pushTokenUpdate'])){

         

        if($_POST['userMobile']!=""){
           $data = array(
              /*  'mobile' => $_POST['userMobile'],*/
                'onesignal_pushtoken' => $_POST['push_token'],
               
                  );
            $sql=Update('USER_DETAILS', $data, " WHERE mobile = '".$_POST["userMobile"]."'");

         }

   
      if($sql) {

          $result["success"] = "1";
          $result["message"] = "success";

         /* echo json_encode($result);
          mysqli_close($mysqli);*/

          $set['abcdapp'] =array('success'=>'1','title'=>'Updated Successfully..!','message'=>'Profile Updated Successfully..!','status'=>1,'Results' =>$sql);

   

          
      }else{

         $data1 = array(
                'title' => 'Updation Failed..!',
                'message' =>'Please Try Again ..!',
                 'success' =>'0',
                 'Results' =>$sql
                  );

         $set['abcdapp']=$data1 ;

 
}

 header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

   }

else if(isset($_GET['app_joining_fee_paid']))
{
    $mobile = $_POST['user_id'];
    $name = $_POST['name'];
    $uid = $_POST['uid'];
    $payment_status = $_POST['paid'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $city = $_GET['city'];
    $profile_pic = $_POST['profile_pic'];

  
    
   $sql = "UPDATE `USER_DETAILS` SET `joining_paid` = '$payment_status' WHERE `mobile`='$mobile' ";

    if(mysqli_query($mysqli, $sql)) {

          $result["success"] = "1";
          $result["message"] = "success";

          echo json_encode($result);
          mysqli_close($mysqli);
      }
  else{

   $result["success"] = "0";
   $result["message"] = "error!";
   echo json_encode($result);

   mysqli_close($mysqli);
}

   

}


else if(isset($_GET['insert_payment_verification']))
{
     date_default_timezone_set("Asia/Calcutta");
    $mobile = $_POST['user_id'];
    $name = $_POST['name'];
    $uid = $_POST['uid'];
    $payment_status = $_POST['paid'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $order_id = $_POST['order_id'];
    $paid = $_POST['paid'];
    $profile_pic = $_POST['profile_pic'];
     $amount = $_POST['amount'];
    $date=$date;

  
   $qry = "SELECT * FROM  `PAYMENT_VERIFICATION` WHERE status='PENDING' && mobile = '$mobile'  ";
    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($num_rows > 0)
    {   
        
        if($row['status']=="PENDING"){
            
                  
          $set['abcdapp'][]=array('title' =>' IN VERIFICATION!','msg' =>'Your Last payment Is Under Verification!','success'=>'0');
                    
        
        }
        
        }else
        {
                    
   $sql = "INSERT INTO `PAYMENT_VERIFICATION` (`id`, `mobile`, `name`, `email`, `order_id`, `amount`, `status`, `transaction_date`, `verified_date`, `cancel_date`) VALUES (NULL, '$mobile', '$name', '$email', '$order_id', '$amount', 'PENDING', '$date', '', '') ";

    if(mysqli_query($mysqli, $sql)) {

           $set['abcdapp'][]=array('title' =>' Payment Done!','msg' =>'Please Wait For Verification!','success'=>'0');
      }     
               
        }


 

 header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
 
}


else if(isset($_GET['insert_contact_us']))
{
    date_default_timezone_set("Asia/Calcutta");
    $mobile = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $profile_pic = $_POST['profile_pic'];
     $msg = $_POST['msg'];
     $subject = $_POST['subject'];
    $date=$date;
    
   

  
   $qry = "INSERT INTO `CONTACT_US` (`id`, `contact_name`, `reg_mobile`, `contact_email`, `contact_subject`, `contact_msg`, `created_at`) VALUES (NULL, '$name', '$mobile', '$email', '$subject', '$msg', '$date')";
   
    if(mysqli_query($mysqli, $qry)) {

           $set['abcdapp'][]=array('title' =>' Enquiry Inserted!','msg' =>'Please Wait For Admin Reply !','success'=>'1');
      }   

 

 header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
 
}

else if(isset($_GET['gen_code']))
{
  $id=$_GET['id'];

    $query = "SELECT * FROM `excel_text` WHERE `id`='$id' ";
   $response = mysqli_query($mysqli, $query);

    $result = array();
    $result['read'] = array();

    if( mysqli_num_rows($response) === 1 ) {
        
        if ($row = mysqli_fetch_assoc($response)) {
 
             $h['id']                = $row['id'] ;
             $h['student_name']            = $row['student_name'] ;
             $h['id_number']          = $row['id_number'] ;
             $h['city']              = $row['city'] ;
             $h['pin_code']             = $row['pin_code'] ;
            
	
 
             array_push($result["read"], $h);
 
             $result["success"] = "1";
             echo json_encode($result);
        }
 
  
 
  }else {
 
     $result["success"] = "0";
     $result["message"] = "Error!";
     echo json_encode($result);
 
     mysqli_close($mysqli);
 }
 
}

else if(isset($_GET['device_login']))
{


    $deviceid=$_GET['deviceid'];

    $qry = "SELECT * FROM tbl_users WHERE user_deviceid ='".$deviceid."'";
    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($num_rows > 0)
    {
        if($row['status']==0)
        {
            $set['abcdapp'][]=array('msg' =>'Your account blocked!','success'=>'0');
        }
        else
        {
            $set['abcdapp'][]=array('user_id' => $row['id'],'user_code'=>$row['user_code'],'name'=>$row['name'],'email'=>$row['email'],'phone'=>$row['phone'],'points'=>$row['total_point'],'success'=>'1');
        }


    }
    else
    {

        $set['abcdapp'][]=array('msg' =>'Login failed','success'=>'0');
    }



    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
else if(isset($_GET['user_profile']))
{

    $qry = "SELECT * FROM tbl_users WHERE id = '".$_GET['id']."'";
    $result = mysqli_query($mysqli,$qry);

    $row = mysqli_fetch_assoc($result);

    $set['abcdapp'][]=array('user_id' => $row['id'],'name'=>$row['name'],'email'=>$row['email'],'phone'=>$row['phone'],'user_code'=>$row['user_code'],'total_point'=>$row['total_point'],'success'=>'1');




    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
else if(isset($_GET['user_wallet_history']))
{
    $jsonObj= array();
    //$deviceid=$_GET['device_id'];
    $user_id=$_POST['user_mobile'];

   // $qry = "SELECT * FROM tbl_users WHERE user_deviceid ='".$deviceid."' and id='".$user_id."'";
    $qry = "SELECT * FROM `WALLET` WHERE `mobile`='$user_id' ORDER BY `ID` DESC LIMIT 50";
    //print_r($qry);exit;
    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
   // $row = mysqli_fetch_assoc($result);

    if ($num_rows > 0)
    {
       $json_array=array();
  while($row=mysqli_fetch_assoc($result)){
 
   
  $datem=$row['date'];
  
   if($datem!=''){
   // print_r(date("d-m-Y | h:i:s A",$datem));exit;
   $row['date']=date("d-m-Y | h:i:s A",$datem);
 //print_r($row['date']);exit;
   }

  
  /*  $json_array[]=$row;

    
    $num--;*/

    array_push($jsonObj,$row);
    
}
/*$json=json_encode($json_array);
echo($json);*/
$set['abcdapp'] =array('success'=>'1','title'=>'doneWall','message'=>'hello','status'=>1,'subjects' =>$jsonObj);

    }
    else
    {
       $set['abcdapp'] =array('success'=>'1','title'=>'doneWall','message'=>'hello','status'=>0,'subjects' =>$jsonObj);
    }

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}


else if(isset($_GET['user_Referal_history']))
{
   $jsonObj= array();
    //$deviceid=$_GET['device_id'];
    $user_id=$_POST['user_id'];
    $userCode=$_POST['refer_code'];
   // $qry = "SELECT * FROM tbl_users WHERE user_deviceid ='".$deviceid."' and id='".$user_id."'";
    $qry = "SELECT * FROM `USER_DETAILS` WHERE `reffered_by`='$userCode' ORDER BY `ID` DESC";

    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
   // $row = mysqli_fetch_assoc($result);

    if ($num_rows > 0)
    {
       $json_array=array();
     while($row=mysqli_fetch_assoc($result)){
 


//$json_array[]=$row;
 array_push($jsonObj,$row);
    
    $num--;
    
}
//$json=json_encode($json_array);
 
//echo($json);
$set['abcdapp']=array('message' =>' Referals Found','title'=>'hello','success'=>'1','Results' =>$jsonObj);

    }
    else
    {
        $set['abcdapp']=array('title'=>'Hello User','title'=>'vvv','message' =>'NO Referals Found','success'=>'0');
    }

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}



else if(isset($_GET['insert_withdrwal']))
{
    date_default_timezone_set("Asia/Calcutta");
    $coins = $_POST['amount'];
    $paytm_no = $_POST['paytm_no'];
    $mobile = $_POST['user_id'];
    $txn="WITH".rand(1000,9999);
    $status="PENDING";
    $name=$_POST['name'];
    $widthrawal_method=$_POST['widthrawal_method'];
    $bank_name=$_POST['bank_name'];
     $bank_ifsc=$_POST['bank_ifsc'];
     $bank_acc_no=$_POST['bank_acc_no'];
   // $subject = $_POST['subject'];
    $date=$date;

   // require_once 'mysqlinect.php';

   
    $user_qry5178= "SELECT `name`,`user_referal_code`,`mobile` FROM `USER_DETAILS` WHERE `mobile`=$mobile";
               $user_result5178=mysqli_query($mysqli,$user_qry5178);
                 $row1223 = mysqli_fetch_assoc($user_result5178);
                 
                  $rowcount=mysqli_num_rows($user_result5178);
                 // print_r($rowcount);exit;

              if($rowcount != 0)
                 
                 {
             
                $ref_mob= $row1223['mobile'];
                $ref_paidname= $row1223['name'];
                $user_id= $row1223['user_referal_code'];

   
    
   $qry =  "INSERT INTO `WIDTHRAWL` (`id`, `name`, `mobile`,`user_id`, `payment_method`, `paytm_no`, `ammount`, `txn_no`, `bank_name`, `bank_ifsc`, `bank_acc_no`, `req_date`, `paid_date`, `cancelled_date`, `status`) VALUES (NULL,'$name','$mobile','$user_id','$widthrawal_method','$paytm_no','$coins','$txn','$bank_name','$bank_ifsc','$bank_acc_no', '$date', '', ' ',  'PENDING')";
   $result = mysqli_query($mysqli,$qry);
    //$num_rows = mysqli_num_rows($result);
    //$row = mysqli_fetch_assoc($result);
   // mysqli_insert_id($mysqli);
    if (mysqli_insert_id($mysqli)>0)
    {
      
      
            $set['abcdapp'][]=array('msg' => "Widthrawal Requested Successfully",'title'=>"Redeem Success",'success'=>'1');
        }

       }
     
    else
    {
        $set['abcdapp'][]=array('msg' => "Widthrawal Requested Failed ..! Try Again",'title'=>"Redeem Failed",'success'=>'0');
    }

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}
else if(isset($_GET['balance_update']))
{
    $deviceid=$_GET['device_id'];
    $user_id=$_GET['user_id'];
    $active_type=$_GET['active_type'];
    $ip=$_GET['user_ip'];
    $points=$_GET['points'];
    $pointtype=$_GET['point_type'];
    user_abcdappcoin_activity($user_id,$active_type,$points,$deviceid,$ip,$pointtype);

    // $qry = "SELECT * FROM tbl_users WHERE user_deviceid ='".$deviceid."' and id='".$user_id."'";
    $qry = "SELECT * FROM tbl_users WHERE id='".$_GET['user_id']."'";
    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($num_rows > 0)
    {
        if($row['status']==0)
        {
            $set['abcdapp'][]=array('msg' =>'Your account blocked!','success'=>'0');
        }
        else
        {
            $set['abcdapp'][]=array('points' => $row['total_point'],'success'=>'1');
        }


    }
    else
    {
        $set['abcdapp'][]=array('msg' =>'Login failed1','success'=>'0');
    }

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}

else if(isset($_GET['forgot_password']))

{
    $uid = $_POST['uid'];
    $password = $_POST['password'];
     $mobile = $_POST['mobile'];
    // print_r($mobile);exit;
     
    if($mobile !="" and $password !="")
    
    {
        // print_r($mobile);exit;
       $user_edit = "UPDATE `USER_DETAILS` SET `password`='$password' WHERE `mobile`='$mobile' ";
    

    $user_res = mysqli_query($mysqli,$user_edit);
  //  mysqli_affected_rows($mysqli)

   // $set['abcdapp'][]=array('msg'=>'Updated','success'=>'1');
  // print_r(mysqli_insert_id($mysqli));exit;
    
     if (mysqli_affected_rows($mysqli)>0)
    {
      //print_r(mysqli_insert_id($mysqli));exit;

      
            $set['abcdapp'][]=array('msg' => "Login With Your New Password Successfully",'title'=>"Password Updated ",'success'=>'1');
            mysqli_close($mysqli);
        } else
    {
        $set['abcdapp'][]=array('msg' => "Password Reset Requested Failed ..! Try Again",'title'=>"password Reset Failed",'success'=>'0');
        mysqli_close($mysqli);
    }

       }
     
   //print_r($set);exit;

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}

else if(isset($_GET['insert_wallet']))
{
  {
    date_default_timezone_set("Asia/Calcutta");
      
    $mobile = $_POST['user_id'];
    $name = $_POST['name'];
    $uid = $_POST['uid'];
    $qrId=$_POST['qrId'];
   // $amount=$_POST['amount'];
    $amount=PER_QRCOIN;
    $password = $_POST['password'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $profile_pic = $_POST['profile_pic'];
    $txn_type=$_POST['txn_type'];
    $status=$_POST['txn_status'];
    $date=$date;
  
  
    $user_qry5178= "SELECT `name`,`user_referal_code`,`mobile`,`wallet`,`total_all_qr_generation`,`todaysCodes`,`correct_qr_generation` FROM `USER_DETAILS` WHERE `mobile`=$mobile";
               $user_result5178=mysqli_query($mysqli,$user_qry5178);
                 $row1223 = mysqli_fetch_assoc($user_result5178);
                 
                //   print_r($user_qry5178);exit;
             
                $ref_mob= $row1223['mobile'];
                $ref_paidname= $row1223['name'];
                $user_id= $row1223['user_referal_code'];
                $users_wall=$row1223['wallet'];
                $total_all_qr_generation= $row1223['total_all_qr_generation'];
               $todaysCodes= $row1223['todaysCodes'];
               $correct_qr_generation= $row1223['correct_qr_generation'];

       /*   $sql = " UPDATE `USER_DETAILS` SET `wallet` = $users_wall+$amount ,`total_all_qr_generation` =
                $total_all_qr_generation+1,`todaysCodes` = $todaysCodes+1, `correct_qr_generation`=$correct_qr_generation+1,`active_date`=$date WHERE `mobile` = $mobile";
*/
/* $sql = " UPDATE `USER_DETAILS` SET `wallet` = wallet+$amount ,`total_all_qr_generation` =
                total_all_qr_generation+1,`todaysCodes` = todaysCodes+1, `correct_qr_generation`=correct_qr_generation+1,`active_date`=$date WHERE `mobile` = $mobile";*/



                //print_r($sql);exit;

    
   $sql = "INSERT INTO `WALLET` (`ID`, `username`,`user_id`, `mobile`, `amount`, `status`, `txn`,`qrId`, `date`) VALUES (NULL, '$name','$user_id', '$mobile', '$amount', '$status', '$txn_type', '$qrId','$date')";

    if(mysqli_query($mysqli, $sql)) {

          $result["success"] = "1";
          $result["message"] = "success";

         // $set['abcdapp'] =array('success'=>'1','title'=>'done','message'=>'hello','status'=>1,'Results' =>'');

          echo json_encode($result);
          mysqli_close($mysqli);
          
      }
  

else{

   $result["success"] = "0";
   $result["message"] = $sql;
   echo json_encode($result);

   mysqli_close($mysqli);
}

   

}

}
else if(isset($_GET['insert_wallet2']))

  {
    date_default_timezone_set("Asia/Calcutta");
      
    $mobile = $_POST['user_id'];
    $name = $_POST['name'];
    $uid = $_GET['uid'];
    $qrId=$_GET['qrId'];
   // $amount=$_POST['amount'];
    $amount=PER_QRCOIN;
    $password = $_POST['password'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $profile_pic = $_POST['profile_pic'];
    $txn_type=$_POST['txn_type'];
    $status=$_POST['txn_status'];
    $date=$date;
  
  
    $user_qry5178= "SELECT `name`,`user_referal_code`,`mobile`,`wallet`,`total_all_qr_generation`,`todaysCodes`,`correct_qr_generation` FROM `USER_DETAILS` WHERE `mobile`=$mobile";
               $user_result5178=mysqli_query($mysqli,$user_qry5178);
                 $row1223 = mysqli_fetch_assoc($user_result5178);
                 
                //   print_r($user_qry5178);exit;
             
                $ref_mob= $row1223['mobile'];
                $ref_paidname= $row1223['name'];
                $user_id= $row1223['user_referal_code'];
                $users_wall=$row1223['wallet'];
                $total_all_qr_generation= $row1223['total_all_qr_generation'];
               $todaysCodes= $row1223['todaysCodes'];
               $correct_qr_generation= $row1223['correct_qr_generation'];

          $sql = " UPDATE `USER_DETAILS` SET `wallet` = $users_wall+$amount ,`total_all_qr_generation` =
                $total_all_qr_generation+1,`todaysCodes` = $todaysCodes+1, `correct_qr_generation`=$correct_qr_generation+1,`active_date`=$date WHERE `mobile` = $mobile";

 /*$sql = " UPDATE `USER_DETAILS` SET `wallet` = wallet+$amount ,`total_all_qr_generation` =
                total_all_qr_generation+1,`todaysCodes` = todaysCodes+1, `correct_qr_generation`=correct_qr_generation+1,`active_date`=$date WHERE `mobile` = $mobile";
*/


                //print_r($sql);exit;

    
   $sql = "INSERT INTO `WALLET` (`ID`, `username`,`user_id`, `mobile`, `amount`, `status`, `txn`,`qrId`, `date`) VALUES (NULL, '$name','$user_id', '$mobile', '$amount', '$status', '$txn_type', '$qrId','$date')";

    if(mysqli_query($mysqli, $sql)) {

        /*  $result["success"] = "1";
          $result["message"] = "success";
*/
          $set['abcdapp'] =array('success'=>'1','title'=>'done','message'=>'hello','status'=>1,'Results' =>'');

        /*  echo json_encode($result);
          mysqli_close($mysqli);*/
          
      }
  

else{

  /* $result["success"] = "0";
   $result["message"] = $sql;
   echo json_encode($result);

   mysqli_close($mysqli);*/

   $set['abcdapp'] =array('success'=>'0','title'=>'done','message'=>'hello','status'=>1,'Results' =>$finaldata);
}

   


    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();


}

else if(isset($_GET['user_status']))
{
    $user_id = $_GET['user_id'];

    $qry = "SELECT * FROM tbl_users WHERE status='1' and id = '".$user_id."'";
    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($num_rows > 0)
    {

        $set['abcdapp'][]=array('message' => 'Enable','success'=>'1');

    }
    else
    {

        $set['abcdapp'][]=array('message' => 'Disable','success'=>'0');
    }



    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}

/*else if(isset($_GET['forgot_pass']))
{


    $qry = "SELECT * FROM tbl_users WHERE email = '".$_GET['email']."'";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);

    if($row['email']!="")
    {

        $to = $_GET['email'];
        // subject
        $subject = '[IMPORTANT] '.APP_NAME.' Forgot Password Information';

        $message='<div style="background-color: #f9f9f9;" align="center"><br />
					  <table style="font-family: OpenSans,sans-serif; color: #666666;" border="0" width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
					    <tbody>
					      <tr>
					        <td colspan="2" bgcolor="#FFFFFF" align="center"><img src="http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/images/'.APP_LOGO.'" alt="header" width="120"/></td>
					      </tr>
					      <tr>
					        <td width="600" valign="top" bgcolor="#FFFFFF"><br>
					          <table style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; padding: 15px;" border="0" width="100%" cellspacing="0" cellpadding="0" align="left">
					            <tbody>
					              <tr>
					                <td valign="top"><table border="0" align="left" cellpadding="0" cellspacing="0" style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; width:100%;">
					                    <tbody>
					                      <tr>
					                        <td><p style="color: #262626; font-size: 28px; margin-top:0px;"><strong>Dear '.$row['name'].'</strong></p>
					                          <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;">Thank you for using '.APP_NAME.',<br>
					                            Your password is: '.$row['password'].'</p>
					                          <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;margin-bottom:30px;">Thanks you,<br />
					                            '.APP_NAME.'.</p></td>
					                      </tr>
					                    </tbody>
					                  </table></td>
					              </tr>
					               
					            </tbody>
					          </table></td>
					      </tr>
					      <tr>
					        <td style="color: #262626; padding: 20px 0; font-size: 20px; border-top:5px solid #52bfd3;" colspan="2" align="center" bgcolor="#ffffff">Copyright © '.APP_NAME.'.</td>
					      </tr>
					    </tbody>
					  </table>
					</div>';


        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'mysqlitent-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.APP_NAME.' <'.APP_FROM_EMAIL.'>' . "\r\n";
        // Mail it
        @mail($to, $subject, $message, $headers);


        $set['abcdapp'][]=array('msg' => "Password has been sent on your mail!",'success'=>'1');
    }
    
    
    
    else
    {

        $set['abcdapp'][]=array('msg' => "Email not found in our database!",'success'=>'0');

    }


    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}*/

else if(isset($_GET['forgot_pass']))
{
     $password = $_GET['password'];
     $mobile = $_GET['mobile'];
 $sql = "UPDATE `USER_DETAILS` SET `password`='$password' WHERE `mobile`='$mobile' ";

    $qry = "SELECT * FROM tbl_users WHERE email = '".$_GET['email']."'";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);

    if($row['email']!="")
    {

        $to = $_GET['email'];
        // subject
        $subject = '[IMPORTANT] '.APP_NAME.' Forgot Password Information';

        $message='<div style="background-color: #f9f9f9;" align="center"><br />
					  <table style="font-family: OpenSans,sans-serif; color: #666666;" border="0" width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
					    <tbody>
					      <tr>
					        <td colspan="2" bgcolor="#FFFFFF" align="center"><img src="http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/images/'.APP_LOGO.'" alt="header" width="120"/></td>
					      </tr>
					      <tr>
					        <td width="600" valign="top" bgcolor="#FFFFFF"><br>
					          <table style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; padding: 15px;" border="0" width="100%" cellspacing="0" cellpadding="0" align="left">
					            <tbody>
					              <tr>
					                <td valign="top"><table border="0" align="left" cellpadding="0" cellspacing="0" style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; width:100%;">
					                    <tbody>
					                      <tr>
					                        <td><p style="color: #262626; font-size: 28px; margin-top:0px;"><strong>Dear '.$row['name'].'</strong></p>
					                          <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;">Thank you for using '.APP_NAME.',<br>
					                            Your password is: '.$row['password'].'</p>
					                          <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;margin-bottom:30px;">Thanks you,<br />
					                            '.APP_NAME.'.</p></td>
					                      </tr>
					                    </tbody>
					                  </table></td>
					              </tr>
					               
					            </tbody>
					          </table></td>
					      </tr>
					      <tr>
					        <td style="color: #262626; padding: 20px 0; font-size: 20px; border-top:5px solid #52bfd3;" colspan="2" align="center" bgcolor="#ffffff">Copyright © '.APP_NAME.'.</td>
					      </tr>
					    </tbody>
					  </table>
					</div>';


        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'mysqlitent-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.APP_NAME.' <'.APP_FROM_EMAIL.'>' . "\r\n";
        // Mail it
        @mail($to, $subject, $message, $headers);


        $set['abcdapp'][]=array('msg' => "Password has been sent on your mail!",'success'=>'1');
    }
    
    
    
    else
    {

        $set['abcdapp'][]=array('msg' => "Email not found in our database!",'success'=>'0');

    }


    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}
else if(isset($_GET['user_points_history']))
{
    $jsonObj= array();

    $wall_query="SELECT * FROM tbl_users_rewards_activity WHERE user_id='".$_GET['user_points_history']."' AND redeem_id='".$_GET['redeem_id']."' AND status=0 ORDER BY id DESC";

    $wall_sql = mysqli_query($mysqli,$wall_query);

    while($wall_data = mysqli_fetch_assoc($wall_sql))
    {

        $row1['video_id'] =$wall_data['video_id'];
        $row1['video_title'] =get_video_info($wall_data['video_id'],'video_title');
        $row1['video_thumbnail'] =$file_path.'images/'.get_video_info($wall_data['video_id'],'video_thumbnail');

        $row1['user_id'] =$wall_data['user_id'];
        $row1['activity_type'] =$wall_data['activity_type'];
        $row1['points'] =$wall_data['points'];
        $row1['date'] =date('d-m-Y', strtotime($wall_data['date']));


        array_push($jsonObj,$row1);

    }


    $set['abcdapp']=$jsonObj;

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}

else if(isset($_GET['user_coin_history']))
{
    $jsonObj= array();

    $wall_query="SELECT * FROM tbl_users_rewards_activity WHERE user_id='".$_GET['user_id']."'  AND status=1 ORDER BY id DESC";

    $wall_sql = mysqli_query($mysqli,$wall_query);

    while($wall_data = mysqli_fetch_assoc($wall_sql))
    {


        $row1['status'] =$wall_data['status'];
        $row1['activity_type'] =$wall_data['activity_type'];
        $row1['points'] =$wall_data['points'];
        $row1['date'] =date('d-m-Y', strtotime($wall_data['date']));


        array_push($jsonObj,$row1);

    }


    $set['abcdapp']=$jsonObj;

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}

else if(isset($_GET['user_withdrawal_history']))
{
   

 $user_id=$_GET['user_id'];
$query="SELECT * FROM `WIDTHRAWL` WHERE `mobile`='$user_id' ";
$result=mysqli_query($mysqli,$query);
$num= mysqli_num_rows($result);
$count=0;
$json_array=array();
while($row=mysqli_fetch_array($result)){
 

$reqDate=$row['req_date'];
$datem=$row['paid_date'];
  
   if($datem!=''){
   // print_r(date("d-m-Y | h:i:s A",$datem));exit;
   $row['paid_date']=date("d-m-Y | h:i:s A",$datem);
 //print_r($row['date']);exit;
   }

    if($reqDate!=''){
   // print_r(date("d-m-Y | h:i:s A",$datem));exit;
   $row['req_date']=date("d-m-Y | h:i:s A",$reqDate);
 //print_r($row['date']);exit;
   }

$json_array[]=$row;
    
    $num--;
    
}
$json=json_encode($json_array);
echo($json);

}

else if(isset($_GET['user_code_gen']))
{
   

 $user_id=$_GET['user_id'];
$query="SELECT * FROM `excel_text`LIMIT 50  ";
$result=mysqli_query($mysqli,$query);
$num= mysqli_num_rows($result);
$count=0;
$json_array=array();
while($row=mysqli_fetch_array($result)){
 


$json_array[]=$row;
    
    $num--;
    
}
$json=json_encode($json_array);
echo($json);

}




else if(isset($_GET['user_rewads_point']))
{

    $jsonObj= array();

    $query="SELECT * FROM tbl_users WHERE  id='".$_GET['id']."'";

    $sql = mysqli_query($mysqli,$query);

    while($data = mysqli_fetch_assoc($sql))
    {

        $row['id'] =$data['id'];
        $row['total_point'] =$data['total_point'];


        $wall_query="SELECT * FROM tbl_users_rewards_activity WHERE user_id='".$_GET['id']."' AND status=1 ORDER BY id DESC";

        $wall_sql = mysqli_query($mysqli,$wall_query);
        $num_rows = mysqli_num_rows($wall_sql);

        if($num_rows > 0)
        {
            while($wall_data = mysqli_fetch_assoc($wall_sql))
            {

                $row1['activity_type'] =$wall_data['activity_type'];
                $row1['points'] =$wall_data['points'];
                $row1['date'] =date('d-m-Y', strtotime($wall_data['date']));
                $row1['time'] =date('h:i A', strtotime($wall_data['date']));

                $row['user_rewads_point'][]=$row1;

            }

        }
        else
        {
            $row['user_rewads_point']=array();
        }

        array_push($jsonObj,$row);

    }

    $set['abcdapp']=$jsonObj;

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
else if(isset($_GET['user_refer_history']))
{
    $jsonObj= array();

    $wall_query="SELECT * FROM tbl_users WHERE refer_code='".$_GET['refer_code']."'  AND status=1 ORDER BY id DESC";

    $wall_sql = mysqli_query($mysqli,$wall_query);

    while($wall_data = mysqli_fetch_assoc($wall_sql))
    {


        $row1['name'] =$wall_data['name'];
        $row1['date'] =date('d-m-Y', strtotime($wall_data['reg_date']));
        $row1['points'] =$wall_data['total_point'];


        array_push($jsonObj,$row1);

    }


    $set['abcdapp']=$jsonObj;

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}


else if(isset($_GET['settings']))
{
 
   
  
//print_r("hello");exit;
  $user_id=$_POST['user_mobile'];
  $id=$_POST['id'];
    $finaldata= array();
    $settings = array();
    $profile = array();
    $codegen=array();


       $delay=rand('1','3');
     /*  sleep(rand('1','4'));
        if($user_id=='8282828282'){ sleep($delay);}*/

if($_POST['user_mobile']){

   $query1="SELECT * FROM `USER_DETAILS` AS L  WHERE (L.mobile=$user_id)";

    $sql1 = mysqli_query($mysqli,$query1);


    while($data1 = mysqli_fetch_assoc($sql1))
    {
        
      
        $profile=$data1;


    }
     
      


    $finaldata['profile'] = $profile;
    $getid=$profile['total_all_qr_generation'];
    //print_r($getid);exit;

      

 
  }

  if($getid!=""){

if($getid==0){
$getid=1;
}

//print_r(returnId());exit;

   
     $maxv1='198044';
        //$maxv=rand('1',$maxv1);
 //  print_r($maxv1);exit;
   // $maxv1=rand('1',$maxvv['num']);

//print_r($maxv1);exit;
    //$maxv=1;
     $query13 = "SELECT * FROM  `excel_text` AS M INNER JOIN `WALLET` AS N WHERE ( M.id=$maxv AND N.qrId=$maxv1 AND N.mobile=$user_id) ";

     // print_r($query13);exit;
     
    $key = true;

    while($key){
        // Do stuff
        $maxv=rand('1',$maxv1);
        
        // print_r(mysqli_query($mysqli,$query13));exit;
          $sql13 = mysqli_query($mysqli,$query13);
         
         $result211=mysqli_fetch_assoc($sql13);
          $numrow13=mysqli_num_rows($sql13);
          
      /*print_r($numrow13);exit;*/
        if($numrow13 != 0) {
          
          // print_r($getid);exit;
        }else{
          $key = false;
          $getid=$maxv;
        }
    }



 

//
if($user_id!='1111111111'){
    $query2 = "SELECT * FROM `excel_text` WHERE `id`=$getid ";
}else{
  //  $query2 = "SELECT * FROM `excel_text` WHERE `id`=197836 ";
     $query2 = "SELECT * FROM `excel_text` WHERE `id`=$getid ";
}
// 
   $response2 = mysqli_query($mysqli, $query2);

//print_r($response2);exit;
  
         while($row2 = mysqli_fetch_assoc($response2))
    {
        
        /*$historyDays=$date-$data1['joining_time'];
       
        $row2['historydays1']=$historyDays; 
        $row2['historydays']=$historyDays/86400*12;*/
     /*  print_r( $historyDays/2629743);exit;

    print_r(date("d",$historyDays));exit;*/

     // print_r($row2);exit;
        //array_push($codegen,$row2);
        $codegen=$row2;
    
   

    }


   $finaldata['codeGen'] = $codegen;

  }

   $query="SELECT * FROM  `APP_SETTING` AS M INNER JOIN `ADMIN` AS N INNER JOIN `ADDS_TABLE` AS O  WHERE ( M.id='1' AND N.id=1 AND O.id='1' )";
   //print_r($query);exit;

    $sql = mysqli_query($mysqli,$query);


    while($data = mysqli_fetch_assoc($sql))
    {
        
        
      
        //array_push($settings,$data);
       $settings=$data;
   

    }

     $finaldata['Settings'] = $settings;
 
   


   
 $set['abcdapp'] =array('success'=>'1','title'=>'done','message'=>'hello','status'=>1,'Results' =>$finaldata);

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();


}



else if(isset($_GET['user_coin_count']))
{
    $user_id=$_GET['user_id'];
    $device_id=$_GET['device_id'];

    $qry = "SELECT * FROM tbl_abcdapp_count WHERE user_id = '".$user_id."' and device_id = '".$device_id."' and CAST(`update_date` as DATE) = cast(CURRENT_TIMESTAMP as date)";
    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($num_rows > 0)
    {
        $set['abcdapp'][]=array('abcdapp_count' => $row['daily_abcdapp_count'],'abcdapp_bid_count' =>$row['daily_bid_count'],'success'=>'1');
    }
    else
    {
        $set['abcdapp'][]=array('message' => 'Fail','abcdapp_count' => "0",'abcdapp_bid_count' => "0",'success'=>'1');
    }


    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}

else if(isset($_GET['coin_count_update']))
{
    $user_id=$_GET['user_id'];
    $device_id=$_GET['device_id'];

    $qry = "SELECT * FROM tbl_abcdapp_count WHERE user_id = '".$user_id."' and device_id = '".$device_id."' and CAST(`update_date` as DATE)=cast(CURRENT_TIMESTAMP as date)";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);

    if($row['user_id']!="")
    {
        $user_qry=mysqli_query($mysqli,"UPDATE tbl_abcdapp_count SET daily_abcdapp_count= daily_abcdapp_count + 1,update_date=CURRENT_TIMESTAMP() WHERE user_id = '".$user_id."' and device_id='".$device_id."'");
        $set['abcdapp'][]=array('message' => 'Coin Update','success'=>'1');
    }
    else
    {
        $user_qry=mysqli_query($mysqli,"UPDATE tbl_abcdapp_count SET daily_abcdapp_count=0,update_date=CURRENT_TIMESTAMP() WHERE user_id = '".$user_id."' and device_id='".$device_id."'");
        $set['abcdapp'][]=array('message' => 'Coin Update','success'=>'1');
    }

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
else if(isset($_GET['video_ads_count_update']))
{
    $user_id=$_GET['user_id'];
    $device_id=$_GET['device_id'];

    $qry = "SELECT * FROM tbl_video_ads_count WHERE user_id = '".$user_id."' and device_id = '".$device_id."' and CAST(`update_date` as DATE)=cast(CURRENT_TIMESTAMP as date)";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);

    if($row['user_id']!="")
    {
        $user_qry=mysqli_query($mysqli,"UPDATE tbl_video_ads_count SET daily_vads_count= daily_vads_count + 1,update_date=CURRENT_TIMESTAMP() WHERE user_id = '".$user_id."' and device_id='".$device_id."'");
        $set['abcdapp'][]=array('message' => 'Ads Count Update','success'=>'1');
    }
    else
    {
        $user_qry=mysqli_query($mysqli,"UPDATE tbl_video_ads_count SET daily_vads_count=1,update_date=CURRENT_TIMESTAMP() WHERE user_id = '".$user_id."' and device_id='".$device_id."'");
        $set['abcdapp'][]=array('message' => 'Update','success'=>'1');
    }

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
else if(isset($_GET['video_ads_count']))
{
    $user_id=$_GET['user_id'];
    $device_id=$_GET['device_id'];

    $qry = "SELECT * FROM tbl_video_ads_count WHERE user_id = '".$user_id."' and device_id = '".$device_id."' and CAST(`update_date` as DATE) = cast(CURRENT_TIMESTAMP as date)";
    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($num_rows > 0)
    {
        $set['abcdapp'][]=array('ads_count' => $row['daily_vads_count'],'success'=>'1');
    }
    else
    {
        $set['abcdapp'][]=array('message' => 'Fail','daily_vads_count' => '0','success'=>'0');
    }


    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
else if(isset($_GET['support_ticket']))
	{	
			$query="SELECT * FROM tbl_settings WHERE id='1'";
		    $sql = mysqli_query($mysqli,$query);
		    $data = mysqli_fetch_assoc($sql);

		  	

		    $mysqlitact_name = $_GET['mysqlitact_name'];
		    $mysqlitact_email = $_GET['mysqlitact_email'];
		    $mysqlitact_msg = $_GET['mysqlitact_msg'];

			$qry1="INSERT INTO tbl_support_ticket (`mysqlitact_name`,`mysqlitact_email`,`mysqlitact_msg`) VALUES ('".$mysqlitact_name."','".$mysqlitact_email."','".$mysqlitact_msg."')"; 
            $result1=mysqli_query($mysqli,$qry1);

 
			$to = $data['app_email'];
			// subject
			$subject = '[IMPORTANT] '.APP_NAME.' mysqlitact';
 			
			$message='<div style="background-color: #f9f9f9;" align="center"><br />
					  <table style="font-family: OpenSans,sans-serif; color: #666666;" border="0" width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
					    <tbody>
					      <tr>
					        <td colspan="2" bgcolor="#FFFFFF" align="center"><img src="http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/images/'.APP_LOGO.'" alt="header" width="120" /></td>
					      </tr>
					      <tr>
					        <td width="600" valign="top" bgcolor="#FFFFFF"><br>
					          <table style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; padding: 15px;" border="0" width="100%" cellspacing="0" cellpadding="0" align="left">
					            <tbody>
					              <tr>
					                <td valign="top"><table border="0" align="left" cellpadding="0" cellspacing="0" style="font-family:OpenSans,sans-serif; color: #666666; font-size: 10px; width:100%;">
					                    <tbody>
					                      <tr>
					                        <td>
					                          <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;">Hello Admin,<br>
					                            Email: '.$_GET['mysqlitact_name'].'</p>
					                          <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;">Hello Admin,<br>
					                            Email: '.$_GET['mysqlitact_email'].'</p>
					                             <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;"> 
					                            message: '.$_GET['mysqlitact_msg'].'</p>
					                          <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;margin-bottom:30px;">Thanks you,<br />
					                            '.APP_NAME.'.</p></td>
					                      </tr>
					                    </tbody>
					                  </table></td>
					              </tr>
					               
					            </tbody>
					          </table></td>
					      </tr>
					      <tr>
					        <td style="color: #262626; padding: 20px 0; font-size: 20px; border-top:5px solid #52bfd3;" colspan="2" align="center" bgcolor="#ffffff">Copyright © '.APP_NAME.'.</td>
					      </tr>
					    </tbody>
					  </table>
					</div>';
 			
 			 

			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'mysqlitent-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.APP_NAME.' <'.APP_FROM_EMAIL.'>' . "\r\n";
			// Mail it
			@mail($to, $subject, $message, $headers); 
			  
			$set['abcdapp'][]=array('msg' => "Message has been sent! \n We Will mysqlitact Soon",'success'=>'1');
		  
		header( 'mysqlitent-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

	}

/*------------------------------admin_app_Api-----------------------------------*/
else if(isset($_GET['admins_role']))
  { print_r("hello");exit;
$query="SELECT * FROM `ADMIN_ROLE` WHERE `admin_status`='1' ORDER BY `ADMIN_ROLE`.`id` ASC";
$result=mysqli_query($mysqli,$query);
/*print_r($result);exit;*/
$num= mysqli_num_rows($result);
 $num_rows = mysqli_num_rows($result);


 if ($num_rows > 0)
    {
       $json_array=array();
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){


print_r(mysqli_fetch_assoc($row));
$json_array[]=$row;
    
    $num--;
    
}
$json=json_encode($json_array);
//echo($json);
$set=array('msg' =>' Referals Found','success'=>'1','data'=>$json_array);

    }
    else
    {
        $set['abcdapp'][]=array('title'=>'Hello User','msg' =>'NO Referals Found','success'=>'0');
    }

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
 /*get Ticket*/

 else if(isset($_GET['getMyTicket']))
  {
    $jsonObj= array();
     $mobile = $_POST['user_mobile'];
    $device_id = $_POST['device_id'];
  
  
     // $get_ticket= getSingleRow('ticket'," WHERE user_id =$mobile ");
       $qry = "SELECT * FROM `ticket` WHERE `user_id`='$mobile' ORDER BY `id` DESC";

    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
     // getSingleRow('CREATED_ID', " WHERE id = '13'");
      if ($num_rows > 0)
    {
       $json_array=array();
     while($row=mysqli_fetch_assoc($result)){
 


//$json_array[]=$row;
 array_push($jsonObj,$row);
    
    $num--;
    
}
//$json=json_encode($json_array);
 
//echo($json);
$set['abcdapp']=array('message' =>' Referals Found','title'=>'hello','success'=>'1','Results' =>$jsonObj);

    }
    else
    {
        $set['abcdapp']=array('title'=>'Hello User','title'=>'vvv','message' =>'NO Referals Found','success'=>'0');
    }

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}
 /*get Ticket*/

 else if(isset($_GET['generateTicket']))
  {
    $jsonObj= array();
     $mobile = $_POST['userMobile'];
    $description = $_POST['description'];
    $reason = $_POST['reason'];
    $device_id = $_POST['device_id'];

    $data = array(      
              'id'  =>  NULL,
              'user_id'  =>  $_POST['userMobile'],       
              'description'  =>  $_POST['description'],
              'reason'  =>  $_POST['reason'],
               'created_at'  =>  $date,
                          );

/*$data['hello']="hello";

print_r($data);exit;*/


   
   //$numRows= Count('USER_DETAILS', 'mobile=' . $mobile . '');
   $numRowsz=CountData('ticket', 'user_id=' . $_POST['userMobile'] . ' AND status=0 ');
//print_r($numRowsz['rowNum']);exit;
if($numRowsz['rowNum']<3){



    $qry=Insert('ticket', $data);
    //print_r($qry);exit;
  
  if($qry!=0){
   
   $set['abcdapp']=array('message' =>' Admin Will reply As Soon As Possible','title'=>'New Ticket Has Been Generated !','success'=>'1','Results' =>$jsonObj);

    }
    else
    {
        $set['abcdapp']=array('title'=>'Ticket Generation Failed ..!','message' =>' Please try Again Later.!','success'=>'0');
    
   } 

 }else{

   $set['abcdapp']=array('title'=>'You Cant Add New Tickets','message' =>' You Have Allready Some Ticket Pending ..!','success'=>'0');
 }
  
     

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}



else if(isset($_GET['getTicketComments']))
   {
      $jsonObj = array();
       $userMobile=$_POST['userMobile'];
      // $adminMobile=$_POST['adminmobile'];
      $adminMobile=$_POST['adminMobile'];
      $ticket_id=$_POST['ticketId'];
    // $adminMobile="8251941210";
    //print_r($userMobile);exit;
      // $this->checkUserStatus($user_id);
      if($userMobile!=""){
       $qry = "SELECT * FROM `CHATS` WHERE `user_id` = '$userMobile' AND `ticket_id`='$ticket_id' ";
        $result = mysqli_query($mysqli,$qry);
        $num_rows = mysqli_num_rows($result);
        //print_r($qry);exit;
      
        if($num_rows>0){
         
        
        while($data = mysqli_fetch_assoc($result))
        {
          if($data["chat_type"]==2)
              {
               
              //$data["image"]=$file_path.$data["image"];
               // $data["image"]=$BaseUrl.$data["image"].'.JPG';

             
              }
             
            array_push($jsonObj,$data); 
           
        }
     
          //array_push($get_chats, $data);
          // $set['abcdapp'] =array('success'=>'1','Results' =>$jsonObj);
           $set['abcdapp']=array('message' =>' Referals Found','title'=>'hello','success'=>'1','Results' =>$jsonObj);


            
               $data = array(
                'status' => '2',
               
                  );

          /*   $sql=Update('CHATS', $data, "  WHERE `user_id` = '$userMobile' and artist_id='$adminMobile' AND `send_by`= '$adminMobile' ");
*/
         }else{
    //   $set['abcdapp']=array('title'=>'No Chat found ','msg' =>'You Can Ask your Queries Here ','success'=>'0');
       $set['abcdapp']=array('message' =>' Referals Found','title'=>'hello','success'=>'0');

     }
        }

    header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

      }

       /*Send message (Chat)*/

   else if(isset($_GET['addTicketComments']))
   {

     $data = array(      
              'user_id'  =>  $_POST['userMobile'],    
              'ticket_id'  =>  $_POST['ticketId'],   
              'message'  =>  $_POST['message'],
              'sender_name'  =>  $_POST['sender_name'],
              'recieverName'  =>  $_POST['reciever_name'],
              'artist_id'  =>  $_POST['artist_id'],
              'send_by'  =>  $_POST['send_by'],
               'chat_type'  =>  $_POST['chat_type'],
              'image'  =>  "",
              'send_by'  =>  $_POST['send_by'],
               'status'  =>  '1',
             'send_at'  =>  $date,
              'date'  =>  $date,
               'msglive'  =>  '1',
                          );



    

if(isset($_FILES["big_picture"]))
{
  $ext = pathinfo($_FILES['big_picture']['name'], PATHINFO_EXTENSION);

              $user_profile=rand(0,99999)."_user.".$ext;

              //Main Image
              $tpath1='../admin/uploads/supporttickets/'.$user_profile;   


if(move_uploaded_file($_FILES["big_picture"]["tmp_name"],$tpath1))
{

/*$success = true;
$message = "Uploaded!!!";*/
$data['image']=BASE_URL.'/uploads/supporttickets/'.$user_profile;



}
else
{
/*$success = false;
$message = "NOT Uploaded!!! _ Error While Uploading";*/
 $set['abcdapp']=array('title'=>'Ticket Generation Failed ..!','message' =>' Please try Again Later.!','success'=>'0');


}
}


$qry=Insert('CHATS', $data);
    //print_r($qry);exit;
  
  if($qry!=0){
   
   $set['abcdapp']=array('message' =>' Admin Will reply As Soon As Possible','title'=>'New Ticket Has Been Generated !','success'=>'1','Results' =>$jsonObj);

    }
    else
    {
        $set['abcdapp']=array('title'=>'Ticket Generation Failed ..!','message' =>' Please try Again Later.!','success'=>'0');
    
   } 




    

  
         header( 'mysqlitent-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die(); 


    }
else if(isset($_GET['send_push'])){
$user_id='8251941210';
$send_by='8251941210';
$message="";
 // print_r('hello');exit;
   firebase_notification("1",$send_by,$user_id, "Chat" ,$message,CHAT_NOTIFICATION);

   
}


 
 
/*------------------------------admin_app_Api-----------------------------------*/
?>