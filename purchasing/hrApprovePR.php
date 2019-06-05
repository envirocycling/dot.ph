<?php
include ("config.php");
date_default_timezone_set("Asia/Manila");
$request_id=$_GET['request_id'];
mysql_query("UPDATE requests set status='approved',  date_approved='".date('Y/m/d h:i A')."' where request_id='$request_id'");
header("Location:hrRequests.php?request_id=$request_id");
?>