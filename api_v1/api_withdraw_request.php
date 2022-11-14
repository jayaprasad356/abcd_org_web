<?php  include("../includes/connection.php");
include("../includes/function.php");

$user_id = $_GET['user_id'];
$device_id = $_GET['device_id'];
$user_points = $_GET['user_points'];
$payment_mode = $_GET['payment_mode'];
$bank_details = $_GET['payment_details'];


$redeem_price= ($_GET['user_points']*REDEEM_MONEY)/REDEEM_POINTS;

$data = array(
    'user_id' =>$user_id ,
    'device_id' =>$device_id ,
    'user_points'  => $user_points,
    'redeem_price'  => $redeem_price,
    'payment_mode'  => $payment_mode,
    'payment_details'  =>  $bank_details,
);

$qry = Insert('tbl_withdraw_request',$data);
$redeem_id=mysqli_insert_id($mysqli);

$user_view_qry=mysqli_query($mysqli,"UPDATE tbl_users SET total_point=0  WHERE id = '".$user_id."'");

//$user_activity_qry=mysqli_query($mysqli,"UPDATE tbl_users_rewards_activity SET redeem_id='".$redeem_id."',status=0  WHERE user_id = '".$user_id."' AND status = '1'");


$set['spin'][] = array('msg'=>'Redeem request send!','success'=>1);

header( 'Content-Type: application/json; charset=utf-8' );
echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
die();


?>