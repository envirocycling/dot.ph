<?php
date_default_timezone_set("Asia/Singapore");
session_start();
$date = date('Y/m/d');

include('connect.php');

$id = $_POST['id'];
$prepared_by = $_SESSION['bhead_username'];
$branch = $_SESSION['owner'];
$remarks = $_POST['remarks'];

$countExist = mysql_query("SELECT count(`bm_id`) FROM `tbl_bm_givento` WHERE bm_id='$id';");
?>

<?php

if($countExist > 0) {

	$query = "DELETE FROM `tbl_bm_givento` WHERE `bm_id`='$id'";
	mysql_query($query) or die(mysql_error());

	$queryUpdateBm = "UPDATE `tbl_bm_report` SET `cash_bond`='', `quota`='', `supplier_name`='', `status`='terminated' WHERE id='$id';";
	mysql_query($queryUpdateBm) or die(mysql_error());

	$querySummary = "INSERT INTO `tbl_bm_assign_summary`(`bm_id`, `date`, `branch`, `user`, `type`, `remarks`) VALUES ('$id', '$date', '$branch', '$prepared_by', 'terminate', '$remarks');";
	mysql_query($querySummary) or die(mysql_error());

?>

<script type= "text/javascript">
	alert("BM Terminated.");
	location.replace('existing_bm.php');
</script>

<?php } else { ?>

<script type= "text/javascript">
	alert("Failed to terminate.");
	location.replace('existing_bm.php');
</script>

<?php } ?>