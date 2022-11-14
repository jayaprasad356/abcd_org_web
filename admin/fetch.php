

 <?php include("includes/connection.php");
      include("includes/session_check.php");  
 if(isset($_POST["username"]))  
 {  /*print_r(username);exit;*/
      $query = "SELECT * FROM ADMIN_ROLE WHERE admin_user_id = '".$_POST["username"]."'";  
      $result = mysqli_query($mysqli, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 
 if(isset($_POST["id"]))  
 { 
      $query = "SELECT * FROM ADMIN_ROLE WHERE id = '".$_POST["id"]."'";  
      $result = mysqli_query($mysqli, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
      //print_r($row);exit;
 }
 if(isset($_POST["idad"]))  
 { 
      $query = "SELECT * FROM USER_DETAILS WHERE `mobile` = '".$_POST["idad"]."'";  
      $result = mysqli_query($mysqli, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
     // print_r($query);exit;
 } if(isset($_POST["aid"]))  
 { 
      //print_r($_POST);exit;
      $query = "SELECT * FROM ADMIN_ROLE WHERE id = '".$_POST["aid"]."'";  
      $result = mysqli_query($mysqli, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
     // print_r($query);exit;
 }
 
 ?>
 
 