<?php
include 'config.php';

$truck_id = $_POST['truck_id'];
$supplier_id = $_POST['supplier_id'];
$issuance_date = $_POST['issuance_date'];
$end_date = $_POST['end_date'];
$id = $_POST['id'];
$amortization = $_POST['amortization'];
$cash_bond = $_POST['cash_bond'];
$proposed_volume = $_POST['proposed_volume'];

mysql_query("UPDATE truck_rent SET supplier_id='$supplier_id', issuance_date='$issuance_date', end_date='$end_date', amortization='$amortization', cash_bond='$cash_bond', proposed_volume='$proposed_volume' WHERE id='$id'");
echo "<script>";
echo "alert('Successfully Updated...');";
echo "location.replace('view_truck_info.php?truck_id=$truck_id');";
echo "</script>";


?>