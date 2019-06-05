<?php
session_start();
if(!isset($_SESSION['bhead_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
$id=$_POST['id'];
mysql_query("Delete from tbl_truckimage Where id='".$_GET['id']."'") or die(mysql_error());
unlink("../trucks/".$_POST['name']);

header("Location: truck_details.php?id=$id");
?>