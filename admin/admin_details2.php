<?php

//if ($_SERVER['REQUEST_METHOD']=='POST') {
    
    $uid = $_POST['uid'];

    require_once 'connect.php';

	
    $sql = "SELECT DISTINCT
   
    ADMIN.joining_bonus,
    ADMIN.per_refer,
    ADMIN.dailytask_coin,
    ADMIN.hourly_quiz_coin,
    ADMIN.maths_quiz_coin,
    ADMIN.maxm_maths_questn,
    ADMIN.hourly_spin_limit,
    ADMIN.hourly_mathsquiz_limit,
    ADMIN.mathsQuiz_unlockMin,
    ADMIN.per_news_coin,
    ADMIN.minimum_widthrawal,
    ADMIN.min_redeem_amount,
    ADMIN.telegramlink,
    ADMIN.youtube_link,
    ADMIN.facebook_page,
    ADMIN.new_version,
    ADMIN.update_link,
    ADMIN.admin_msg,
    ADMIN.join_group,
    ADDS_TABLE.publisher_id,
    ADDS_TABLE.adds_type,
    ADDS_TABLE.banner_add,
    ADDS_TABLE.industrial_add,
    ADDS_TABLE.reward_add,
    ADDS_TABLE.native_add,
    ADDS_TABLE.fb_banner1,
    ADDS_TABLE.fb_banner2,
    ADDS_TABLE.fb_industrial1,
    ADDS_TABLE.fb_industrial2,
    ADDS_TABLE.fb_industrial3,
    ADDS_TABLE.fb_reward1,
    ADDS_TABLE.fb_reward2,
    ADDS_TABLE.fb_native,
    ADDS_TABLE.addmob_banner1,
    ADDS_TABLE.addmob_banner2,
    ADDS_TABLE.addmob_industrial1,
    ADDS_TABLE.addmob_industrial2,
    ADDS_TABLE.addmob_industrial3,
    ADDS_TABLE.addmob_rewarded1,
    ADDS_TABLE.addmob_rewarded2,
    ADDS_TABLE.addmob_native,
    ADDS_TABLE.rewardadd_Coins,
    ADDS_TABLE.news_api,
   
    
    APP_SETTING.id,
    APP_SETTING.app_name,
    APP_SETTING.app_logo,
    APP_SETTING.app_description,
    APP_SETTING.app_version,
    APP_SETTING.app_author,
    APP_SETTING.app_contact,
    APP_SETTING.app_email,
    APP_SETTING.app_website,
    APP_SETTING.app_developed_by,
    APP_SETTING.payment_mode1,
    APP_SETTING.payment_mode2,
    TASK_INSTRUCTION.id,
    TASK_INSTRUCTION.instruction1,
    TASK_INSTRUCTION.instruction2,
    TASK_INSTRUCTION.instruction3,
    TASK_INSTRUCTION.instruction4,
    TASK_INSTRUCTION.instruction5,
    TASK_INSTRUCTION.instruction6,
    TASK_INSTRUCTION.instruction7,
    TASK_INSTRUCTION.instruction8,
    TASK_INSTRUCTION.instruction9
   
    
FROM
    ADMIN,
    ADDS_TABLE,
    APP_SETTING,
    TASK_INSTRUCTION
WHERE
ADMIN.id=ADDS_TABLE.id=APP_SETTING.id=TASK_INSTRUCTION.id=1";

    $response = mysqli_query($conn, $sql);
    
     $sql_marque ="";
     $response_marque = mysqli_query($conn, $sql);
     $num=mysqli_num_rows($response_marque);
     
      $query1="SELECT * FROM `WALLET` ORDER by `ID` DESC LIMIT 10";
      $result1=mysqli_query($conn,$query1);
      $num= mysqli_num_rows($result1);
      $i=0;
						while($row1= mysqli_fetch_array($result1)){
						$marque_text=$row1['username']." Got ".$row1['amount']." Coins by ".$row1['txn']." | ";
						$j[$i]=$marque_text;
							
							$i++;
                          $num--;

						}
      
    $result = array();
    $result['read'] = array();

    if( mysqli_num_rows($response) === 1 ) {
        
        if ($row = mysqli_fetch_assoc($response)) {
 
$h['joining_bonus']        = $row['joining_bonus'] ;
$h['per_refer']        = $row['per_refer'] ;
$h['dailytask_coin']        = $row['dailytask_coin'] ;
$h['hourly_quiz_coin']        = $row['hourly_quiz_coin'] ;
$h['maths_quiz_coin']        = $row['maths_quiz_coin'] ;
$h['maxm_maths_questn']        = $row['maxm_maths_questn'] ;
$h['hourly_spin_limit']        = $row['hourly_spin_limit'] ;
$h['hourly_mathsquiz_limit']        = $row['hourly_mathsquiz_limit'] ;
$h['mathsQuiz_unlockMin']        = $row['mathsQuiz_unlockMin'] ;
$h['per_news_coin']        = $row['per_news_coin'] ;
$h['minimum_widthrawal']        = $row['minimum_widthrawal'] ;
$h['min_redeem_amount']        = $row['min_redeem_amount'] ;
$h['telegramlink']        = $row['telegramlink'] ;
$h['youtube_link']        = $row['youtube_link'] ;
$h['facebook_page']        = $row['facebook_page'] ;
$h['new_version']        = $row['new_version'] ;
$h['update_link']        = $row['update_link'] ;
$h['admin_msg']        = $row['admin_msg'] ;
$h['join_group']        = $row['join_group'] ;
$h['publisher_id']        = $row['publisher_id'] ;
$h['adds_type']        = $row['adds_type'] ;
$h['banner_add']        = $row['banner_add'] ;
$h['industrial_add']        = $row['industrial_add'] ;
$h['reward_add']        = $row['reward_add'] ;
$h['native_add']        = $row['native_add'] ;
$h['fb_banner1']        = $row['fb_banner1'] ;
$h['fb_banner2']        = $row['fb_banner2'] ;
$h['fb_industrial1']        = $row['fb_industrial1'] ;
$h['fb_industrial2']        = $row['fb_industrial2'] ;
$h['fb_industrial3']        = $row['fb_industrial3'] ;
$h['fb_reward1']        = $row['fb_reward1'] ;
$h['fb_reward2']        = $row['fb_reward2'] ;
$h['fb_native']        = $row['fb_native'] ;
$h['addmob_banner1']        = $row['addmob_banner1'] ;
$h['addmob_banner2']        = $row['addmob_banner2'] ;
$h['addmob_industrial1']        = $row['addmob_industrial1'] ;
$h['addmob_industrial2']        = $row['addmob_industrial2'] ;
$h['addmob_industrial3']        = $row['addmob_industrial3'] ;
$h['addmob_rewarded1']        = $row['addmob_rewarded1'] ;
$h['addmob_rewarded2']        = $row['addmob_rewarded2'] ;
$h['addmob_native']       = $row['addmob_native'] ;
$h['rewardadd_Coins']       = $row['rewardadd_Coins'] ;
$h['news_api']       = $row['news_api'] ;
$h['youtube_link']       = $row['youtube_link'] ;
 $h['app_name']       = $row['app_name'] ;
 $h['app_logo']       = $row['app_logo'] ;
 $h['app_description']       = $row['app_description'] ;
 $h['app_version']       = $row['app_version'] ;
 $h['app_author']       = $row['app_author'] ;
 $h['app_contact']       = $row['app_contact'] ;
 $h['app_email']       = $row['app_email'] ;
 $h['app_website']       = $row['app_website'] ;
 $h['app_developed_by']       = $row['app_developed_by'] ;
 $h['payment_mode1']       = $row['payment_mode1'] ;
 $h['payment_mode2']       = $row['payment_mode2'] ;
 $h['instruction1']       = $row['instruction1'] ;
 $h['instruction2']       = $row['instruction2'] ;
 $h['instruction3']       = $row['instruction3'] ;
 $h['instruction4']       = $row['instruction4'] ;
 $h['instruction5']       = $row['instruction5'] ;
 $h['instruction6']       = $row['instruction6'] ;
 $h['instruction7']       = $row['instruction7'] ;
 $h['instruction8']       = $row['instruction8'] ;
 $h['instruction9']       = $row['instruction9'] ;
 $h['marque_data']         =$j['0'].$j['1'].$j['2'].$j['3'].$j['4'].$j['5'].$j['6'].$j['7'].$j['8'].$j['9'];

          
			 
			
			
			 
			 
			 
			 
			 
			 
 
             array_push($result["read"], $h);
 
             $result["success"] = "1";
             echo json_encode($result);
        }
 
 //  }
 
 }else {
 
     $result["success"] = "0";
     $result["message"] = "Error!";
     echo json_encode($result);
 
     mysqli_close($conn);
 }
 
 ?>