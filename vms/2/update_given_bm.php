<?php
date_default_timezone_set("Asia/Singapore");
session_start();
$date = date('Y/m/d');

include('connect.php');

$type = $_POST['type'];
$id = $_POST['id'];
$prepared_by = $_SESSION['bhead_username'];
$branch =  $_POST['branch'];

if($type == 'branch') {

	$from = $_POST['from_branch'];
	$to = $_POST['to_branch'];
	$remarks = $_POST['remarks'];

	$query = "UPDATE `tbl_bm_report` SET `branch`='$to', `status`='' WHERE `branch`='$from' AND id='$id'";
	mysql_query($query) or die(mysql_error());

	$querySummary = "INSERT INTO `tbl_bm_assign_summary`(`bm_id`, `date`,`branch`, `user`, `type`, `from_branch`, `to_branch`, `remarks`) VALUES ('$id','$date','$branch','$prepared_by','$type','$from','$to','$remarks')";
	mysql_query($querySummary) or die(mysql_error());

?>	

<script type= "text/javascript">
	alert("Successful assigned to <?= $to; ?>.");
	location.replace('existing_bm.php');
</script>

<?php

} else {

	
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

	$queryAssign = "INSERT INTO `tbl_bm_givento`(`name`, `supplier_name`, `bm_id`, `issuance_date`, `end_date`, `amortization`, `cash_bond`, `penalty`, `prepared_by`, `remarks`, `cash_bond_month`, `amortization_month`, `quota`, `date_encode`) VALUES ('$branch', '$supplier_name', '$id' ,'$issuanceDate', '$endDate', '$amortization', '$cashBond', '$penalty', '$prepared_by', '$remarks','$cashBondMonth', '$amortizationMonth', '$quota', '$date' )";
	mysql_query($queryAssign) or die(mysql_error());

	$queryUpdateBm = "UPDATE `tbl_bm_report` SET `cash_bond`='$cashBond', `quota`='$quota', `supplier_name`='$supplier_name', `status`='assigned' WHERE id='$id'";
	mysql_query($queryUpdateBm) or die(mysql_error());

	$querySummary = "INSERT INTO `tbl_bm_assign_summary`(`bm_id`, `date`, `branch`, `user`, `type`, `supplier_name`, `remarks`) VALUES ('$id', '$date', '$branch', '$prepared_by', '$type', '$supplier_name', '$remarks')";
	mysql_query($querySummary) or die(mysql_error());

} ?>

<script type= "text/javascript">
	alert("Successful.");
	location.replace('existing_bm.php');
</script>