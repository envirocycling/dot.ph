<?php
include('connect.php');
$id=$_GET['id'];
mysql_query("Delete from tbl_trip Where id='".$_POST['ids']."'") or die (mysql_error());
header("Location: trip_new.php?id=$id");
?>