<?php   include("includes/connection.php");
    include("includes/header.php");
    
    require("includes/function.php");
    require("language/language.php");
   
  
  $qry="SELECT * FROM  `APP_SETTING` AS M INNER JOIN `ADMIN` AS N INNER JOIN `ADDS_TABLE` AS O  WHERE ( M.id='1' AND N.id=1 AND O.id='1' )";
  $result=mysqli_query($mysqli,$qry);
  $settings_row=mysqli_fetch_assoc($result);


  if(isset($_POST['submit']))
  {

    $img_res=mysqli_query($mysqli,"SELECT * FROM APP_SETTING WHERE id='1'");
    $img_row=mysqli_fetch_assoc($img_res);
    

         if($_FILES['image']['name']!="")
            {        
            
         if($img_res_row['app_logo']!="")
            {
           
               unlink('./assets/images/'.$img_res_row['app_logo']);
           }


          $image="profile.png";
                 $image= $_FILES['image']['name'];
                 $extension=end(explode(".", $image));
           $pic1=$_FILES['image']['tmp_name'];
           $tpath1='./assets/images/applogo';
          
          copy($pic1,$tpath1);

           
             $data = array(      
              'app_email'  =>  $_POST['app_email'],
              'redeem_currency'  =>  $_POST['redeem_currency'],       
              'app_name'  =>  $_POST['app_name'],
              'app_logo'  =>  'applogo',
              'app_description'  => addslashes($_POST['app_description']),
                'appReferTxt'  => addslashes($_POST['appReferTxt']),
              'app_version'  =>  $_POST['app_version'],
              'app_author'  =>  $_POST['app_author'],
              'app_contact'  =>  $_POST['app_contact'],
              'app_email'  =>  $_POST['app_email'],   
              'app_website'  =>  $_POST['app_website'],
              'app_developed_by'  =>  $_POST['app_developed_by']                

                  );

    }
    else
    {
  
                $data = array(      
              'app_email'  =>  $_POST['app_email'],
              'redeem_currency'  =>  $_POST['redeem_currency'],       
              'app_name'  =>  $_POST['app_name'],
              'app_logo'  =>  $_POST['app_name'],
              'app_description'  => addslashes($_POST['app_description']),
              'app_version'  =>  $_POST['app_version'],
              'app_author'  =>  $_POST['app_author'],
              'app_contact'  =>  $_POST['app_contact'],
              'app_email'  =>  $_POST['app_email'],   
              'app_website'  =>  $_POST['app_website'],
              'app_developed_by'  =>  $_POST['app_developed_by']                

                  );

    } 

    $settings_edit=Update('APP_SETTING', $data, "WHERE id = '1'");
 

      if ($settings_edit > 0)
      {

        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;

      }   
 
  }

 
  if(isset($_POST['appcontrol_submit']))
  {

        $data = array(
                'joining_bonus' => $_POST['joining_bonus'],
                'per_refer' => $_POST['per_refer'],
                 'perreferTxt' => $_POST['perreferTxt'],
                'appJcode' => $_POST['appJcode'],
                'per_refer_code' => $_POST['per_refer_code'],
                'per_qr_coin' => $_POST['per_qr_coin'],
                 'minReload' => $_POST['minReload'],
                'app_joining_fee' => $_POST['app_joining_fee'],
                'paytm_merchent_key' => $_POST['paytm_merchent_key'],
                'paytm_mid' => $_POST['paytm_mid'],
               // 'min_redeem_amount' => $_POST['min_redeem_amount'],
                'new_version' => $_POST['new_version'],
                'update_link' => $_POST['update_link'],
                'telegramlink' => $_POST['telegramlink'],
                'youtube_link' => $_POST['youtube_link'],
                'facebook_page' => $_POST['facebook_page'],
                'qr_min_time'=>$_POST['qr_min_time'],
                 'widthrawal_btn'=>$_POST['widthrawal_btn'],
                'generate_btn'=>$_POST['generate_btn'],
                 'disableGenBtn'=>$_POST['disableGenBtn'],
                 'dailytask_coin'=>$_POST['dailytask_coin'],
                  );

    
      $settings_edit=Update('ADMIN', $data, "WHERE id = '1'");
  
 
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
 
  }
 

  if(isset($_POST['payment_submit']))
  {

        $data = array(
                'payment_mode1' => $_POST['payment_method1'],
                'payment_mode2' => $_POST['payment_method2'],
                'payment_mode3' => $_POST['payment_method3'],
               'payment_mode4' => $_POST['payment_method4'],
                'widthraw_note'=>$_POST['widthraw_note'],
                  );

    
      $settings_edit=Update('APP_SETTING', $data, "WHERE id = '1'");
  
 
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
 
  }

 if(isset($_POST['gateway_submit']))
  {
    print_r($_POST);

        $data = array(
                'payment_gateway'  =>  $_POST['gateway_option'],
                'paytm_mid'  =>  $_POST['paytm_mid'],
                 'paytm_key'  =>  $_POST['paytm_key'],
                 // 'cash_payment'  =>  $_POST['cash_payment'],
               'paytm_mid'  =>  $_POST['paytm_mid'],
                'razorpay_mid'  =>  $_POST['razorpay_mid'],
                   'razorpay_key'  =>  $_POST['razorpay_key'],
                   'payumoney_mid'  =>  $_POST['payumoney_mid'],
                   'payumoney_key'  =>  $_POST['payumoney_key'],
                   'upiId'  =>  $_POST['upiId'],
                  
                  );

    
      $settings_edit=Update('APP_SETTING', $data, "WHERE id = '1'");
   print_r($settings_edit);
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        
        exit;
  
  }

 

  if(isset($_POST['admob_submit']))
  {

        $data = array(
                'publisher_id'  =>  $_POST['publisher_id'],
                'addmob_industrial1'  =>  $_POST['addmob_industrial1'],
                 // 'addmob_industrial2'  =>  $_POST['addmob_industrial1'],
                 //  'addmob_industrial3'  =>  $_POST['addmob_industrial1'],
               // 'interstital_ad_id'  =>  $_POST['interstital_ad_id'],
                //'interstital_ad_click'  =>  $_POST['interstital_ad_click'],
                   'banner_add'  =>  $_POST['banner_add'],
                   'industrial_add'  =>  $_POST['industrial_add'],
                    'call_industrial_on'  =>  $_POST['call_industrial_on'],
                   'reward_add'  =>  $_POST['reward_add'],
                   'native_add'  =>  $_POST['native_add'],
                   'addmob_banner1'  =>  $_POST['addmob_banner1'],
                   // 'addmob_banner2'  =>  $_POST['addmob_banner1'],
                   'addmob_rewarded1'  =>  $_POST['addmob_rewarded1'],
                   // 'addmob_rewarded2'  =>  $_POST['addmob_rewarded1'],
                   'fb_banner1'  =>  $_POST['fb_banner1'],
                   //'fb_banner2'  =>  $_POST['fb_banner1'],
                   'fb_industrial1'  =>  $_POST['fb_industrial1'],
                  // 'fb_industrial2'  =>  $_POST['fb_industrial1'],
                   //'fb_industrial3'  =>  $_POST['fb_industrial1'],
                   'fb_reward1'  =>  $_POST['fb_reward1'],
                   // 'fb_reward2'  =>  $_POST['fb_reward1'],
                   'fb_native'  =>  $_POST['fb_native'],
                   'addmob_native'  =>  $_POST['addmob_Native'],
                   'reward_frequency'  =>  $_POST['reward_frequency'],
               // 'rewarded_video_ads'  =>  $_POST['rewarded_video_ads'],
               // 'rewarded_video_ads_id'  =>  $_POST['rewarded_video_ads_id'],
               // 'daily_rewarded_video_ads_limits'  =>  $_POST['daily_rewarded_video_ads_limits']
                  );

    
      $settings_edit=Update('ADDS_TABLE', $data, "WHERE id = '1'");
   
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
  
  }

 
  if(isset($_POST['api_submit']))
  {

        $data = array(
                'api_page_limit'  =>  $_POST['api_page_limit'],
                'api_latest_limit'  =>  $_POST['api_latest_limit'],
                'api_cat_order_by'  =>  $_POST['api_cat_order_by'],
                'api_cat_post_order_by'  =>  $_POST['api_cat_post_order_by'],
                'api_all_order_by'  =>  $_POST['api_all_order_by']
                  );

    
      $settings_edit=Update('APP_SETTING', $data, "WHERE id = '1'");
 

      if ($settings_edit > 0)
      {

        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;

      }   
 
  }


  if(isset($_POST['app_faq_submit']))
  {

        $data = array(
                'app_faq'  =>  addslashes($_POST['app_faq'])
                  );

    
      $settings_edit=Update('APP_SETTING', $data, "WHERE id = '1'");
 
 
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
    
 
  }

  if(isset($_POST['app_pri_poly']))
  {

        $data = array(
                'app_privacy_policy'  =>  addslashes($_POST['app_privacy_policy']) 
                  );

    
      $settings_edit=Update('APP_SETTING', $data, "WHERE id = '1'");
 
 
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
    
 
  }


?>
 
   <div class="row">
      <div class="col-md-12">
        <div class="card">
      <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Settings</div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">

 <!-- <input type="button" name="Addcodes" value="Add Codes" idad="<?php echo $_GET['user_id']; ?>" class="btn btn-primary btn-xs edit_data"/> -->

                <?php if(isset($_SESSION['msg'])){?> 
                 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?> 
              </div>
            </div>
          </div>
          <div class="card-body mrg_bottom">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                 
                <li role="presentation" class="active"><a href="#app_settings" aria-controls="app_settings" role="tab" data-toggle="tab">App Settings</a></li>
                <li role="presentation"><a href="#app_control" aria-controls="payment_settings" role="tab" data-toggle="tab">App Control</a></li>
                 <li role="presentation"><a href="#payment_settings" aria-controls="payment_settings" role="tab" data-toggle="tab">Payment Mode</a></li>

                <li role="presentation"><a href="#payment_gateway" aria-controls="payment_gateway" role="tab" data-toggle="tab">Payment Gateway</a></li>

                <li role="presentation"><a href="#ad_settings" aria-controls="ad_settings" role="tab" data-toggle="tab">AdMob Ads</a></li>

                
           <!--     <li role="presentation"><a href="#fbads_settings" aria-controls="fbads_settings" role="tab" data-toggle="tab">Facebook Ads</a></li>
                <li role="presentation"><a href="#api_faq" aria-controls="api_faq" role="tab" data-toggle="tab">App FAQ</a></li> -->
                <li role="presentation"><a href="#app_privacy_policy" aria-controls="app_privacy_policy" role="tab" data-toggle="tab"> Privacy Policy</a></li>
            </ul>
          
           <div class="tab-content">
              <!-- App Setting tab  Start -->
              <div role="tabpanel" class="tab-pane active" id="app_settings">   
                <form action="" name="settings_from" method="post" class="form form-horizontal" enctype="multipart/form-data">
              <div class="section">
                <div class="section-body">
                    
                     <div class="form-group">
                    <label class="col-md-3 control-label">App Name :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_name" id="app_name" value="<?php echo $settings_row['app_name'];?>" class="form-control">
                    </div>
                  </div>
                    
                <div class="form-group">
                    <label class="col-md-3 control-label">App Version :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_version" id="app_version" value="<?php echo $settings_row['app_version'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Author :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_author" id="app_author" value="<?php echo $settings_row['app_author'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Contact :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_contact" id="app_contact" value="<?php echo $settings_row['app_contact'];?>" class="form-control">
                    </div>
                  </div>     
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_email" id="app_email" value="<?php echo $settings_row['app_email'];?>" class="form-control">
                    </div>
                  </div>                 
                   <div class="form-group">
                    <label class="col-md-3 control-label">Website :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_website" id="app_website" value="<?php echo $settings_row['app_website'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Developed By :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_developed_by" id="app_developed_by" value="<?php echo $settings_row['app_developed_by'];?>" class="form-control">
                    </div>
                  </div>     
                    
                    
                  <div class="form-group">
                    <label class="col-md-3 control-label">Host Email :-
                      <p class="control-label-help">(Note: This email required otherwise forgot password email feature will not be work. e.g.info@example.com)</p>
                    </label>
                    <div class="col-md-6">
                      <input type="text" name="app_email" id="app_email" value="<?php echo $settings_row['app_email'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Currency Code:-</label>
                    <div class="col-md-6">
                      <input type="text" name="redeem_currency" id="redeem_currency" value="<?php echo $settings_row['redeem_currency'];?>" class="form-control" placeholder="USD">
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Logo (300x300) :-</label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="image" id="fileupload">
                         
                          <?php if($settings_row['app_logo']!="") {?>
                            <div class="fileupload_img"><img type="image" src="./assets/images/<?php echo $settings_row['app_logo'];?>" alt="image" /></div>
                          <?php } else {?>
                            <div class="fileupload_img"><img type="image" src="assets/images/add-image.png" alt="image" /></div>
                          <?php }?>
                        
                      </div>
                    </div>
                  </div>
                  
                  
                  
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Description :-</label>
                    <div class="col-md-6">
                 
                      <textarea name="app_description" id="app_description" class="form-control"><?php echo $settings_row['app_description'];?></textarea>

                      <script>CKEDITOR.replace( 'app_description' );</script>
                    </div>
                  </div>
                  <div class="form-group">&nbsp;</div>


                    <div class="form-group">
                    <label class="col-md-3 control-label">App Refer Text :-</label>
                    <div class="col-md-6">
                 
                      <textarea name="appReferTxt" id="appReferTxt" class="form-control"><?php echo $settings_row['appReferTxt'];?></textarea>

                      <script>CKEDITOR.replace( 'appReferTxt' );</script>
                    </div>
                  </div>
                  <div class="form-group">&nbsp;</div>

                  
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>
               </form>
              </div>
               <!-- App Setting tab  End -->
            
               
                 <!-- App Control tab Start -->
               <div role="tabpanel" class="tab-pane" id="app_control">
              <form action="" name="app_control" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Joining Bonus:-</label>
                    <div class="col-md-6">
                      <input type="integer" name="joining_bonus" id="joining_bonus" value="<?php echo $settings_row['joining_bonus'];?>" class="form-control">
                    </div>
                  </div>
                  
                  
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Refer Rate:-</label>
                    <div class="col-md-6">
                      <input type="integer" name="per_refer" id="per_refer" value="<?php echo $settings_row['per_refer'];?>" class="form-control">
                    </div>
                  </div>


                     <div class="form-group">
                    <label class="col-md-3 control-label">App Refer Invite Text :-</label>
                    <div class="col-md-6">
                 
                      <textarea name="perreferTxt" id="perreferTxt" class="form-control"><?php echo $settings_row['perreferTxt'];?></textarea>

                      <script>CKEDITOR.replace( 'perreferTxt' );</script>
                    </div>
                  </div>
                  <div class="form-group">&nbsp;</div>


               <div class="form-group">
                    <label class="col-md-3 control-label">App Joining Add Codes:-</label>
                    <div class="col-md-6">
                      <input type="integer" name="appJcode" id="appJcode" value="<?php echo $settings_row['appJcode'];?>" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Disable Gen Btn Days :-</label>
                    <div class="col-md-6">
                      <input type="integer" name="disableGenBtn" id="disableGenBtn" value="<?php echo $settings_row['disableGenBtn'];?>" class="form-control">
                    </div>
                  </div>




                   <div class="form-group">
                    <label class="col-md-3 control-label">App Refer Codes:-</label>
                    <div class="col-md-6">
                      <input type="integer" name="per_refer_code" id="per_refer_code" value="<?php echo $settings_row['per_refer_code'];?>" class="form-control">
                    </div>
                  </div>

                 <div class="form-group">
                    <label class="col-md-3 control-label">Qr code Generation rate :-</label>
                          <b>Note:</b> Maths Quiz Chance After Should be Only In minutes
                    <div class="col-md-6">
                      <input type="integer" name="per_qr_coin" id="per_qr_coin" value="<?php echo $settings_row['per_qr_coin'];?>" class="form-control">
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="col-md-3 control-label">App Joining Fee:-</label>
                    <div class="col-md-6">
                      <input type="integer" name="app_joining_fee" id="app_joining_fee" value="<?php echo $settings_row['app_joining_fee'];?>" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Minimum Code Gen Time:-</label>
                    <div class="col-md-6">
                      <input type="integer" name="qr_min_time" id="qr_min_time" value="<?php echo $settings_row['qr_min_time'];?>" class="form-control">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="col-md-3 control-label">Minimum Reload Time:-</label>
                    <div class="col-md-6">
                      <input type="integer" name="minReload" id="minReload" value="<?php echo $settings_row['minReload'];?>" class="form-control">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Paytm_Key:-</label>
                    <div class="col-md-6">
                      <input type="integer" name="paytm_merchent_key" id="paytm_merchent_key" value="<?php echo $settings_row['paytm_merchent_key'];?>" class="form-control">
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="col-md-3 control-label">paytm_mid:-</label>
                    <div class="col-md-6">
                      <input type="integer" name="paytm_mid" id="paytm_mid" value="<?php echo $settings_row['paytm_mid'];?>" class="form-control">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">New Update Version :-</label>
                          
                    <div class="col-md-6">
                      <input type="integer" name="new_version" id="new_version" value="<?php echo $settings_row['new_version'];?>" class="form-control">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">New Update Link :-</label>
                      <b>Note:</b> Change This Link only When your App is Listed In another Developer group      
                    <div class="col-md-6">
                      <input type="text" name="update_link" id="update_link" value="<?php echo $settings_row['update_link'];?>" class="form-control">
                    </div>
                  </div>



        <div class="form-group">
                  <label class="col-md-3 control-label" style="color: red">Enable/Disable Generate Button :-</label>
                  <div class="col-md-6">
                              <select name="generate_btn" id="generate_btn" class="select2">
                               <option value="0" <?php if($settings_row['generate_btn']=='0'){?>selected<?php }?>>Enabled</option>
                                <option value="1" <?php if($settings_row['generate_btn']!='0'){?>selected<?php }?>>Disable </option>
                                
                    
                              </select>
                            </div>
                          </div>

                   <div class="form-group">
                  <label class="col-md-3 control-label" style="color: red">Enable/Disable Widthraw Button :-</label>
                  <div class="col-md-6">
                              <select name="widthrawal_btn" id="widthrawal_btn" class="select2">
                               <option value="0" <?php if($settings_row['widthrawal_btn']=='0'){?>selected<?php }?>>Enabled</option>
                                <option value="1" <?php if($settings_row['widthrawal_btn']!='0'){?>selected<?php }?>>Disable </option>
                                
                    
                              </select>
                            </div>
                          </div>

                            <div class="form-group">
                  <label class="col-md-3 control-label" style="color: red">Enable/Disable Otp Button :-</label>
                  <div class="col-md-6">
                              <select name="dailytask_coin" id="dailytask_coin" class="select2">
                               <option value="0" <?php if($settings_row['dailytask_coin']=='0'){?>selected<?php }?>>Firebase</option>
                                <option value="1" <?php if($settings_row['dailytask_coin']=='1'){?>selected<?php }?>>Fast2sms </option>
                                  <option value="3" <?php if($settings_row['dailytask_coin']=='3'){?>selected<?php }?>>OFF </option>
                                
                    
                              </select>
                            </div>
                          </div>


                  
                  
                   <div class="form-group">
                    <label class="col-md-3 control-label">In App Telegram Link :-</label>
                          
                    <div class="col-md-6">
                      <input type="text" name="telegramlink" id="telegramlink" value="<?php echo $settings_row['telegramlink'];?>" class="form-control">
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="col-md-3 control-label">In App Youtube Link :-</label>
                          
                    <div class="col-md-6">
                      <input type="text" name="youtube_link" id="youtube_link" value="<?php echo $settings_row['youtube_link'];?>" class="form-control">
                    </div>
                  </div>
                  
                  
                   <div class="form-group">
                    <label class="col-md-3 control-label">In App Facebook Page :-</label>
                          
                    <div class="col-md-6">
                      <input type="text" name="facebook_page" id="facebook_page" value="<?php echo $settings_row['facebook_page'];?>" class="form-control">
                    </div>
                  </div>
                  
                  
                  
                  <br/>
                  <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-6">
                     <!--  <b>Note:</b> If any payment mode empty means inactive and not display in app side-->
                    </div>
                  </div>
                        
                  <div class="form-group">
                  <div class="col-md-9 col-md-offset-3">
                    <button type="submit" name="appcontrol_submit" class="btn btn-primary">Save</button>
                  </div>
                  </div>
                </div>
                </div>
              </form>
            </div>
               <!-- App Control tab End -->
               
               
               
               
               

               <!-- Payment Settings tab Start -->
               <div role="tabpanel" class="tab-pane" id="payment_settings">
              <form action="" name="payment_settings" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Payment Mode 1 :-</label>
                    <div class="col-md-6">
                      <input type="text" name="payment_method1" id="payment_method1" value="<?php echo $settings_row['payment_mode1'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Payment Mode 2 :-</label>
                    <div class="col-md-6">
                      <input type="text" name="payment_method2" id="payment_method2" value="<?php echo $settings_row['payment_mode2'];?>" class="form-control">
                    </div>
                  </div>
                 <div class="form-group">
                    <label class="col-md-3 control-label">Payment Mode 3 :-</label>
                    <div class="col-md-6">
                      <input type="text" name="payment_method3" id="payment_method3" value="<?php echo $settings_row['payment_mode3'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Payment Mode 4 :-</label>
                    <div class="col-md-6">
                      <input type="text" name="payment_method4" id="payment_method4" value="<?php echo $settings_row['payment_mode4'];?>" class="form-control">
                    </div>
                  </div>
                  <br/>
                  <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-6">
                       <b>Note:</b> If any payment mode empty means inactive and not display in app side
                    </div>
                  </div>
                  
                  <br/>
                   <div class="form-group">
                    <label class="col-md-3 control-label">Widthrawal Note :-</label>
                    <div class="col-md-6">
                      <input type="text" name="widthraw_note" id="widthraw_note" value="<?php echo $settings_row['widthraw_note'];?>" class="form-control">
                    </div>
                  </div>
                  <br/>
                  <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-6">
                       <b>Note:</b> If widthraw note is empty Then Note Will not display in Widthrawal section of app side
                    </div>
                  </div>
                        
                  <div class="form-group">
                  <div class="col-md-9 col-md-offset-3">
                    <button type="submit" name="payment_submit" class="btn btn-primary">Save</button>
                  </div>
                  </div>
                </div>
                </div>
              </form>
            </div>
               <!-- Payment  Setting tab End -->

                  
                  <!-- Payment Gateway Settings tab Start -->

               <div role="tabpanel" class="tab-pane" id="payment_gateway">
              <form action="" name="payment_gateway" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                <div class="section">
                <div class="section-body">


                  <div class="form-group">
                  <label class="col-md-2 control-label" style="color: red">Active Payment Gateway :-</label>
                  <div class="col-md-8">
                              <select name="gateway_option" id="gateway_option" class="select2">
                               <option value="cash_payment" <?php if($settings_row['payment_gateway']=='cash_payment'){?>selected<?php }?>>Cash Payment</option>
                                <option value="paytm_gateway" <?php if($settings_row['payment_gateway']=='paytm_gateway'){?>selected<?php }?>>Paytm Gateway </option>
                                <option value="razorpay_gateway" <?php if($settings_row['payment_gateway']=='razorpay_gateway'){?>selected<?php }?>>Razorpay Gateway</option>
                                <option value="payumoney_gateway" <?php if($settings_row['payment_gateway']=='payumoney_gateway'){?>selected<?php }?>>PayuMoney Gateway</option>
                                 <option value="upiId" <?php if($settings_row['payment_gateway']=='upiId'){?>selected<?php }?>>UPI Gateway</option>
                    
                              </select>
                            </div>
                          </div>

             <div class="form-group">
                  <label class="col-md-2 control-label" style="color: red">UPI Payment Gateway :-</label>
                  <div class="col-md-8">

                    <div class="col-md-12">
                              <select name="paytm_active_status" id="paytm_active_status" class="select2" disabled>
                                <option value="true" <?php if($settings_row['payment_gateway']=='upiId'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['payment_gateway']!='upiId'){?>selected<?php }?>>False</option>
                            </select>


  <div class="form-group">
                            <label class="col-md-12 control-label mr_bottom20">UPI Gateway :-</label>
                            <div class="col-md-12">
                            <input type="text" name="upiId" id="upiId" value="<?php echo $settings_row['upiId'];?>" class="form-control">
                            </div>
                          </div>

                          </div>
                             
                            

                            </div>
                          </div>


                  <div class="row">
                  <div class="form-group">
                    <div class="col-md-12">
                    <div class="col-md-5">
                      <div class="banner_ads_block">
                        <div class="banner_ad_item">
                          <label class="control-label">Cash Payment Option</label>              
                           
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Cash Payment Active Status:-</label>
                            <div class="col-md-12">
                              <select name="cash_payment" id="cash_payment" class="select2" disabled>
                                <option value="cash_payment" <?php if($settings_row['payment_gateway']=='cash_payment'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['payment_gateway']!='cash_payment'){?>selected<?php }?>>False</option>
                              </select>
                            </div>
                          </div>
                          
                         <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Cash Payment Merchent:-</label>
                            <div class="col-md-12">
                              <select name="cash_payment" id="cash_payment" class="select2">
                               <option value="True" <?php if($settings_row['payment_gateway']=='cash_payment'){?>selected<?php }?>>True</option>
                                <option value="False" <?php if($settings_row['payment_gateway']!='cash_payment'){?>selected<?php }?>>False</option>
                                <!-- <option value="addmob" <?php if($settings_row['banner_add']=='addmob'){?>selected<?php }?>>Google AdMob Add Banner</option>
                                <option value="Both" <?php if($settings_row['banner_add']=='Both'){?>selected<?php }?>>Both Addmob & Facebook Banner</option> -->
                    
                              </select>
                            </div>
                          </div>
                       
                          
                        </div>
                      </div>
                      <div class="banner_ads_block">
                        <div class="banner_ad_item">
                          <label class="control-label">Paytm Payment Option </label>              
                           
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Paytm Active Status:-</label>
                          <div class="col-md-12">
                              <select name="paytm_active_status" id="paytm_active_status" class="select2" disabled>
                                <option value="true" <?php if($settings_row['payment_gateway']=='paytm_gateway'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['payment_gateway']!='paytm_gateway'){?>selected<?php }?>>False</option>
                            </select>
                          </div>
                        </div>
                        
                       <!--  -->

                          <div class="form-group">
                            <label class="col-md-12 control-label mr_bottom20">Paytm Merchent Id :-</label>
                            <div class="col-md-12">
                            <input type="text" name="paytm_mid" id="paytm_mid" value="<?php echo $settings_row['paytm_mid'];?>" class="form-control">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-md-12 control-label mr_bottom20">Paytm Merchent Key :-</label>
                            <div class="col-md-12">
                            <input type="text" name="paytm_key" id="paytm_key" value="<?php echo $settings_row['paytm_key'];?>" class="form-control">
                            </div>
                          </div>
                          
                       

                        </div>
                      </div>  
                    </div>
                    <div class="col-md-5">
                      <div class="interstital_ads_block">
                        <div class="interstital_ad_item">
                          <label class="control-label">Razorpay Payment Option</label>
                        </div>  
                        <div class="col-md-12"> 
                          <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Razorpay Active Status:-</label>
                          <div class="col-md-12">
                            <select name="razorpay_active_status" id="razorpay_active_status" class="select2" disabled>add
                                <option value="true" <?php if($settings_row['payment_gateway']!=='razorpay_gateway'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['payment_gateway']!='razorpay_gateway'){?>selected<?php }?>>False</option>
                            </select> 
                          </div>
                        </div>
                        
                       
                        
                        <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Razorpay Merchent Id :-</label>
                          <div class="col-md-12">
                            <input type="text" name="razorpay_mid" id="razorpay_mid" value="<?php echo $settings_row['razorpay_mid'];?>" class="form-control">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Razorpay Merchent Key :-</label>
                          <div class="col-md-12">
                            <input type="text" name="razorpay_key" id="razorpay_key" value="<?php echo $settings_row['razorpay_key'];?>" class="form-control">
                          </div>
                        </div>
                        
                        </div>
                    </div>
                    
                    <div class="banner_ads_block">
                        <div class="banner_ad_item">
                          <label class="control-label">PayuMoney Payment Option </label>              
                           
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">payumoney Active Status:-</label>
                          <div class="col-md-12">
                              <select name="payumoney_active_status" id="payumoney_active_status" class="select2" disabled>
                                <option value="true" <?php if($settings_row['payment_gateway']!=='payumoney_gateway'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['payment_gateway']!='payumoney_gateway'){?>selected<?php }?>>False</option>
                            </select>
                          </div>
                        </div>
                        
                       

                          <div class="form-group">
                            <label class="col-md-12 control-label mr_bottom20">Payumoney Merchent Id :-</label>
                            <div class="col-md-12">
                            <input type="text" name="payumoney_mid" id="payumoney_mid" value="<?php echo $settings_row['payumoney_mid'];?>" class="form-control">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-md-12 control-label mr_bottom20">Payumoney Merchent Key :-</label>
                            <div class="col-md-12">
                            <input type="text" name="payumoney_key" id="payumoney_key" value="<?php echo $settings_row['payumoney_key'];?>" class="form-control">
                            </div>
                          </div>

                         
                          
                            

                        </div>
                      </div>  
                    </div>
                    
                    <div class="form-group">
                    <div class="col-md-9">
                    <button type="submit" name="gateway_submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                  
                </div>
              </div> 
              </div>
              </div>
              </div>
              </form>
              </div>

               <!-- Payment Gateway Setting tab End -->


               <!-- Ads settings tab Start -->
        <div role="tabpanel" class="tab-pane" id="ad_settings">   
                <form action="" name="admob_settings" method="post" class="form form-horizontal" enctype="multipart/form-data">
                <div class="section">
                <div class="section-body">
                  <div class="form-group">
                  <label class="col-md-2 control-label">Publisher ID :-</label>
                  <div class="col-md-7">
                    <input type="text" name="publisher_id" id="publisher_id" value="<?php echo $settings_row['publisher_id'];?>" class="form-control">
                  </div>
                  </div>
                  <div class="row">
                  <div class="form-group">
                    <div class="col-md-12">
                    <div class="col-md-5">
                      <div class="banner_ads_block">
                        <div class="banner_ad_item">
                          <label class="control-label">Banner Ads </label>              
                           
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Banner Ad:-</label>
                            <div class="col-md-12">
                              <select name="banner_add" id="banner_add" class="select2" disabled>
                                <option value="true" <?php if($settings_row['banner_add']!=='False'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['banner_add']=='False'){?>selected<?php }?>>False</option>
                              </select>
                            </div>
                          </div>
                          
                         <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Banner Display Type:-</label>
                            <div class="col-md-12">
                              <select name="banner_add" id="banner_add" class="select2">
                               <option value="False" <?php if($settings_row['banner_add']=='False'){?>selected<?php }?>>Disable Add Banner</option>
                                <option value="Facebook" <?php if($settings_row['banner_add']=='Facebook'){?>selected<?php }?>>Facebook Network Audience Add Banner</option>
                                <option value="addmob" <?php if($settings_row['banner_add']=='addmob'){?>selected<?php }?>>Google AdMob Add Banner</option>
                                <option value="Both" <?php if($settings_row['banner_add']=='Both'){?>selected<?php }?>>Both Addmob & Facebook Banner</option>
                    
                              </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-md-12 control-label mr_bottom20">AddMob Banner Add ID :-</label>
                            <div class="col-md-12">
                            <input type="text" name="addmob_banner1" id="addmob_banner1" value="<?php echo $settings_row['addmob_banner1'];?>" class="form-control">
                            </div>
                          </div>  
                          
                          
                           <div class="form-group">
                            <label class="col-md-12 control-label mr_bottom20">Facebook Banner Add ID :-</label>
                            <div class="col-md-12">
                            <input type="text" name="fb_banner1" id="fb_banner1" value="<?php echo $settings_row['fb_banner1'];?>" class="form-control">
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <div class="banner_ads_block">
                        <div class="banner_ad_item">
                          <label class="control-label">Rewarded Video Ads </label>              
                           
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Rewarded Video Ad:-</label>
                          <div class="col-md-12">
                              <select name="rewarded_video_ads" id="rewarded_video_ads" class="select2" disabled>
                                <option value="true" <?php if($settings_row['addmob_rewarded']=='true'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['addmob_rewarded']=='false'){?>selected<?php }?>>False</option>
                            </select>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Rewarded Video Display Type:-</label>
                            <div class="col-md-12">
                              <select name="reward_add" id="reward_add" class="select2">
                               <option value="False" <?php if($settings_row['reward_add']=='False'){?>selected<?php }?>>Disable Rewarded Add </option>
                                <option value="Facebook" <?php if($settings_row['reward_add']=='Facebook'){?>selected<?php }?>>Facebook Network Audience Rewarded Add</option>
                                <option value="addmob" <?php if($settings_row['reward_add']=='addmob'){?>selected<?php }?>>Google AdMob Rewarded Add</option>
                                <option value="Both" <?php if($settings_row['reward_add']=='Both'){?>selected<?php }?>>Both Addmob & Facebook Rewarded Add</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-12 control-label mr_bottom20">AddMob Rewarded Video Ad ID :-</label>
                            <div class="col-md-12">
                            <input type="text" name="addmob_rewarded1" id="addmob_rewarded1" value="<?php echo $settings_row['addmob_rewarded1'];?>" class="form-control">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-md-12 control-label mr_bottom20">Facebook Rewarded Video Ad ID :-</label>
                            <div class="col-md-12">
                            <input type="text" name="fb_reward1" id="fb_reward1" value="<?php echo $settings_row['fb_reward1'];?>" class="form-control">
                            </div>
                          </div>
                          
                            <div class="form-group">
                                <label class="col-md-12 control-label mr_bottom20">Daily Rewarded Video Limits :-</label>
                                <div class="col-md-12">
                                    <input type="text" name="reward_frequency" id="reward_frequency" value="<?php echo $settings_row['reward_frequency'];?>" class="form-control">
                                </div>
                            </div>

                        </div>
                      </div>  
                    </div>
                    <div class="col-md-5">
                      <div class="interstital_ads_block">
                        <div class="interstital_ad_item">
                          <label class="control-label">Interstital Ads</label>
                        </div>  
                        <div class="col-md-12"> 
                          <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Interstital Add:-</label>
                          <div class="col-md-12">
                            <select name="industrial_add" id="industrial_add" class="select2" disabled>add
                                <option value="true" <?php if($settings_row['industrial_add']!=='False'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['industrial_add']=='False'){?>selected<?php }?>>False</option>
                            </select> 
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Interstital Call Type:-</label>
                            <div class="col-md-12">
                              <select name="call_industrial_on" id="call_industrial_on" class="select2">
                               <option value="everytime" <?php if($settings_row['call_industrial_on']=='everytime'){?>selected<?php }?>>Call Industrial Everytime </option>
                                <option value="on_wrong_code" <?php if($settings_row['call_industrial_on']=='on_wrong_code'){?>selected<?php }?>>Call Industrial on Wrong Code</option>
                                <option value="onscreen_opening" <?php if($settings_row['call_industrial_on']=='onscreen_opening'){?>selected<?php }?>>Call Industrial on Screen Opening</option>
                                <option value="Both" <?php if($settings_row['call_industrial_on']=='Both'){?>selected<?php }?>>Call Industrial on Screen Opening & Wrong Code</option>
                              </select>
                            </div>
                          </div>

                        <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Interstital Display Type:-</label>
                            <div class="col-md-12">
                              <select name="industrial_add" id="industrial_add" class="select2">
                               <option value="False" <?php if($settings_row['industrial_add']=='False'){?>selected<?php }?>>Disable Industrial Add </option>
                                <option value="Facebook" <?php if($settings_row['industrial_add']=='Facebook'){?>selected<?php }?>>Facebook Network Audience Industrial Add</option>
                                <option value="addmob" <?php if($settings_row['industrial_add']=='addmob'){?>selected<?php }?>>Google AdMob Industrial Add</option>
                                <option value="Both" <?php if($settings_row['industrial_add']=='Both'){?>selected<?php }?>>Both Addmob & Facebook Industrial Add</option>
                              </select>
                            </div>
                          </div>
                        
                        <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">AddMob Interstital Ad ID :-</label>
                          <div class="col-md-12">
                            <input type="text" name="addmob_industrial1" id="addmob_industrial1" value="<?php echo $settings_row['addmob_industrial1'];?>" class="form-control">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Facebook Interstital Ad ID :-</label>
                          <div class="col-md-12">
                            <input type="text" name="fb_industrial1" id="fb_industrial1" value="<?php echo $settings_row['fb_industrial1'];?>" class="form-control">
                          </div>
                        </div>
                        
                        </div>
                    </div>
                    
                    <div class="banner_ads_block">
                        <div class="banner_ad_item">
                          <label class="control-label">Native Adds </label>              
                           
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Native Add:-</label>
                          <div class="col-md-12">
                              <select name="native_add" id="native Add" class="select2" disabled>
                                <option value="true" <?php if($settings_row['native_add']!=='False'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['native_add']=='False'){?>selected<?php }?>>False</option>
                            </select>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Native Add Display Type:-</label>
                            <div class="col-md-12">
                              <select name="native_add" id="native_add" class="select2">
                                <option value="False" <?php if($settings_row['native_add']=='False'){?>selected<?php }?>>Disable Native Add </option>
                                <option value="Facebook" <?php if($settings_row['native_add']=='Facebook'){?>selected<?php }?>>Facebook Network Audience Native Add</option>
                                <option value="addmob" <?php if($settings_row['native_add']=='addmob'){?>selected<?php }?>>Google AdMob Native Add</option>
                                <option value="Both" <?php if($settings_row['native_add']=='Both'){?>selected<?php }?>>Both Addmob & Facebook Industrial Native Add</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-12 control-label mr_bottom20">AddMob Native Add ID :-</label>
                            <div class="col-md-12">
                            <input type="text" name="addmob_Native" id="addmob_native" value="<?php echo $settings_row['addmob_native'];?>" class="form-control">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-md-12 control-label mr_bottom20">Facebook Native Add ID :-</label>
                            <div class="col-md-12">
                            <input type="text" name="fb_native" id="fb_native" value="<?php echo $settings_row['fb_native'];?>" class="form-control">
                            </div>
                          </div>
                          
                            <div class="form-group">
                                <label class="col-md-12 control-label mr_bottom20">Native Add_Limits :-</label>
                                <div class="col-md-12">
                                    <input type="text" name="daily_rewarded_video_ads_limits" id="daily_rewarded_video_ads_limits" value="<?php echo $settings_row['reward_frequency'];?>" class="form-control">
                                </div>
                            </div>

                        </div>
                      </div>  
                    </div>
                    
                    <div class="form-group">
                    <div class="col-md-9">
                    <button type="submit" name="admob_submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                  
                </div>
              </div> 
              </div>
              </div>
              </div>
              </form>
              </div>
                          <!--  <div class="form-group">
                                <label class="col-md-12 control-label mr_bottom20">Interstital Ad Clicks :-</label>

                                <div class="col-md-12">
                                    <input type="text" name="interstital_ad_click" id="interstital_ad_click" value="<?php /*echo $settings_row['interstital_ad_click'];*/?>" class="form-control">
                                </div>
                            </div>-->
                      
                                    
                  
               <!-- Ads settings tab End -->


           <!-- FB Ads settings tab Start -->
               <!--
               <div role="tabpanel" class="tab-pane" id="fbads_settings">
                   <form action="" name="fbads_settings" method="post" class="form form-horizontal" enctype="multipart/form-data">
                       <div class="section">
                           <div class="section-body">
                               <div class="form-group">
                                   <label class="col-md-2 control-label">Publisher ID :-</label>
                                   <div class="col-md-7">
                                       <input type="text" name="publisher_id" id="publisher_id" value="<?php echo $settings_row['publisher_id'];?>" class="form-control">
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group">
                                       <div class="col-md-12">
                                           <div class="col-md-5">
                                               <div class="banner_ads_block">
                                                   <div class="banner_ad_item">
                                                       <label class="control-label">Banner Ads </label>

                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label class="col-md-12 control-label mr_bottom20">Banner Ad:-</label>
                                                           <div class="col-md-12">

                                                               <select name="banner_ad" id="banner_ad" class="select2">
                                                                   <option value="true" <?php if($settings_row['addmob_banner']=='true'){?>selected<?php }?>>True</option>
                                                                   <option value="false" <?php if($settings_row['addmob_banner']=='false'){?>selected<?php }?>>False</option>

                                                               </select>

                                                           </div>

                                                       </div>
                                                       <div class="form-group">
                                                           <label class="col-md-12 control-label mr_bottom20">Banner Ad ID :-</label>
                                                           <div class="col-md-12">
                                                               <input type="text" name="banner_ad_id" id="banner_ad_id" value="<?php echo $settings_row['addmob_banner'];?>" class="form-control">
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="banner_ads_block">
                                                   <div class="banner_ad_item">
                                                       <label class="control-label">Rewarded Video Ads </label>

                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label class="col-md-12 control-label mr_bottom20">Rewarded Video Ad:-</label>
                                                           <div class="col-md-12">

                                                               <select name="rewarded_video_ads" id="rewarded_video_ads" class="select2">
                                                                   <option value="true" <?php if($settings_row['addmob_rewarded']=='true'){?>selected<?php }?>>True</option>
                                                                   <option value="false" <?php if($settings_row['addmob_rewarded']=='false'){?>selected<?php }?>>False</option>

                                                               </select>

                                                           </div>

                                                       </div>

                                                       <div class="form-group">
                                                           <label class="col-md-12 control-label mr_bottom20">Rewarded Video Ad ID :-</label>
                                                           <div class="col-md-12">
                                                               <input type="text" name="rewarded_video_ads_id" id="rewarded_video_ads_id" value="<?php echo $settings_row['addmob_rewarded'];?>" class="form-control">
                                                           </div>
                                                       </div>
                                                       <div class="form-group">
                                                           <label class="col-md-12 control-label mr_bottom20">Daily Rewarded Video Limits :-</label>
                                                           <div class="col-md-12">
                                                               <input type="text" name="daily_rewarded_video_ads_limits" id="daily_rewarded_video_ads_limits" value="<?php echo $settings_row['daily_rewarded_video_ads_limits'];?>" class="form-control">
                                                           </div>
                                                       </div>

                                                   </div>
                                               </div>
                                           </div>
                                           <div class="col-md-5">
                                               <div class="interstital_ads_block">
                                                   <div class="interstital_ad_item">
                                                       <label class="control-label">Interstital Ads</label>
                                                   </div>
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                           <label class="col-md-12 control-label mr_bottom20">Interstital Ad:-</label>
                                                           <div class="col-md-12">

                                                               <select name="interstital_ad" id="interstital_ad" class="select2">
                                                                   <option value="true" <?php if($settings_row['addmob_industrial']=='true'){?>selected<?php }?>>True</option>
                                                                   <option value="false" <?php if($settings_row['addmob_industrial']=='false'){?>selected<?php }?>>False</option>

                                                               </select>
                                                           </div>

                                                       </div>
                                                       <div class="form-group">
                                                           <label class="col-md-12 control-label mr_bottom20">Interstital Ad ID :-</label>
                                                           <div class="col-md-12">
                                                               <input type="text" name="interstital_ad_id" id="interstital_ad_id" value="<?php echo $settings_row['addmob_industrial'];?>" class="form-control">
                                                           </div>
                                                       </div>
                                                       <div class="form-group">
                                                           <label class="col-md-12 control-label mr_bottom20">Interstital Ad Clicks :-</label>

                                                           <div class="col-md-12">
                                                               <input type="text" name="interstital_ad_click" id="interstital_ad_click" value="<?php echo $settings_row['addmob_industrial'];?>" class="form-control">
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>

                               <div class="form-group">
                                   <div class="col-md-9">
                                       <button type="submit" name="admob_submit" class="btn btn-primary">Save</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </form>
               </div>
               -->
               <!-- FB Ads settings tab End -->

               <!-- App faq tab Start --
              <div role="tabpanel" class="tab-pane" id="api_faq">   
                <form action="" name="api_faq" method="post" class="form form-horizontal" enctype="multipart/form-data">
              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">App FAQ :-</label>
                    <div class="col-md-6">
                 
                      <textarea name="app_faq" id="app_faq" class="form-control"><?php /* echo stripslashes($settings_row['app_faq']);*/?></textarea>

                      <script>CKEDITOR.replace( 'app_faq' );</script>
                    </div>
                  </div>
                  
                  <br>
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="app_faq_submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>
               </form>
              </div>





               <!-- App faq tab End -->

               <!-- App privacy policy tab Start -->
              <div role="tabpanel" class="tab-pane" id="app_privacy_policy">   
                <form action="" name="api_privacy_policy" method="post" class="form form-horizontal" enctype="multipart/form-data">
              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Privacy Policy :-</label>
                    <div class="col-md-6">
                 
                      <textarea name="app_privacy_policy" id="app_privacy_policy" class="form-control"><?php echo stripslashes($settings_row['app_privacy_policy']);?></textarea>

                      <script>CKEDITOR.replace( 'privacy_policy' );</script>
                    </div>
                    </div>
                           <br>
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="app_pri_poly" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                    </div>
                    </div>
                     </div>
                    </form>
             </div>
                </div>     
                  
                  
                  
               
</div>               
           
               <!-- App privacy policy tab end -->

       
        
<?php include("includes/footer.php");?>       
