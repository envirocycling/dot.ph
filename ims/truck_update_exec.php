<?php
include 'config.php';
$truck_id = $_POST['truck_id'];
$plate_number = $_POST['plate_number'];
$plate_number2 = $_POST['plate_number2'];
$aquisition_cost = $_POST['aquisition_cost'];
$netbook_value = $_POST['netbook_value'];
$amount = $_POST['amount'];
$truck_condition = $_POST['truck_condition'];

//echo $truck_id;
//echo $plate_number;
//echo $plate_number2;
//echo $aquisition_cost;
//echo $netbook_value;
//echo $amount;
//echo $truck_condition;

if ($plate_number != $plate_number2) {
    $sql_check = mysql_query("SELECT * FROM truck WHERE plate_number='$plate_number'");
    $rs_check = mysql_num_rows($sql_check);
    if ($rs_check >= '1') {
        echo "<script>";
        echo "alert('The plate number is already taken.');";
        echo "history.back();";
        echo "</script>";
    } else {
        mysql_query("UPDATE truck SET plate_number='$plate_number', aquisition_cost='$aquisition_cost', netbook_value='$netbook_value', amount='$amount', truck_condition='$truck_condition' WHERE truck_id='$truck_id'");
        echo "<script>";
        echo "alert('Successfully Added...');";
        echo "location.replace('view_truck_info.php?truck_id=".$truck_id."');";
        echo "</script>";
    }

} else {
    mysql_query("UPDATE truck SET plate_number='$plate_number', aquisition_cost='$aquisition_cost', netbook_value='$netbook_value', amount='$amount', truck_condition='$truck_condition' WHERE truck_id='$truck_id'");
    echo "<script>";
    echo "alert('Successfully Updated...');";
    echo "location.replace('view_truck_info.php?truck_id=$truck_id');";
    echo "</script>";
}


?>