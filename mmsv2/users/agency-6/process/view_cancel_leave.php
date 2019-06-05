<?php
session_start();
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');

$id = $_POST['leave_id'];
$user = $_SESSION['user_type'];
$date = date('Y/m/d H:i');

mysql_query("UPDATE leaves SET status='cancelled', cancelled_user_type='$user', cancelled_date='$date' WHERE leave_id='$id'") or die (mysql_error());

