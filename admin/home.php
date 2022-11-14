<?php
include("includes/header.php");
//$date=date("Y-m-d");
date_default_timezone_set("Asia/Calcutta");
// $date2=date("Y-m-d");

$startDate=strtotime(date('d-m-Y',strtotime("now")));
$endDate= strtotime(date('d-m-Y',strtotime("+1 days")));


$where='BETWEEN '.$startDate.' AND '.$endDate ;
$admin_user_id=$_SESSION['admin_refer_code'];

$qry_cat="SELECT COUNT(*) as num FROM tbl_category";
$total_category= mysqli_fetch_array(mysqli_query($mysqli,$qry_cat));
$total_category = $total_category['num'];
$qry_video="SELECT COUNT(*) as num FROM tbl_video";
$total_video = mysqli_fetch_array(mysqli_query($mysqli,$qry_video));
$total_video = $total_video['num'];
// Total User
$admin_user_id=$_SESSION['admin_refer_code'];
if($_SESSION['id'] > 1){

if($admin_user_id==""){
$qry_users="SELECT COUNT(*) as num FROM USER_DETAILS";
$total_users = mysqli_fetch_array(mysqli_query($mysqli,$qry_users));
$total_users = $total_users['num'];
}else{
$qry_users="SELECT COUNT(*) as num FROM USER_DETAILS where reffered_by LIKE '$admin_user_id%'";
$total_users = mysqli_fetch_array(mysqli_query($mysqli,$qry_users));
$total_users = $total_users['num'];
}


}else{
$qry_users="SELECT COUNT(*) as num FROM USER_DETAILS";
$total_users = mysqli_fetch_array(mysqli_query($mysqli,$qry_users));
$total_users = $total_users['num'];
}
// Total Active user
if($_SESSION['id'] > 1){

$qry_act_users="SELECT COUNT(*) as num FROM USER_DETAILS where  `active_date` $where";
$total_act_users = mysqli_fetch_array(mysqli_query($mysqli,$qry_act_users));
// print_r($qry_act_users);exit;
$total_act_user = $total_act_users['num'];

}else{
$qry_act_users="SELECT COUNT(*) as num FROM USER_DETAILS WHERE `active_date` $where";
$total_act_users = mysqli_fetch_array(mysqli_query($mysqli,$qry_act_users));
$total_act_user = $total_act_users['num'];
}
// Today total Register user
$joining_date=date("d-m-Y ");
$joining_date='BETWEEN '.$startDate. ' AND ' .$endDate;
date_default_timezone_set("Asia/Calcutta");
if($_SESSION['id'] > 1){
$joining_time=$joining_date;
//(strpos($reffered_by,'DBAB') !== false)
/*print_r()*/
if($admin_user_id==""){
$total_tday_users = "SELECT COUNT(*) as num FROM USER_DETAILS where reffered_by LIKE '$admin_user_id%'and `joining_time` $where ";
//  print_r($total_tday_users);exit;
$total_todayy_users = mysqli_fetch_array(mysqli_query($mysqli,$total_tday_users));
//print_r($users_result);exit;
$total_today_user = $total_todayy_users['num'];
}else{
$total_tday_users = "SELECT COUNT(*) as num FROM USER_DETAILS WHERE `joining_time` $where ";
//print_r($qry_act_users);exit;
$total_todayy_users = mysqli_fetch_array(mysqli_query($mysqli,$total_tday_users));
//print_r($users_result);exit;
$total_today_user = $total_todayy_users['num'];
}

}else{
$total_tday_users = "SELECT COUNT(*) as num FROM USER_DETAILS WHERE `joining_time` $where ";
//print_r($qry_act_users);exit;
$total_todayy_users = mysqli_fetch_array(mysqli_query($mysqli,$total_tday_users));
//print_r($users_result);exit;
$total_today_user = $total_todayy_users['num'];
//print_r($qry_act_users);exit;
}
//Today Coin Genarated
if($_SESSION['id'] > 1){
$joining_time=$joining_date;

/*print_r()*/
$qry_users_coin = "SELECT SUM(amount) AS num FROM WALLET where `user_id` LIKE '$admin_user_id%' ";
// print_r($qry_users_coin);exit;
$total_coin = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_coin));
$total_coin1 = $total_coin['num'];
if($total_coin1==''){
$total_coin1 = '0';
}

}else{
$qry_users_coin="SELECT SUM(amount) AS num FROM WALLET ";
$total_coin = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_coin));
$total_coin1 = $total_coin['num'];
if($total_coin1==''){
$total_coin1 = '0';
}
}
//TOTAL Paid
if($_SESSION['id'] > 1){
$joining_time=$joining_date;

/*print_r()*/
$qry_users_paid = "SELECT ROUND(SUM(ammount),2) AS num FROM WIDTHRAWL where `user_id` LIKE '$admin_user_id%' and `status` = 'Paid' ";
//  print_r($qry_users_paid);exit;
$total_paid = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_paid));
$total_paid = $total_paid['num'];
if($total_paid==''){
$total_paid = '0';
}

}else{
$qry_users_paid="SELECT ROUND(SUM(ammount),2) AS num FROM WIDTHRAWL where `status` = 'Paid' ";
$total_paid = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_paid));
$total_paid = $total_paid['num'];
if($total_paid==''){
$total_paid = '0';
}
}
//Total Pending
if($_SESSION['id'] > 1){
$joining_time=$joining_date;

/*print_r()*/
$qry_users_pending = "SELECT ROUND(SUM(ammount),2) AS num FROM WIDTHRAWL where `user_id` LIKE '$admin_user_id%' and `status` = 'Pending' ";
// print_r($qry_users_coin);exit;
$total_pending = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_pending));
$total_pending = $total_pending['num'];

if($total_pending==''){
$total_pending = '0';
}

}else{
$qry_users_pending="SELECT ROUND(SUM(ammount),2) AS num FROM WIDTHRAWL where `status` = 'Pending' ";
$total_pending = mysqli_fetch_array(mysqli_query($mysqli,$qry_users_pending));
$total_pending = $total_pending['num'];
//  print_r( $total_pending);

if($total_pending==''){
$total_pending = '0';
}
}
$users51_qry = "SELECT * FROM `ADMIN_ROLE` ";
$users51_result = mysqli_query($mysqli, $users51_qry);
$i = 0;
$count=1;
while ($users51_row = mysqli_fetch_array($users51_result)) {
  $id=$users51_row['admin_refer_code'];
$users_qry1 = "SELECT SUM(today_app_joining)AS totalappjoina1,SUM(today_joining_paid_no)AS totalappjoinpan1,SUM(total_jpaid_amnt)AS totalappjoinpay1,SUM(today_payment_request)AS totalappreq1,SUM(today_payment_done)AS totalapppaydone1  FROM `ADMINS1_DATA` WHERE `admin_refer_code`='$id' ";
 //print_r($users_qry1);
$graph_result = mysqli_query($mysqli, $users_qry1);
$graph_row=mysqli_fetch_assoc($graph_result);



 ${"totalappjoina$count"} = $graph_row['totalappjoina1'];
 ${"$totalappjoinpay$count"} = $graph_row['totalappjoinpay1'];
 ${"totalappreq$count"} = $graph_row['totalappreq1'];
 ${"totalapppaydone$count"} = $graph_row['totalapppaydone1'];

 //print_r($totalappjoinpay1);exit;
                     

if($count==1){
// print_r('hello');
$totalappjoina1= $graph_row['totalappjoina1'];
$totalappjoinpay1=$graph_row['totalappjoinpay1'];
$totalappreq1=$graph_row['totalappreq1'];
$totalapppaydone1=$graph_row['totalapppaydone1'];
//print_r($totalappjoina1);
}if($count==2){

$totalappjoina2= $graph_row['totalappjoina1'];
$totalappjoinpay2=$graph_row['totalappjoinpay1'];
$totalappreq2=$graph_row['totalappreq1'];
$totalapppaydone2=$graph_row['totalapppaydone1'];
}if($count==3){
//print_r($totalapppaydone3);

$totalappjoina3= $graph_row['totalappjoina1'];
$totalappjoinpay3=$graph_row['totalappjoinpay1'];
$totalappreq3=$graph_row['totalappreq1'];
$totalapppaydone3=$graph_row['totalapppaydone1'];
}if($count==4){
//print_r($totalapppaydone4);
$totalappjoina4= $graph_row['totalappjoina1'];
$totalappjoinpay4=$graph_row['totalappjoinpay1'];
$totalappreq4=$graph_row['totalappreq1'];
$totalapppaydone4=$graph_row['totalapppaydone1'];

/*$totalappjoina4= '0';
$totalappjoinpay4='0';
$totalappreq4='0';
$totalapppaydone4='0';*/
}/*if($count==5){
print_r($totalapppaydone5);
$totalappjoina5= $graph_row['totalappjoina1'];
$totalappjoinpay5=$graph_row['totalappjoinpay1'];
$totalappreq5=$graph_row['totalappreq1'];
$totalapppaydone5=$graph_row['totalapppaydone1'];
}*/


$i++;
$count++;
}


?>


<script>
window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer", {
exportEnabled: true,
animationEnabled: true,
title:{
text: "Total Number Of App Joinings By Different Admins Source"
},
subtitles: [{
text: "Click Legend to Hide or Unhide Data Series"
}],
axisX: {
title: "States"
},
axisY: {
title: "Total Number Of App Joinings - Units",
titleFontColor: "#4F81BC",
lineColor: "#4F81BC",
labelFontColor: "#4F81BC",
tickColor: "#4F81BC",
includeZero: true
},
axisY2: {
title: "Paid Joinings - Units",
titleFontColor: "#C0504E",
lineColor: "#C0504E",
labelFontColor: "#C0504E",
tickColor: "#C0504E",
includeZero: true
},
toolTip: {
shared: true
},
legend: {
cursor: "pointer",
itemclick: toggleDataSeries
},
data: [{
type: "column",
name: "Total Number Of App Joinings",
showInLegend: true,
yValueFormatString: "#,##0.# Units",
dataPoints: [
{ label: "Total Direct Joining",  y: <?=$totalappjoina1?> },
{ label: "Total Joining By Admin1", y: <?=$totalappjoina2?> },
{ label: "Total Joining By Admin2", y: <?=$totalappjoina3?> },
{ label: "Total Joining By Admin3",  y: <?=$totalappjoina4?> }
]
},
{
type: "column",
name: "Paid Joinings",
axisYType: "secondary",
showInLegend: true,
yValueFormatString: "#,##0.# Units",
dataPoints: [
{ label: " Direct Joinings Data ", y: <?=$totalappjoinpay1?> },
{ label: "Admin 1 Joinings Data", y: <?=$totalappjoinpay2?> },
{ label: "Admin 2 Joinings Data", y: <?=$totalappjoinpay3?> },
{ label: "Admin 3 Joinings Data", y: <?=$totalappjoinpay4?>},
]
}]
});
chart.render();

function toggleDataSeries(e) {
if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
e.dataSeries.visible = false;
} else {
e.dataSeries.visible = true;
}
e.chart.render();
}
}
</script>

</head>
<body>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php
//print_r($data);exit;
if($_SESSION['id'] == 1){

?>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<?php
}
?>
</body>
</html>

<div class="row">
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_users.php" class="card card-banner card-blue-light">
<div class="card-body"> <i class="icon fa fa-users fa-4x"></i>
  <div class="content">
    <div class="title">Total Users</div>
    <div class="value"><span class="sign"></span><?php echo $total_users;?></div>
  </div>
</div>
</a>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_users.php?get_active_users" class="card card-banner card-green-light">
<div class="card-body"> <i class="icon fa fa-users fa-4x"></i>
<div class="content">
  <div class="title">Active Users</div>
  <div class="value"><span class="sign"></span><?php echo $total_act_user;?></div>
</div>
</div>
</a>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_users.php?get_today_registration" class="card card-banner card-alicerose-light">
<div class="card-body"> <i class="icon fa fa-users fa-4x"></i>
<div class="content">
<div class="title">Today Registation</div>
<div class="value"><span class="sign"></span><?php echo $total_today_user;?></div>
</div>
</div>
</a>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mr_bot60">
<a href="#" class="card card-banner card-pink-light">
<div class="card-body"> <i class="icon fa fa-coins fa-4x"></i>
<div class="content">
<div class="title">Total Transaction</div>
<div class="value"><span class="sign"></span><?php echo $total_coin1;?></div>
</div>
</div>
</a>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mr_bot60">
<a href="manage_withdraw_request.php" class="card card-banner card-orange-light">
<div class="card-body"> <i class="icon fa fa-dollar fa-4x"></i>
<div class="content">
<div class="title">Paid</div>
<div class="value"><span class="sign"></span><?php echo $total_paid ? $total_paid : '0';?> <span class="sign"><?php echo $settings_row['redeem_currency'];?></span></div>
</div>
</div>
</a>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mr_bot60">
<a href="manage_withdraw_request.php" class="card card-banner card-yellow-light">
<div class="card-body"> <i class="icon fa fa-dollar fa-4x"></i>
<div class="content">
<div class="title">Pending</div>
<div class="value"><span class="sign"></span><?php echo $total_pending ? $total_pending : '0';?> <span class="sign"><?php echo $settings_row['redeem_currency'];?></span></div>
</div>
</div>
</a>
</div>
</div>
<!--
<div class="col-lg-12 col-md-6 col-sm-6 col-xs-12"> <a href="#" class="card card-banner ">
<div class="card-body">
<div class="content">
<div class="title">Total Users</div>
<div class="content" id="chartContainer" style="height: 250px; width: 90%;"></div>

</div>
</div>
</a>
</div>
-->

<?php include("includes/footer.php");?>