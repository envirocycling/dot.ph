<?php
include('connect.php');
$id= $_GET['id'];
mysql_query("Update tbl_trucktools Set remarks='".$_POST['remarks']."' Where ti='".$_POST['ti']."'") or die (mysql_error());
header("Location: maintenance_tools.php?id=$id");
?>
