<?php include('includes/header.php'); 
  include("includes/connection.php");
  
    include("includes/function.php");
  include("language/language.php"); 
 
     $users_res=mysqli_query($mysqli,'SELECT * FROM USER_DETAILS WHERE mobile='.$_GET['user_id'].'');
       $users_res_row=mysqli_fetch_assoc($users_res);
   
     $start = 0; 
     

   $tableName="WALLET";
      $targetpage = "total_transaction.php";
      $limit = 250; 
      
      $query = "SELECT COUNT(*) as num FROM  WALLET  WHERE  WALLET.`txn`!='Qr Code Generation'";
      $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query));
      $total_pages = $total_pages['num'];
      
  

      $stages = 3;
      $page=0;
      if(isset($_GET['page'])){
      $page = mysqli_real_escape_string($mysqli,$_GET['page']);
      }
      if($page){
        $start = ($page - 1) * $limit; 
      }else{
        $start = 0; 
        } 
$admin_user_id=$_SESSION['admin_refer_code'];
if($_SESSION['id'] > 1){
        /*print_r()*/
       $users_walletquey="SELECT * 
FROM WALLET  INNER JOIN USER_DETAILS
ON  WALLET.mobile=USER_DETAILS.mobile
WHERE USER_DETAILS.reffered_by LIKE '$admin_user_id%' AND  WALLET.`txn`!='Qr Code Generation' ORDER BY WALLET.ID DESC LIMIT $start, $limit";
        $users_result = mysqli_query($mysqli, $users_walletquey);
       
    
              
   }else{
       
        $users_walletquey="SELECT * FROM `WALLET` WHERE `txn`!='Qr Code Generation'  ORDER BY `ID` DESC LIMIT $start, $limit";
       
      $users_result=mysqli_query($mysqli,$users_walletquey);
   }
       
      
       
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




    <!-- Main content -->
    
     <div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
              
              
               <div class="row">
      <div class="col-xs-12 mr_bottom20">
      <div class="card mr_bottom20 mr_top10">
      <div class="page_title_block user_dashboard_item" style="background-color: #fff;">
           <!-- <div class="col-md-10 col-xs-12">
              <br>
              <span class="badge badge-success badge-icon"><i class="fa fa-user fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"><?php echo $users_res_row['name'];?></span></span>
              <span class="badge badge-success badge-icon"><i class="fa fa-envelope fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"><?php echo $users_res_row['email'];?></span></span>
              <span class="badge badge-success badge-icon"><i class="fa fa-mobile fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"><?php echo $users_res_row['mobile'];?></span></span>
              <br><br>
            </div>-->
            


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
          </div>
              
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Payment Verification</div>
            </div>
           <!-- <div class="col-md-7 col-xs-12">              
                  <div class="search_list">
                    <div class="search_block">
                      <form  method="post" action="">
                        <input class="form-control input-sm" placeholder="Search..." aria-controls="DataTables_Table_0" type="search" name="search_value" required>
                        <button type="submit" name="user_search" class="btn-search"><i class="fa fa-search"></i></button>
                      </form>  
                    </div>
                     
                  </div>
               </div>-->
               
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
                 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?> 
              </div>
            </div>
          </div>
          <div class="col-md-12 mrg-top manage_transaction_btn">

           <form method="post" action="">
            <button type="submit" class="btn btn-primary" style="margin-bottom:20px;" name="delete_rec" value="delete_post" onclick="return confirm('Are you sure you want to delete this items?');">Delete</button> 
            <table id="customer_data" table class="table table-bordered table-striped">
                <!--  <table id="customer_data" table class="table  table-striped primary">-->
              <thead>
                <tr>
                  <th>
                    <div class="checkbox">
                    <input type="checkbox" name="checkall" id="checkall" value="">
                    <label for="checkall"></label>
                    </div>
          All
                  </th>
                  
                
                  <th>Mobile No.</th>
                  <th>Remark</th>
                  <th>TransactionType</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                $count=1;
             while($row1= mysqli_fetch_array( $users_result)){
                  $class1="";
                  
                  
                  
                    if($row1['status']=='CREDIT' & $row1['txn']=='BONUS')
                    {    $t_status="SUCCESSFULL";
                          $class2="text-warning";
                        $txn_type=" Bonus Deposit";
                        $remark=" Deposited For Bonus";
                       
                    }
                     if( $row1['status']=='CREDIT'& $row1['txn']=='Qr Code Generation')
                     {
                         $t_status1=$row1['status'];
                        $t_status="CREDIT";
                          $class2="text-success";
                        $txn_type="$t_status1 Depost";
                        $remark="Deposited For Qr generation";
                       
                    }
                     if( $row1['status']=='CREDIT'& $row1['txn']=='Codes Added By Admin')
                     {
                         $t_status1=$row1['status'];
                        $t_status="CREDIT";
                          $class2="text-success";
                        $txn_type="$t_status1 Depost";
                        $remark="Codes Added By Admin";
                       
                    }

                    if($row1['status']=='REDEEM')
                    {     $t_status=$row1['status'];
                          $class2="text-danger";
                        $txn_type=" TradeIncome Deposit";
                        $remark="Redeemed By User";
                       
                    }
                  if($row1['releted_id']=='2'& $row1['status']=='0')
                    {    $t_status="PENDING";
                      $class2="text-danger";
                         $txn_type="LevelIncome Deposit";
                        $remark="Amount Deposited For Referal Bonus";
                    }
                    if($row1['releted_id']=='3'& $row1['status']=='0')
                    {    $t_status="PENDING";
                      $class2="text-danger";
                         $txn_type="Withdraw Requested";
                        $remark="Withdrawal Requested By User";
                    }
                  if($row1['releted_id']=='3'& $row1['status']=='1')
                    {    $t_status="SUCCESSFULL";
                    $class2="text-success";
                         $txn_type="Withdraw Requested";
                        $remark="Withdrawal Processed By Admin";
                    }
                    
                     if($row1['releted_id']=='1'& $row1['status']=='2')
                    {    $t_status="CANCELLED";
                    $class2="text-danger";
                         $txn_type="Verification Requested";
                        $remark="Verification Cancelled By Admin";
                    }
                 
                    if($row1['releted_id']=='CREDIT')
                    {
                        $class="text-success";
                    }
                    if($row1['releted_id']=='REDEEM')
                    {
                         $class="text-danger";
                    }
                    if($row1['releted_id']=='BONUS')
                    {
                         $class="text-warning";
                    }
                 
                 
                echo " 
                
                
                
                <tr>
              
                  <td class='".$class1."'>".$count."</td>
                  <td class='".$class1."'>".$row1['mobile']."</td>
                  <td class='".$class1."'>".$remark."</td>
                   <td class='".$class1."'>".$row1['status']."</td>
                  <td class='".$class1."'>".$row1['amount']."</td>
                  
                 <td class='".$class1."'>".$row1['txn']."</td>
                  <td class='".$class1."'>".formatTimeToDate($row1['date'])."</td>
                  
                </tr>
               ";$count++;}?>
          
              </tbody>
            </table>
            </form> 
          </div>
          <div class="col-md-12 col-xs-12">
            <div class="pagination_item_block">
              <nav>
                <?php if(!isset($_POST["search"])){ include("pagination.php");}?>                 
              </nav>
            </div>
          </div>
          <div class="clearfix"></div>
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