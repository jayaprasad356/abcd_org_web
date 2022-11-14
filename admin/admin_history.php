<?php include('includes/header.php'); 
	include("includes/connection.php");
	
    include("includes/function.php");
	include("language/language.php"); 
 
 
 if (isset($_GET['user_id'])) {
     $admin_id=$admin_role_row['admin_refer_code'];
      $admin_id=$_GET['user_id'];
      /*print_r($_GET['user_id']);*/
    /*  $users_walletquey="SELECT * FROM `ADMINS1_DATA` WHERE `admin_refer_code`=$admin_id'";
       $settings_uresult=mysqli_query($mysqli,$users_walletquey);*/
        $users_walletquey=mysqli_query($mysqli,"SELECT * FROM `ADMINS1_DATA` WHERE `admin_refer_code`='$admin_id'");

      
 }
 
      /* $admin_role="SELECT `admin_refer_code` FROM `ADMIN_ROLE`";
       $admin_results=mysqli_query($mysqli,$admin_role);
       
     
				$i=0;
				while($admin_role_row=mysqli_fetch_assoc($admin_results))
			//	print_r("HELLO");exit;
				  $admin_id=$admin_role_row['admin_refer_code'];
				  print_r($admin_id);
				   $users_walletquey=mysqli_query($mysqli,'SELECT * FROM `ADMINS1_DATA` WHERE `admin_refer_code`='.$admin_role_row['admin_refer_code'].'');
				{
				 
	
       // $admin_id=$admin_result['admin_refer_code'];
       // print_r($admin_id);exit;
     
				 $admin_id=$admin_role_row['admin_refer_code'];
				  print_r($admin_id);
				$i++;
				}
	 */
         
       
	 	 $users_res=mysqli_query($mysqli,"SELECT * FROM ADMIN_ROLE WHERE admin_refer_code='$admin_id'");
	     $users_res_row=mysqli_fetch_assoc($users_res);
	     
	 //   $users_walletquey=mysqli_query($mysqli,'SELECT * FROM `ADMINS1_DATA` WHERE `admin_refer_code`='.$_GET['user_id'].'');
	  //  print_r($users_walletquey);
	     // $users_walletquey=mysqli_query($mysqli,'SELECT * FROM `ADMINS1_DATA` ');
			 
		 $users_rewards_qry="SELECT * FROM tbl_users_rewards_activity
		 LEFT JOIN tbl_users ON tbl_users_rewards_activity.user_id= tbl_users.id
		 WHERE tbl_users_rewards_activity.user_id='".$_GET['user_id']."'
		 ORDER BY tbl_users_rewards_activity.id DESC";
			 
		$users_rewards_result=mysqli_query($mysqli,$users_rewards_qry);


$settings_qry="SELECT * FROM APP_SETTING where id='1'";
  $settings_result=mysqli_query($mysqli,$settings_qry);
  $settings_row=mysqli_fetch_assoc($settings_result);

$qry_refer="SELECT COUNT(*) as num FROM USER_DETAILS WHERE refFered_by='$admin_id'";
$total_refer = mysqli_fetch_array(mysqli_query($mysqli,$qry_refer));


//(SELECT SUBSTR(($admin_id),1,4))

$qry_users_paid="SELECT SUM(ammount) AS num FROM WIDTHRAWL
                WHERE user_id=(SELECT SUBSTR(($admin_id),1,4)) AND WIDTHRAWL.status = 'PAID'";
                
                
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
              <span class="badge badge-success badge-icon"><i class="fa fa-user fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"><?php echo $users_res_row['admin_name'];?></span></span>
              <span class="badge badge-success badge-icon"><i class="fa fa-envelope fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"><?php echo $users_res_row['admin_email'];?></span></span>
              <span class="badge badge-success badge-icon"><i class="fa fa-mobile fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"><?php echo $users_res_row['admin_mobile'];?></span></span>
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
          <table id="customer_data" table class="table table-bordered table-striped">
    <thead>
        <tr>
            <tr>
                
              <th>Admin Id</th>    
	          <th>Today App Joining</th>
			   <th>Today Joining Payment</th>
			  <th>Payment Recieved</th>
			  <th>Widthrawal Requested</th>
			  <th>Widthrawal Done</th>
              <th>Transaction Details Date</th>
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
           <td><?php echo $users_walletqueryrow['admin_refer_code'];?></td>
           <td><?php echo $users_walletqueryrow['today_app_joining'];?></td>
           <td><?php echo $users_walletqueryrow['today_joining_paid_no'];?></td>
           <td><?php echo $users_walletqueryrow['total_jpaid_amnt'];?></td>
           <td><?php echo $users_walletqueryrow['today_payment_request'];?></td>
            <td><?php echo $users_walletqueryrow['today_payment_done'];?></td>
             <td><?php echo $users_walletqueryrow['today_date'];?></td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> 
           



<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript" >
 $('#customer_data').DataTable({ 
        responsive: true, 
        paging:true,
        dom: "<'row'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>tp", 
        buttons: [  
            {extend: 'copy', className: 'btn-sm btn-success'}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm btn-success'}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm btn-success', title: 'exportTitle'}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm btn-success'}, 
            {extend: 'print', className: 'btn-sm btn-success'} 
        ] 
    });
 
</script> 
<style type="text/css">
    .btn-success:hover {
    color: #fff !important;
    background-color: #5c2379 !important;
    border-color: #398439 !important;
}
.btn-success {
    /* color: #fff; */
    /* background-color: #5cb85c; */
    /* border-color: #4cae4c; */
    color: #333 !important;
    background-color: #fff!important;
    border-color: #ccc!important;
}
</style>

<?php include('includes/footer.php'); ?>

<?php include('includes/footer.php');?>                  