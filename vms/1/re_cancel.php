<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
?>
<?php 
include('connect.php');
$select = mysql_query("Select * from tbl_addinventorytool Where ")or die (mysql_error());

?>