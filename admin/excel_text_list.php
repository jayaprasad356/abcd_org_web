<?php  include("includes/header.php");
	include("includes/connection.php");
  
    include("includes/function.php");
	include("language/language.php"); 


	    
		/*$total_pages = $total_pages['num'];*/
	 
		$tableName="excel_text";		
		$targetpage = "excel_text_list.php";
		$limit = 15; 
		
		$query = "SELECT COUNT(*) as num FROM excel_text";
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
		
		
	 $users_qry="SELECT * FROM excel_text
	 ORDER BY excel_text.id DESC LIMIT $start, $limit";  
		 
		$users_result=mysqli_query($mysqli,$users_qry);
							
	 
	if(isset($_GET['id']))
	{
		  
		 
		Delete('excel_text','id='.$_GET['id'].'');
		
		$_SESSION['msg']="12";
		header( "Location:manage_support.php");
		exit;
	}
	
 if(isset($_POST['delete_rec']))
  {

    $checkbox = $_POST['post_ids'];
    
    for($i=0;$i<count($checkbox);$i++){
      
      $del_id = $checkbox[$i]; 
     
      Delete('excel_text','id='.$del_id.'');
 
    }

    $_SESSION['msg']="12";
    header( "Location:manage_support.php");
    exit;
  } 
	
	
?>

<!-- Area to display the percent of progress -->
 
 <div id='percent'></div>
 
 <!-- area to display a message after completion of upload --> 
 <div id='status'></div>

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

          	<form method="post" action="modal.php" enctype="multipart/form-data">
          	 <input type="file" name="f_name" class="form-control">
          	<button type="submit" class="btn btn-primary" style="margin-bottom:20px;" name="upload_excel" value="delete_post" onclick="return confirm('Are you sure you want to upload this items?');">Upload excel</button>

            <button type="submit" class="btn btn-primary" style="margin-bottom:20px;" name="del_excel" value="delete_post" onclick="return confirm('Are you sure you want to delete this items?');">Delete excel </button>

          

          	</form>

            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  	
  				  <th style="width:150px">Slno</th>
 				  <th style="width:170px">Student Name</th>
 				  <th style="width:170px">Id Number</th>
 				  <th style="width:170px">City</th>
 				  <th style="width:170px">Pin code</th>
 				   <!--<th style="width:100px">Phone No.</th>
				  <th>support_message</th>-->
                   <!--<th class="cat_action_list" style="width:60px">Action</th>-->
                </tr>
              </thead>
              <tbody>
              	<?php
              	$query_one = "SELECT * FROM excel_text";
		        $total_pages_one = mysqli_query($mysqli,$query_one);
						$i=1;
						while($users_one=mysqli_fetch_array($users_result))
						{
						 
				?>
                <tr>
                   <td><?=$users_one['id'];?></td>	
  		           <td><?=$users_one['student_name'];?></td>
  		           <td><?php echo $users_one['id_number'];?></td>
  		            <td><?php echo $users_one['ecity'];?></td>
     		       <td><?php echo $users_one['pin_code'];?></td>
                    
                </tr>
               <?php
						
						$i++;
						}
			   ?>
              </tbody>
            </table>
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

<script>
 
 $(function() {
 $(document).ready(function(){
 var percent = $('#percent');
 var status = $('#status');
 
 $('form').ajaxForm({
 beforeSend: function() {
 status.empty();
 var percentVal = '0%';
 percent.html(percentVal);
 },
 uploadProgress: function(event, position, total, percentComplete) {
 var percentVal = percentComplete + '%';
 percent.html(percentVal);
 },
 complete: function(xhr) {
 status.html(xhr.responseText);
 }
 });
 });
 });
 </script>