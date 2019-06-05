<?php
session_start();
if(!isset($_SESSION['encoder_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
$id=$_GET['id'];
mysql_query("Update tbl_truck_report Set tiname='' Where tiname='".$_POST['name']."'");
unlink("../trucks/".$_POST['name']);


header("Location: truck_details.php?id=$id");
?>