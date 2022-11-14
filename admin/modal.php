<?php
	include("includes/connection.php");
  
    include("includes/function.php");
	include("language/language.php"); 


	 
	 
		$tableName="CONTACT_US";		
		$targetpage = "manage_support.php";
		$limit = 15; 
		
		$query = "SELECT COUNT(*) as num FROM CONTACT_US";
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
		
		
	 $users_qry="SELECT * FROM CONTACT_US
	 ORDER BY CONTACT_US.id DESC LIMIT $start, $limit";  
		 
		$users_result=mysqli_query($mysqli,$users_qry);
							
	 
	if(isset($_GET['id']))
	{
		  
		 
		Delete('CONTACT_US','id='.$_GET['id'].'');
		
		$_SESSION['msg']="12";
		header( "Location:manage_support.php");
		exit;
	}
	
 if(isset($_POST['delete_rec']))
  {

    $checkbox = $_POST['post_ids'];
    
    for($i=0;$i<count($checkbox);$i++){
      
      $del_id = $checkbox[$i]; 
     
      Delete('CONTACT_US','id='.$del_id.'');
 
    }

    $_SESSION['msg']="12";
    header( "Location:manage_support.php");
    exit;
  }
  if(isset($_POST['upload_excel'])){
      
      $file = $_FILES['f_name']['tmp_name'];
          $handle = fopen($file, "r");
          fgetcsv($handle);
          $c = 0;
          while(($filesop = fgetcsv( $handle)))
                    {
            
          $sn = $filesop[0];
          $id_num = $filesop[1];
          $city = $filesop[3];
          $pin = $filesop[2];
          $sql = "INSERT INTO `excel_text` (`id`, `student_name`, `id_number`, `ecity`, `pin_code`) VALUES (NULL, '$sn', '$id_num', '$city', '$pin')";
          $stmt = mysqli_prepare($mysqli,$sql);
          mysqli_stmt_execute($stmt);

         $c = $c + 1;
           }

            if($sql){
               header( "Location:excel_text_list.php");
                exit;
             } 
		 else
		 {
            header( "Location:excel_text_list.php");
                exit;
          }
  }
	if(isset($_POST['del_excel'])){
		$sql = "TRUNCATE TABLE  `excel_text` ";
          $stmt = mysqli_prepare($mysqli,$sql);
          mysqli_stmt_execute($stmt);
           

            if($sql){
               header( "Location:excel_text_list.php");
                exit;
             } 
		 else
		 {
            header( "Location:excel_text_list.php");
                exit;
          }
  }
	
	
?>