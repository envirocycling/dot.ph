<?php
include('connect.php');
$id = $_GET['id'];

	$name=$_POST['tool'];
	$qty = $_POST['qty'];
	
	$update = mysql_query("UPDATE tbl_trucktools SET toolname='$name', qty='$qty' WHERE ti='$id'") or die (mysql_error());
?>
<script>
	window.history.back();
</script>