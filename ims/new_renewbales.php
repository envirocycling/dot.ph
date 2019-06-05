<?php
include("config.php");

$id = $_GET['id'];
$sql = mysql_query("SELECT * from bales WHERE log_id = $id") or die(mysql_error());
$row = mysql_fetch_array($sql);
$myMonth = date('Y/m/d');
$row_outdate1 = date('Y/m', strtotime("-1 month", strtotime($myMonth)));
$row_outdate = $row_outdate1.'/01';

	mysql_query("UPDATE bales SET str_no='1010101010', out_date='$row_outdate' WHERE log_id=$id") or die (mysql_error());
	mysql_query("INSERT INTO bales (wp_grade, bale_id, bale_weight, str_no, date, branch)
		VALUES ('".$row['wp_grade']."','".$row['bale_id']."', '".$row['bale_weight']."','0','$row_outdate','".$row['branch']."')") or die(mysql_error());		
?>
<script>
	alert("Successful.");
	window.history.back();
</script>