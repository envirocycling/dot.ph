<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
<?php
@$p=$_GET['p'];
{ 
header("Location: truck_reassignment2.php?p=$p");
 } ?>