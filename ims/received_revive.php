<?php
include 'config.php';
$ctr2 = $_POST['ctr'];
$ctr = 0;
while ($ctr <= $ctr2) {
    $supplier_id = $_POST['supplier_id'.$ctr];
    $supplier_name = $_POST['supplier_name'.$ctr];
    $supplier_type = $_POST['supplier_type'.$ctr];
    $wp_grade = $_POST['wp_grade'.$ctr];
    $weight = $_POST['weight'.$ctr];
    $branch_delivered = $_POST['branch_delivered'.$ctr];
    $date_delivered = $_POST['date_delivered'.$ctr];
    $month_delivered = $_POST['month_delivered'.$ctr];
    $day_delivered = $_POST['day_delivered'.$ctr];
    $year_delivered = $_POST['year_delivered'.$ctr];
    mysql_query("INSERT INTO sup_deliveries (supplier_id, supplier_name, supplier_type, wp_grade, weight, branch_delivered, date_delivered, month_delivered, day_delivered, year_delivered)
        VALUES ('$supplier_id', '$supplier_name', '$supplier_type', '$wp_grade', '$weight', '$branch_delivered', '$date_delivered', '$month_delivered', '$day_delivered', '$year_delivered')");
    $ctr++;
}

?>