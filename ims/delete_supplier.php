<?php
include 'config.php';

$del_id = $_GET['sup_id'];
mysql_query("DELETE FROM supplier_details WHERE supplier_id='$del_id'");
mysql_query("DELETE FROM sup_deliveries WHERE supplier_id='$del_id'");

echo "<script>";
echo "alert('Successfully Deleted');";
echo "window.history.back();";
echo "</script>";
?>