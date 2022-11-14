<?php
include("includes/connection.php");

include("includes/function.php");
include("language/language.php");



/*$d = DateTime::createFromFormat('d-m-Y  h:i:s a', '28-05-2022  07:15:14 pm');
if ($d === false) {
    die("Incorrect date string");
} else {
    echo $d->getTimestamp();exit;
}*/

if(isset($_POST['getHistoryDays']))
{
    $jsonObj= array();
$mobile=$_POST['mobile'];
$userCode=$_GET['refer_code'];

$qry = "SELECT * FROM `USER_DETAILS` AS M INNER JOIN `PAYMENT_VERIFICATION` AS N WHERE ( M.mobile='$mobile' and N.mobile='$mobile' AND N.status='PAID') ORDER BY M.`id` DESC  ";

$result = mysqli_query($mysqli,$qry);
$num_rows = mysqli_num_rows($result);
// $row = mysqli_fetch_assoc($result);
if ($num_rows > 0)
{

$json_array=array();
while($row=mysqli_fetch_assoc($result)){

$startDay=$row['verified_date'];

$endDay=strtotime(date('d-m-Y',strtotime("0 days")));
$historyDays1=$endDay-$startDay;
$historyDays=($historyDays/ (60 * 60 * 24));

//print_r($historyDays1);exit;

    $mobile = $row['mobile'];
     $sql = "UPDATE `USER_DETAILS`  SET `total_qr_generation` = '$historyDays'  WHERE `mobile`='$mobile' ";

    // print_r($sql);exit;

    $result2 = mysqli_query($mysqli,$sql);
    $row2 = mysqli_fetch_assoc($result2);
     if (mysqli_affected_rows($mysqli)>0)
    {
          $row['historyDays']=$historyDays;

         

          array_push($jsonObj,$row);
    }

  

$num--;

}
/*$json=json_encode($json_array);
echo($json);*/
$set['abcdapp'][]=array('msg' =>' Referals Found','success'=>'1','result'=>$jsonObj);
}
else
{
$set['abcdapp'][]=array('title'=>'Hello User','msg' =>'NO Referals Found','success'=>'0');
}
header( 'Content-Type: application/json; charset=utf-8' );
echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
die();
}
if(isset($_POST['updateV']))
{

 $mobile = $_POST['mobile'];
$qry = "SELECT * FROM  `PAYMENT_VERIFICATION` AS N WHERE N.`verified_date` !=''  AND N.id=334  ";

$result = mysqli_query($mysqli,$qry);
$num_rows = mysqli_num_rows($result);
// $row = mysqli_fetch_assoc($result);
if ($num_rows > 0)
{

$json_array=array();
while($row=mysqli_fetch_assoc($result)){

$startDay=$row['verified_date'];


$badUrl = $startDay;
$vDate = str_replace('|', '', $badUrl);



$d = DateTime::createFromFormat('d-m-Y  h:i:s a', $startDay);
if ($d === false) {
    print_r($row['id']);
    die("Incorrect date string");
} else {
    $vDate= $d->getTimestamp();
}
 
    $mobile = $row['mobile'];
     $sql = "UPDATE `PAYMENT_VERIFICATION2`  SET `verified_date` = '$vDate'  WHERE `mobile`='$mobile'  ";

     print_r($sql);exit;

    $result2 = mysqli_query($mysqli,$sql);
    $row2 = mysqli_fetch_assoc($result2);
     if (mysqli_affected_rows($mysqli)>0)
    {
          $row['historyDays']=$historyDays;

         

          array_push($jsonObj,$row);
    }

  

$num--;

}
/*$json=json_encode($json_array);
echo($json);*/
$set['abcdapp'][]=array('msg' =>'  Found','success'=>'1','result'=>$jsonObj);
}
else
{
$set['abcdapp'][]=array('title'=>'Hello User','msg' =>'NO Referalsy Found','success'=>'0');
}
header( 'Content-Type: application/json; charset=utf-8' );
echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
die();
}

if(isset($_POST['updateDuplicateRef']))
{

 $mobile = $_POST['mobile'];
$qry = "SELECT `user_referal_code`, `mobile` ,COUNT(`user_referal_code`) AS `user_referal_code` FROM USER_DETAILS GROUP BY `user_referal_code` HAVING COUNT(`user_referal_code`)>1
 ";

$result = mysqli_query($mysqli,$qry);
$num_rows = mysqli_num_rows($result);
// $row = mysqli_fetch_assoc($result);
if ($num_rows > 0)
{

$json_array=array();
while($row=mysqli_fetch_assoc($result)){

//$startDay=$row['verified_date'];
 ${"admincode$count"} = "DBAA";
$refferCode =createUserCode(${"admincode$count"});


/*$badUrl = $startDay;
$vDate = str_replace('|', '', $badUrl);



$d = DateTime::createFromFormat('d-m-Y  h:i:s a', $startDay);
if ($d === false) {
    print_r($row['id']);
    die("Incorrect date string");
} else {
    $vDate= $d->getTimestamp();
}*/
 
    $mobile = $row['mobile'];
     $sql = "UPDATE `USER_DETAILS`  SET `user_referal_code` = '$refferCode'  WHERE `mobile`='$mobile'  ";

     //print_r($sql);exit;

    $result2 = mysqli_query($mysqli,$sql);
   /* $row2 = mysqli_fetch_assoc($result2);
     if (mysqli_affected_rows($mysqli)>0)
    {
          $row['historyDays']=$historyDays;

         

          array_push($jsonObj,$row);
    }
*/
  

$num--;

}
/*$json=json_encode($json_array);
echo($json);*/
$set['abcdapp'][]=array('msg' =>'  Found','success'=>'1','result'=>$jsonObj);
}
else
{
$set['abcdapp'][]=array('title'=>'Hello User','msg' =>'NO Referalsy Found','success'=>'0');
}
header( 'Content-Type: application/json; charset=utf-8' );
echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
die();
}

if(isset($_POST['getHistoryDays1']))
{
    $jsonObj= array();
$mobile=$_POST['mobile'];
$userCode=$_GET['refer_code'];

$qry = "SELECT * FROM `USER_DETAILS` AS M INNER JOIN `PAYMENT_VERIFICATION` AS N WHERE (M.mobile=N.mobile AND  N.status='PAID') ORDER BY M.`id` DESC  ";
//print_r($qry );exit;
$result = mysqli_query($mysqli,$qry);
$num_rows = mysqli_num_rows($result);
// $row = mysqli_fetch_assoc($result);
//print_r('hellom');exit;

if ($num_rows > 0)
{

$json_array=array();
while($row=mysqli_fetch_assoc($result)){
   // $mobile=$row['mobile'];
$startDay=$row['verified_date'];

$endDay=strtotime(date('d-m-Y',strtotime("0 days")));
$historyDays=$endDay-$startDay;
$historyDays=($historyDays/(60 * 60 * 24));



    $mobile = $row['mobile'];
     $sql = "UPDATE `USER_DETAILS`  SET `total_qr_generation` = '$historyDays'  WHERE `mobile`='$mobile' ";

   //  print_r($sql);exit;

    $result2 = mysqli_query($mysqli,$sql);
    $row2 = mysqli_fetch_assoc($result2);
     if (mysqli_affected_rows($mysqli)>0)
    {
          $row['historyDays']=$historyDays;

         

          array_push($jsonObj,$row);
    }

  

$num--;

}
/*$json=json_encode($json_array);
echo($json);*/
$set['abcdapp'][]=array('msg' =>' Referals Found','success'=>'1','result'=>$jsonObj);
}
else
{
$set['abcdapp'][]=array('title'=>'Hello User','msg' =>'NO Referals Found','success'=>'0');
}
header( 'Content-Type: application/json; charset=utf-8' );
echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
die();
}


?>