<?php include('includes/header.php'); 

    include('includes/function.php');
  include('language/language.php');  


if($profile_details['manageWithdrawal'] == 2){
  $class1="";
  $class2="";
  $class3="";
 
  
 }else{
  $class1="";
  $class2="none";
  $class3="none";
 
 
 }

  $admin_user_id=$_SESSION['admin_refer_code'];
  

  


  

  if(isset($_POST['status']))
   

    { //alert("hello");exit;
     $start = 0; 
     $limit=250;
     $st1=$_POST['status'];
     // print_r($st1);exit;
     if($_SESSION['id'] > 1){
       
    
    $user_qry="SELECT * FROM `WIDTHRAWL` WHERE `status` = '$st1' and `user_id` LIKE '$admin_user_id%'  ORDER BY WIDTHRAWL.id DESC LIMIT $start, $limit";  
               
    $users_result=mysqli_query($mysqli,$user_qry);
    // $users_result = mysqli_query($mysqli, $users_qry);
   // print_r($users_result);exit;
   }else{
       
        $users_qry="SELECT * FROM `WIDTHRAWL` WHERE `status` = '$st1'  ORDER BY WIDTHRAWL.id DESC LIMIT $start, $limit";
       
      $users_result=mysqli_query($mysqli,$users_qry);
      // print_r($users_qry);exit;
   }
              
   }
   else if(isset($_POST['user_search']))
   {
     

    $user_qry="SELECT * FROM  WIDTHRAWL
                  WHERE name like '%".addslashes($_POST['search_value'])."%' or WIDTHRAWL.user_id like '%".addslashes($_POST['search_value'])."%' or WIDTHRAWL.mobile like '%" . addslashes($_POST['search_value']) . "%' ORDER BY WIDTHRAWL.id DESC ";  

               //   print_r($user_qry);exit;
               
    $users_result=mysqli_query($mysqli,$user_qry);
    
     
   }
   else
   {
   
      $tableName="WIDTHRAWL";
      $targetpage = "manage_withdraw_request.php";
      $limit = 250; 
      
      $query = "SELECT COUNT(*) as num FROM $tableName ";
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
        

           if($_SESSION['id'] > 1)
     {
        
        $users_qry = "SELECT * FROM USER_DETAILS  INNER JOIN WIDTHRAWL ON  USER_DETAILS.mobile=WIDTHRAWL.mobile
                          WHERE USER_DETAILS.reffered_by LIKE '$admin_user_id%' ORDER BY WIDTHRAWL.id DESC LIMIT $start, $limit ";
        $users_result = mysqli_query($mysqli, $users_qry);
         


         $qry_users_PAID="SELECT COUNT(*) as num FROM WIDTHRAWL  where `user_id` LIKE '$admin_user_id%' AND `status` = 'PAID'";
  $total_PAID = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_PAID));
  $total_PAID = $total_PAID['num'];


  $qry_users_PENDING="SELECT COUNT(*) as num FROM WIDTHRAWL  where `user_id` LIKE '$admin_user_id%' AND `status` = 'PENDING'";
  $total_PENDING = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_PENDING));
  $total_PENDING = $total_PENDING['num'];
  
   $qry_users_CANCELLED="SELECT COUNT(*) as num FROM WIDTHRAWL  where `user_id` LIKE '$admin_user_id%' AND `status` = 'CANCELLED'";
  $total_CANCELLED = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_CANCELLED));
  $total_CANCELLED = $total_CANCELLED['num'];

              
   }else{
       
        $users_qry="SELECT * FROM `WIDTHRAWL` ORDER BY `id` DESC LIMIT $start, $limit";
       
      $users_result=mysqli_query($mysqli,$users_qry);




      /* $users_qry = "SELECT * FROM `USER_DETAILS` AS L INNER JOIN `WIDTHRAWL` AS M  WHERE (L.mobile= M.mobile ) ORDER BY M.id DESC LIMIT $start, $limit ";
        $users_result = mysqli_query($mysqli, $users_qry);
*/
/*
      $qry="SELECT * FROM WIDTHRAWL where id='1'";
  $result=mysqli_query($mysqli,$qry);
  $settings_row=mysqli_fetch_assoc($result);*/

$qry_users_PAID="SELECT COUNT(*) as num FROM WIDTHRAWL WHERE `status` = 'PAID'";
  $total_PAID = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_PAID));
  $total_PAID = $total_PAID['num'];


  $qry_users_PENDING="SELECT COUNT(*) as num FROM WIDTHRAWL WHERE `status` = 'PENDING'";
  $total_PENDING = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_PENDING));
  $total_PENDING = $total_PENDING['num'];
  
   $qry_users_CANCELLED="SELECT COUNT(*) as num FROM WIDTHRAWL WHERE `status` = 'CANCELLED'";
  $total_CANCELLED = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_CANCELLED));
  $total_CANCELLED = $total_CANCELLED['num'];

   }
   

        
   }
  
  
  //Active and Deactive status
   if(isset($_GET['status_deactive_id']))
  {
    // $date=date("d-m-Y | h:i:s a");
    $data = array('status'  =>  'CANCELLED','cancelled_date' => $date);
    
     
    
    $edit_status=Update('WIDTHRAWL', $data, "WHERE id = '".$_GET['status_deactive_id']."'");
    
     $_SESSION['msg']="14";
     header( "Location:manage_withdraw_request.php");
     exit;
  }
   if(isset($_GET['status_active_id']))
  {
     //$date=date("d-m-Y | h:i:s a");
    $data = array('status'  =>  'PAID','paid_date' => $date);
    
   $edit_status=Update('WIDTHRAWL', $data, "WHERE id = '".$_GET['status_active_id']."'");
    
    $_SESSION['msg']="13";
     header( "Location:manage_withdraw_request.php");
     exit;
  }
  
   if(isset($_GET['trans_id']))
  {
      
     
    Delete('WIDTHRAWL','id='.$_GET['trans_id'].'');
    
    $_SESSION['msg']="12";
    header( "Location:manage_withdraw_request.php");
    exit;
  }


  if(isset($_POST['delete_rec']))
  {

    $checkbox = $_POST['post_ids'];
    
    for($i=0;$i<count($checkbox);$i++){
      
      $del_id = $checkbox[$i]; 
     
      Delete('WIDTHRAWL','id='.$del_id.'');
 
    }

    $_SESSION['msg']="12";
    header( "Location:manage_withdraw_request.php");
    exit;
  }
   
   if(isset($_POST['paid_post']))
  {

    $checkbox = $_POST['post_ids'];
    
    for($i=0;$i<count($checkbox);$i++){
      
      $del_id = $checkbox[$i]; 
     
     // Delete('WIDTHRAWL','id='.$del_id.'');
      $data = array('status'  =>  'PAID','paid_date' => $date);
     $edit_status=Update('WIDTHRAWL', $data, "WHERE id = '".$del_id."'");
    
  // print_r($edit_status);exit;

    /* $_SESSION['msg']="14";
     header( "Location:manage_withdraw_request.php");
     exit;*/
 
    }

    $_SESSION['msg']="13";
    header( "Location:manage_withdraw_request.php");
    exit;
  }
  if(isset($_POST['cancel_rec']))
  {

    $checkbox = $_POST['post_ids'];
    
    for($i=0;$i<count($checkbox);$i++){
      
      $del_id = $checkbox[$i]; 
     
     // Delete('WIDTHRAWL','id='.$del_id.'');
      $data = array('status'  =>  'CANCELLED','cancelled_date' => $date);
     $edit_status=Update('WIDTHRAWL', $data, "WHERE id = '".$del_id."'");
    
  // print_r($edit_status);exit;

    /* $_SESSION['msg']="14";
     header( "Location:manage_withdraw_request.php");
     exit;*/
 
    }

    $_SESSION['msg']="14";
    header( "Location:manage_withdraw_request.php");
    exit;
  }
?>





 <div class="row">
     <div class="col-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Transaction</div>
            </div>


            <div class="col-md-7 col-xs-12">              
                  <div class="search_list">
                    <div class="search_block">
                      <form  method="post" action="">
                        <input class="form-control input-sm" placeholder="Search..." aria-controls="DataTables_Table_0" type="search" name="search_value" required>
                        <button type="submit" name="user_search" class="btn-search"><i class="fa fa-search"></i></button>
                      </form>  
                    </div>
                     
                  </div>
                   </div>
                     
                  </div>


                  <form method="POST" name="myform" action="">
                  <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-6">
                      <select name="status" id="status" class="select2" required>
                        <option value="">--Filter--</option>
                        <option value="PENDING" <?php if(isset($_POST['status']) AND $_GET['status']=="PENDING"){?>selected<?php }?>>PENDING</option>
                        <option value="PAID" <?php if(isset($_POST['status']) AND $_GET['status']=="PAID"){?>selected<?php }?>>PAID</option>
                        <option value="CANCELLED" <?php if(isset($_POST['status']) AND $_GET['status']=="CANCELLED"){?>selected<?php }?>>CANCELLED</option>
                          
                      </select>
                    </div>
                  </div>
                  </form>                 
            
      
      <div class="col-md-12 mrg_bottom">
        <span class="badge badge-success badge-icon"><i class="fa fa-check fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"><?php echo $total_PAID ? $total_PAID : '0';?> <?php echo $settings_row['redeem_currency'];?> PAID</span></span>
                <span class="badge badge-danger badge-icon"><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"> <?php echo $total_PENDING ? $total_PENDING : '0';?> <?php echo $settings_row['redeem_currency'];?> PENDING</span></span>
                <span class="badge badge-danger badge-icon"><i class="fa fa-times fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"> <?php echo $total_CANCELLED ? $total_CANCELLED : '0';?> <?php echo $settings_row['redeem_currency'];?> CANCELLED</span></span>
      </div>

         
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

         <button type="submit" class="btn btn-primary" style="margin-bottom:20px;" name="paid_post" value="paid_post" onclick="return confirm('Are you sure you want to Update this items?');">PAID </button>

          <button type="submit" class="btn btn-primary" style="margin-bottom:20px;" name="cancel_rec" value="cancel_rec" onclick="return confirm('Are you sure you want to Cancel this items?');">CANCELL</button> 

            <table id="customer_data" table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>
                    <div class="checkbox">
                    <input type="checkbox" name="checkall" id="checkall" value="">
                    <label for="checkall"></label>
                    </div>
                 All
                  </th>
                  <th style="width: 89.889px;">Sl.No</th>
                  <th style="width:120px;">Name</th>            
                  <th style="width:220px;">Mobile</th>
                  <th style="width:180px;" class="manage_table_th">Widthrawal Method</th>
                  
                  <th style="width:100px;">Ammount</th>
          <th style="width:90px;">Txn_no</th>
                  <th style="width:70px;">Txn_date</th>
                  <th style="width:70px;">Status</th>
                  <th style="width:200px;">Action</th>  
                 </tr>
              </thead>
              <tbody>
                <?php
            $i=1;
            while($users_row=mysqli_fetch_array($users_result))
            {
             //print_r($users_row);exit;
               $mobile= $users_row['mobile'];

          
                $userDetails= getSingleRow("USER_DETAILS"," WHERE mobile='$mobile' ");
               
                    $users_row['total_referals']=$userDetails['total_referals'];
                  $users_row['wallet']=$userDetails['wallet'];
                    $users_row['user_referal_code']=$userDetails['user_referal_code'];
                    $users_row['reffered_by']=$userDetails['reffered_by'];
                    $users_row['total_all_qr_generation']=$userDetails['total_all_qr_generation'];
                   $users_row['total_qr_generation']=$userDetails['total_qr_generation'];
                    $users_row['code_gen_allow']=$userDetails['code_gen_allow'];
                     $users_row['codegenTimer']=$userDetails['codegenTimer'];
                        $users_row['joining_time']=$userDetails['joining_time'];
             
               
            
               

        ?>
                <tr>
               <td> 
                 
                  <div>
                  <div class="checkbox">
                    <input type="checkbox" name="post_ids[]" id="checkbox<?php echo $i;?>" value="<?php echo $users_row['id']; ?>">
                    <label for="checkbox<?php echo $i;?>">
                    </label>
                  </div>
                  
                </div>
               </td>
               <td><?php echo $i;?></td>
              <!--  <td><?php echo $users_row['name'];?></td> -->
              
               <td><br> Name  </br><p><?php echo $users_row['name']; ?></p>,
                                    <br> Joining Date </br><p><?php echo formatTimeToDate($users_row['joining_time']);?></p>
                                    <br> Total Refer </br><p><?php echo $users_row['total_referals'];?></p>,
               
                                </td>

               <td> <br> Mobile </br><p> <?php echo $users_row['mobile'];?></p>
                  <br> History Days  </br><p><?php echo $users_row['total_qr_generation']; ?></p>,
                   <br> Refer Code </br><p><?php echo $users_row['user_referal_code']; ?></p>,
                    <br> Reffered By </br><p><?php echo $users_row['reffered_by']; ?></p>
               </td>
              <!--  <td class="manage_table_td"><?php echo $users_row['payment_method'];?></td> -->

               <td class="manage_table_td">


  <?php if($users_row['payment_method']=="BANK ACCOUNT"){?>
                
                <p><?php echo $users_row['payment_method'];?>,</p>
                <p><?php echo $users_row['bank_name'];?>,</p>
                <p><?php echo $users_row['bank_ifsc'];?>,</p>
                 <p><?php echo $users_row['bank_acc_no'];?>,</p>
            
                  <?php  }else
                   {?>

                  <p><?php echo $users_row['payment_method'];?>,</p>
                  <?=$users_row['paytm_no']?>
                  
                  <?php }?>




                 </td>





           <td><?php echo $users_row['ammount'];?></td>
              <!--  <td><?php echo $users_row['txn_no'];?></td> -->


            <td>
                <br> Trans No  </br><p><?php echo $users_row['txn_no']; ?></p>,
                <br> Wallet Bal </br><p><?php echo $users_row['wallet'];?></p>,
                <br> Codes </br><p><?php echo $users_row['total_all_qr_generation'];?></p>
               
            </td>

          <!-- <td><?=$users_row['req_date']?></td>-->
            <?php
        $tmp_date="";
            
        ?>
           <td><?php if($users_row['status']=="PAID"){?>
                  <?=formatTimeToDate($users_row['paid_date'])?>
                  <?php
            $tmp_date=$users_row['paid_date'];
          ?>
                  <?php }else if($users_row['status']=="CANCELLED"){?>
                  <?=formatTimeToDate($users_row['cancelled_date'])?>
                  <?php
            $tmp_date=$users_row['cancelled_date'];
          ?>
                  <?php }else {?>
                  <?=formatTimeToDate($users_row['req_date'])?>
                  <?php
            $tmp_date=$users_row['req_date'];
          ?>
                  <?php }?>



                 </td>

                
           
        <td>
        
         <?php  if($users_row['status']=="PAID"){?>
                  <a href="#" title="Change Status"><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>PAID</span></span></a>

                  <?php }else if($users_row['status']=="CANCELLED"){?>
                  <a href="#" title="Change Status"><span class="badge badge-danger badge-icon" ><i class="fa fa-times" aria-hidden="true"></i><span>CANCELLED </span></span></a>
                  <?php }else {?>
                  <a href="#" title="Change Status"><span class="badge badge-warning badge-icon" ><i class="fa fa-clock-o" aria-hidden="true"></i><span>PENDING </span></span></a>
                  <?php }?>


             <br> CodeGen Status  </br>

             <p><?php if($users_row['code_gen_allow']!="2"){?>
                  <a href="#" title="Change Status"><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Allowed</span></span></a>

                  <?php }else {?>
                  <a href="#" title="Change Status"><span class="badge badge-warning badge-icon" ><i class="fa fa-clock-o" aria-hidden="true"></i><span>Blocked </span></span></a>
                  <?php }?></p>

                  <br> CodeGen Timer  </br><p><?php echo $users_row['codegenTimer']; ?></p>,

                 
               </td>

                 <!-- <td> 
                     <a href="manage_withdraw_request.php?status_active_id=<?php echo $users_row['id'];?>" onclick="return confirm('Are you sure you want to Update Paid In this transaction?');" class="btn btn-success" data-toggle="tooltip" data-tooltip="PAID"><i class="fa fa-check"></i></a>
                    <a href="manage_withdraw_request.php?status_deactive_id=<?php echo $users_row['id'];?>" onclick="return confirm('Are you sure you want to Cancel this transaction?');" class="btn btn-primary" data-toggle="tooltip" data-tooltip="CANCELLED"><i class="fa fa-times"></i></a>
          </td>-->
          
         <td>
                      <?php
                      $u_id=$users_row['id'];
                      $n_name=$users_row['name'];
                      $user_mob=$users_row['mobile'];
                      $txn_id=$users_row['txn_no'];
                      $method_pay=$users_row['payment_method'];
                      $amt=$users_row['ammount'];
                      $u_status=$users_row['status'];
                      $req_date=$users_row['request_date'];
                      $bank_name=$users_row['bank_name'];
                      $bank_ifsc=$users_row['bank_ifsc'];
                      $bank_acc_no=$users_row['bank_acc_no'];
                      $paytm_no=$users_row['paytm_no'];
                      ?>
                    
                        <a style="pointer-events: <?=$class3?>" href="manage_withdraw_request.php?status_active_id=<?php echo $users_row['id'];?>&userMobile=<?=$user_mob?>" onclick="return confirm('Are you sure you want to Update Paid In this transaction?');"class="btn btn-success" data-toggle="tooltip" style=" margin-bottom: 5px; width: 50px" data-tooltip="PAID"><i class="fa fa-check"></i></a>


                 
                       
                       <a style="pointer-events: <?=$class3?>" href="manage_withdraw_request.php?status_deactive_id=<?php echo $users_row['id'];?>" onclick="return confirm('Are you sure you want to Cancel this transaction?');" class="btn btn-primary" data-toggle="tooltip" data-tooltip="CANCELLED"><i class="fa fa-times"></i></a>
                       
                       <a style="pointer-events: <?=$class3?>"  href="manage_user_history.php?user_id=<?=$user_mob?>" class="AjaxModal btn btn-warning btn-sm" data-toggle="tooltip" data-tooltip="History"><i class="fas fa-history"></i></a>
                       
                       <a style="pointer-events: <?=$class3?>" href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="get_details('<?=$u_id?>','<?=$n_name?>','<?=$user_mob?>','<?=$txn_id?>','<?=$method_pay?>','<?=$amt?>','<?=$u_status?>','<?=$tmp_date?>','<?=$bank_name?>','<?=$bank_ifsc?>','<?=$bank_acc_no?>','<?=$paytm_no?>')"><i class="fas fa-info" data-toggle="tooltip" data-tooltip="DETAILS"><i class="fa fa-info"></i></a>
                    </td>
          
          
                </tr>
               <?php
            
            $i++;
            }
         ?>
                           </tbody>
                    </table>

                </form>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="pagination_item_block">
                    <nav>
                        <?php if (!isset($_POST["search"])) {
                            include("pagination.php");
                        } ?>
                    </nav>
                </div>
            </div> 
        
            <div class="clearfix"></div>
        </div>
    </div>
</div>   

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: blue;">
        <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Payment Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 align="center" style="text-decoration: underline;">PAYMENT DETAILS</h3>
        <P><strong>USERNAME</strong> :<span id="name_one"></span></P>
        <P><strong>PAYMENT METHOD</strong> :<span id="pay_method"></span></P>
            <ul id="details_payment">
                
            </ul>
        <P><strong>TRANSECTION NO</strong> :<span id="trns_no"></span></P>
        <P><strong>TRANSECTION STATUS</strong> :<span id="trns_status"></span></P>
        <P><strong id="change_date_one">REQUEST DATE</strong> :<span id="trns_date"></span></P>
      </div>
      
    </div>
  </div>
</div>
<script type="text/javascript">
  function get_details(u_id,n_name,user_mob,txn_id,method_pay,amt,u_status,req_date,bank_name,bank_ifsc,bank_acc_no,paytm_no)
  {
      /*alert(req_date);*/
    $("#name_one").html(n_name);
    $("#pay_method").html(method_pay);
    if(method_pay == 'BANK ACCOUNT'){
        $("#details_payment").html('<li>BANK NAME :'+bank_name+'</li><li>BANK IFSC :'+bank_ifsc+'</li><li>BANK ACCOUNT :'+bank_acc_no+'</li>');
    }else if(method_pay == 'PAYTM'){
         $("#details_payment").html('<li>PAYTM NUMBER :'+paytm_no+'</li>');
    }else if(method_pay == 'UPI'){
        $("#details_payment").html('<li>UPI NUMBER :'+paytm_no+'</li>');
    }
    
    $("#trns_no").html(txn_id);
    $("#trns_status").html(u_status);
    if(u_status == 'PAID')
    {
        $("#change_date_one").html('PAID DATE');
    }else if(u_status == 'CANCELLED'){
        $("#change_date_one").html('CANCELLED DATE');
    }else{
        $("#change_date_one").html('REQUEST DATE');
    }
    $("#trns_date").html(req_date);
   
  }
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
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
.table {
    display: inline-table;}
</style>




</body>
</html>


<?php include('includes/footer.php');?>   

<script>
  $(function () {

      $('#customer_data').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>