<?php  include("includes/header.php");
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
	
	
?>


 <div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Contact List</div>
            </div>
             
          </div>
          <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
               	 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                	<?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?>	
              </div>
            </div>
          </div>
          <div class="col-md-12 mrg-top manage_comment_btn">

          	<form method="post" action="">
          	<button type="submit" class="btn btn-primary" style="margin-bottom:20px;" name="delete_rec" value="delete_post" onclick="return confirm('Are you sure you want to delete this items?');">Delete</button>	

            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th style="width:40px">
                  	<div class="checkbox">
				    <input type="checkbox" name="checkall" id="checkall" value="">
				    <label for="checkall"></label>
				    </div>					
					All
				  </th>	
  				  <th style="width:150px">name</th>
 				  <th style="width:170px">email</th>
 				   <th style="width:100px">Phone No.</th>
				  <th>support_message</th>
                   <th class="cat_action_list" style="width:60px">Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php
						$i=0;
						while($users_row=mysqli_fetch_array($users_result))
						{
						 
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
  		           <td><?php echo $users_row['contact_name'];?></td>
  		           <td><?php echo $users_row['contact_email'];?></td>
  		            <td><?php echo $users_row['reg_mobile'];?></td>
     		       <td><?php echo $users_row['contact_msg'];?></td>
                    <td> 
                    <a href="manage_support.php?id=<?php echo $users_row['id'];?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-default" data-toggle="tooltip" data-tooltip="Delete"><i class="fa fa-trash"></i></a></td>
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
              	<?php include("pagination.php");?>                 
              </nav>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>     



<?php include('includes/footer.php');?>          