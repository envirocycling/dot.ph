<?php
session_start();
if(!isset($_SESSION['bhead_username'])){
	header("Location: ../index.php");
	}

?>
<?php
$info = $_GET['name'];
mysql_query("Delete  from tbl_truck_report where finame = '$info' ");
unlink("..trucks/".$_GET['name']);
?>
