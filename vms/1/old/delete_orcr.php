<?php
include('connect.php');
$id=$_GET['id'];
mysql_query("Update tbl_truckorcr Set location='' Where location='".$_POST['name']."'");
unlink("orcr/".$_POST['name']);

header("Location: truck_details.php?id=$id");
?>