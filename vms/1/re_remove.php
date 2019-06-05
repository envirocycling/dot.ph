
<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?><?php
include('connect.php');
echo $_GET['p'];
?>