<?php
$id=$_POST['request_id'];
$status=$_POST['status'];
include ("config.php");
mysql_query("UPDATE requests set status='$status' where request_id='$id'");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>