<?php include('includes/header.php'); 
	include("includes/connection.php");
	
    include("includes/function.php");
	include("language/language.php"); 
 
	 	 $users_res=mysqli_query($mysqli,'SELECT * FROM USER_DETAILS WHERE mobile='.$_GET['user_id'].'');
	     $users_res_row=mysqli_fetch_assoc($users_res);
	     
	     $users_walletquey=mysqli_query($mysqli,'SELECT * FROM `WALLET` WHERE `mobile`='.$users_res_row['mobile'].'');
	     
			 
		 $users_rewards_qry="SELECT * FROM tbl_users_rewards_activity
		 LEFT JOIN tbl_users ON tbl_users_rewards_activity.user_id= tbl_users.id
		 WHERE tbl_users_rewards_activity.user_id='".$_GET['user_id']."'
		 ORDER BY tbl_users_rewards_activity.id DESC";
			 
		$users_rewards_result=mysqli_query($mysqli,$users_rewards_qry);


$settings_qry="SELECT * FROM APP_SETTING where id='1'";
  $settings_result=mysqli_query($mysqli,$settings_qry);
  $settings_row=mysqli_fetch_assoc($settings_result);

$qry_refer="SELECT COUNT(*) as num FROM USER_DETAILS WHERE refFered_by='".$users_res_row['user_referal_code']."'";
$total_refer = mysqli_fetch_array(mysqli_query($mysqli,$qry_refer));



$qry_users_paid="SELECT SUM(ammount) AS num FROM WIDTHRAWL
                WHERE mobile='".$users_res_row['mobile']."' AND WIDTHRAWL.status = 'PAID'";
                
                
$total_paid = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_paid));
$total_paid = $total_paid['num'];

$qry_users_pending="SELECT SUM(redeem_price) AS num FROM tbl_withdraw_request
                  LEFT JOIN tbl_users ON tbl_withdraw_request.user_id= tbl_users.id
                  WHERE tbl_withdraw_request.user_id='".$_GET['user_id']."' AND tbl_withdraw_request.status = 'Pending'";
$total_pending = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_pending));
$total_pending = $total_pending['num'];				
	 
?>
 

    <div class="row">
     	<div class="col-xs-12 mr_bottom20">
      <div class="card mr_bottom20 mr_top10">
     	<div class="page_title_block user_dashboard_item" style="background-color: #333;">
            <div class="col-md-10 col-xs-12">
              <br>
              <span class="badge badge-success badge-icon"><i class="fa fa-user fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"><?php echo $users_res_row['name'];?></span></span>
              <span class="badge badge-success badge-icon"><i class="fa fa-envelope fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"><?php echo $users_res_row['email'];?></span></span>
              <span class="badge badge-success badge-icon"><i class="fa fa-mobile fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"><?php echo $users_res_row['mobile'];?></span></span>
              <br><br>
            </div>
            <div class="col-md-2 col-xs-12">              
			  <div class="search_list">                     
				<div class="add_btn_primary"> <a href="manage_users.php">Back</a> </div>
			  </div>                  
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"> <a href="javascript::void();" class="card card-banner card-orange-light">
                    <div class="card-body"> <i class="icon fa fa-coins fa-4x"></i>
                        <div class="content">
                            <div class="title">Balance</div>
                            <div class="value"><span class="sign"></span><?php echo $users_res_row['wallet'];?></div>
                        </div>
                    </div>
                </a>
            </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"> <a href="javascript::void();" class="card card-banner card-orange-light">
            <div class="card-body"> <i class="icon fa fa-users fa-4x"></i>
              <div class="content">
                <div class="title">Total Referrals</div>
                <div class="value"><span class="sign"></span><?php echo $total_refer['num']; ?></div>
              </div>
            </div>
            </a> 
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mr_bot60"> 
          <a href="javascript::void();" class="card card-banner card-blue-light">
        <div class="card-body"> <i class="icon fa fa-money fa-4x"></i>
          <div class="content">
            <div class="title">Paid</div>
            <div class="value"><span class="sign"></span><?php echo $total_paid; ?></div>
            
          </div>
        </div>
        </a> 
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mr_bot60"> 
          <a href="javascript::void();" class="card card-banner card-yellow-light">
        <div class="card-body"> <i class="icon fa fa-money fa-4x"></i>
          <div class="content">
            <div class="title">Pending</div>
            <div class="value"><span class="sign"></span><?php echo $total_pending ? $total_pending : '0';?><span class="sign"><?php echo $settings_row['redeem'];?></span></div>
          </div>
        </div>
        </a> 
    </div> 


      </div>

     </div>
          </div>

    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <?php echo $users_res_row['name'];?> All Wallet Transaction History
        </div>
        <div class="card-body no-padding">
          <table class="datatable table table-striped primary" cellspacing="0" width="100%">
    <thead>
        <tr>
            <tr>
                
              <th>Activity Type</th>    
	          <th>Txn Status</th>
			   <th>Coins</th>
			  <th>Transaction No</th>
              <th>Date</th>
        </tr>
        </tr>
    </thead>
    <tbody>
        <?php
				$i=0;
				while($users_walletqueryrow=mysqli_fetch_assoc($users_walletquey))
				{
				 
		?>
        <tr>
           <td><?php echo $users_walletqueryrow['ID'];?></td>
           <td><?php echo $users_walletqueryrow['status'];?></td>
           <td><?php echo $users_walletqueryrow['amount'];?></td>
           <td><?php echo $users_walletqueryrow['txn'];?></td>
           <td><?php echo formatTimeToDate($users_walletqueryrow['date']);?></td>
           <!--<td>
          		 <span class="badge badge-danger badge-icon"><i class="fa fa-clock-o" aria-hidden="true"></i><span><?php echo date('d-m-Y', strtotime($users_walletqueryrow['date'])).' - '.date('h:i A', strtotime($users_walletqueryrow['date']));?> </span></span>
      		</td>-->
           
        </tr>
       <?php
				
				$i++;
				}
	   ?>
         
    </tbody>
</table>
        </div>
      </div>
    </div>
  </div>   



<?php include('includes/footer.php');?>                  