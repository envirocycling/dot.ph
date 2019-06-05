<?php
date_default_timezone_set("Asia/Manila");
include("connect_out.php");
$id = $_GET['id'];
$current_date = date('Y/m/d');
$thirdMonth = date('Y/m', strtotime('-1 month', strtotime($current_date)));
$secondMonth = date('Y/m', strtotime('-1 month', strtotime($thirdMonth.'/01')));
$firstMonth = date('Y/m', strtotime('-1 month', strtotime($secondMonth.'/01')));
$actualThirdMonth = 0;
$actualSecondMonth = 0;
$actualFirstMonth = 0;

$sql_deliveries = mysql_query("SELECT * from paper_buying WHERE (date_received LIKE '$thirdMonth%' or date_received LIKE '$secondMonth%' or date_received LIKE '$firstMonth%') and corrected_weight > 0 and supplier_id='$id'") or die(mysql_error());
while($row_deliveries = mysql_fetch_array($sql_deliveries)){
    $date_received = date('Y/m', strtotime($row_deliveries['date_received']));
    if($thirdMonth == $date_received ){
        $actualThirdMonth += $row_deliveries['corrected_weight'];
    }else if($secondMonth == $date_received ){
        $actualSecondMonth += $row_deliveries['corrected_weight'];
    }else if($firstMonth == $date_received ){
        $actualFirstMonth += $row_deliveries['corrected_weight'];
    }
}

$actualThirdMonthTons = round($actualThirdMonth / 1000);
$actualSecondMonthTons = round($actualSecondMonth / 1000);
$actualFirstMonthTons = round($actualFirstMonth / 1000);
$actulAvg = round(($actualThirdMonthTons + $actualSecondMonthTons + $actualFirstMonthTons) / 3);

$fThirdMonth = date('M Y', strtotime('-1 month', strtotime($current_date)));
$fSecondMonth = date('M Y', strtotime('-1 month', strtotime($thirdMonth.'/01')));
$fFirstMonth = date('M Y', strtotime('-1 month', strtotime($secondMonth.'/01')));

$sql_supplier = mysql_query("SELECT * from supplier_details WHERE supplier_id='$id'");
$row_supplier = mysql_fetch_array($sql_supplier);

$address = strtoupper($row_supplier['warehouse_address']);

if(empty($address) || (strpos($address, 'SAME') !== false)){
    $address = strtoupper($row_supplier['address']);
}

echo $row_supplier['address'].'~'.$row_supplier['owner_contact'].'~'.$fThirdMonth.'~'.$fSecondMonth.'~'.$fFirstMonth.'~'.$actualThirdMonthTons.'~'.$actualSecondMonthTons.'~'.$actualFirstMonthTons.'~'.$actulAvg;