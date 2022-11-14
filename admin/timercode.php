<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");
	 
	
	$qry="SELECT * FROM ADMIN where `id`='1'";
  $result=mysqli_query($mysqli,$qry);
  $settings_row=mysqli_fetch_assoc($result);


	if(isset($_POST['submit']))
	{
               
        $min_redeem_amount  =  $_POST['min_redeem_amount'];
        $minimum_widthrawal  =  $_POST['minimum_widthrawal'];
        $joining_bonus  =  $_POST['joining_bonus'];
        $per_refer  =  $_POST['per_refer'];
        $dailytask_coin  =  $_POST['dailytask_coin'];
        $maths_quiz_coin  = $_POST['maths_quiz_coin'];
              

    
      $sql = "UPDATE ADMIN SET min_redeem_amount ='$min_redeem_amount',minimum_widthrawal ='$minimum_widthrawal',joining_bonus ='$joining_bonus',per_refer ='$per_refer',dailytask_coin ='$dailytask_coin',maths_quiz_coin ='$maths_quiz_coin' WHERE id=1";
        if (mysqli_query($mysqli, $sql)) {
          $_SESSION['msg']="11";
        header( "Location:rewards_points.php");
        exit;
        } else {
          echo "Error updating record: " . mysqli_error($conn);
        }
        
		 
	}


?>
 
	 <div class="row">
      <div class="col-md-12">
        <div class="card">
		  <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Rewards Points</div>
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
          	  
            <form action="" name="admob_settings" method="post" class="form form-horizontal" enctype="multipart/form-data">
          
                                          <div class="section">              
                                          <div class="section-body">
                  <div class="form-group">
                      
                      
                        <div class="row">
                    <div class="form-group redeem_point_block">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <input type="integer" name="minimum_widthrawal" id="minimum_widthrawal" value="<?php echo $settings_row['minimum_widthrawal'];?>" class="form-control"> </div>
                                    <label class="col-md-3 control-label">Coins =</label>
                                    <div class="col-md-3">
                                         <input type="text" name="min_redeem_amount" id="min_redeem_amount" value="<?php echo $settings_row['min_redeem_amount'];?>" class="form-control"> </div>
                                          <label class="col-md-3 control-label">Rs</label>
                                    <label class="col-md-2 control-label"><?php echo $settings_row['redeem_currency'];?></label>                         
                                    </div>                      
                                    </div>                    
                                    <div class="col-md-6">                       
                                    <label class="col-md-6 control-label">Minimum Redeem Coins =</label>                          <div class="col-md-6">                            
                                    <input type="integer" name="minimum_widthrawal" id="minimum_widthrawal" value="<?php echo $settings_row['minimum_widthrawal'];?>" class="form-control">                     </div>                      
                                          </div>                      
                                          </div>                    
                                          </div>				  
                                          </div>	
                      
                      
                  <label class="col-md-3 control-label">App Registration Points:-</label>
                  <div class="col-md-4">
                    <input type="integer" name="joining_bonus" id="joining_bonus" value="<?php echo $settings_row['joining_bonus'];?>" class="form-control">
                  </div>
                  </div>
                  
                 
                  
                  <div class="form-group">
                  <label class="col-md-3 control-label">App Refer Points:-</label>
                  <div class="col-md-4">
                    <input type="text" name="per_refer" id="per_refer" value="<?php echo $settings_row['per_refer'];?>" class="form-control">
                  </div>
                  </div>
 
                <div class="form-group">
                 <label class="col-md-3 control-label">Minimum Withdrawal:-</label>
                  <div class="col-md-4">
                    <input type="integer" name="minimum_widthrawal" id="minimum_widthrawal" value="<?php echo $settings_row['minimum_widthrawal'];?>" class="form-control">
                  </div>
                  </div>
                   
                  <div class="form-group">
                  <label class="col-md-3 control-label">Daily Task Coins:-</label>
                  <div class="col-md-4">
                    <input type="text" name="dailytask_coin" id="dailytask_coin" value="<?php echo $settings_row['dailytask_coin'];?>" class="form-control">
                  </div>
                  </div>
                  
                  
                  
                   
               <!--   <div class="form-group">
                  <label class="col-md-3 control-label">Maths Quiz Correct Answer Coins:-</label>
                  <div class="col-md-4">
                    <input type="integer" name="maths_quiz_coin" id="maths_quiz_coin" value="<?php echo $settings_row['maths_quiz_coin'];?>" class="form-control">
                  </div>
                  </div>-->
                   
             <div  align="center" class="form-group">
                    <div class="col-md-8">
                    <button type="submit" name="submit" class="btn btn-primary ">Save</button>
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
