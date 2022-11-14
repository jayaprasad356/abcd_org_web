<?php include("includes/connection.php");
	 

	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

	  
	if($username=="")
	{
		 $_SESSION['msg']="1"; 
		 header( "Location:index.php");
		 exit;
		 
	}
	else if($password=="")
	{
		$_SESSION['msg']="2"; 
		header( "Location:index.php");
		exit;		 
	}	 
	else
	{
		$qry="select * from ADMIN_ROLE where admin_email='$username' and admin_password='$password'";
		 
		$result=mysqli_query($mysqli,$qry);		
		
		if(mysqli_num_rows($result) > 0)
		{ 
			$row=mysqli_fetch_assoc($result);
            /*print_r($row);exit;*/
			$_SESSION['id']=$row['id'];
		    $_SESSION['admin_name']=$row['admin_user_id'];
		     $_SESSION['admin_refer_code']=$row['admin_refer_code'];
			  
			header( "Location:home.php");
			exit;
				
		}
		else
		{
			$_SESSION['msg']="4"; 
			header( "Location:index.php");
			exit;
			 
		}
	}
	
	
	


?> 