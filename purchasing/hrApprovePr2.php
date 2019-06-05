<?php include('config.php');

$request_id = $_GET['request_id'];
$signature = $_GET['signature'];
$date = date("Y/m/d h:i a");

mysql_query("UPDATE requests SET status='pending',date_verified='$date',verified_signature='$signature' where request_id='$request_id'");

header('Location: hrPending.php');

?>