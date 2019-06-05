<?php
include ("config.php");
$request_id=$_GET['request_id'];
mysql_query("UPDATE requests set type='for approval',status='approved by Jess' where request_id='$request_id'");
header("Location:jessRequests.php?request_id=$request_id");
?>