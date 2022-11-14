    <?php include('includes/header.php');


    if (isset($_POST['user_search'])) {

        $user_qry = "SELECT * FROM ADMIN_ROLE WHERE ADMIN_ROLE.admin_name like '%" . addslashes($_POST['search_value']) . "%' or ADMIN_ROLE.admin_email like '%" . addslashes($_POST['search_value']) . "%' ORDER BY ADMIN_ROLE.id DESC";

        $users_result = mysqli_query($mysqli, $user_qry);

    } else {

        $tableName = "ADMIN_ROLE";
        $targetpage = "admins-list.php";
        $limit = 15;

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


        $users_qry = "SELECT * FROM ADMIN_ROLE
                 ORDER BY ADMIN_ROLE.id  LIMIT $start, $limit";

        $users_result = mysqli_query($mysqli, $users_qry);

    }
 
    


    if (isset($_POST['delete_rec'])) {

        $checkbox = $_POST['post_ids'];

        for ($i = 0; $i < count($checkbox); $i++) {

            $del_id = $checkbox[$i];

            Delete('tbl_users_redeem', 'user_id=' . $del_id . '');
            Delete('tbl_users_rewards_activity', 'user_id=' . $del_id . '');
            Delete('tbl_users', 'id=' . $del_id . '');

        }

        $_SESSION['msg'] = "12";
        header("Location:admins-list.php");
        exit;
    }

    //Active and Deactive status
  
    if (isset($_GET['status_deactive_id'])) {
    $data = array('admin_status' => '1');


    $edit_status = Update('ADMIN_ROLE', $data, "WHERE id = '" . $_GET['status_deactive_id'] . "'");
   
   print_r($edit_status);exit;
   
    header("Location:admins-list.php");
    exit;
}
if (isset($_GET['status_active_id'])) {
    $data = array('admin_status' => '2');
   //  print_r($_GET['status_active_id']); exit;

    $edit_status = Update('ADMIN_ROLE', $data, "WHERE id = '" . $_GET['status_active_id'] . "'");

    
    print_r($edit_status); exit;

  
    header("Location:admins-list.php");
    exit;
}


    if (isset($_GET['admin_id'])) {
        // print_r($_GET);exit;
     $sql = "DELETE FROM `ADMIN_ROLE` WHERE `ADMIN_ROLE`.`admin_user_id` = '" . $_GET['admin_id'] . "' ";

    if(mysqli_query($mysqli, $sql)) {
        //print_r( $sql );exit;

    $_SESSION['msg'] = "12";
    header("Location:admins-list.php");
    exit;
    }
  
 
      }

    ?>


        <div class="row">
            <div class="col-xs-12">
                <div class="card mrg_bottom">
                    <div class="page_title_block">
                        <div class="col-md-5 col-xs-12">
                            <div class="page_title">Manage Admins</div>
                        </div>
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
                                <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary">Add Admin</button> 
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

                            <table id="adminsList" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width:80px">#</th>
                                    <th style="width:120px">Name</th>
                                    <th style="width:120px">Email</th>
                                    <th style="width:100px">Phone</th>
                                    <th style="width:30px">Username</th>
                                    <th style="width:30px">Password</th>
                                    <th style="width:30px">Allow</th>
                                    <th style="width:220px">Action</th>
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
                                         <td><?php echo $count; ?></td>
                                        <td><?php echo $users_row['admin_name']; ?></td>
                                        <td><?php echo $users_row['admin_email']; ?></td>
                                        <td><?php echo $users_row['admin_mobile']; ?></td>
                                        <td><?php echo $users_row['admin_user_id']; ?></td>
                                        <td><?php echo $users_row['admin_password']; ?></td>
                                        <td>
                                            <?php if ($users_row['admin_status'] != "1") { ?>
                                            <a href=" admins-list.php?status_deactive_id=<?php echo $users_row['id']; ?>"
                                            title="Change Status"><span class="badge badge-danger badge-icon"><i
                                            class="fa fa-check"
                                            aria-hidden="true"></i><span>Disabled</span></span></a>

                                            <?php } else { ?>
                                                <a href="admins-list.php?status_active_id=<?php echo $users_row['id']; ?>"
                                                   title="Change Status"><span class="badge badge-success badge-icon"><i
                                                                class="fa fa-check" aria-hidden="true"></i><span>Enabled </span></span></a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <input type="button" name="edit" value="Edit" id="<?php echo $users_row['id']; ?>" class="btn btn-primary btn-xs edit_data"/>

                       <?php if($users_row['id'] != "1"){
                          $class1="";
                         }else{ 
                          $class1="none";
                         }  
                         
                         ?>                   
                                            
                        <a  style="pointer-events: <?=$class1?>" href="admins-list.php?admin_id=<?php echo $users_row['admin_user_id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this user?');"
                       class="btn btn-default" data-toggle="tooltip" data-tooltip="Delete"><i
                                class="fa fa-trash"></i></a>
                                </td>
                                        
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

       <!-- The Modal -->
      <div class="modal" id="add_data_Modal">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
             <h4 class="modal-title" id="modal-title">Add Admin</h4>
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
                <div class="col-md-6">
                    <label>Email</label>  
                    <input type="text" name="adminEmail" id="adminEmail" class="form-control" />  
                    <br />  
                </div>
                <div class="col-md-6">
                     <label>Phone</label>  
                     <input type="text" name="adminMobile" id="adminMobile" class="form-control" />  
                     <br />
                </div>
                <div class="col-md-6">
                      <label>Username</label>  
                      <input type="text" name="adminUserid" id="adminUserid" class="form-control" />  
                      <br />
                </div>

                <div class="col-md-6">
                      <label>Refer Code</label>  
                      <input type="text" name="adminRcode" id="adminRcode" class="form-control" />  
                      <br />
                </div>

                <div class="col-md-6">
                      <label>Password</label>  
                      <input type="text" name="adminPassword" id="adminPassword" class="form-control" />  
                      <br />
                </div>

                <div class="col-md-6">
                     <label>Status</label>  
                     <select name="status" id="status" class="form-control">  
                        <option style="color:green" value="1">ACTIVE</option>  
                        <option value="2">DEACTIVE</option>
                     </select>  
                     <br /> 
                </div>

                <div class="col-md-6">
                     <label>Manage App Settings</label>  
                     <select name="manageAppSetting" id="manageAppSetting" class="form-control"> 
                        <option style="color:#808080"  value="0">NO ACCESS</option>
                        <option style="color:#808000" value="1">VIEW ONLY</option>
                        <option style="color:green"  value="2">MANAGE CONTOROL</option>
                     </select>  
                     <br /> 
                </div>
           </div>

            <!--  <h4 class="modal-title" id="modal-title">Manage Access </h4> -->
<div>
  <h4 style="text-align:center;  margin-bottom:18px; color:#808080;">Manage Admin Access!</h4>
</div>
            
           <div class="row">


         <div class="col-md-12">
                     <label>Manage AdminList Access</label>  
                     <select name="adminDetailsA" id="adminDetailsA" class="form-control">  
                        <option style="color:#808080"  value="0">NO ACCESS</option>
                        <option style="color:#808000" value="1">VIEW ONLY</option>
                        <option style="color:green"  value="2">MANAGE CONTOROL</option>
                     </select>  
                     <br /> 
                </div>

                 <div class="col-md-6">
                     <label>Manage User Details Access</label>  
                     <select name="userDetailsA" id="userDetailsA" class="form-control">  
                        <option style="color:#808080"  value="0">NO ACCESS</option>
                        <option style="color:#808000" value="1">VIEW ONLY</option>
                        <option style="color:green"  value="2">MANAGE CONTOROL</option>
                     </select>  
                     <br /> 
                </div>

                  <div class="col-md-6">
                     <label>Manage Payment Verification Access</label>  
                     <select name="managePaymentV" id="managePaymentV" class="form-control"> <option style="color:#808080"  value="0">NO ACCESS</option>
                        <option style="color:#808000" value="1">VIEW ONLY</option>
                        <option style="color:green"  value="2">MANAGE CONTOROL</option>
                     </select>  
                     <br /> 
                </div>

                 <div class="col-md-6">
                     <label>Manage Support Access</label>  
                     <select name="manageSupportList" id="manageSupportList" class="form-control">  
                       <option style="color:#808080"  value="0">NO ACCESS</option>
                        <option style="color:#808000" value="1">VIEW ONLY</option>
                        <option style="color:green"  value="2">MANAGE CONTOROL</option>
                     </select>  
                     <br /> 
                </div>
                 <div class="col-md-6">
                     <label>Manage Reward Access</label>  
                    
                     <select name="manageRewardP" id="manageRewardP" class="form-control">  
                       <option style="color:#808080"  value="0">NO ACCESS</option>
                        <option style="color:#808000" value="1">VIEW ONLY</option>
                        <option style="color:green"  value="2">MANAGE CONTOROL</option>
                     </select>  
                     <br /> 
                </div>

              

                <div class="col-md-6">
                     <label>Manage Withdrawal Access</label>  
                     <select name="withdrawalMa" id="withdrawalMa" class="form-control">  
                       <option style="color:#808080"  value="0">NO ACCESS</option>
                        <option style="color:#808000" value="1">VIEW ONLY</option>
                        <option style="color:green"  value="2">MANAGE CONTOROL</option>
                     </select>  
                     <br /> 
                </div>

            

              

                   <div class="col-md-6">
                     <label>Manage total Transaction</label>  
                     <select name="mtc" id="mtc" class="form-control">  
                      <option style="color:#808080"  value="0">NO ACCESS</option>
                        <option style="color:#808000" value="1">VIEW ONLY</option>
                        <option style="color:green"  value="2">MANAGE CONTOROL</option>
                     </select>  
                     <br /> 
                </div>

                   <div class="col-md-6">
                     <label>Manage Upload Text</label>  
                     <select name="manageUploadT" id="manageUploadT" class="form-control">
                        <option style="color:#808080"  value="0">NO ACCESS</option>
                        <option style="color:#808000" value="1">VIEW ONLY</option>
                        <option style="color:green"  value="2">MANAGE CONTOROL</option>
                       
                     </select>  
                     <br /> 
                </div>

                <div class="col-md-6">
                     <label>Manage Send Notification</label>  
                     <select name="msn" id="msn" class="form-control"> 
                         <option style="color:#808080"  value="0">NO ACCESS</option>
                        <option style="color:#808000" value="1">VIEW ONLY</option>
                        <option style="color:green"  value="2">MANAGE CONTOROL</option>
                     </select>  
                     <br /> 
                </div>
               


            </div>
            
       <!--   <input type="hidden" name="id" id="id" />  --> 

        <input type="label" hidden="" name="id" id="id" value="new" style="width: 100%;"/> 

         <input type="submit" name="insert" id="insert" value="Update" class="btn btn-primary" />  


          </form>  
         </div>  
         </div>  
         </div>  
     </div>  
     <!-- Modal footer -->

    <?php include('includes/footer.php'); ?>


     <script>  
     $(document).ready(function(){  
          $('#add').click(function(){  
               $('#insert').val("Insert");  
               $('#insert_form')[0].reset();  
          });  
          $(document).on('click', '.edit_data', function(){  
               var id = $(this).attr("id");  
               $.ajax({  
                    url:"fetch.php",  
                    method:"POST",  
                    data:{aid:id},  
                    dataType:"json",
                    //dataType:"text",
                   
                    success:function(data){ 
                   // alert(data); 
                          $('#adminName').val(data.admin_name); 
                          $('#adminEmail').val(data.admin_email); 
                          $('#adminMobile').val(data.admin_mobile);
                          $('#adminUserid').val(data.admin_user_id);
                           $('#adminRcode').val(data.admin_refer_code);
                          $('#adminPassword').val(data.admin_password);
                          $('#id').val(data.id);
                          $('#status').val(data.admin_status);
                           $('#adminDetailsA').val(data.manageAdminList);
                          
                          $('#userDetailsA').val(data.manageUserList); 
                          $('#managePaymentV').val(data.managePaymentV); 
                          $('#manageSupportList').val(data.manageSupportList);
                          $('#withdrawalMa').val(data.manageWithdrawal);
                          $('#mtc').val(data.manageTotalTransaction);
                           $('#manageUploadT').val(data.manageUploadT); 
                          $('#msn').val(data.manageNotification); 
                         $('#manageAppSetting').val(data.manageAppSettings);
                         $('#manageRewardP').val(data.manageRewardP);  
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
               else if($('#adminEmail').val() == '')  
               {  
                    alert("Email is required");  
               }  
               else if($('#adminMobile').val() == '')  
               {  
                    alert("Phone is required");  
               }   else if($('#adminUsername').val() == '')  
               {  
                    alert("Username is required");  
               }  
               else if($('#adminPassword').val() == '')  
               {  
                    alert("Password is required");  
               }  else if($('#adminRcode').val() == '')  
               {  
                    alert("Admin Refer Code is required");  
               } 
               else  
               {  
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
                       
                     // alert(data.msg+"st"+data);
                     // alert("st"+data);
                      if(data.status=='200'){
                       toastr.success(data.msg); 
                             $('#insert_form')[0].reset();  
                              $('#add_data_Modal').modal('hide');  
                              $('#adminsList').html(data);  
                   setTimeout(function(){ 
                      window.location.replace('admins-list.php');
                    }, 1000);
                           }else{
                            toastr.error(data.msg);
                          }
                     } 
                    });  
               }  
          });  
         
     });  
     </script>
     