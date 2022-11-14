<?php  
include('connect.php');
//$level=$_GET['level'];
$id=$_GET['id'];
$query="SELECT * FROM `WALLET` WHERE `mobile`='$id' ORDER BY `WALLET`.`ID` DESC ";
$result=mysqli_query($conn,$query);
$num= mysqli_num_rows($result);
$count=0;
$json_array=array();
while($row=mysqli_fetch_array($result)){
 


$json_array[]=$row;
    
    $num--;
    
}
$json=json_encode($json_array);
echo($json);
?>