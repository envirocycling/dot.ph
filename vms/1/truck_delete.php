<?php
include("connect.php");
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
	$select = mysql_query("Select * from tbl_truck_report Where id=''".$_GET['id']."") or die (mysql_error());
	$row = mysql_fetch_array($select);
$truck = mysql_query("Delete from tbl_truck_report Where id ='".$_GET['id']."'") or die(mysql_error());



header("Location: existing_truck.php");
?>
