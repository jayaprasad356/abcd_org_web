<?php  
include('connect.php');
//$level=$_GET['level'];
$id=$_GET['id'];
$query="SELECT * FROM `WIDTHRAWL` WHERE `mobile`='$id'ORDER BY `WIDTHRAWL`.`ID` DESC";
$result=mysqli_query($conn,$query);
$num= mysqli_num_rows($result);
$count=0;
$json_array=array();
while($row=mysqli_fetch_array($result)){
 
 $reqDate=$row['req_date'];
$datem=$row['paid_date'];
  
   if($datem!=''){
   // print_r(date("d-m-Y | h:i:s A",$datem));exit;
   $row['paid_date']=date("d-m-Y | h:i:s A",$datem);
 //print_r($row['date']);exit;
   }

    if($reqDate!=''){
   // print_r(date("d-m-Y | h:i:s A",$datem));exit;
   $row['req_date']=date("d-m-Y | h:i:s A",$reqDate);
 //print_r($row['date']);exit;
   }

$json_array[]=$row;
    
    $num--;
    
}
$json=json_encode($json_array);
echo($json);
?>