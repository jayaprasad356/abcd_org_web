<?php include('includes/header.php'); 

    include('includes/function.php');
  include('language/language.php');  
   date_default_timezone_set("Asia/Calcutta");
    
  
  $admin_user_id=$_SESSION['admin_refer_code'];

  $qry="SELECT * FROM PAYMENT_VERIFICATION where id='1'";
  $result=mysqli_query($mysqli,$qry);
  $settings_row=mysqli_fetch_assoc($result);

   
  $qry_users_PAID="SELECT COUNT(*) as num FROM PAYMENT_VERIFICATION  WHERE `status` = 'PAID'";
  $total_PAID = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_PAID));
  $total_PAID = $total_PAID['num'];


  $qry_users_PENDING="SELECT COUNT(*) as num FROM PAYMENT_VERIFICATION  WHERE `status` = 'PENDING'";
  $total_PENDING = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_PENDING));
  $total_PENDING = $total_PENDING['num'];
  
   $qry_users_CANCELLED="SELECT COUNT(*) as num FROM PAYMENT_VERIFICATION  WHERE `status` = 'CANCELLED'";
  $total_CANCELLED = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_CANCELLED));
  $total_CANCELLED = $total_CANCELLED['num'];



     if(isset($_POST['status']))
   

    { //alert("hello");exit;
     $start = 0; 
     $limit=250;
     $st1=$_POST['status'];
     // print_r($st1);exit;
     if($_SESSION['id'] > 1)
     {
       
    
      $user_qry="SELECT * FROM USER_DETAILS INNER JOIN `PAYMENT_VERIFICATION` WHERE `status` = '$st1' and `user_id` LIKE '$admin_user_id%'  ORDER BY PAYMENT_VERIFICATION.id DESC ";  
                 
      $users_result=mysqli_query($mysqli,$user_qry);
  
     }else{
         
          $users_qry="SELECT * FROM USER_DETAILS INNER JOIN `PAYMENT_VERIFICATION` WHERE `status` = '$st1'  ORDER BY PAYMENT_VERIFICATION.id DESC ";
         
           $users_result=mysqli_query($mysqli,$users_qry);
          // print_r($users_qry);exit;
     }
    
   }
   else if(isset($_POST['user_search']))
   {
     
    
    $user_qry="SELECT * FROM  PAYMENT_VERIFICATION
                  WHERE name like '%".addslashes($_POST['search_value'])."%' or PAYMENT_VERIFICATION.email like '%".addslashes($_POST['search_value'])."%' or PAYMENT_VERIFICATION.mobile like '%".addslashes($_POST['search_value'])."%'  ORDER BY PAYMENT_VERIFICATION.id DESC";  
               
    $users_result=mysqli_query($mysqli,$user_qry);
    
     
   }
   else
   {
   
      $tableName="PAYMENT_VERIFICATION";
      $targetpage = "payment_verification.php";
      $limit = 10; 
      
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
      
      
     /*$users_qry="SELECT * FROM USER_DETAILS INNER JOIN PAYMENT_VERIFICATION ON USER_DETAILS.mobile=PAYMENT_VERIFICATION.mobile WHERE USER_DETAILS.reffered_by LIKE 'DTAA%'";
       
      $users_result=mysqli_query($mysqli,$users_qry);*/
      
    $admin_user_id=$_SESSION['admin_refer_code'];
     if($_SESSION['id'] > 1){
        /*print_r()*/
        $users_qry = "SELECT * FROM USER_DETAILS INNER JOIN PAYMENT_VERIFICATION ON USER_DETAILS.mobile=PAYMENT_VERIFICATION.mobile WHERE USER_DETAILS.reffered_by LIKE '$admin_user_id%' ORDER BY USER_DETAILS.id DESC LIMIT $start, $limit";
        $users_result = mysqli_query($mysqli, $users_qry);
    
              
   }else{
       
        $users_qry="SELECT * FROM  PAYMENT_VERIFICATION  ORDER BY PAYMENT_VERIFICATION.`id` DESC LIMIT $start, $limit
";
       
      $users_result=mysqli_query($mysqli,$users_qry);
   }
              
   }
   
  //Active and Deactive status
   if(isset($_GET['status_deactive_id']))
  {
   // print_r($_GET);exit;
      
    $data = array('status'  =>  'CANCELLED','cancel_date'=>$date);
    
     
    
    $edit_status=Update('PAYMENT_VERIFICATION', $data, "WHERE id = '".$_GET['status_deactive_id']."'");
    
     $_SESSION['msg']="14";
     header( "Location:payment_verification.php");
     exit;
  }
  
   if($_POST['status_active_id'])
  {
     // echo('hii');exit;
     
     // alert("done4me");exit;
      $data = array('status'  => 'PAID','verified_date'=>$date,'remarks'=>$addTimer);

      $id=$_POST['status_active_id'];
    // $refmobile=$_POST['mobile'];
    
   $edit_status=Update('PAYMENT_VERIFICATION', $data, "WHERE id = $id ");
     $users_result=mysqli_query($mysqli,$edit_status);
     //print_r($edit_status);exit;
      // print_r(mysqli_affected_rows( $mysqli));exit;
     
     if($edit_status != 0){ 
        
      //  print_r("done4me2");
         
     /*     $edit_status12="SELECT `reffered_paid`,`mobile`,`name`,`user_referal_code` FROM `USER_DETAILS` WHERE `mobile`='$refmobile' ";
        //  print_r($edit_status12);exit;
             $users_result12=mysqli_query($mysqli,$edit_status12);
             $row122 = mysqli_fetch_assoc($users_result12);
             
               $reffered_paidref= $row122['reffered_paid'];
                $reffered_paidmob= $row122['mobile'];
                $reffered_paidname= $row122['name'];
                $reffered_refcode= $row122['user_referal_code'];
         //mysqli_close($mysqli);
         
       //  print_r( $reffered_paidname);exit;
         
         if( $reffered_paidref !="PAID")
         
           {
               
              $user_qry5178= "SELECT `name`,`mobile` FROM `USER_DETAILS` WHERE `user_referal_code`=(SELECT `reffered_by` FROM `USER_DETAILS` WHERE `mobile`=$refmobile)";
               $user_result5178=mysqli_query($mysqli,$user_qry5178);
                 $row1223 = mysqli_fetch_assoc($user_result5178);
                 
             
                $ref_mob= $row1223['mobile'];
                $ref_paidname= $row1223['name'];
               
          
            $user_qry51789="INSERT INTO `WALLET` (`ID`, `username`, `mobile`, `amount`, `status`, `txn`,`refer_id`, `date`) VALUES (NULL,'$ref_paidname',$ref_mob,(SELECT `per_refer` FROM `ADMIN` WHERE `id`=1), 'CREDIT', 'Referal Bonus','$reffered_refcode','$date')";
          
            $user_result51789=mysqli_query($mysqli,$user_qry51789);
           
            $LastID = mysql_insert_id($mysqli);
          
             $row1224 = mysqli_fetch_assoc( $user_result51789);
             //print_r( $LastID);exit;
              // print_r( $user_qry51789);exit;
               // print_r($user_result5178);exit;
               // print_r(mysqli_insert_id($user_qry5178));exit;
                // print_r($row1224);exit;
             
            
            $_SESSION['msg']="13";
       header( "Location:payment_verification.php");
        exit;
          
    
        }*/
         
        $_SESSION['msg']="13";
       header( "Location:payment_verification.php");  
        exit;
         
     }else{
      $_SESSION['msg']="13";
       header( "Location:payment_verification.php");  
        exit;
     }
     $_SESSION['msg']="13";
     header( "Location:payment_verification.php");
     exit;
   
   
  }
  
   if(isset($_GET['trans_id']))
  {
      
     
    Delete('PAYMENT_VERIFICATION','id='.$_GET['trans_id'].'');
    
    $_SESSION['msg']="12";
    header( "Location:payment_verification.php");
    exit;
  }


  if(isset($_POST['delete_rec']))
  {

    $checkbox = $_POST['post_ids'];
    
    for($i=0;$i<count($checkbox);$i++){
      
      $del_id = $checkbox[$i]; 
     
      Delete('PAYMENT_VERIFICATION','id='.$del_id.'');
 
    }

    $_SESSION['msg']="12";
    header( "Location:payment_verification.php");
    exit;
  }

?>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">
  
$(function() {
    $('#status').change(function() {
        this.form.submit();
    });
});

</script>

 <div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Payment Verification</div>
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

             <!--  <div class="form-group">
                          <label class="col-md-12 control-label mr_bottom20">Banner Display Type:-</label>
                            <div class="col-md-12">
                              <select name="banner_add" id="banner_add" class="select2">
                               <option value="False" <?php if($settings_row['banner_add']=='False'){?>selected<?php }?>>Disable Add Banner</option>
                                <option value="Facebook" <?php if($settings_row['banner_add']=='Facebook'){?>selected<?php }?>>Facebook Network Audience Add Banner</option>
                                <option value="addmob" <?php if($settings_row['banner_add']=='addmob'){?>selected<?php }?>>Google AdMob Add Banner</option>
                                <option value="Both" <?php if($settings_row['banner_add']=='Both'){?>selected<?php }?>>Both Addmob & Facebook Banner</option>
                    
                              </select>
                            </div>
                          </div> -->
                         

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
      
<div>
      <div class="col-md-12 mrg_bottom">
        <span class="badge badge-success badge-icon"><i class="fa fa-check fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"><?php echo $total_PAID ? $total_PAID : '0';?> <?php echo $settings_row['redeem_currency'];?> PAID</span></span>
                <span class="badge badge-danger badge-icon"><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"> <?php echo $total_PENDING ? $total_PENDING : '0';?> <?php echo $settings_row['redeem_currency'];?> PENDING</span></span>
                <span class="badge badge-danger badge-icon"><i class="fa fa-times fa-2x" aria-hidden="true"></i><span style="font-size: 18px;"> <?php echo $total_CANCELLED ? $total_CANCELLED : '0';?> <?php echo $settings_row['redeem_currency'];?> CANCELLED</span></span>
      </div>

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
                  
                  <!-- <th>Sl.no</th>
                    <th>Reg. Mobile</th>
                    <th>Name Of User</th>
                    <!--<th>User Email</th>
                     <th>Amount</th>
                      <th>Order Id</th>
                      <th>Transaction Date</th>
                    <th>Status</th>
                    <th>Req/Paid date</th>
                    <th>Action</th>    -->
                  
                  <th style="width:120px;">Sl.no</th>
                  <th style="width:120px;">Name</th>            
                  <th style="width:220px;">Mobile</th>
                  <th style="width:220px;">Refer Code</th>
                  <th style="width:220px;">Refer By</th>
                  <th style="width:120px;">Amount</th>
            <th>Order Id</th>
             <th>Transaction Date/Remark</th>
                  <th style="width:70px;">Status</th>
                  <th style="width:180px;">Action</th>  
                 </tr>
              </thead>
              <tbody>
                <?php
            $i=1;
            while($users_row=mysqli_fetch_array($users_result))
            {


              $mobile=$users_row['mobile'];

                $userDetails= getSingleRow("USER_DETAILS"," WHERE mobile='$mobile' ");
               // print_r($userDetails);
               
                    $users_row['total_referals']=$userDetails['total_referals'];
                  $users_row['wallet']=$userDetails['wallet'];
                    $users_row['user_referal_code']=$userDetails['user_referal_code'];
                    $users_row['reffered_by']=$userDetails['reffered_by'];
                    $users_row['total_all_qr_generation']=$userDetails['total_all_qr_generation'];
                   $users_row['total_qr_generation']=$userDetails['total_qr_generation'];
                    $users_row['code_gen_allow']=$userDetails['code_gen_allow'];
                     $users_row['codegenTimer']=$userDetails['codegenTimer'];
                        $users_row['joining_time']=$userDetails['joining_time'];
                        //  $users_row['remarks']=$userDetails['remarks'];
             
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
               <td><?php echo $i?></td>
               <td><?php echo $users_row['name'];?></td>
               <td><?php echo $users_row['mobile'];?></td>
                <td><?php echo $users_row['user_referal_code'];?></td>
                 <td><?php echo $users_row['reffered_by'];?></td>
               
           <td><?php echo $users_row['amount'];?></td>
               <td><?php echo $users_row['order_id'];?></td> <!--<?php echo $settings_row['redeem_currency'];?></td>-->
          
          
            <td>
                      <?php if($users_row['status'] == 'PENDING'){?>
                      <?php echo formatTimeToDate($users_row['transaction_date']); ?>

                       <br><p span class="badge badge-warning badge-icon"> Remarks</p>  </br>

                     <br>   <?php echo ($users_row['remarks']); ?>
                      
                       <?php } else if($users_row['status']=="PAID"){?>
                       <?php echo formatTimeToDate($users_row['verified_date']); ?>

  <br><p span class="badge badge-warning badge-icon"> Remarks</p>  
                      <br>  <?php echo ($users_row['remarks']); ?>

                       <?php } else{ ?>
                      <?php echo formatTimeToDate($users_row['cancel_date']); ?>
                        <br><p span class="badge badge-warning badge-icon"> Remarks</p>  

                      <br> <?php echo ($users_row['remarks']); ?>
                       <?php } ?>
                   </td>
                   
                   
         <!--  <td><?php echo date('m-d-Y',strtotime($users_row['transaction_date']));?></td>-->

        <td>
         <?php if($users_row['status']=="PAID"){?>
                  <a href="#" title="Change Status"><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>PAID</span></span></a>

                  <?php }else if($users_row['status']=="CANCELLED"){?>
                  <a href="#" title="Change Status"><span class="badge badge-danger badge-icon" ><i class="fa fa-times" aria-hidden="true"></i><span>CANCELLED </span></span></a>
                  <?php }else {?>
                  <a href="#" title="Change Status"><span class="badge badge-danger badge-icon" ><i class="fa fa-clock-o" aria-hidden="true"></i><span>PENDING </span></span></a>
                  <?php }?>
                 
               </td>
                  <td> 
                   <!--   <a href="payment_verification.php?status_active_id=<?php echo $users_row['id'];?>&mobile=<?php echo $users_row['mobile'];?>" onclick="return confirm('Are you sure you want to Update Paid In this transaction?');" class="btn btn-success" data-toggle="tooltip" data-tooltip="PAID"><i class="fa fa-check"></i></a> -->

<?php
  $u_id=$users_row['id'];
   $user_mob=$users_row['mobile'];
//  print_r($u_id);exit;  ?>
                   

                     <a  class="btn btn-success" onclick="get_details('<?=$u_id?>','<?=$user_mob?>')" data-toggle="modal" data-target="#setCode_Modal"data-tooltip="PAID"><i class="fa fa-check"></i></a>

                     
                    <a href="payment_verification.php?status_deactive_id=<?php echo $users_row['id'];?>&mobile=<?php echo $users_row['mobile'];?>" onclick="return confirm('Are you sure you want to Cancel this transaction?');" class="btn btn-primary" data-toggle="tooltip" data-tooltip="CANCELLED"><i class="fa fa-times"></i></a>
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


<!-- The Modal -->
  <div class="modal" id="setCode_Modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
         <h4 class="modal-title" id="modal-title">Insert Verified Transaction Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
         <div class="modal-body">  
                     <form method="post" id="insert_sform"> 
                          
                          <div class="row">
                             

                             <!--  <div class="col-md-12">
                                    <label>Transaction Id</label>  
                                    <input type="Number" name="addays" id="addays" class="form-control" />  
                                    <br />
                              </div> -->
                            
                            <div class="col-md-12">
                                    <label>Transaction Details Remark</label>  
                                    <input type="text" name="addtimer" id="addtimer" class="form-control" />  
                                    <br />
                              </div>
                             
                          </div>
                          
                           <input  type="hidden"  name="status_active_id" id="status_active_id"  />  
                           <input type="submit" name="inserttSetCode" id="inserttSetCode" value="Update" class="btn btn-success" />  
                     </form>  
                </div>  
           </div>  
      </div>  
 </div>  
 <!-- Modal footer -->

 <script type="text/javascript">
  function get_details(u_id,user_mob)
  {
      //alert(u_id);
    $("#status_active_id").val(u_id);
  //  $("#addtimer").val(user_mob);
   
  }
</script>

 <script  type="text/javascript">  

     /* $(document).on('click', '.edit_data', function(){  
        alert('hello');exit;
           //var idad = $idmm;  
           alert(idmm);
            $("#status_active_id").val("hello");
             $('#addtimer').val(idmm); 

                   // $('#status_active_id').html(idmm);
                      $('#setCode_Modal').modal('show');  
      });  */
      
      $('#insert_sform').on("submit", function(event){  
           event.preventDefault();  
           if($('#addtimer').val() == '')  
           {  
                alert("Remark  is required");  
           }
           else{ 
               ////////////////////////////

              /* payment_verification.php?status_active_id=<?php echo $users_row['id'];?>&mobile=<?php echo $users_row['mobile'];?>*/

                    $.ajax({  
                         url:"insert_dailytask.php",  
                         method:"POST",  
                         data:$('#insert_sform').serialize(),

                         beforeSend:function(){  
                              $('#inserttSetCode').val("Inserting");  
                             // alert(idmm);exit;
                         },  
                          //dataType:"text",
                          dataType:"json",
                         success:function(data)
                         {  
                       
                      //alert(data);
                     // alert("st"+data);
                      if(data.status=='200'){
                       toastr.success(data.msg); 
                             $('#insert_sform')[0].reset();  
                              $('#setCode_Modal').modal('hide');  
                              //$('#adminsList').html(data);  
                   setTimeout(function(){ 
                      window.location.replace('payment_verification.php');
                    }, 1000);
                           }else{
                            toastr.error(data.msg);
                          }
                     } 
                    });
               //////////////////////////

           }  
      });  
     
  
 </script>



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
}.table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 0;
    word-break: break-word;
}
</style>


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