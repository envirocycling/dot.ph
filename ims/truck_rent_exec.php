<?php
include 'config.php';

$truck_id = $_POST['truck_id'];
$supplier_id = $_POST['supplier_id'];
$issuance_date = $_POST['issuance_date'];
$end_date = $_POST['end_date'];
$amortization = $_POST['amortization'];
$cash_bond = $_POST['cash_bond'];
$proposed_volume = $_POST['proposed_volume'];

mysql_query("INSERT INTO `truck_rent`(`truck_id`, `supplier_id`, `issuance_date`, `end_date`, `amortization`, `cash_bond`, `proposed_volume`)
    VALUES ('$truck_id','$supplier_id','$issuance_date', '$end_date', '$amortization','$cash_bond','$proposed_volume')");
echo "<script>";
echo "alert('Successful..');";
echo "window.close();";
echo "</script>";

?>
