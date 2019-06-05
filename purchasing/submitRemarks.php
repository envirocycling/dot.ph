<?php
$id=$_POST['request_id'];
$remarks=$_POST['remarks'];
include ('config.php');
mysql_query("UPDATE requests set remarks='$remarks' where request_id='$id'");
header("Location:".$_SERVER["HTTP_REFERER"]);

?>	