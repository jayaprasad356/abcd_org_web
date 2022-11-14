<?php include("includes/connection.php");
      include("includes/session_check.php");
      
      //Get file name
      $currentFile = $_SERVER["SCRIPT_NAME"];
      $parts = Explode('/', $currentFile);
      $currentFile = $parts[count($parts) - 1];       
       
      
?>
<!DOCTYPE html>
<html>
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type"content="text/html;charset=UTF-8"/>
<meta name="viewport"content="width=device-width, initial-scale=1.0">
<title><?php echo 'ADMIN Data Device APP';?></title>
<link rel="stylesheet" type="text/css" href="assets/css/vendor.css">
<link rel="stylesheet" type="text/css" href="assets/css/all.css">
<link rel="stylesheet" type="text/css" href="assets/css/flat-admin.css">

<!-- Theme -->
<link rel="stylesheet" type="text/css" href="assets/css/theme/blue-sky.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme/blue.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme/red.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme/yellow.css">


 <script src="assets/ckeditor/ckeditor.js"></script>

</head>
<body>
<div class="app app-default">
  <aside class="app-sidebar" id="sidebar">
    <div class="sidebar-header"> <a class="sidebar-brand" href="home.php"><img src="./assets/images/applogo" alt="app logo" /></a>
      <button type="button" class="sidebar-toggle"> <i class="fa fa-times"></i> </button>
    </div>
    <div class="sidebar-menu">
      <ul class="sidebar-nav">
        <li <?php if($currentFile=="home.php"){?>class="active"<?php }?>> <a href="home.php">
          <div class="icon icon-v5">  <i class="fas fa-tachometer-alt"></i> </div>
          <div class="title">Dashboard</div>
          </a> 
        </li>
        <li <?php if($currentFile=="manage_users.php" or $currentFile=="add_user.php"){?>class="active"<?php }?>> <a href="manage_users.php">
          <div class="icon"> <i class="fa fa-users" aria-hidden="true"></i> </div>
          <div class="title">Users List</div>
          </a> 
        </li>
        <li <?php if($currentFile=="manage_withdraw_request.php"){?>class="active"<?php }?>> <a href="manage_withdraw_request.php">
          <div class="icon"> <i class="fa fa-list" aria-hidden="true"></i> </div>
          <div class="title">Withdraw Request</div>
          </a> 
        </li>
        
         <li <?php if($currentFile=="payment_verification.php"){?>class="active"<?php }?>> <a href="payment_verification.php">
          <div class="icon"> <i class="fa fa-list" aria-hidden="true"></i> </div>
          <div class="title">Payment Verification</div>
          </a> 
        </li>
        
        <li <?php if($currentFile=="manage_support.php"){?>class="active"<?php }?>> <a href="manage_support.php">
          <div class="icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
          <div class="title">Support Ticket</div>
          </a> 
        </li>

        <li <?php if($currentFile=="rewards_points.php"){?>class="active"<?php }?>> <a href="rewards_points.php">
          <div class="icon"> <i class="fa fa-dollar" aria-hidden="true"></i> </div>
          <div class="title">Rewards Points</div>
          </a> 
        </li>
        
        
        <li <?php if($currentFile=="total_transaction.php"){?>class="active"<?php }?>> <a href="total_transaction.php">
          <div class="icon"> <i class="fa fa-dollar" aria-hidden="true"></i> </div>
          <div class="title">Total Transaction</div>
          </a> 
        </li>
        
         <?php
                  if($_SESSION['id'] == 1)
                  {
                      ?>
                        
                         <li <?php if($currentFile=="excel_text_list.php"){?>class="active"<?php }?>> <a href="excel_text_list.php">
          <div class="icon"> <i class="fa fa-dollar" aria-hidden="true"></i> </div>
          <div class="title">Uload text excel</div>
          </a> 
        </li>
         <!-- <li <?php if($currentFile=="spin_setting.php"){?>class="active"<?php }?>> <a href="spin_setting.php">
                  <div class="icon"> <i class="fa fa-spinner" aria-hidden="true"></i> </div>
                  <div class="title">Spin Setting</div>
              </a>
          </li>-->
        <li <?php if($currentFile=="settings.php"){?>class="active"<?php }?>> <a href="settings.php">
          <div class="icon"> <i class="fa fa-cog" aria-hidden="true"></i> </div>
          <div class="title">App Settings</div>
          </a>
        </li>
                        
                      <?php
                  }
                  ?>
        
       

         <li <?php if($currentFile=="logout.php"){?>class="active"<?php }?>> <a href="logout.php">
          <div class="icon icon-v5"><i class="fas fa-sign-out-alt"></i> </div>

          <div class="title">Logout</div>
          </a> 
        </li>  
      </ul>
    </div>
     
  </aside>   
  <div class="app-container">
    <nav class="navbar navbar-default" id="navbar">
      <div class="container-fluid">
        <div class="navbar-collapse collapse in">
          <ul class="nav navbar-nav navbar-mobile">
            <li>
              <button type="button" class="sidebar-toggle"> <i class="fa fa-bars"></i> </button>
            </li>
            <li class="logo"> <a class="navbar-brand" href="#"><?php echo APP_NAME;?></a> </li>
            <li>
              <button type="button" class="navbar-toggle">
                <?php if(PROFILE_IMG){?>               
                  <img class="profile-img" src="assets/images/profile.png">
                <?php }else{?>
                  <img class="profile-img" src="assets/images/profile.png">
                <?php }?>
                  
              </button>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-left">
            <li class="navbar-title"><?php echo APP_NAME;?></li>
             
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown profile"> <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown"> <?php if(PROFILE_IMG){?>               
                  <img class="profile-img" src="images/<?php echo PROFILE_IMG;?>">
                <?php }else{?>
                  <img class="profile-img" src="./assets/images/profile">
                <?php }?>
              <div class="title">Profile</div>
              </a>
              <div class="dropdown-menu">
                <div class="profile-info">
                  <h4 class="username">Super Admin</h4>
                </div>
                <ul class="action">
                  <li><a href="profile.php">Profile</a></li>
                  <?php
                  if($_SESSION['id'] == 1)
                  {
                      ?>
                        <li><a href="admins-list.php">Admins</a></li>  
                      <?php
                  }
                  ?>
                  <li><a href="logout.php">Logout</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>