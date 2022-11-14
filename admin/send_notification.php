<?php include("includes/header.php");
 include("includes/connection.php");
require("includes/function.php");
require("language/language.php");



 if(isset($_POST['submit'])){
     extract($_POST);
     extract($_FILES);
     //$qry="SELECT `onesignalapp_id`, `onesignalapp_key` FROM APP_SETTING WHERE APP_SETTING.id=1";
    // $result=mysqli_query($mysqli,$qry);
   // $settings_row=mysqli_fetch_assoc($result);
    /*print_r($settings_row['onesignalapp_id']);exit;*/
    //$key=$settings_row['onesignalapp_key'];
      $external_link=($_POST['external_link']!='') ? addslashes(trim($_POST['external_link'])) : false;

      $message=addslashes(trim($_POST['notification_msg']));

      $content = array("en" => $message);
      if(isset($_FILES['big_picture']['name']))
     {
         move_uploaded_file($big_picture['tmp_name'],'./uploads/push_noti/'.$big_picture['name']);
         $file_path = BASE_URL.'uploads/push_noti/'.$big_picture['name'];
			$fields = array(
				//'app_id' =>$settings_row['onesignalapp_id'],
				'app_id' =>"a55b3068-3d26-4b9c-9e82-ec1e09e0859f",
				'included_segments' => array('All'),                                            
		     	'data' => array("foo" => "bar","title"=>$title,"external_link"=>$external_link),
				'headings'=> array("en" => $notification_title),
				'contents' => $content,
				'big_picture' =>$file_path
				);     
			//	print_r($fields);exit;
     }else{
         
      $fields = array(
       // 'app_id' =>$settings_row['onesignalapp_id'],
       	'app_id' =>'a55b3068-3d26-4b9c-9e82-ec1e09e0859f',
			'included_segments' => array('All'),   
			 'data' => array("foo" => "bar","title"=>$title,"external_link"=>$external_link),
			'headings'=> array("en" =>$notification_title),
			'contents' => $content,
			 'big_picture' =>$file_path
             );   
     }
      
//print_r($fields);exit;
      $fields = json_encode($fields);

        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
			'Authorization: Basic ZmM4YmI4NDktNzdkNC00NDRhLWIzNDYtMGNkYjEyYzg3NzZi'));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
	//	print_r($fields);
       // print_r($response);exit;
		curl_close($ch);
        
      $_SESSION['msg']="16";
      header( "Location:send_notification.php");
      exit; 
     
     
     
  }

  if(isset($_POST['notification_submit']))
  {

      $data = array(
        'onesignal_app_id' => $_POST['onesignal_app_id'],
        'onesignal_rest_key' => $_POST['onesignal_rest_key'],
      );

      $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

      $_SESSION['msg']="11";
      header( "Location:send_notification.php");
      exit;
  }

?>

<div class="clearfix"></div>

<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumb-->
		<div class="row pt-2 pb-2">
			<div class="col-sm-9">
				<h4 class="page-title">Notification</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="javaScript:void();">Notification</a></li>
					<li class="breadcrumb-item active" aria-current="page">Send Notification</li>
				</ol>
			</div>
			
		</div>
		<!-- End Breadcrumb-->
		
		<div class="row">
			<div class="col-lg-10 mx-auto">
				<div class="card">
					<div class="card-body">
						<div class="card-title">Send Notification</div>
						<hr>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="input-1">Title</label>
								 <input type="text" name="notification_title" id="notification_title" class="form-control" value="" placeholder="Enter Title oF Notification" required>
							</div>
							
							<div class="form-group">
								<label for="input-2">Message</label>
							<textarea name="notification_msg" id="notification_msg" class="form-control"value="" placeholder="Enter Title oF Notification Message" required></textarea>
							</div>
							
							
							<div class="form-group">
								<label for="input-1">Image (Optional)</label>
								<input type="file"   class="form-control" name="big_picture" id="fileupload" placeholder="Enter Video Name">
								<p class="noteMsg">Note: Image Size Minimum - 512x256 & Maximum - 2880x1440</p>
							</div>
							
						<div class="form-group">
                          <label class="col-md-4 control-label">External Link :-<br/>(Optional)</label>
                         
                            <input type="text" name="external_link" id="external_link" class="form-control" value="" placeholder="http://www.viaviweb.com">
                          </div>
                           
                      </div>   
                        <div class="form-group">
                          <div class="col-md-9 col-md-offset-3">
                            <button type="submit" name="submit" class="btn btn-primary">Send</button>
                          </div>
						</form>
					</div>
				</div>
				

			</div></div></div>
		</div>
	<?php include("includes/footer.php"); ?>




		
		