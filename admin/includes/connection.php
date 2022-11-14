<?php
    error_reporting(0);
 		 ob_start();
    session_start();
 
 	header("Content-Type: text/html;charset=UTF-8");
 	
		 
           /* DEFINE ('DB_USER', 'u389767788_abcdjoblive');
            DEFINE ('DB_PASSWORD', 'King@#5178');
            DEFINE ('DB_HOST', 'localhost'); //host name depends on server
            DEFINE ('DB_NAME', 'u389767788_abcdjoblive');*/

              DEFINE ('DB_USER', 'u893061261_abcdAshok');
            DEFINE ('DB_PASSWORD', 'King@#5178');
            DEFINE ('DB_HOST', 'localhost'); //host name depends on server
            DEFINE ('DB_NAME', 'u893061261_abcdAshok');
	
	 date_default_timezone_set("Asia/Calcutta");
    $date=strtotime("now");

	$mysqli =mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	if ($mysqli->connect_errno) 
	{
    	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	mysqli_query($mysqli,"SET NAMES 'utf8'");	 



	//Settings
     $setting_qry="SELECT * FROM  `APP_SETTING` AS M INNER JOIN `ADMIN` AS N INNER JOIN `ADDS_TABLE` AS O  WHERE ( M.id='1' AND N.id=1 AND O.id='1' )";

    $setting_result=mysqli_query($mysqli,$setting_qry);
    $settings_details=mysqli_fetch_assoc($setting_result);

    define("APP_API_KEY",'pXtZkdKQei4hiSgEfLG0pFW2yhAAPDCJCV8x3viuAoSuB');
    define("ONESIGNAL_APP_ID","a55b3068-3d26-4b9c-9e82-ec1e09e0859f");
    define("ONESIGNAL_REST_KEY","ZmM4YmI4NDktNzdkNC00NDRhLWIzNDYtMGNkYjEyYzg3NzZi");
     define("FIREBASE_KEY","AAAAkqC7cW8:APA91bFMMCTkpyrCH4Z9VwYgNE2jXT2IXdA9QO5U_fHD0_-yjLvou7gKG2fBw3bIGVuzTCCyqPUjyBFGnrPMZdfBULhdisyQqwsPlJ3gvAmlMy8qcx-5A3FX8M18phhi18JupgbGK3v6");

    define("APP_NAME",$settings_details['app_name']);
    define("APP_LOGO",$settings_details['app_logo']);
    define("APP_FROM_EMAIL",$settings_details['email_from']);

    define("API_PAGE_LIMIT",$settings_details['api_page_limit']);
    define("API_LATEST_LIMIT",$settings_details['api_latest_limit']);
    define("API_CAT_ORDER_BY",$settings_details['api_cat_order_by']);
    define("API_CAT_POST_ORDER_BY",$settings_details['api_cat_post_order_by']);
    define("API_REGISTRATION_REWARD",$settings_details['registration_reward']);
    define("API_REFER_REWARD",$settings_details['app_refer_reward']);
 
    define("REDEEM_POINTS",$settings_details['redeem_points']);
    define("REDEEM_MONEY",$settings_details['redeem_money']);  /*$row['per_qr_coin'] = $data['per_qr_coin'];*/
     define("PER_QRCOIN",$settings_details['per_qr_coin']); 
    define('PAYTM_MERCHANT_KEY',$settings_details['paytm_merchent_key']); 
    define('PAYTM_MERCHANT_ID',$settings_details['paytm_mid']); 
     define('CHAT_NOTIFICATION',10007);
      // $amount=100*PER_QRCOIN;
      // print_r($amount);exit;

        //Profile
    if(isset($_SESSION['id']))
    {
        $profile_qry="SELECT * FROM ADMIN_ROLE where id='".$_SESSION['id']."'";
        $profile_result=mysqli_query($mysqli,$profile_qry);
        $profile_details=mysqli_fetch_assoc($profile_result);

        define("PROFILE_IMG",$profile_details['profileImg']);
        
       // print_r(PROFILE_IMG);exit;
    }
    
     
     define('BASE_URL',"https://abcdjob.live/admin/");
  
?> 
     
	 
 