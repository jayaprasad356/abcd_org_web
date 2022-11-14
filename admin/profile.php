<?php include("includes/header.php");

  require("includes/function.php");
  require("language/language.php");
   
  
  if(isset($_SESSION['id']))

       
    $qry="select * from ADMIN_ROLE where id='".$_SESSION['id']."'";
 // print_r($qry);
     
    $result=mysqli_query($mysqli,$qry);
    $row=mysqli_fetch_assoc($result);

  if(isset($_POST['submit']))
  {
    if($_FILES['image']['name']!="")
     {    


          $img_res=mysqli_query($mysqli,'SELECT * FROM ADMIN_ROLE WHERE id='.$_SESSION['id'].'');
          $img_res_row=mysqli_fetch_assoc($img_res);
      

          if($img_res_row['profileImg']!="")
            {
           
               unlink('./assets/images/'.$img_res_row['profileImg']);
           }


          $imagename=rand(0,99999)."admin".$_SESSION['id'];
            $image="profile.png";
                 $image= $_FILES['image']['name'];
                 $extension=end(explode(".", $image));
           $pic1=$_FILES['image']['tmp_name'];
           $tpath1='./assets/images/'.$imagename;
           $tpath1 = preg_replace('/\s+/', ' ', $tpath1);
          copy($pic1,$tpath1);


//////////////////////////////////////////////////
         /* $image="profile.png";
                 $image= $_FILES['image']['name'];
                 $extension=end(explode(".", $image));
           $pic1=$_FILES['image']['tmp_name'];
           $tpath1='./assets/images/profile';
          
          copy($pic1,$tpath1);*/
 
          $data = array( 
                   'admin_user_id'  =>  $_POST['username'],
                  'admin_password'  =>  $_POST['password'],
                  //'email'  =>  $_POST['email'],
                  'profileImg'  =>  $imagename
                  );
          
          $channel_edit=Update('ADMIN_ROLE', $data, "WHERE id = '".$_SESSION['id']."'"); 

     }
     else
     {
          $data = array( 
                  'admin_user_id'  =>  $_POST['username'],
                  'admin_password'  =>  $_POST['password'],
                 // 'email'  =>  $_POST['email'] 
                  );
          
          $channel_edit=Update('ADMIN_ROLE', $data, "WHERE id = '".$_SESSION['id']."'"); 
         // print_r($channel_edit);exit;

    }

    $_SESSION['msg']="11"; 
    header( "Location:profile.php");
    exit;
     
  }


?>
 
   <div class="row">
      <div class="col-md-12">
        <div class="card">
      <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Admin Profile</div>
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
              
            <form action="" name="editprofile" method="post" class="form form-horizontal" enctype="multipart/form-data">
              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Profile Image (300x300) :-</label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="image" id="fileupload">
                          
                            <div class="fileupload_img"><img type="image" src="assets/images/add-image.png" alt="add image" /></div>
                         
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp; </label>
                    <div class="col-md-6">
                      <?php if($row['profileImg']!="") {?>
                            <div class="block_wallpaper"><img src="assets/images/<?php echo $row['profileImg'];?>" alt="image" width="50px" height="50px" /></div>
                      <?php } ?>
                    </div>
                  </div><br>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Username :-</label>
                    <div class="col-md-6">
                      <input type="text" name="username" id="username" value="<?php echo $row['admin_user_id'];?>" class="form-control" required autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Password :-</label>
                    <div class="col-md-6">
                      <input type="text" name="password" id="password" value="<?php echo $row['admin_password'];?>" class="form-control" required autocomplete="off">
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

        
<?php include("includes/footer.php");?>       
