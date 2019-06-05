<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
$id=$_GET['id'];
mysql_query("Update tbl_truckdeedofsale Set location='' Where location='".$_POST['name']."'");
unlink("../deedofsale/".$_POST['name']);

header("Location: truck_details.php?id=$id");
?>