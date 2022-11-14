<?php //error_reporting(0);

/**
 * Copyright 2019 DARWINBARK.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
 

#Admin Login
function adminUser($username, $password){
    
    global $mysqli;

    $sql = "SELECT id,admin_id FROM ADMIN where admin_id = '".$username."' and password = '".md5($password)."'";       
    $result = mysqli_query($mysqli,$sql);
    $num_rows = mysqli_num_rows($result);
     
    if ($num_rows > 0){
        while ($row = mysqli_fetch_array($result)){
            echo $_SESSION['ADMIN_ID'] = $row['id'];
                        echo $_SESSION['ADMIN_USERNAME'] = $row['username'];
                                      
        return true; 
        }
    }
    
}


# Insert Data 
function Insert($table, $data){

    global $mysqli;
    //print_r($data);

    $fields = array_keys( $data );  
    $values = array_map( array($mysqli, 'real_escape_string'), array_values( $data ) );
    
   //echo "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');";
   //exit;  
  return  mysqli_query($mysqli, "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');") or die( mysqli_error($mysqli) );

}

// Update Data, Where clause is left optional
function Update($table_name, $form_data, $where_clause='')
{   
    global $mysqli;
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);

    // append the where statement
    $sql .= $whereSQL;
      
    //  SendNotiOnUpd($table_name,$orderId);   
    // run and return the query result

 /*firebase_notificationToBoth("2",$mobile,APP_CONTACT,"","",$orderId,$screenIntent);*/

    return mysqli_query($mysqli,$sql);
    //return $sql;
   // print_r($sql);exit;
 //return "heloji";
}

 
//Delete Data, the where clause is left optional incase the user wants to delete every row!
function Delete($table_name, $where_clause='')
{   
    global $mysqli;
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM ".$table_name.$whereSQL;
     
    // run and return the query result resource
    return mysqli_query($mysqli,$sql);
}  

//Create Thumb Image
function create_thumb_image($target_folder ='',$thumb_folder = '', $thumb_width = '',$thumb_height = '')
 {  
     //folder path setup
         $target_path = $target_folder;
         $thumb_path = $thumb_folder;  
          

         $thumbnail = $thumb_path;
         $upload_image = $target_path;

            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                     break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
            }
       imagecopyresized($thumb_create, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width,$height);
            switch($file_ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,80);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,80);
                    break;
                case 'gif':
                    imagegif($thumb_create,$thumbnail,80);
                     break;
                default:
                    imagejpeg($thumb_create,$thumbnail,80);
            }
 }

 function user_reward_activity($video_id="",$user_id,$activity_type,$rewards_points)
    {
        global $mysqli;
    
      if($video_id!="" AND $user_id!="" AND $activity_type!="Add Video")
      {
            $qry = "SELECT * FROM tbl_users_rewards_activity WHERE  video_id = '".$video_id."' and user_id = '".$user_id."'";
            $result = mysqli_query($mysqli,$qry);
            $num_rows = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            
            if ($num_rows <= 0)
                { 
                     $user_qry=mysqli_query($mysqli,"UPDATE tbl_users SET total_point= total_point + '".API_VIDEO_VIEWS."' WHERE id = '".$user_id."'");

                     $data = array( 
                     'video_id'  =>  $video_id,
                     'user_id'  =>  $user_id,
                     'activity_type'  =>  $activity_type,
                     'points'  =>  $rewards_points
                      );
                  
                     $qry = Insert('tbl_users_rewards_activity',$data);

                     return  $qry; 
                    
                } 
      } 
      else
      {
            $data = array(                    
                     'user_id'  =>  $user_id,
                     'activity_type'  =>  $activity_type,
                     'points'  =>  $rewards_points
                      );
                  
             $qry = Insert('tbl_users_rewards_activity',$data);

              return  $qry; 
      }

        
                 
    }



function verify_envato_purchase_code($product_code)
{

//$url = "https://api_v1.envato.com/v3/market/author/sale?code=".$product_code;
$curl = curl_init($url);


$personal_token = "M8tF6z8lzZBBkmZt4xm3dU4lw7Rlbrwp";
$header = array();
$header[] = 'Authorization: Bearer '.$personal_token;
$header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
$header[] = 'timeout: 20';
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER,$header);

$envatoRes = curl_exec($curl);
curl_close($curl);
$envatoRes = json_decode($envatoRes);


 return $envatoRes->buyer;

 
}


//This for Spin Coin Apps

function user_spincoin_activity_test($user_id,$activity_type,$rewards_points,$deviceid,$ipaddress)
{
    global $mysqli;

   
    $user_qry=mysqli_query($mysqli,"UPDATE tbl_users SET total_point= total_point + '".$rewards_points."' WHERE id = '".$user_id."'");

    $data = array(
        'user_ip'  =>  $ipaddress,
        'user_id'  =>  $user_id,
        'activity_type'  =>  $activity_type,
        'device_id'  =>  $deviceid,
        'points'  =>  $rewards_points
    );

    $qry = Insert('tbl_users_rewards_activity',$data);

    return  $qry;
   
}

function user_spincoin_activity($user_id,$activity_type,$rewards_points,$deviceid,$ipaddress,$pointtype)
{
    global $mysqli;
    $user_qry=mysqli_query($mysqli,"UPDATE tbl_users SET total_point= total_point + '".$rewards_points."' WHERE id = '".$user_id."'");

    $data = array(
        'user_ip'  =>  $ipaddress,
        'user_id'  =>  $user_id,
        'activity_type'  =>  $activity_type,
        'device_id'  =>  $deviceid,
        'points'  =>  $rewards_points,
        'point_type'=> $pointtype
    );

    $qry = Insert('tbl_users_rewards_activity',$data);
    return  $qry;
}

function spin_count_user($user_id,$device_id)
{
    global $mysqli;
    $data = array(
        'user_id'  =>  $user_id,
        'device_id'  =>  $device_id,
        'daily_spin_count'  =>  '0',
        'daily_bid_count'  =>  '0',
        'status'=> 1
    );
    $qry = Insert('tbl_spin_count',$data);
    return  $qry;
}
function video_ads_count_user($user_id,$device_id)
{
    global $mysqli;
    $data = array(

        'user_id'  =>  $user_id,
        'device_id'  =>  $device_id,
        'daily_vads_count'  =>  '0',       
        'status'=> 1
    );
    $qry = Insert('tbl_video_ads_count',$data);
    return  $qry;
}
function user_spincoin_update($user_id,$device_id)
{
    global $mysqli;

    $qry = "SELECT * FROM tbl_spin_count WHERE user_id = '".$user_id."' and device_id = '".$device_id."' and CAST(`update_date` as DATE)=cast(CURRENT_TIMESTAMP as date)";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);
    if($row['user_id']!="")
    {
        $user_qry=mysqli_query($mysqli,"UPDATE tbl_spin_count SET daily_spin_count= daily_spin_count + 1,update_date=CURRENT_TIMESTAMP() WHERE user_id = '".$user_id."' and device_id='".$device_id."'");
    }else
        {
        $user_qry=mysqli_query($mysqli,"UPDATE tbl_spin_count SET daily_spin_count=0,update_date=CURRENT_TIMESTAMP() WHERE user_id = '".$user_id."' and device_id='".$device_id."'");

    }
    return  $user_qry;

}
  function formatTimeToDate($timeStamp)
    { 
        global $mysqli;
      $timeStampD=(date("d-m-Y | h:i:s A",$timeStamp));
        return  $timeStampD;       
    }

 function formatTimeToDate2($timeStamp)
    { 
        global $mysqli;
      $timeStampD=(date("d-m-Y",$timeStamp));
        return  $timeStampD;       
    }
    
 function getSingleRow($table, $mysqlidition)    
    {   
    global $mysqli;
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "SELECT * FROM ".$table.$mysqlidition;
     
    // run and return the query result resource
    //return mysqli_query($mysqli,$sql);
    return mysqli_fetch_assoc(mysqli_query($mysqli,$sql));
   //return $sql;
  }  

  /* function returnId()    
  {   
    //global $mysqli;
     print_r("hello");exit;
    // check for optional where clause
   
    // build the query
    $sql = "SELECT * FROM ".$table.$condition;
    $query21 = "SELECT COUNT(*) as num FROM `excel_text` ";
    $maxvv=mysqli_fetch_assoc(mysqli_query($mysqli,$query21));
   print_r($maxv['num']);exit;
   $maxv1=rand('1','10');

    
     
    $key = true;

    while($key){
        // Do stuff
        $maxv=rand(1,$maxv1);
         $query211 = "SELECT * FROM  `excel_text` AS M INNER JOIN `WALLET` AS N WHERE ( M.id='$maxv' AND N.qrId=$maxv AND N.mobile=$mobile) ";
       $result=mysqli_fetch_assoc(mysqli_query($mysqli,$query211));
        if(mysql_num_rows($result) > 0) $key = false;
    }
    // run and return the query result resource
    // return "hello";
   //return $sql;
  }  
  
   
*/
    function createUserCode1($adminCode)
{
   global $mysqli;
   

/*do {
$referCode=$adminCode.rand(10000,99999);
$result = $mysqli->query("SELECT * FROM  `USER_DETAILS` WHERE  user_referal_code =  '$referCode'");
$num_rows = $result->num_rows;
} 
while ($num_rows = 0);

//print_r($referCode);exit;
 //return $referCode;
*/
 $key = true;
$maxv1='99999';
    while($key){
        // Do stuff
        $maxv=rand('10000',$maxv1);
        $referCcode=$adminCode.rand(10000,99999);
        $query13 = "SELECT * FROM  `USER_DETAILS`  WHERE  user_referal_code =  '$referCcode' ";
        // print_r(mysqli_query($mysqli,$query13));exit;
          $sql13 = mysqli_query($mysqli,$query13);
         
         $result211=mysqli_fetch_assoc($sql13);
          $numrow13=mysqli_num_rows($sql13);
          
      /*print_r($numrow13);exit;*/
        if($numrow13 != 0) {
          
          // print_r($getid);exit;
        }else{
          $key = false;
          $referCode=$referCcode;
        }
    }

  return $referCode;
}

function calculate_time_span($post_time,$flag=false)
{  
  if($post_time!=''){

    $seconds = time() - $post_time;
    $year = floor($seconds /31556926);
    $months = floor($seconds /2629743);
    $week=floor($seconds /604800);
    $day = floor($seconds /86400); 
    $hours = floor($seconds / 3600);
    $mins = floor(($seconds - ($hours*3600)) / 60); 
    $secs = floor($seconds % 60);
      
    if($seconds < 60) $time = $secs." seconds ago";
    else if($seconds < 3600 ) $time =($mins==1)? $mins." min ago" : $mins." mins ago";
    else if($seconds < 86400) $time = ($hours==1)?$hours." hour ago":$hours." hours ago";
    else if($seconds < 604800) $time = ($day==1)?$day." day ago":$day." days ago";
    else if($seconds < 2629743) $time = ($week==1)?$week." week ago":$week." weeks ago";
    else if($seconds < 31556926) $time =($months==1)? $months." month ago":$months." months ago";
    else $time = ($year==1)? $year." year ago":$year." years ago";

    if($flag){
      if($day > 1){
        $time=date('d-m-Y',$post_time);
      }
    }

    return $time;
  }
  else{
    return 'not available';
  }
  
}
/*Firebase for notification*/
    function firebase_notification($userType,$sendBy,$sendTo,$title,$msg1,$type)
    { global $mysqli;
    
      $mobile=$sendTo;
  
  if($userType=="1"){
    $sqlm = "SELECT * FROM USER_DETAILS WHERE mobile='$mobile' ";
  }else{
    $sqlm = "SELECT * FROM `ADMIN_ROLE` WHERE `admin_mobile`='$mobile' ";
  }
        
         $resultm = mysqli_query($mysqli,$sqlm);
           // $num_rows = mysqli_num_rows($result);
            $rowm = mysqli_fetch_assoc($resultm);
            // $rowm=mysqli_fetch_assoc($resultm,MYSQLI_ASSOC);
            if($userType=="1"){
              $username=$rowm['name'];

            }else{
               $username=$rowm['admin_name'];
            }
           

//print_r($rowm);exit;

        if($rowm['onesignal_pushtoken']!=""){
          $registrationIds=$rowm['onesignal_pushtoken'];
        }/*else{
           $registrationIds ="f_Q082tzSo-QNMvfnXkfqL:APA91bGd6Ia2lTo9BIMOLDtngIrszVcSjmi_lnP3LTG6mw4PHxJR6NPjIFKP0ZAj45mjb5g4GV_avHXP5W5t0QxouDmJDd23FLgC_8FJGkET_RsuIUUdCXVVbVhQO77FDwSbbzf0pqfR";

        }*/

       /*$API_ACCESS_KEY="AAAAVz-Mor4:APA91bHUbXMcLx2hAgzEOECM-7F0q_wdDhmtngs2lmRqaLtSxYczYPHiICSNKITYO67vitwCUxiu0dp39p3KHUVGZbqXnEBJNnNbCkiA0nL0fnqm7msyvwkmwOFRYHp_yKDKPdPQCqjY";*/
       $API_ACCESS_KEY=FIREBASE_KEY;

       
         $msg = array
              (
                  'body'    => $msg1,
                  'title'   => $title,
                  'type'   =>  $type,
                  'username'   => $username,
                  'icon'    => 'myicon',/*Default Icon*/
                  'sound'   =>  'mySound',/*Default sound*/
                  'sendBy'   =>  $sendBy,
                   'sendTo'   =>  $sendTo,
            );

          $fields = array
              (
                  'to'        => $registrationIds,
                  'data'    => $msg,
                   'priority' => 10
                  
              ); 

             // print_r($fields);    
      
          $headers = array
              (
                  'Authorization: key=' . $API_ACCESS_KEY,
                  'Content-Type: application/json'
              );
          
          #Send Reponse To FireBase Server    
          $ch = curl_init();
          curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
          curl_setopt( $ch,CURLOPT_POST, true );
          curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
          curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
          curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
          curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
          $result = curl_exec($ch );
         // print_r($result);exit;
          curl_close( $ch );
       
    }



?>