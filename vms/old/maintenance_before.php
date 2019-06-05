<?php
include('connect.php');
$id =$_POST['plate'];
echo $_POST['maintain'];

if($_POST['maintain'] == 'TOOLS'){
	header("Location: maintenance_tools.php?id=$id");
	}
?>