<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
<?php
$id = $_POST['filter'];

include('connect.php');


if($id == 'TOOLS'){
	header("Location: inventory_tools.php?id=$id");
	}
if($id == 'BATTERY'){
	header("Location: inventory_battery.php?id=$id");
	}
	if($id == 'TIRE'){
	header("Location: inventory_tire.php?id=$id");
	}
?>
