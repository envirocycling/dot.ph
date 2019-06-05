<?php
include('connect.php');
$p = $_GET['p'];
 $timezone=+8;
	 $date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));
 mysql_query("Insert into tbl_trucktools (truckid,toolname,dateadded) Values('".$_GET['p']."','".$_POST['tools']."','$date')") or die(mysql_error());
 header("Location: truck_reassignment2.php?p=$p");
?>
