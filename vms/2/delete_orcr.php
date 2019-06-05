<?php
session_start();
?>
<?php
include('connect.php');
$id=$_GET['id'];
mysql_query("Update tbl_truckorcr Set location='' Where location='".$_POST['name']."'");
unlink("../orcr/".$_POST['name']);
?>
<script>
	alert("Successful");
	window.close();
</script>