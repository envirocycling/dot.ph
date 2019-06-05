<?php
include('connect.php');
$id=$_GET['id'];
mysql_query("Update tbl_truck_report Set finame='' Where finame='".$_POST['name']."'");
unlink("trucks/".$_POST['name']);


header("Location: truck_details.php?id=$id");
?>