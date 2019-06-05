<?php
include('connect.php');
$id =$_GET['id'];
mysql_query("DELETE from tbl_trip WHERE id='$id'") or die (mysql_error());
?>
<script>
        alert("Successful. Please Refresh.");
	window.history.back();
</script>
