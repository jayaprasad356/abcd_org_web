<?php
/**
 * Created by Darwinbark.
 * User: KINGSN
 * Date: 13/02/2019
 * Time: 8:45 PM
 */

 date_default_timezone_set("Asia/Calcutta");
    $date=date("d-m-Y | h:i:s a");
 include("../includes/connection.php");
      include("../includes/function.php");
      include("../language/app_language.php"); 

    if( isset($_SERVER['HTTPS'] ) ) {

        $file_path = 'https://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/';
        //https://spinwin.online/admin/

     /* $file_path = 'http://'.$_SERVER['SERVER_NAME'] .'/admin/assets/images/'.APP_LOGO.'';*/
    }
    else
    {
        $file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/';
    }
    /*$src="https://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/admin/assets/images/'.APP_LOGO.'"*/
//print_r($file_path);exit;

    /*public function general_setting(){

     $qry = "SELECT * FROM tbl_settings WHERE id = '1' ";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);

        if(sizeof($result)>0){
            $response=array('status'=>200,'message'=>'Success','Result'=>$result);
        }else{
            $response=array('status'=>400,'message'=>'Sorry, we could not find any matches.<br>Please try again.','Result'=>$result);
        }
        echo json_encode($response);
    }*/



    

if(isset($_GET['user_register2']))
{

    $registration_reward=API_REGISTRATION_REWARD;
    $reg_date = date('d/m/Y');
     date_default_timezone_set("Asia/Calcutta");
    $reg_date=date("d-m-Y | h:i:s a");

    $qry = "SELECT * FROM tbl_users WHERE   email = '".$_POST['email']."' OR phone = '".$_POST['phone']."' ";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);
//print_r($row);exit;
    if($row['email']==$_POST['email'])
    {
        $set['spin'][]=array('msg' => "Email address  already used!",'success'=>'0');
    }else if($row['phone']==$_POST['phone']){
        $set['spin'][]=array('msg' => "Fone Number  already used!",'success'=>'0');
    }
    else
    {
        $user_code=createRandomCode();

        $qry1="INSERT INTO tbl_users(`id`,`user_deviceid`,`user_type`,`user_code`,`name`,`email`,`password`,`phone`,reg_ip,total_point,wallet_bal) VALUES (NULL,'".$_POST['deviceid']."','Normal','".$user_code."','".$_POST['name']."','".$_POST['email']."','".$_POST['password']."','".$_POST['phone']."','".$_POST['reg_ip']."','0','$registration_reward')";
         // print($qry1);exit;
        $result1=mysqli_query($mysqli,$qry1);
        $user_id=mysqli_insert_id($mysqli);

        if (mysqli_insert_id($mysqli) > 0)
      {
         $set['spin'][]=array('msg' => "Registation successflly...!",'success'=>'1');
      } else{
             $cat_id=mysqli_affected_rows($mysqli);
            $set['spin'] []=array('success'=>'0','title'=>"Error",'msg'=>' Details Updation Failed  !','id'=>$cat_id);  
             
              mysqli_close($mysqli);
              // $res=array('status'=>'200','msg'=>"Details Has Been Updated ! ");
              // print_r($sql);exit;
          }

    }

    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();


}
else if(isset($_GET['user_register']))
{
      $registration_reward=API_REGISTRATION_REWARD;
      $user_code=createRandomCode();

          $user_type= $_POST['type']; //Google, Normal, Facebook
            $email= cleanInput($_POST['email']);
            $auth_id= cleanInput($_POST['auth_id']);
            $deviceid=$_POST['deviceid'];

      // register with google
    if($user_type=='Google' || $user_type=='google'){

            // register with google
            $sql="SELECT * FROM tbl_users WHERE (`email` = '$email' OR `auth_id`='$auth_id') AND `user_type`='Google'";
    $result = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_assoc($result);
    $num_rows = mysqli_num_rows($result);
//print_r($row);exit;
      
  

      if($num_rows == 0)
            {
                $user_code=createRandomCode();
                // data is not available
                $data = array(
                    'user_type'=>'Google',
                    'user_code'=>$user_code,
                    'user_deviceid'=> $_POST['deviceid'],
                    'name'  => cleanInput($_POST['name']),                 
                    'email'  =>  cleanInput($_POST['email']),
                    'password'  =>  cleanInput($_POST['password']),
                    'phone'  =>  cleanInput($_POST['phone']),
                    'reg_ip'  =>  cleanInput($_POST['reg_ip']),
                     'auth_id'  =>  cleanInput($_POST['auth_id']),
                    'total_point'  => "0",
                    'wallet_bal'  => $registration_reward,
                    'reg_date'  =>  $date, 
                    'status'  =>  '1'
                );      
                 
                $qry = Insert('tbl_users',$data);

                $user_id=mysqli_insert_id($mysqli);

                $set['spin'][]=array('user_id' => strval($user_id),'name'=>$_POST['name'],'email'=>$_POST['email'], 'success'=>'1', 'user_code'=>$user_code,'msg' =>'Registation successflly...!', 'auth_id' => $auth_id);
              //  $set['spin'][]=array('msg' => "Registation successflly...!",'success'=>'1');
            
            }else{
                $user_code=$row['user_code'];
                $data = array(
                    'auth_id'  =>  $auth_id,
                ); 
   
                $update=Update('tbl_users', $data, "WHERE id = '".$row['id']."'");

                if($row['status']==0)
                {
                    $set['spin'][]=array('msg' =>$app_lang['account_deactive'],'success'=>'0');
                }   
                else
                {
                     $set['spin'][]=array('user_id' => strval($user_id),'name'=>$_POST['name'],'email'=>$_POST['email'], 'success'=>'1', 'user_code'=>$user_code,'msg' =>'Login successflly...!', 'auth_id' => $auth_id);
                }
            }

        }else{
            // for normal registration

            $sql = "SELECT * FROM tbl_users WHERE email = '$email'"; 
            $result = mysqli_query($mysqli, $sql);
            $row = mysqli_fetch_assoc($result);
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $set['spin'][]=array('msg' => $app_lang['invalid_email_format'],'success'=>'0');
            }
            else if($row['email']!="")
            {
                $set['spin'][]=array('msg' => $app_lang['email_exist'],'success'=>'0');
            }
            else
            {   
                if($_FILES['user_profile']['name']!=''){
                    $ext = pathinfo($_FILES['user_profile']['name'], PATHINFO_EXTENSION);

                    $user_profile=rand(0,99999)."_user.".$ext;

                    //Main Image
                    $tpath1='images/'.$user_profile;   

                    if($ext!='png')  {
                      $pic1=compress_image($_FILES["user_profile"]["tmp_name"], $tpath1, 80);
                    }
                    else{
                      $tmp = $_FILES['user_profile']['tmp_name'];
                      move_uploaded_file($tmp, $tpath1);
                    }
                }
                else{
                    $user_profile='';
                }

                

                $data = array(

                    'user_type'=>'Normal',
                    'user_code'=>$user_code,
                    'user_deviceid'=> $_POST['deviceid'],
                    'name'  => cleanInput($_POST['name']),                 
                    'email'  =>  cleanInput($_POST['email']),
                    'password'  =>  cleanInput($_POST['password']),
                    'phone'  =>  cleanInput($_POST['phone']),
                    'reg_ip'  =>  cleanInput($_POST['reg_ip']),
                     'auth_id'  =>  "",
                    'total_point'  => "0",
                    'wallet_bal'  => $registration_reward,
                    'reg_date'  =>  $date, 
                    'status'  =>  '1'
                );      
                 
                $qry = Insert('tbl_users',$data);
                    
              //  $set['spin'][]=array('msg' => $app_lang['register_success'],'success'=>'1');
                  $set['spin'][]=array('user_id' => strval($user_id),'name'=>$_POST['name'],'email'=>$_POST['email'], 'success'=>'1', 'user_code'=>$user_code,'msg' =>'Registation successflly...!', 'auth_id' => $auth_id);
            }

        }
             header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();

}
else if(isset($_GET['user_logs']))
{
    if(isset($_GET["user_id"])!=null)
    {
        $qry1="INSERT INTO tbl_user_login_logs(`user_id`,`user_deviceid`,`user_ip`,`logs_status`) VALUES ('".$_GET['user_id']."','".$_GET['deviceid']."','".$_GET['user_ip']."','".$_GET['logs_status']."')";

        $result1=mysqli_query($mysqli,$qry1);
        $id=mysqli_insert_id($mysqli);

        $set['spin'][]=array('msg' => "Logs Added",'success'=>'1');
    }else{
        $set['spin'][]=array('msg' => "user not found...!",'success'=>'0');
    }


    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
else if(isset($_GET['users_login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $device_id = $_POST['device_id'];
//print_r($_POST);exit;
    $qry = "SELECT * FROM tbl_users WHERE  email = '$email' ";
    //print_r($qry);exit;
    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
//print_r($row);exit;
     if ($num_rows >0)
    {   
         if($row['user_deviceid']==$device_id ||$row['user_deviceid']=="5178" )
         
         {
             
         
                if($row['password']==$password ){
                    
                            if($row['status']=='2')
                            {
                                 $set['spin'][]=array('title' =>' Account blocked!','msg' =>'Your account blocked!','success'=>'0');
                               
                            }else
                             if($row['status']=='1')
                                
                            {
                                 $set['spin'][]=array('user_id' => $row['id'],'user_code'=>$row['user_code'],'name'=>$row['name'],'email'=>$row['email'],'phone'=>$row['phone'],'walletBal'=>$row['wallet_bal'],'success'=>'1','totalPoint'=>$row['total_point']);
                                
                            }
                
                 }else{
                 $set['spin'][]=array('title' =>' Login Failed!','msg' =>'Your Password Was Incorrect!','success'=>'0');
                 }
                
            }
                else
                {
                    $set['spin'][]=array('title' =>' Login Failed!','msg' =>'Login with The same Device You have Registered!','success'=>'0');
                 }


    }
    else
    {

        //$set['darwinbarkk'][]=array('msg' =>'Login failed','success'=>'0');
        $set['spin'][]=array('title' =>' User Doesnt Exist!','msg' =>'Given Email Id  Is not Registered!','success'=>'0');

    }

   



    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

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
            $set['spin'][]=array('msg' =>'Your account blocked!','success'=>'0');
        }
        else  
        {
            $set['spin'][]=array('user_id' => $row['id'],'user_code'=>$row['user_code'],'name'=>$row['name'],'email'=>$row['email'],'phone'=>$row['phone'],'points'=>$row['total_point'],'walletBal'=>$row['wallet_bal'],'success'=>'1');
        }


    }
    else
    {

        $set['spin'][]=array('msg' =>'Login failed','success'=>'0');
    }



    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
else if(isset($_GET['user_profile']))
{

    $qry = "SELECT * FROM tbl_users WHERE id = '".$_GET['id']."'";
    $result = mysqli_query($mysqli,$qry);

    $row = mysqli_fetch_assoc($result);

    $set['spin'][]=array('user_id' => $row['id'],'name'=>$row['name'],'email'=>$row['email'],'phone'=>$row['phone'],'user_code'=>$row['user_code'],'total_point'=>$row['total_point'],'success'=>'1');




    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
else if(isset($_POST['user_balance']))
{
    //$deviceid=$_GET['device_id'];
    $user_id=$_POST['user_id'];

   // $qry = "SELECT * FROM tbl_users WHERE user_deviceid ='".$deviceid."' and id='".$user_id."'";
    $qry = "SELECT * FROM tbl_users WHERE id='".$_GET['user_id']."'";
    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($num_rows > 0)
    {
        if($row['status']==0)
        {
            $set['spin'][]=array('msg' =>'Your account blocked!','success'=>'0');
        }
        else
        {
            $set['spin'][]=array('points' => $row['total_point'],'success'=>'1');
        }


    }
    else
    {
        $set['spin'][]=array('msg' =>'Login failed1','success'=>'0');
    }

    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}
else if(isset($_GET['balance_update2']))
{
    $deviceid=$_GET['device_id'];
    $user_id=$_GET['user_id'];
    $active_type=$_GET['active_type'];
    $ip=$_GET['user_ip'];
    $points=$_GET['points'];
    $pointtype=$_GET['point_type'];
    user_spincoin_activity($user_id,$active_type,$points,$deviceid,$ip,$pointtype);
    
    // $qry = "SELECT * FROM tbl_users WHERE user_deviceid ='".$deviceid."' and id='".$user_id."'";
    $qry = "SELECT * FROM tbl_users WHERE user_code='".$_GET['user_id']."'";
    //print_r($qry);exit;
    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($num_rows > 0)
    {
        if($row['status']==0)
        {
            $set['spin'][]=array('msg' =>'Your account blocked!','success'=>'0');
        }
        else
        {
            $set['spin'][]=array('points' => $row['total_point'],'wallet_bal'=>$row['wallet_bal'],'success'=>'1');
        }


    }
    else
    {
        $set['spin'][]=array('msg' =>'Login failed1','success'=>'0');
    }

    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}
else if(isset($_GET['balance_update']))
{
    $deviceid=$_POST['device_id'];
    $user_id=$_POST['user_id'];
    $active_type=$_POST['active_type'];
    $ip=$_POST['user_ip'];
    $points=$_POST['points'];
    $pointtype=$_POST['point_type'];
   // user_spincoin_activity($user_id,$active_type,$points,$deviceid,$ip,$pointtype);
    
    
    
   
    date_default_timezone_set("Asia/Calcutta");
    $date=date("d-m-Y | h:i:s a");

    if($pointtype=='0')
    {
        $activity_type="Amount Credited For Lucky Spin";
   
    }
    //todo 
    elseif($pointtype=='1')
    {
         $activity_type="Amount Debited For Spin Chance";
   
    }
     elseif($pointtype=='3')
    {
         $activity_type="Deposited Amount Added Successfully ";
        // $user_qry=mysqli_query($mysqli,"UPDATE tbl_users SET total_point= total_point + '".$rewards_points."' WHERE id = '".$user_id."'");
      }
   
    $data = array(
        'user_ip'  =>  $ip,
        'user_id'  =>  $user_id,
        'activity_type'  =>  $activity_type,
        'device_id'  =>  $deviceid,
        'points'  =>  $points,
        'point_type'=> $pointtype,
        'date'=> $date,
    );

    $qry = Insert('tbl_users_rewards_activity',$data);
    $cat_id=mysqli_insert_id($mysqli);
    //print_r($qry);exit;
      if ($cat_id > 0)
      {
        $qry = "SELECT * FROM tbl_users WHERE user_code='$user_id'";
    //print_r($qry);exit;
            $result = mysqli_query($mysqli,$qry);
            $num_rows = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

         if($row['status']==0)
        {
            $set['spin'][]=array('msg' =>'Your account blocked!','success'=>'0');
        }
        else
        {
         
         // $jsonObj= array();
        // $cat_id=mysqli_affected_rows($mysqli);
         
                $set['spin'][] =array('success'=>'1','title'=>"Success",'msg'=>"Details Has Been Updated ! ",'id'=>$cat_id,'points' => $row['total_point'],'wallet_bal'=>$row['wallet_bal']);  
             // echo json_encode($res);
             // mysqli_close($mysqli);
           }  
    
      }
      else{
             $cat_id=mysqli_affected_rows($mysqli);
            $set['spin'] []=array('success'=>'0','title'=>"Error",'msg'=>' Details Updation Failed  !','id'=>$cat_id);  
             
              // mysqli_close($mysqli);
              // $res=array('status'=>'200','msg'=>"Details Has Been Updated ! ");
              // print_r($sql);exit;
          }
               
            
         header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die(); 




}



else if(isset($_GET['user_profile_update']))
{
    if($_GET['password']!="")
    {
        $user_edit= "UPDATE tbl_users SET name='".$_GET['name']."',email='".$_GET['email']."',password='".$_GET['password']."',phone='".$_GET['phone']."' WHERE id = '".$_GET['user_id']."'";
    }
    else
    {
        $user_edit= "UPDATE tbl_users SET name='".$_GET['name']."',email='".$_GET['email']."',phone='".$_GET['phone']."' WHERE id = '".$_GET['user_id']."'";
    }

    $user_res = mysqli_query($mysqli,$user_edit);

    $set['spin'][]=array('msg'=>'Updated','success'=>'1');

    header( 'Content-Type: application/json; charset=utf-8' );
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

        $set['spin'][]=array('message' => 'Enable','success'=>'1');

    }
    else
    {

        $set['spin'][]=array('message' => 'Disable','success'=>'0');
    }



    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}

else if(isset($_GET['forgot_pass']))
{


    $qry = "SELECT * FROM tbl_users WHERE email = '".$_POST['email']."'";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);

    if($row['email']!="")
    {

        $to = $_POST['email'];
        // subject
        $subject = '[IMPORTANT] '.APP_NAME.' Forgot Password Information';

        $message='<div style="background-color: #f9f9f9;" align="center"><br />
                      <table style="font-family: OpenSans,sans-serif; color: #666666;" border="0" width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
                        <tbody>
                          <tr>
                            <td colspan="2" bgcolor="#FFFFFF" align="center"><img src="https://'.$_SERVER['SERVER_NAME'].'/admin/assets/images/'.APP_LOGO.'" alt="header" width="120"/></td>
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

//print_r($message);exit

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.APP_NAME.' <'.APP_FROM_EMAIL.'>' . "\r\n";
        // Mail it
        @mail($to, $subject, $message, $headers);


        $set['spin'][]=array('msg' => "Password has been sent on your mail!",'success'=>'1');
    }
    else
    {

        $set['spin'][]=array('msg' => "Email not found in our database!",'success'=>'0');

    }


    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}

else if(isset($_GET['sendMailOtp']))
{

$OTP=rand ( 10000 , 99999 );
$OTP=$_GET['email'];

//print_r($OTP);exit;
   /* $qry = "SELECT * FROM tbl_users WHERE email = '".$_POST['email']."'";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);*/

    

        $to = $_GET['email'];
        // subject
        $subject = '[IMPORTANT] '.APP_NAME.' Forgot Password Information';

        $message='<div style="background-color: #f9f9f9;" align="center"><br />
                      <table style="font-family: OpenSans,sans-serif; color: #666666;" border="0" width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
                        <tbody>
                          <tr>
                            <td colspan="2" bgcolor="#FFFFFF" align="center"><img src="https://'.$_SERVER['SERVER_NAME'].'/admin/assets/images/'.APP_LOGO.'" alt="header" width="120"/></td>
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
                                                Your OTP is: '.$OTP.'</p>
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

//print_r($message);exit

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.APP_NAME.' <'.APP_FROM_EMAIL.'>' . "\r\n";
        // Mail it
        @mail($to, $subject, $message, $headers);


        $set['spin'][]=array('msg' => "OTP has been sent on your mail!",'success'=>'1');
    

    header( 'Content-Type: application/json; charset=utf-8' );
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


    $set['spin']=$jsonObj;

    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}

else if(isset($_GET['user_coin_history']))
{
    $jsonObj= array();
    $user_id=$_POST['user_id'];

    $wall_query="SELECT * FROM tbl_users_rewards_activity WHERE user_id='$user_id'  AND status=1 ORDER BY id DESC";

    //print("HELLO");exit;

    $wall_sql = mysqli_query($mysqli,$wall_query);

    while($wall_data = mysqli_fetch_assoc($wall_sql))
    {


        $row1['status'] =$wall_data['status'];
        $row1['activity_type'] =$wall_data['activity_type'];
        $row1['points'] =$wall_data['points'];
         $row1['point_type'] =$wall_data['point_type'];
        $row1['date'] =$wall_data['date'];


        array_push($jsonObj,$row1);

    }


    $set['spin']=$jsonObj;

    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}

else if(isset($_POST['user_withdrawal_history']))
{
      $user_id=$_POST['user_id'];

    $jsonObj= array();

    $wall_query="SELECT * FROM tbl_withdraw_request WHERE user_id='$user_id' ORDER BY id DESC";

    $wall_sql = mysqli_query($mysqli,$wall_query);

  //print_r($wall_sql);
    while($wall_data = mysqli_fetch_assoc($wall_sql))
    {
        $row1['status'] =$wall_data['status'];
        $row1['activity_type'] =$wall_data['payment_mode'];
        $row1['points'] =$wall_data['redeem_price'];
        $row1['payment_details']  =$wall_data['payment_details']; 
        $row1['date'] =$wall_data['request_date']; 
       // $row1['date'] =date('d-m-Y', strtotime($wall_data['request_date']));
        array_push($jsonObj,$row1);
    }


    $set['spin']=$jsonObj;

    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
else if(isset($_GET['api_withdraw_request']))
{
    //print_r($_POST);exit;
   date_default_timezone_set("Asia/Calcutta");
    $date=date("d-m-Y | h:i:s a");

$user_id = $_POST['user_id'];
$device_id = $_POST['device_id'];
$user_points = $_POST['user_points'];
$payment_mode = $_POST['payment_mode'];
$bank_details = $_POST['payment_details'];


$redeem_price= ($_POST['user_points']*REDEEM_MONEY)/REDEEM_POINTS;

$data = array(
    'user_id' =>$user_id ,
    'device_id' =>$device_id ,
    'user_points'  => $user_points,
    'redeem_price'  => $user_points,
    'payment_mode'  => $payment_mode,
    'payment_details'  =>  $bank_details,
     'request_date'=> $date
);
//print_r($data);exit;
$qry = Insert('tbl_withdraw_request',$data);
//print_r($qry);exit;
//$redeem_id=mysqli_insert_id($mysqli);

 $cat_id=mysqli_insert_id($mysqli);
    //print_r($qry);exit;
      if ($cat_id > 0)
      {
        $qry2 = "SELECT * FROM tbl_users WHERE user_code='".$_POST['user_id']."'";
    //print_r($qry);exit;
    $result = mysqli_query($mysqli,$qry2);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($num_rows > 0)
    {
        if($row['status']==0)
        {
            $set['spin'][]=array('msg' =>'Your account blocked!','success'=>'0');
        }
        else
        {
            $set['spin'][]=array('msg'=>'Redeem Request send!','points' => $row['total_point'],'wallet_bal'=>$row['wallet_bal'],'success'=>'1');
        }
       }

}else{
     $set['spin'][]=array('msg' =>'Something Went Wrong!','success'=>'0');
   }

//$user_activity_qry=mysqli_query($mysqli,"UPDATE tbl_users_rewards_activity SET redeem_id='".$redeem_id."',status=0  WHERE user_id = '".$user_id."' AND status = '1'");


header( 'Content-Type: application/json; charset=utf-8' );
echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
die();


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

    $set['spin']=$jsonObj;

    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
else if(isset($_GET['user_refer_history']))
{
    $refer_code=$_POST['refer_code'];
    $jsonObj= array();

    $wall_query="SELECT * FROM tbl_users WHERE refer_code='$refer_code'  AND status=1 ORDER BY id DESC";
    //print_r($wall_query);exit;

    $wall_sql = mysqli_query($mysqli,$wall_query);

    while($wall_data = mysqli_fetch_assoc($wall_sql))
    {


        $row1['name'] =$wall_data['name'];
         $row1['mobile'] =$wall_data['phone'];
       // $row1['date'] =date('d-m-Y', strtotime($wall_data['reg_date']));
         $row1['date'] =$wall_data['reg_date'];
        $row1['points'] =$wall_data['total_point'];


        array_push($jsonObj,$row1);

    }


    $set['spin']=$jsonObj;

    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}
else if(isset($_GET['settings']))
{
    $user_id = $_POST['user_id'];
   // print_r($_POST);exit;
    $mobile=$_POST['user_id'];



$jsonObj= array();

if($user_id!=''){
    $query="SELECT * FROM `tbl_settings` L INNER JOIN `tbl_users` AS W WHERE ( L.id=1 AND W.user_code='$user_id' )";
}else{
    $query="SELECT * FROM tbl_settings WHERE id='1'";

}

    // print_r($query);exit;

$query1 = "SELECT * FROM tbl_withdraw_request AS L INNER JOIN `tbl_users` AS W WHERE ( L.user_id= W.user_code)";

     $result1=mysqli_query($mysqli,$query1);
      $num= mysqli_num_rows($result1);
      $i=0;
        while($row1= mysqli_fetch_array($result1)){
            $userId=$row1['user_id'];
              //  $nummber= str_pad(substr($userId, 2), strlen($userId), 'X', STR_PAD_LEFT);
            $nummber=$row1['name'];
        $marque_text=$nummber." Won Rs ".$row1['user_points']." | ";

        $j[$i]=$marque_text;
            
            $i++;
          $num--;

         }
//print_r(mysqli_fetch_assoc($sql));exit;
         $sql = mysqli_query($mysqli,$query);
         if(mysqli_num_rows($sql)>0){

         
    while($data = mysqli_fetch_assoc($sql))
    {
 

        $row['app_name'] = $data['app_name'];
        $row['app_logo'] = $data['app_logo'];
        $row['app_version'] = $data['app_version'];
        $row['app_author'] = $data['app_author'];
        $row['app_contact'] = $data['app_contact'];
        $row['app_email'] = $data['app_email'];
        $row['app_website'] = $data['app_website'];
        $row['app_description'] = $data['app_description'];
        $row['app_developed_by'] = $data['app_developed_by'];
        $row['app_faq'] = stripslashes($data['app_faq']);
        $row['app_privacy_policy'] = stripslashes($data['app_privacy_policy']);
        $row['publisher_id'] = $data['publisher_id'];
        $row['interstital_ad'] = $data['interstital_ad'];
        $row['interstital_ad_id'] = $data['interstital_ad_id'];
        $row['fb_interstital_ad_id'] = $data['fb_interstital_ad_id'];
        $row['banner_ad'] = $data['banner_ad'];
        $row['banner_ad_id'] = $data['banner_ad_id'];
        $row['fb_banner_ad_id'] = $data['fb_banner_ad_id'];
        $row['interstital_ad_click'] = $data['interstital_ad_click'];
        $row['rewarded_video_ads'] = $data['rewarded_video_ads'];
        $row['rewarded_video_ads_id'] = $data['rewarded_video_ads_id'];
        $row['daily_rewarded_video_ads_limits'] = $data['daily_rewarded_video_ads_limits'];
        $row['daily_spin_limit'] = $data['daily_spin_limit'];
        $row['ads_frequency_limit'] = $data['ads_frequency_limit'];
        $row['redeem_currency'] = $data['redeem_currency'];
        $row['redeem_points'] = $data['redeem_points'];
        $row['redeem_money'] = $data['redeem_money'];
        $row['minimum_redeem_points'] = $data['minimum_redeem_points'];
        $row['payment_method1'] = $data['payment_method1'] ? $data['payment_method1'] : "";
        $row['payment_method2'] = $data['payment_method2'] ? $data['payment_method2'] : "";
        $row['payment_method3'] = $data['payment_method3'] ? $data['payment_method3'] : "";
        $row['payment_method4'] = $data['payment_method4'] ? $data['payment_method4'] : "";
        $row['registration_reward'] = $data['registration_reward'];
        $row['app_refer_reward'] = $data['app_refer_reward'];
        $row['video_add_point'] = $data['video_add_point'];
        $row['redeem_points'] =$data['redeem_points'];
        $row['redeem_money'] =$data['redeem_money'];
        $row['redeem_currency'] =$data['redeem_currency'];
        $row['minimum_redeem_points'] =$data['minimum_redeem_points'];
        $row['per_spin_charge'] =$data['per_spin_charge'];
        $row['spin_charge'] =$data['spin_charge'];
        $row['paytm_mid'] =$data['paytm_mid'];
        $row['paytm_key'] =$data['paytm_key'];
        $row['upi_id'] =$data['upi_id'];
         $row['upi_payment'] =$data['upi_payment'];
         $row['payment_gateway'] =$data['payment_gateway'];
          $row['razorpay_mid'] =$data['razorpay_mid'];
           $row['razorpay_key'] =$data['razorpay_key'];
            $row['payumoney_mid'] =$data['payumoney_mid'];
             $row['payumoney_key'] =$data['payumoney_key'];
          $row['payumoney_salt'] =$data['payumoney_salt'];
        $row['add_type'] =$data['add_type'];
        $row['fb_banner_ad_id'] =$data['fb_banner_ad_id'];
        $row['fb_rewarded_add_id'] = $data['fb_rewarded_add_id'];
        $row['payment_gateway'] = $data['payment_gateway'];
        $row['minimum_add_money'] = $data['minimum_add_money'];
        $row['screenType'] = $data['screenType'];
        $row['id'] = $data['id'];
        $row['user_code'] = $data['user_code'];
        $row['name'] = $data['name'];
        $row['email'] = $data['email'];
        $row['phone'] = $data['phone'];
        $row['password'] = $data['password'];
        $row['wallet_bal'] = $data['wallet_bal'];
        $row['total_point'] = $data['total_point'];
         $row['totalDeposit'] = $data['totalDeposit'];
        $row['user_code'] = $data['user_code'];
        $row['device_id'] = $data['user_deviceid'];
        $row['reg_date'] = $data['reg_date'];
         $row['marque_data']  =$j['0'].$j['1'].$j['2'].$j['3'].$j['4'].$j['5'].$j['6'].$j['7'].$j['8'].$j['9'];
            
        array_push($jsonObj,$row);
        // $set['spin'] = $jsonObj;
           $set['spin']=array('success'=>'1','spin' => $jsonObj);

    }
        

        }else{
            $set['spin']=array('success'=>'0','spin' => $jsonObj);

        }

    


   
   
    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
}
else if(isset($_GET['user_coin_count']))
{
    $user_id=$_GET['user_id'];
    $device_id=$_GET['device_id'];

    $qry = "SELECT * FROM tbl_spin_count WHERE user_id = '".$user_id."' and device_id = '".$device_id."' and CAST(`update_date` as DATE) = cast(CURRENT_TIMESTAMP as date)";
    $result = mysqli_query($mysqli,$qry);
    $num_rows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($num_rows > 0)
    {
        $set['spin'][]=array('spin_count' => $row['daily_spin_count'],'spin_bid_count' =>$row['daily_bid_count'],'success'=>'1');
    }
    else
    {
        $set['spin'][]=array('message' => 'Fail','spin_count' => "5",'spin_bid_count' => "5",'success'=>'1');
    }


    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}

else if(isset($_GET['coin_count_update']))
{
    $user_id=$_GET['user_id'];
    $device_id=$_GET['device_id'];

    $qry = "SELECT * FROM tbl_spin_count WHERE user_id = '".$user_id."' and device_id = '".$device_id."' and CAST(`update_date` as DATE)=cast(CURRENT_TIMESTAMP as date)";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);

    if($row['user_id']!="")
    {
        $user_qry=mysqli_query($mysqli,"UPDATE tbl_spin_count SET daily_spin_count= daily_spin_count + 1,update_date=CURRENT_TIMESTAMP() WHERE user_id = '".$user_id."' and device_id='".$device_id."'");
        $set['spin'][]=array('message' => 'Coin Update','success'=>'1');
    }
    else
    {
        $user_qry=mysqli_query($mysqli,"UPDATE tbl_spin_count SET daily_spin_count=0,update_date=CURRENT_TIMESTAMP() WHERE user_id = '".$user_id."' and device_id='".$device_id."'");
        $set['spin'][]=array('message' => 'Coin Update','success'=>'1');
    }

    header( 'Content-Type: application/json; charset=utf-8' );
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
        $set['spin'][]=array('message' => 'Ads Count Update','success'=>'1');
    }
    else
    {
        $user_qry=mysqli_query($mysqli,"UPDATE tbl_video_ads_count SET daily_vads_count=1,update_date=CURRENT_TIMESTAMP() WHERE user_id = '".$user_id."' and device_id='".$device_id."'");
        $set['spin'][]=array('message' => 'Update','success'=>'1');
    }

    header( 'Content-Type: application/json; charset=utf-8' );
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
        $set['spin'][]=array('ads_count' => $row['daily_vads_count'],'success'=>'1');
    }
    else
    {
        $set['spin'][]=array('message' => 'Fail','daily_vads_count' => '0','success'=>'0');
    }


    header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();

}

else if(isset($_GET['insert_payment_verification']))
{
     date_default_timezone_set("Asia/Calcutta");
    $mobile = $_POST['mobile'];
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $uid = $_POST['uid'];
   // $status = $_POST['status'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $order_id = $_POST['order_id'];
    $amount = $_POST['amount'];
    $date=date("d-m-Y | h:i:s a");
    $status = "1";
//print_r($_POST);exit;
  
   
        {
                    
   $sql = "INSERT INTO `tbl_payment` (`id`, `mobile`, `name`, `email`, `order_id`, `amount`, `status`, `transaction_date`, `verified_date`, `cancel_date`) VALUES (NULL, '$user_id', '$name', '$email', '$order_id', '$amount', '$status', '$date', '', '') ";

   //print_r($sql);exit;
  

    if(mysqli_query($mysqli, $sql)) {

           $set['spin'][]=array('title' =>' Payment Done!','msg' =>'Please Wait For Verification!','success'=>'1');
      }     
               
        }


 

 header( 'Content-Type: application/json; charset=utf-8' );
    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
 
}


else if(isset($_GET['support_ticket']))
    {   
            $query="SELECT * FROM tbl_settings WHERE id='1'";
            $sql = mysqli_query($mysqli,$query);
            $data = mysqli_fetch_assoc($sql);

            

            $contact_name = $_POST['contact_name'];
            $contact_email = $_POST['contact_email'];
            $contact_msg = $_POST['contact_msg'];

            $qry1="INSERT INTO tbl_support_ticket (`contact_name`,`contact_email`,`contact_msg`) VALUES ('".$contact_name."','".$contact_email."','".$contact_msg."')"; 
            $result1=mysqli_query($mysqli,$qry1);

 
            $to = $data['app_email'];
            // subject
            $subject = '[IMPORTANT] '.APP_NAME.' Contact';
            
            $message='<div style="background-color: #f9f9f9;" align="center"><br />
                      <table style="font-family: OpenSans,sans-serif; color: #666666;" border="0" width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
                        <tbody>
                          <tr>
                            <td colspan="2" bgcolor="#FFFFFF" align="center"><img src="https://'.$_SERVER['SERVER_NAME'] .'/admin/assets/images/'.APP_LOGO.'" alt="header" width="120" /></td>
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
                                                Email: '.$_POST['contact_name'].'</p>
                                              <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;">Hello Admin,<br>
                                                Email: '.$_POST['contact_email'].'</p>
                                                 <p style="color:#262626; font-size:20px; line-height:32px;font-weight:500;"> 
                                                message: '.$_POST['contact_msg'].'</p>
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
            
           //  print_r($message);exit;

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: '.APP_NAME.' <'.APP_FROM_EMAIL.'>' . "\r\n";
            // Mail it
            @mail($to, $subject, $message, $headers); 
              
            $set['spin'][]=array('msg' => "Message has been sent! \n We Will Contact Soon",'success'=>'1');
          
        header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();

    }



?>