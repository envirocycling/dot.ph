<?php
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');

$id = $_POST['pr_id'];
$date = date('Y/m/d');

mysql_query("UPDATE personnel_requisition SET status='cancelled', hr_status='cancelled', hr_date='$date' WHERE pr_id='$id'") or die (mysql_error());

