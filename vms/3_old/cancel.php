<?php 
include('connect.php');
$select = mysql_query("Select * from tbl_reassign Where  id='".$_GET['id']."'") or die(mysql_error());
$row = mysql_fetch_array($select);
$id=$row['truckid'];
$delete = mysql_query("Delete from tbl_reassign Where id ='".$_GET['id']."'") or die(mysql_error());
$deletetool = mysql_query("Delete from tbl_toolreassign Where truckid='$id'") or die(mysql_error());
header("Location: truck_reassign.php");

?>