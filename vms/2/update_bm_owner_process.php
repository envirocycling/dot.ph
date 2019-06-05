<?php

date_default_timezone_set("Asia/Singapore");
session_start();

$date = date('Y/m/d');

include('connect.php');

$id = $_POST['id'];
$prepared_by = $_SESSION['bhead_username'];
$branch =  $_POST['branch'];

$supplier_name = $_POST['supplier_name'];
$issuanceDate = $_POST['issuancedate'];
$endDate = $_POST['enddate'];
$amortization = $_POST['amortization'];
$amortizationMonth = $_POST['amortization_month'];
$cashBond = $_POST['cashbond'];
$cashBondMonth = $_POST['cashbond_month'];
$quota = $_POST['quota'];
$penalty = $_POST['penalty'];
$remarks = $_POST['remarks'];

$queryAssignUpdate = "UPDATE `tbl_bm_givento` SET `supplier_name`='$supplier_name', `issuance_date`='$issuanceDate', `end_date`='$endDate', `amortization`='$amortization', `cash_bond`='$cashBond', `penalty`='$penalty', `remarks`='$remarks', `cash_bond_month`='$cashBondMonth', `amortization_month`='$amortizationMonth', `quota`='$quota', `prepared_by`='$prepared_by', `date_encode`='$date' WHERE bm_id='$id';";

mysql_query($queryAssignUpdate) or die(mysql_error());

$queryUpdateBm = "UPDATE `tbl_bm_report` SET `cash_bond`='$cashBond', `quota`='$quota', `supplier_name`='$supplier_name', `status`='assigned' WHERE id='$id'";

mysql_query($queryUpdateBm) or die(mysql_error());

$querySummary = "INSERT INTO `tbl_bm_assign_summary`(`bm_id`, `date`, `branch`, `user`, `type`, `supplier_name`, `remarks`) VALUES ('$id', '$date', '$branch', '$prepared_by', 'Update data', '$supplier_name', '$remarks')";

mysql_query($querySummary) or die(mysql_error());


?>

<script type= "text/javascript">
	alert("Successful.");
	location.replace('existing_bm.php');
</script>