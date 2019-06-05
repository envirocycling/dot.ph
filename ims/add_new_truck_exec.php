<?php
include 'config.php';

$plate_number = $_POST['plate_number'];
$aquisition_cost = $_POST['aquisition_cost'];
$netbook_value = $_POST['netbook_value'];
$amount = $_POST['amount'];
$truck_condition = $_POST['truck_condition'];

$sql_check = mysql_query("SELECT * FROM truck WHERE plate_number='$plate_number'");
$rs_check = mysql_num_rows($sql_check);
if ($rs_check >= '1') {
    echo "<script>";
    echo "alert('The plate number is already taken.');";
    echo "history.back();";
    echo "</script>";
} else {
    mysql_query("INSERT INTO `truck`(`plate_number`, `aquisition_cost`, `netbook_value`, `amount`, `truck_condition`)
        VALUES ('$plate_number','$aquisition_cost','$netbook_value','$amount','$truck_condition')");

    echo "<script>";
    echo "alert('Successfully Added...');";
    echo "location.replace('existing_truck.php');";
    echo "</script>";
}
?>