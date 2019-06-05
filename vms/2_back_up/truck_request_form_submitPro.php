<?php

date_default_timezone_set("Asia/Manila");
include("connect.php");
@session_start();
$supplierName = $_POST['supplierName'];
$supplierId = $_POST['supplierId'];
$spnWarehouseAddress = mysql_real_escape_string($_POST['spnWarehouseAddress']);
$spnContactNo = $_POST['spnContactNo'];
$volumeSumm = $_POST['volumeSumm'];
$spnAvgVal = $_POST['spnAvgVal'];
$spnCommitmentVal = $_POST['spnCommitmentVal'];
$truck_request = $_POST['truck_request'];
$tr_id = $_POST['tr_id'];
$truckCost = $_POST['truckCost'];
$moAm = $_POST['moAm'];
$amort = $_POST['amort'];
$moCb = $_POST['moCb'];
$cb = $_POST['cb'];
$_textArea = utf8_decode(mysql_real_escape_string(json_encode($_POST['_textArea'], JSON_UNESCAPED_UNICODE)));
$date = date('Y-m-d');

$sql_gm = mysql_query("SELECT * from tbl_users WHERE type = '0' ORDER BY id Desc LIMIT 1") or die(mysql_error());
$row_gm = mysql_fetch_array($sql_gm);

if (!empty($_POST['id']) && $_POST['id'] > 0) {
    mysql_query("UPDATE tbl_truckrequest SET supplier_id='$supplierId', supplier_name='$supplierName', address='$spnWarehouseAddress', contact_no='$spnContactNo', volume_summary='$volumeSumm', avg='$spnAvgVal', commitment='$spnCommitmentVal',
        truck_request='$truck_request', justification='$_textArea', date='$date', branch='" . $_SESSION['owner'] . "', tr_id='$tr_id', truck_cost='$truckCost', amortization='$amort', mo_amortization='$moAm', cashbond='$cb', mo_cashbond='$moCb' , prepared_by='" . $_SESSION['id'] . "', approved_by='" . $row_gm['id'] . "' WHERE id='".$_POST['id']."'") or die(mysql_error());
} else {
    mysql_query("INSERT INTO tbl_truckrequest (supplier_id, supplier_name, address, contact_no, volume_summary, avg, commitment, truck_request, justification, status, date, branch, tr_id, truck_cost, amortization, mo_amortization, cashbond, mo_cashbond , prepared_by, approved_by)
    VALUES('$supplierId', '$supplierName', '$spnWarehouseAddress', '$spnContactNo', '$volumeSumm', '$spnAvgVal', '$spnCommitmentVal', '$truck_request', '$_textArea' , 'Pending to GM', '$date', '" . $_SESSION['owner'] . "', '$tr_id', '$truckCost', '$amort', '$moAm', '$cb', '$moCb', '" . $_SESSION['id'] . "', '" . $row_gm['id'] . "') ") or die(mysql_error());
}
