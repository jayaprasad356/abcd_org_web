<?php

 if ($_SERVER['REQUEST_METHOD']=='POST') {
    
    $mobile = $_POST['mobile'];

    require_once 'connect.php';
    
     date_default_timezone_set('Asia/Kolkata');
 
 
   $hour=(date("H")*60)+date("i");

    $sql = "SELECT DISTINCT
   
    USER_DETAILS.unique_id,
    USER_DETAILS.mobile,   
    USER_DETAILS.name,   
    USER_DETAILS.wallet,
    DAILY.spin_hour,
    DAILY.watch_hour,
    DAILY.scratch_hour,
    DAILY.quiz_hour,
    ADMIN.dailytask_coin,
    ADMIN.hourly_quiz_coin,
    ADMIN.maths_quiz_coin,
    ADMIN.maxm_maths_questn,
    ADMIN.hourly_spin_limit,
    ADMIN.hourly_mathsquiz_limit,
    ADMIN.mathsQuiz_unlockMin
   
FROM
    USER_DETAILS,
    DAILY,
    ADMIN
WHERE
    USER_DETAILS.mobile = '$mobile' AND DAILY.mobile = '$mobile' ";

    $response = mysqli_query($conn, $sql);

    $result = array();
    $result['read'] = array();

    if( mysqli_num_rows($response) === 1 ) {
        
        if ($row = mysqli_fetch_assoc($response)) {
 
             
                         $h['unique_id']         = $row['unique_id'] ;
                         $h['mobile']            = $row['mobile'] ;
                         $h['name']              = $row['name'] ;
                         $h['email']             = $row['email'] ;
                         $h['wallet']            = $row['wallet'] ;
                         $h['spin']              = $row['spin'] ;
			 $h['watch']             = $row['watch'] ;
			 $h['scratch']           = $row['scratch'] ;
			 $h['quiz']              = $row['quiz'] ;
			  $h['spin_hour']         = $row['spin_hour'] ;
			 $h['watch_hour']          = $row['watch_hour'] ;
			 $h['scratch_hour']           = $row['scratch_hour'] ;
			 $h['quiz_hour']              = $row['quiz_hour'] ;
                         $h['dailytask_coin']        = $row['dailytask_coin'] ;
                        $h['hourly_quiz_coin']        = $row['hourly_quiz_coin'] ;
                        $h['maths_quiz_coin']        = $row['maths_quiz_coin'] ;
                        $h['maxm_maths_questn']        = $row['maxm_maths_questn'] ;
                        $h['hourly_spin_limit']        = $row['hourly_spin_limit'] ;
                        $h['hourly_mathsquiz_limit']        = $row['hourly_mathsquiz_limit'] ;
                        $h['mathsQuiz_unlockMin']        = $row['mathsQuiz_unlockMin'] ;
			$h['current_minute']    =        $hour ;
			
			
			 
 
             array_push($result["read"], $h);
 
             $result["success"] = "1";
             echo json_encode($result);
        }
 
   }
 
  }else {
 
     $result["success"] = "0";
     $result["message"] = "Error!";
     echo json_encode($result);
 
     mysqli_close($conn);
 }

 
 ?>