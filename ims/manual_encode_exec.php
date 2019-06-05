<?php
include 'config.php';
session_start();
$branch = $_SESSION['user_branch'];
$ctr = 0;
$count = $_POST['count'];
$date = $_POST['date'];
$month = date("F", strtotime($date));
$day = date("d", strtotime($date));
$year = date("Y", strtotime($date));
while ($ctr < $count) {
    $details = $_POST['supplier_id'.$ctr];
    $que = preg_split("/[_]/", $details);
    $supplier_id = $que[0];
    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$supplier_id'");
    $rs_sup = mysql_fetch_array($sql_sup);
    $supplier_type = $rs_sup['classification'];
    $bh_in_charge = $rs_sup['bh_in_charge'];
    $supplier_name = $que[1];
    $priority = $_POST['priority'.$ctr];
    $wp_grade = $_POST['wp_grade'.$ctr];
    $weight = $_POST['weight'.$ctr];
    $remarks = $_POST['remarks'.$ctr];
    $mc_percentage = $_POST['mc_percentage'.$ctr];
    $mc_weight = $_POST['mc_weight'.$ctr];
    $plate_number = $_POST['plate_number'.$ctr];

    mysql_query("INSERT INTO sup_deliveries (supplier_id, supplier_name, supplier_type, bh_in_charge, wp_grade, weight, branch_delivered, date_delivered, month_delivered, day_delivered, year_delivered, remarks, mc_percentage, mc_weight, priority_number, plate_number)
        VALUES ('$supplier_id', '$supplier_name', '$supplier_type', '$bh_in_charge', '$wp_grade', '$weight', '$branch', '$date', '$month', '$day', '$year', '$remarks', '$mc_percentage', '$mc_weight', '$priority', '$plate_number')");
    $ctr++;
}

?>
<script>
    alert('Successfuly Inserted.');
    location.replace('form_manual_encode.php');
</script>