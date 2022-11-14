<?php include('includes/header.php'); 

    include('includes/function.php');
  include('language/language.php');

  session_start();

  //include_once "admin/php/config.php";

  if(!isset($_GET['user_id'])){
    header("location: login.php");
  }else{
   $_SESSION['unique_id'] = $_GET['user_id'];
    $_SESSION['ticket_id'] = $_GET['ticket_id'];
  }  

//print_r($_SESSION['unique_id']);exit;


  $admin_user_id=$_SESSION['admin_refer_code'];
  
?>


<div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
           
<!-- ----------------------------------------------------------------------------------------------  -->      

 <header>
               <a href="chat.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $_SESSION['name']. " " ?></span>

            <p>User Mobile Number <?php echo $_SESSION['unique_id']. " " . $_SESSION['tickett_id'] ?></p>

          <p>Ticket ID<?php echo $_SESSION['ticket_id']; ?></p>
        </div>
      </header> 
     

     <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>

      
<!-- ------------------------------------------------------------------------------------------------ -->
</div>
    </div>     
  </div>


<?php include('includes/footer.php');?>          

<script src="../javascript/chat.js"></script>
<link rel="stylesheet" href="style.css">