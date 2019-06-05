<?php
$request_id=$_GET['request_id'];
include('config.php');
mysql_query("UPDATE requests SET status='disapproved' where request_id='$request_id'");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>  
