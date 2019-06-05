<?php
include 'config.php';
$ctr=0;
$c=$_POST['ctr'];

while ($ctr < $c){
$supplier_id = $_POST['supplier_id'.$ctr.''];
$supplier_name = $_POST['supplier_name'.$ctr.''];
$supplier_type = $_POST['supplier_type'.$ctr.''];
$bh_in_charge = $_POST['bh_in_charge'.$ctr.''];
$wp_grade = $_POST['wp_grade'.$ctr.''];
$weight = $_POST['weight'.$ctr.''];
$branch_delivered = $_POST['branch_delivered'.$ctr.''];
$date_delivered = $_POST['date_delivered'.$ctr.''];
$month_delivered = $_POST['month_delivered'.$ctr.''];
$year_delivered = $_POST['year_delivered'.$ctr.''];
$plate_number = $_POST['plate_number'.$ctr.''];

echo $supplier_id;
echo $supplier_name;
echo $supplier_type;
echo $bh_in_charge;
echo $wp_grade;
echo $weight;
echo $branch_delivered;
echo $date_delivered;
echo $month_delivered;
echo $year_delivered;
echo $plate_number;
$ctr++;
mysql_query("INSERT INTO sup_deliveries
    (supplier_id, supplier_name, supplier_type, bh_in_charge, wp_grade, weight, branch_delivered, date_delivered, month_delivered, year_delivered, plate_number)
    VALUES
    ('$supplier_id', '$supplier_name', '$supplier_type', '$bh_in_charge', '$wp_grade', '$weight', '$branch_delivered', '$date_delivered', '$month_delivered', '$year_delivered', '$plate_number')");

echo "<br>";

}
echo "<script> alert('Added Successfully ".$ctr."...'); window.location='http://localhost/romarlon/index.php';</script>";

?>