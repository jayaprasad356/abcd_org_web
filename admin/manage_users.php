<?php include('includes/header.php');
include("includes/connection.php");

include("includes/function.php");
include("language/language.php");

if($profile_details['manageUserList'] == 2){
  $class1="";
  $class2="";
  $class3="";
 
  
 }else{
  $class1="";
  $class2="none";
  $class3="none";
 
 
 }


  $tableName = "USER_DETAILS";
    $targetpage = "manage_users.php";
     $limit = 500;

    $query = "SELECT COUNT(*) as num FROM $tableName";
    $total_pages = mysqli_fetch_array(mysqli_query($mysqli, $query));
    $total_pages = $total_pages['num'];

    $stages = 3;
    $page = 0;
    if (isset($_GET['page'])) {
        $page = mysqli_real_escape_string($mysqli, $_GET['page']);
    }
    if ($page) {
        $start = ($page - 1) * $limit;
    } else {
        $start = 0;
    }




 $joining_date=date("d-m-Y ");
 //print_r(formatTimeToDate2($date));exit;

 $admin_user_id=$_SESSION['admin_refer_code'];
   
 date_default_timezone_set("Asia/Calcutta");

if (isset($_POST['user_search'])) {

    $user_qry = "SELECT * FROM USER_DETAILS WHERE USER_DETAILS.name like '%" . addslashes($_POST['search_value']) . "%' or USER_DETAILS.mobile like '%" . addslashes($_POST['search_value']) . "%' or USER_DETAILS.email like '%" . addslashes($_POST['search_value']) . "%' or USER_DETAILS.user_referal_code like '%" . addslashes($_POST['search_value']) . "%' ORDER BY USER_DETAILS.id DESC";

    $users_result = mysqli_query($mysqli, $user_qry);

}else
if (isset($_GET['get_active_users'])){
     $limit = 15;
      $start = 0;
       $startDate=strtotime(date('d-m-Y',strtotime("now")));
       $endDate= strtotime(date('d-m-Y',strtotime("+1 days")));
      $joining_date='BETWEEN '.$startDate. ' AND ' .$endDate;
    if($_SESSION['id'] > 1){
   
        /*print_r()*/
        $users_qry = "SELECT * FROM USER_DETAILS where reffered_by LIKE '$admin_user_id%'and `active_date` LIKE BETWEEN $startDate AND $endDate ORDER BY USER_DETAILS.id DESC ";
      //  print_r($users_qry);exit;
        $users_result = mysqli_query($mysqli, $users_qry);    
    }else{
        $users_qry = "SELECT * FROM USER_DETAILS WHERE `active_date`  BETWEEN $startDate AND $endDate ORDER BY  USER_DETAILS.id DESC";
        $users_result = mysqli_query($mysqli, $users_qry);
       // print_r($users_qry);exit;
    }
}

else if(isset($_GET['get_today_registration'])) {
    $limit = 15;
      $start = 0;
       $joining_date=formatTimeToDate2($date);
      $startDate=strtotime(date('d-m-Y',strtotime("now")));
       $endDate= strtotime(date('d-m-Y',strtotime("+1 days")));
         $joining_date='BETWEEN '.$startDate. ' AND ' .$endDate;
    
 date_default_timezone_set("Asia/Calcutta");
    if($_SESSION['id'] > 1){
   $joining_time=$joining_date;
   //(strpos($reffered_by,'DBAB') !== false) 
        /*print_r()*/
        $users_qry = "SELECT * FROM USER_DETAILS where reffered_by LIKE '$admin_user_id%'and `joining_time` LIKE '$joining_time'  ORDER BY USER_DETAILS.id DESC ";
       // print_r($users_qry);exit;
        $users_result = mysqli_query($mysqli, $users_qry);    
    }else{
        $users_qry = "SELECT * FROM USER_DETAILS WHERE `joining_time` BETWEEN $startDate AND $endDate ORDER BY  USER_DETAILS.id DESC ";
    /*  $users_qry =  "SELECT *  FROM USER_DETAILS WHERE `joining_time` $where ";*/
          //print_r($users_qry);exit;
        $users_result = mysqli_query($mysqli, $users_qry);
       // print_r($users_qry);exit;
    }
    
}
 else if(isset($_POST['status']))
   

    { //alert("hello");exit;
     
     $st1=$_POST['status'];
     // print_r($st1);exit;
     if($_SESSION['id'] > 1){
       
    
    $user_qry="SELECT * FROM `USER_DETAILS` WHERE `joining_paid` = '$st1' and `user_id` LIKE '$admin_user_id%'  ORDER BY USER_DETAILS.id DESC LIMIT $start, $limit";  
               
    $users_result=mysqli_query($mysqli,$user_qry);
    // $users_result = mysqli_query($mysqli, $users_qry);
   // print_r($users_result);exit;
   }else{
       
        $users_qry="SELECT * FROM `USER_DETAILS` WHERE `joining_paid` = '$st1'  ORDER BY USER_DETAILS.id DESC LIMIT $start, $limit";
       
      $users_result=mysqli_query($mysqli,$users_qry);
      // print_r($users_qry);exit;
   }
              
   }

else {

   
    

$admin_user_id=$_SESSION['admin_refer_code'];

if($_SESSION['id'] > 1){
        /*print_r()*/
        $users_qry = "SELECT * FROM USER_DETAILS where reffered_by LIKE '$admin_user_id%' ORDER BY USER_DETAILS.id DESC  LIMIT $start, $limit";
        $users_result = mysqli_query($mysqli, $users_qry);    
    }else{
        $users_qry = "SELECT * FROM USER_DETAILS ORDER BY USER_DETAILS.id DESC LIMIT $start, $limit ";
        $users_result = mysqli_query($mysqli, $users_qry);
    }

// print_r($users_qry);exit;
}
if (isset($_GET['user_id'])) {
    Delete('USER_DETAILS', 'mobile=' . $_GET['user_id'] . '');
    Delete('WALLET', 'mobile' . $_GET['user_id'] . '');
    Delete('tbl_users', 'id=' . $_GET['user_id'] . '');

    $_SESSION['msg'] = "12";
    header("Location:manage_users.php");
    exit;
}


if (isset($_POST['delete_rec'])) {

    $checkbox = $_POST['post_ids'];

    for ($i = 0; $i < count($checkbox); $i++) {

        $del_id = $checkbox[$i];

        Delete('tbl_users_redeem', 'user_id=' . $del_id . '');
        Delete('tbl_users_rewards_activity', 'user_id=' . $del_id . '');
        Delete('USER_DETAILS', 'mobile=' . $del_id . '');

    }

    $_SESSION['msg'] = "12";
    header("Location:manage_users.php");
    exit;
}

if (isset($_POST['idad'])) {

    $checkbox = $_POST['post_ids'];

    for ($i = 0; $i < count($checkbox); $i++) {

        $del_id = $checkbox[$i];



        print_r($del_id);exit;

        /*Delete('tbl_users_redeem', 'user_id=' . $del_id . '');
        Delete('tbl_users_rewards_activity', 'user_id=' . $del_id . '');
      
*/
    }
 //print_r($del_id);exit;
    $_SESSION['msg'] = "12";
    header("Location:manage_users.php");
    exit;
}


  
//Active and Deactive status
if (isset($_GET['status_deactive_id'])) {
    $data = array('allow' => '1');

    $edit_status = Update('USER_DETAILS', $data, "WHERE id = '" . $_GET['status_deactive_id'] . "'");

   
    header("Location:manage_users.php");
    exit;
}
if (isset($_GET['status_active_id'])) {
    $data = array('allow' => '2');

    $edit_status = Update('USER_DETAILS', $data, "WHERE id = '" . $_GET['status_active_id'] . "'");
    
    //print_($edit_status); exit;

  
    header("Location:manage_users.php");
    exit;
}


?>


<div class="row">
    <div class="col-xs-12">
        <div class="card mrg_bottom">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">Manage Users</div>
                    

                    <input type="button" name="SetTimer" value="Set Timer" idad="" class="btn btn-primary btn-xs edit_data"/>

                  <input type="button" name="SetWbtn" value="Disable Gen Code" idad="" class="btn btn-primary btn-xs add_data"/>
                    
                </div>
               

             <form method="POST" name="myform" action="">
                  <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-6">
                      <select name="status" id="status" class="select2" required>
                        <option value="">--Filter--</option>
                        <option value="1" <?php if(isset($_POST['status']) AND $_GET['status']=="1"){?>selected<?php }?>>PENDING USERS</option>
                        <option value="2" <?php if(isset($_POST['status']) AND $_GET['status']=="2"){?>selected<?php }?>>PAID USERS</option>
                        <option value="3" <?php if(isset($_POST['status']) AND $_GET['status']=="3"){?>selected<?php }?>>UNDER VERIFICATION USERS</option>
                          
                      </select>
                    </div>
                  </div>
                  </form>         

                
                <div class="col-md-7 col-xs-12">
                    <div class="search_list">
                        <div class="search_block">
                            <form method="post" action="">
                                <input class="form-control input-sm" placeholder="Search..."
                                       aria-controls="DataTables_Table_0" type="search" name="search_value" required>
                                <button type="submit" name="user_search" class="btn-search"><i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="add_btn_primary"><a href="add_user.php?add">Add User</a></div>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row mrg-top">
                <div class="col-md-12">

                    <div class="col-md-12 col-sm-12">
                        <?php if (isset($_SESSION['msg'])) { ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                <?php echo $client_lang[$_SESSION['msg']]; ?></a> </div>
                            <?php unset($_SESSION['msg']);
                        } ?>
                    </div>
                </div>
            </div>
            
            
            
            <div class="col-md-12 mrg-top manage_user_btn">
                <form method="post" action="">
                    <button type="submit" class="btn btn-primary btn-xs " style="margin-bottom:20px;" name="delete_rec"
                            value="delete_post"
                            onclick="return confirm('Are you sure you want to delete this items?');">Delete
                    </button>

                   <!--   <button type="submit" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary btn-xs " style="margin-bottom:20px;" >Add Codes
                    </button>
 -->
                   <!--  <button type="submit" class="btn btn-primary btn-xs " style="margin-bottom:20px;" name="Addbal"
                            value="delete_post" idad="<?php echo $_GET['user_id']; ?>"
                            onclick="return confirm('Are you sure you want to Update this items?');">Add Balance
                    </button> -->

                     <!-- <input type="button" name="delete_post" value="Delete" idad="<?php echo $_GET['user_id']; ?>" class="btn btn-primary btn-xs edit_data"/> -->

                  <!--    <input type="button" name="Addcodes" value="Add Codes" idad="<?php echo $_GET['user_id']; ?>" class="btn btn-primary btn-xs edit_data"/>

       <input type="button" name="Addbal" value="Add Balance" idad="<?php echo $_GET['user_id']; ?>" class="btn btn-primary btn-xs add_data"/>  -->

                     <!-- <table id="customer_data" class="table table-bordered table-striped">-->
                    <table  id="customer_data" table class="table table-bordered table-striped">
                        <thead>
                        <tr >
                            <th style="width:5px">
                                <div class="checkbox">
                                    <input type="checkbox" name="checkall" id="checkall" value="<?php echo $users_row['mobile']; ?>">
                                    <label for="checkall"></label>
                                </div>
                                All
                            </th>
                            <th >count</th>
                            <th  >Name </th>
                            <!--<th>Email</th>-->
                            <th>Phone</th>
                            <th>Wallet</th>
                            <th>Referal_code</th>
                            <th>Reffered_By</th>
                            <th>Allow</th>
                            <th>Action</th>
                            
                             <!--<th style="width:50px">count</th>
                            <th style="width:110px">Name</th>
                            <th style="width:100px">Email</th>
                            <th style="width:100px">Phone</th>
                            <th style="width:30px">wallet</th>
                            <th style="width:30px">referal_code</th>
                            <th style="width:30px">Allow</th>
                            <th style="width:200px">Action</th>-->
                            
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        $count=1;
                        while ($users_row = mysqli_fetch_array($users_result)) {
                            $qry_refer = "SELECT COUNT(*) as num FROM tbl_users WHERE refer_code='" . $users_row['user_code'] . "'";
                            $total_refer = mysqli_fetch_array(mysqli_query($mysqli, $qry_refer));

                            ?>


                            <tr>
                                <td>

                                    <div>
                                        <div class="checkbox">
                                            <input type="checkbox" name="post_ids[]" id="checkbox<?php echo $i; ?>"
                                                   value="<?php echo $users_row['mobile']; ?>">
                                            <label for="checkbox<?php echo $i; ?>">
                                            </label>
                                        </div>

                                    </div>
                                </td>
                                 <td><?php echo $count; ?></td>
                                <!-- <td><?php echo $users_row['name'];  ?></td> -->

                                  <td><br> Name  </br><p><?php echo $users_row['name']; ?></p>,
                                    <br> Joining Date </br><p><?php echo formatTimeToDate($users_row['joining_time']);?></p>


                                  <?php 
                                    if($users_row['joining_paid']=="2"){?>

                                      <p span class="badge badge-warning badge-icon"> Paid Member </p>  

                                   <?php }?>
                                 
               
                                </td>

                              <td><br>  Reg. Number </br><p><?php echo $users_row['mobile']; ?></p>,
                                    <br> Reg. Email  </br><p><?php echo $users_row['email'];?></p></td>

                                <td><br> Wallet Balance </br><p><?php echo $users_row['wallet']; ?></p>,
                                    <br> Total Qr Generated </br><p><?php echo $users_row['total_all_qr_generation'];?></p>
               
                                </td>
                              <!--   <td><?php echo $users_row['user_referal_code']; ?></td> -->

                                  <td><br>  Refer Code </br><p><?php echo $users_row['user_referal_code']; ?></p>,
                                     <br> Total Refer </br><p><?php echo $users_row['total_referals'];?></p>,
               
                                    <br> Reg. Device ID  </br><p><?php echo $users_row['device_id'];?></p></td>

                                 <td>
                                   <br>Reffered By </br>
                                   <p> <?php echo $users_row['reffered_by']; ?></p>,

                                    <br> History Days </br>
                                   
                                    <p><?php echo $users_row['total_qr_generation']; ?> </p>,

                                     <br>Timer </br>
                                   
                                    <p><?php echo $users_row['codegenTimer']; ?> </p>
                                     
                                 </td>
                               
                                <td><br> User Status </br>
                                    <?php if ($users_row['allow'] != "1") { ?>
                                        <a href="manage_users.php?status_deactive_id=<?php echo $users_row['id']; ?>"
                                           title="Change Status"><span class="badge badge-danger badge-icon"><i
                                                        class="fa fa-check"
                                                        aria-hidden="true"></i><span>Disabled</span></span></a>

                                    <?php } else { ?>
                                        <a href="manage_users.php?status_active_id=<?php echo $users_row['id']; ?>"
                                           title="Change Status"><span class="badge badge-success badge-icon"><i
                                                        class="fa fa-check" aria-hidden="true"></i><span>Enabled </span></span></a>
                                    <?php } ?>

                                          <br> </br>
                                    <br> Gen.Allowed </br>

                                     <?php if ($users_row['code_gen_allow'] != "0") { ?>
                                        <a href="#"
                                           title="Change Status"><span class="badge badge-danger badge-icon"><i
                                                        class="fa fa-check"
                                                        aria-hidden="true"></i><span>Disabled</span></span></a>

                                    <?php } else { ?>
                                        <a href="#"
                                           title="Change Status"><span class="badge badge-success badge-icon"><i
                                                        class="fa fa-check" aria-hidden="true"></i><span>Enabled </span></span></a>
                                    <?php } ?>

                                </td>
                               <td>

                                    <a style="pointer-events: <?=$class1?>" href="manage_user_history.php?user_id=<?php echo $users_row['mobile']; ?>"
                                       class="btn btn-success"  style=" margin-bottom: 5px; width: 50px" data-toggle="tooltip" data-tooltip="History"><i class="fa fa-history"></i></a>
                                    
                                    <a style="pointer-events: <?=$class2?>" href="add_user.php?user_id=<?php echo $users_row['mobile']; ?>"
                                       class="btn btn-primary" style=" margin-bottom: 5px; width: 50px" data-toggle="tooltip" data-tooltip="Edit"><i
                                                class="fa fa-edit"></i></a>
                                   
                                    <a style="pointer-events: <?=$class3?>" href="manage_users.php?user_id=<?php echo $users_row['mobile']; ?>"
                                       onclick="return confirm('Are you sure you want to delete this user?');"
                                       class="btn btn-default" style=" margin-bottom: 5px; width: 50px" data-toggle="tooltip" data-tooltip="Delete"><i
                                                class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php

                            $i++;
                            $count++;
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
}table.table > tbody > tr td, table.table > tbody > tr th, table.table > thead > tr td {
    font-size: 14px;
    padding: 8px 9px;
    vertical-align: middle;

}
.btn-success {
    /* color: #fff; */
    /* background-color: #5cb85c; */
    /* border-color: #4cae4c; */
    color: #333 !important;
    background-color: #fff!important;
    border-color: #ccc!important;
}.bordered.dataTable tbody td {
    border-bottom-width: 0;
    isplay: inline-block;
    word-break: break-word;
}.table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 0;
    word-break: break-word;
}
</style>

<?php include('includes/footer.php'); ?>

<!-- The Modal -->
  <div class="modal" id="disableGen_Modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
         <h4 class="modal-title" id="modal-title">Disable Generate Btn After</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
         <div class="modal-body">  
                     <form method="post" id="insert_formm"> 
                          
                          <div class="row">
                              

                              <div class="col-md-12">
                                    <label>Execute When Days Is Greater Than</label>  
                                    <input type="text" name="disableAfter" id="disableAfter" class="form-control" />  
                                    <br />
                              </div>


                            
                             
                          </div>
                          
                           <input type="hidden" name="disableGen" id="disableGen" />  
                           <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />  
                     </form>  
                </div>  
           </div>  
      </div>  
 </div>  
 <!-- Modal footer -->


<!-- The Modal -->
  <div class="modal" id="setCode_Modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
         <h4 class="modal-title" id="modal-title">Set Code Loading Time</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
         <div class="modal-body">  
                     <form method="post" id="insert_form"> 
                          
                          <div class="row">
                             

                              <div class="col-md-12">
                                    <label>Execute When Days Is Greater Than</label>  
                                    <input type="Number" name="addays" id="addays" class="form-control" />  
                                    <br />
                              </div>
                            
                            <div class="col-md-12">
                                    <label>Timer Seconds For Loading</label>  
                                    <input type="Number" name="addtimer" id="addtimer" class="form-control" />  
                                    <br />
                              </div>
                             
                          </div>
                          
                           <input type="hidden" name="idSetCode" id="idSetCode" />  
                           <input type="submit" name="inserttSetCode" id="inserttSetCode" value="Update" class="btn btn-success" />  
                     </form>  
                </div>  
           </div>  
      </div>  
 </div>  
 <!-- Modal footer -->

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
                /*url:"fetch.php",  
                method:"POST",  
                data:{idad:idad},  
                dataType:"json",*/
                //dataType:"text",
               
                success:function(data){  
                  //alert(data);
                      
                      //$('#adminPassword').val(data.password);
                      //$('#idad').val(data.id);
                      $('#setCode_Modal').modal('show');  
                }  
           });  
      });  
      
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#addtimer').val() == '')  
           {  
                alert("Timer Loading Sec  is required");  
           }   
           else if($('#addays').val() == '')  
           {  
                alert("No of Days  is required");  
           }
           else{ 
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
                         success:function(data)
                         {  
                       
                     // alert(data.msg+"st"+data);
                     // alert("st"+data);
                      if(data.status=='200'){
                       toastr.success(data.msg); 
                             $('#insert_form')[0].reset();  
                              $('#setCode_Modal').modal('hide');  
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
               /* url:"fetch.php",  
                method:"POST",  
                data:{idad:idad},  
                dataType:"json",*/
                //dataType:"text",
               
                success:function(data){  
                 // alert(data);
                    /*  $('#userrName').val(data.name); 
                      $('#userrMobile').val(data.mobile);
                      $('#userUserid').val(data.user_referal_code);
                      //$('#adminPassword').val(data.password);
                      //$('#idad').val(data.id);*/
                      $('#disableGen_Modal').modal('show');  
                }  
           });  
      });  
      
      $('#insert_formm').on("submit", function(event){  
           event.preventDefault();  
           if($('#disableAfter').val() == "")  
           {  
                alert("No of Days  is required");  
           }  
            
           else  
           {  
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
                             $('#insert_formm')[0].reset();  
                              $('#disableGen_Modal').modal('hide');  
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


