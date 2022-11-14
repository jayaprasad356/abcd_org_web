<?php include("includes/header.php");
	include("includes/connection.php");
    include("includes/session_check.php");
  
    include("includes/function.php");
	include("language/language.php"); 

 	require_once("thumbnail_images.class.php");
	 
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
	 
	 
	if(isset($_POST['submit']) and isset($_GET['add']))
	{		
			  
	//	print_r("hello");exit;
			
		//	'user_referal_code'  =>createRandomCode(),
			 $user_referal_code  = $_POST['user_referal_code'];
			 $name  =  $_POST['name'];
			 $email  =  $_POST['email'];
			$password =   $_POST['password'];
	    	$phone =  $_POST['phone'];
			$reffered_by =$_POST['reffered_by'];
			 $allow = "1";
            $joining_paid="1";
            $device_id = $_POST['device_id'];
            $total_refferals="0";
			$wallet =$_POST['wallet'];
       $total_qr_generation=$_POST['total_qr_generation'];
		    $onesignal_playerid =$_POST['onesignalplayerid'];
		    $onesignal_pushtoken =$_POST['onesignal_pushtoken'];
		      $joining_date=date("d-m-Y | h:i:s a");
          $codegenTimer=$_POST['codegenTimer'];
		       date_default_timezone_set("Asia/Calcutta");
		       
		       if($device_id=5178){
		         $qry = "SELECT * FROM `USER_DETAILS` WHERE `mobile`= $phone ";  
		       }else{
		            $qry = "SELECT * FROM `USER_DETAILS` WHERE `mobile`= $phone or `device_id` = '$device_id' ";
		       }
		
		// $qry = "SELECT * FROM `USER_DETAILS` WHERE `mobile`= $phone or `device_id` = '$device_id' ";
		// $qry = "SELECT * FROM `USER_DETAILS` WHERE `mobile`= $phone or `device_id` = '$device_id' ";
    $result = mysqli_query($mysqli,$qry);
    $row = mysqli_fetch_assoc($result);
    $rowcount=mysqli_num_rows($result);
    //print_r($rowcount);exit;

         if($rowcount != 0)
         {
            // print_r("hello");exit;
            // echo "Hello world!";
               // $set['darwinbarkk'][]=array('msg' => "Mobile Number  already used!",'success'=>'0');
                
                 if($row['mobile']== $phone and $row['device_id']!= $device_id)
                 {
                    
                   $set['darwinbarkk'][]=array('msg' => "Mobile Number  already used!",'success'=>'0');
                  }
                  else if($row['device_id']==$device_id and $row['mobile'] != $phone)
                 {
                  $set['darwinbarkk'][]=array('msg' => "This Device Is   already used!",'success'=>'0');
                  }
                  else if($row['device_id']== $device_id and $row['mobile']== $phone)
                  {
                       $set['darwinbarkk'][]=array('msg' => "This Device with This Mobile Number Is already used!",'success'=>'0');
                  }
   
        }

        else
            {
        //$user_code=createRandomCode();
               if( $reffered_by==""){
                     $refferCode ="DBAA".rand(1000,9999);
                }else if  (strpos($reffered_by,'DBAB') !== false) 
             
                    {
                     $refferCode ="DBAB".rand(1000,9999);
                    // echo $refferCode;
                    }
                else if  (strpos($reffered_by,'DBAC') !== false) 
             
                    {
                     $refferCode ="DBAC".rand(1000,9999);
                     //echo $refferCode;
                    } 
                else if  (strpos($reffered_by,'DBAD') !== false) 
             
                    {
                     $refferCode ="DBAD".rand(1000,9999);
                     //echo $refferCode;
                    } else
                    
                    {
                         $refferCode ="DBAA".rand(1000,9999);
                    }
                    
        $qry1="INSERT INTO `USER_DETAILS` (`id`, `mobile`, `password`, `name`, `city`, `email`, `wallet`,`bonus_balance`, `total_qr_generation`, `correct_qr_generation`, `total_paid`, `user_referal_code`, `reffered_by`, `total_referals`, `reffered_paid`, `joining_paid`, `allow`, `device_id`, `profile_pic`, `active_date`, `onesignal_playerid`, `onesignal_pushtoken`, `joining_time`) VALUES ('0', '$phone', '$password', '$name', '$city', '$email', '$wallet',(SELECT `joining_bonus` FROM `ADMIN` WHERE `id`=1), '0', '0', '0', '$refferCode', '$reffered_by', '$total_refferals', '', '$joining_paid', '$allow', '$device_id', '', '$reg_date', '$onesignalplayerid', '$onesignalpushtoken', '$joining_date')";
        
             $result1=mysqli_query($mysqli,$qry1);
      
      if(mysqli_insert_id($mysqli)>0)
      
         {
        
         
 
        $set['darwinbarkk'][]=array('msg' => "Registation successflly...!",'success'=>'1'); 
        
           }

      


       

    }
     $_SESSION['msg']="10";
			header("location:manage_users.php");	 
			exit;
		
			
			
			
			
		
	}
	
	


	
	
	if(isset($_GET['user_id']))
	{
			 
			$user_qry="SELECT * FROM USER_DETAILS where mobile='".$_GET['user_id']."'";
			$user_result=mysqli_query($mysqli,$user_qry);
			$user_row=mysqli_fetch_assoc($user_result);
      //print_r($user_row);exit;
		
	}
	
	if(isset($_POST['submit']) and isset($_POST['user_id']))
	{
		  
		if($_POST['password']!="")
		{
        if($_SESSION['id'] == 1)
          {
                    $data = array(
        'name'  =>  $_POST['name'],
        'email'  =>  $_POST['email'],
        'password'  =>  $_POST['password'],
        'mobile'  =>  $_POST['phone'],
        'user_referal_code'  =>  $_POST['user_referal_code'],
        'device_id'  =>  $_POST['device_id'],
        'onesignal_playerid'  =>  $_POST['onesignal_playerid'],
        'onesignal_pushtoken'  =>  $_POST['onesignal_pushtoken'],
        'reffered_by'  =>  $_POST['reffered_by'],
        'Wallet'  =>  $_POST['wallet'],
        'total_qr_generation'=>$_POST['hisgeneration'],
        'code_gen_allow' => $_POST['code_gen_allow'],
        'widthrawal_allow' => $_POST['widthrawal_allow'],
        'codegenTimer'=>$_POST['codegenTimer'],
        'total_all_qr_generation'=>$_POST['total_qr_generation']
        );
                 
       }else{

        $data = array(
        'name'  =>  $_POST['name'],
        'email'  =>  $_POST['email'],
        'password'  =>  $_POST['password'],
        'mobile'  =>  $_POST['phone'],
        'user_referal_code'  =>  $_POST['user_referal_code'],
        'device_id'  =>  $_POST['device_id'],
        'onesignal_playerid'  =>  $_POST['onesignal_playerid'],
        'onesignal_pushtoken'  =>  $_POST['onesignal_pushtoken'],
        'reffered_by'  =>  $_POST['reffered_by'],
        'code_gen_allow' => $_POST['code_gen_allow'],
        'widthrawal_allow' => $_POST['widthrawal_allow'],
        'codegenTimer'=>$_POST['codegenTimer'],
    
        );
       }
  			
  		}
		else
		{
			$data = array(
			'name'  =>  $_POST['name'],
			'email'  =>  $_POST['email'],			 
			'mobile'  =>  $_POST['phone'],
			'reffered_by'  =>  $_POST['reffered_by'],
      'codegenTimer'=>$_POST['codegenTimer'],
      'code_gen_allow' => $_POST['code_gen_allow'],
      'widthrawal_allow' => $_POST['widthrawal_allow'],
      'device_id'  =>  $_POST['device_id'],
      'total_all_qr_generation'=>$_POST['total_qr_generation'],
      'Wallet'  =>  $_POST['wallet'],
      'total_qr_generation'=>$_POST['hisgeneration'],
			);
		}
 
		
		   $user_edit=Update('USER_DETAILS', $data, "WHERE mobile = '".$_POST['user_id']."'");
		 
			if ($user_edit > 0){
				
				$_SESSION['msg']="11";
				header("Location:add_user.php?user_id=".$_POST['user_id']);
				exit;
			} 	
		
	 
	}
	
	
?>
 	

 <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title"><?php if(isset($_GET['cat_id'])){?>Edit<?php }else{?>Add<?php }?> User</div>
    <?php 
    if(isset($_GET['user_id']))
    {?>
      
       <input type="button" name="Addcodes" value="Add Codes" idad="<?php echo $_GET['user_id']; ?>" class="btn btn-primary btn-xs edit_data"/>

       <input type="button" name="Addbal" value="Add Balance" idad="<?php echo $_GET['user_id']; ?>" class="btn btn-primary btn-xs add_data"/>

   <?php }?>
 

            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
               	 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                	<?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?>	
              </div>
            </div>
          </div>
          <div class="card-body mrg_bottom"> 
            <form action="" name="addedituser" method="post" class="form form-horizontal" enctype="multipart/form-data" >
            	<input  type="hidden" name="user_id" value="<?php echo $_GET['user_id'];?>" />

              <div class="section">
                <div class="section-body">
				
				
                  <div class="form-group">
                    <label class="col-md-3 control-label">Name :-</label>
                    <div class="col-md-6">
                      <input type="text" name="name" id="name" value="<?php if(isset($_GET['user_id'])){echo $user_row['name'];}?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email :-</label>
                    <div class="col-md-6">
                      <input type="email" name="email" id="email" value="<?php if(isset($_GET['user_id'])){echo $user_row['email'];}?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Password :-</label>
                    <div class="col-md-6">
                      <input type="text" name="password" id="password" value="<?php if(isset($_GET['user_id'])){echo $user_row['password'];}?>" class="form-control" <?php if(!isset($_GET['password'])){?>required<?php }?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Phone :-</label>
                    <div class="col-md-6">
                      <input type="text" name="phone" id="phone" value="<?php if(isset($_GET['user_id'])){echo $user_row['mobile'];}?>" class="form-control">
                    </div>
                  </div>
                    
                     <div class="form-group">
                    <label class="col-md-3 control-label">Referal Code :-</label>
                    <div class="col-md-6">
                      <input type="text" name="user_referal_code" id="user_referal_code" value="<?php if(isset($_GET['user_id'])){echo $user_row['user_referal_code'];}?>" class="form-control">
                    </div>
                  </div>
                    
                   <div class="form-group">
                    <label class="col-md-3 control-label">Refered By :-</label>
                    <div class="col-md-6">
                      <input type="text" name="reffered_by" id="reffered_by" value="<?php if(isset($_GET['user_id'])){echo $user_row['reffered_by'];}?>" class="form-control">
                    </div>
                  </div>


                  <?php
                    if($_SESSION['id'] == 1)
                  {
                      ?>
                       
                        <div class="form-group">
                    <label class="col-md-3 control-label">Wallet Ballance :-</label>
                    <div class="col-md-6">
                      <input type="text" name="wallet" id="wallet" value="<?php if(isset($_GET['user_id'])){echo $user_row['wallet'];}?>" class="form-control">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="col-md-3 control-label">Total Qr Generated :-</label>
                    <div class="col-md-6">
                      <input type="text" name="total_qr_generation" id="total_qr_generation" value="<?php if(isset($_GET['user_id'])){echo $user_row['total_all_qr_generation'];}?>" class="form-control">
                    </div>
                  </div>

                      <?php
                  }
                  ?>
                  
                 <!--  <div class="form-group">
                    <label class="col-md-3 control-label">Wallet Ballance :-</label>
                    <div class="col-md-6">
                      <input type="text" name="wallet" id="wallet" value="<?php if(isset($_GET['user_id'])){echo $user_row['wallet'];}?>" class="form-control">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="col-md-3 control-label">Total Qr Generated :-</label>
                    <div class="col-md-6">
                      <input type="text" name="total_qr_generation" id="total_qr_generation" value="<?php if(isset($_GET['user_id'])){echo $user_row['total_all_qr_generation'];}?>" class="form-control">
                    </div>
                  </div>
 -->
                   <div class="form-group">
                    <label class="col-md-3 control-label">Total History Days :-</label>
                    <div class="col-md-6">
                      <input type="text" name="hisgeneration" id="hisgeneration" value="<?php if(isset($_GET['user_id'])){echo $user_row['total_qr_generation'];}?>" class="form-control">
                    </div>
                  </div>

                 
                  
                   <div class="form-group">
                  <label class="col-md-3 control-label" style="color: red">Enable/Disable Generate Button :-</label>
                  <div class="col-md-6">
                              <select name="code_gen_allow" id="code_gen_allow" class="select2">
                               <option value="0" <?php if($user_row['code_gen_allow']=='0'){?>selected<?php }?>>Enabled</option>
                                <option value="1" <?php if($user_row['code_gen_allow']!='0'){?>selected<?php }?>>Disable </option>
                                
                    
                              </select>
                            </div>
                          </div>


                          <div class="form-group">
                  <label class="col-md-3 control-label" style="color: red">Enable/Disable Widthraw Button :-</label>
                  <div class="col-md-6">
                              <select name="widthrawal_allow" id="widthrawal_allow" class="select2">
                               <option value="0" <?php if($user_row['widthrawal_allow']=='0'){?>selected<?php }?>>Enabled</option>
                                <option value="1" <?php if($user_row['widthrawal_allow']!='0'){?>selected<?php }?>>Disable </option>
                                
                    
                              </select>
                            </div>
                          </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" style="color: red">Delay Code Loading Time :-</label>
                    <div class="col-md-6">
                        <input type="text" name="codegenTimer" id="codegenTimer" value="<?php if(isset($_GET['user_id'])){echo $user_row['codegenTimer'];}?>" class="form-control">
                      </div>
                   </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Device Id :-</label>
                    <div class="col-md-6">
                      <input type="text" name="device_id" id="device_id" value="<?php if(isset($_GET['user_id'])){echo $user_row['device_id'];}?>" class="form-control">
                    </div>
                  </div>
                  
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Add Codes To User :-</label>
                    <div class="col-md-6">
                      <input type="text" name="addCodes" id="addCodes" value="<?php if(isset($_GET['user_id'])){echo $user_row['onesignal_playerid'];}?>" class="form-control">
                    </div>
                  </div>
                   
                 
                  
                  
                    
                  <div class="form-group">
                    <label class="col-md-3 control-label">OneSignal Push Token :-</label>
                    <div class="col-md-6">
                      <input type="text" name="onesignal_pushtoken" id="onesignal_pushtoken" value="<?php if(isset($_GET['user_id'])){echo $user_row['onesignal_pushtoken'];}?>" class="form-control">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
   

<?php include('includes/footer.php');?>   

<!-- The Modal -->
  <div class="modal" id="add_data_Modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
         <h4 class="modal-title" id="modal-title">Add Codes</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
         <div class="modal-body">  
                     <form method="post" id="insert_form"> 
                          
                          <div class="row">
                              <div class="col-md-6">
                                  <label>Name</label>  
                                  <input type="text" name="adminName" id="adminName" class="form-control" />  
                                  <br />  
                              </div>
                             <!--  <div class="col-md-6">
                                  <label>Email</label>  
                                  <input type="text" name="adminEmail" id="adminEmail" class="form-control" />  
                                  <br />  
                              </div> -->
                              <div class="col-md-6">
                                   <label>Phone</label>  
                                   <input type="text" name="userMobile" id="userMobile" class="form-control" />  
                                   <br />
                              </div>
                              <div class="col-md-6">
                                    <label>User ID</label>  
                                    <input type="text" name="adminUserid" id="adminUserid" class="form-control" />  
                                    <br />
                              </div>

                              <div class="col-md-6">
                                    <label>No of Codes To Add</label>  
                                    <input type="text" name="addcodestouser" id="addcodestouser" class="form-control" />  
                                    <br />
                              </div>
                            
                             
                          </div>
                          
                           <input type="hidden" name="idad" id="idad" />  
                           <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />  
                     </form>  
                </div>  
           </div>  
      </div>  
 </div>  
 <!-- Modal footer -->


<!-- The Modal -->
  <div class="modal" id="add_databal_Modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
         <h4 class="modal-title" id="modal-title">Add Balance</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
         <div class="modal-body">  
                     <form method="post" id="insert_formm"> 
                          
                          <div class="row">
                              <div class="col-md-6">
                                  <label>Name</label>  
                                  <input type="text" name="userrName" id="userrName" class="form-control" />  
                                  <br />  
                              </div>
                             <!--  <div class="col-md-6">
                                  <label>Email</label>  
                                  <input type="text" name="adminEmail" id="adminEmail" class="form-control" />  
                                  <br />  
                              </div> -->
                              <div class="col-md-6">
                                   <label>Phone</label>  
                                   <input type="text" name="userrMobile" id="userrMobile" class="form-control" />  
                                   <br />
                              </div>
                              <div class="col-md-6">
                                    <label>User ID</label>  
                                    <input type="text" name="userUserid" id="userUserid" class="form-control" />  
                                    <br />
                              </div>

                              <div class="col-md-6">
                                    <label>Balance To Add</label>  
                                    <input type="Number" name="adddatabal" id="adddatabal" class="form-control" />  
                                    <br />
                              </div>
                            
                             
                          </div>
                          
                           <input type="hidden" name="idadbl" id="idadbl" />  
                           <input type="submit" name="insertt" id="insertt" value="Update" class="btn btn-success" />  
                     </form>  
                </div>  
           </div>  
      </div>  
 </div>  
 <!-- Modal footer -->


<script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var idad = $(this).attr("idad");  
          // alert (idad);
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{idad:idad},  
                dataType:"json",
                //dataType:"text",
               
                success:function(data){  
                 // alert(data);
                      $('#adminName').val(data.name); 
                      $('#userMobile').val(data.mobile);
                      $('#adminUserid').val(data.user_referal_code);
                      //$('#adminPassword').val(data.password);
                      //$('#idad').val(data.id);
                      $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#adminName').val() == "")  
           {  
                alert("Name is required");  
           }  
           else if($('#userMobile').val() == '')  
           {  
                alert("Phone is required");  
           }   else if($('#adminUsername').val() == '')  
           {  
                alert("Username is required");  
           }   else if($('#addcodestouser').val() == '')  
           {  
                alert("No of codes is required");  
           }   
           else  
           {  /*
                 $.ajax({  
                         url:"insert_admins.php",  
                         method:"POST",  
                         data:$('#insert_form').serialize(),  
                         beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#adminsList').html(data);  
                       
                     }  
                });  

               */
               ////////////////////////////

                    $.ajax({  
                         url:"insert_admins.php",  
                         method:"POST",  
                         data:$('#insert_form').serialize(),  
                         beforeSend:function(){  
                              $('#insert').val("Inserting");  
                         },  
                          //dataType:"text",
                           dataType:"json",
                         success:function(data)/*{  
                              $('#insert_form')[0].reset();  
                              $('#add_data_Modal').modal('hide');  
                              $('#adminsList').html(data);  
                         } */
                         {  
                       
                      //alert(data.msg+"st"+data);
                     // alert("st"+data);
                      if(data.status=='200'){
                       toastr.success(data.msg); 
                             $('#insert_form')[0].reset();  
                              $('#add_data_Modal').modal('hide');  
                              $('#adminsList').html(data);  
                   setTimeout(function(){ 
                      window.location.replace('manage_users.php');
                    }, 1000);
                           }else{
                            toastr.error(data.msg);
                          }
                     } 
                    });
               //////////////////////////

           }  
      });  
     
 });  
 </script>

 <script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.add_data', function(){  
           var idad = $(this).attr("idad");  
         //  alert (idad);
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{idad:idad},  
                dataType:"json",
                //dataType:"text",
               
                success:function(data){  
                 // alert(data);
                      $('#userrName').val(data.name); 
                      $('#userrMobile').val(data.mobile);
                      $('#userUserid').val(data.user_referal_code);
                      //$('#adminPassword').val(data.password);
                      //$('#idad').val(data.id);
                      $('#add_databal_Modal').modal('show');  
                }  
           });  
      });  
      
      $('#insert_formm').on("submit", function(event){  
           event.preventDefault();  
           if($('#userrName').val() == "")  
           {  
                alert("Name is required");  
           }  
           else if($('#userrMobile').val() == '')  
           {  
                alert("Phone is required");  
           }   else if($('#userUserid').val() == '')  
           {  
                alert("Username is required");  
           }   else if($('#adddatabal').val() == '')  
           {  
                alert("No of codes is required");  
           }   
           else  
           {  /*
                 $.ajax({  
                         url:"insert_admins.php",  
                         method:"POST",  
                         data:$('#insert_form').serialize(),  
                         beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#adminsList').html(data);  
                       
                     }  
                });  

               */
               ////////////////////////////

                    $.ajax({  
                         url:"insert_admins.php",  
                         method:"POST",  
                         data:$('#insert_formm').serialize(),  
                         beforeSend:function(){  
                              $('#insert').val("Inserting");  
                         },  
                         // dataType:"text",
                           dataType:"json",
                         success:function(data)/*{  
                              $('#insert_form')[0].reset();  
                              $('#add_data_Modal').modal('hide');  
                              $('#adminsList').html(data);  
                         } */
                         {  
                       
                      //alert(data.msg+"st"+data);
                      //alert("st"+data);
                      if(data.status=='200'){
                       toastr.success(data.msg); 
                             $('#insert_form')[0].reset();  
                              $('#add_data_Modal').modal('hide');  
                              $('#adminsList').html(data);  
                   setTimeout(function(){ 
                      window.location.replace('manage_users.php');
                    }, 1000);
                           }else{
                            toastr.error(data.msg);
                          }
                     } 
                    });
               //////////////////////////

           }  
      });  
     
 });  
 </script>

