<?php
session_start();
if(!isset($_SESSION['bhead_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
$id=$_GET['id'];
mysql_query("Update tbl_truck_report Set siname='' Where siname='".$_POST['name']."'");
unlink("../trucks/".$_POST['name']);


header("Location: truck_details.php?id=$id");
?>