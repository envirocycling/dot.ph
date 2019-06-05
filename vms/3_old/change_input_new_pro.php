<?php
include('connect.php');
echo $_POST['con'];
echo $id =$_GET['id'];
mysql_query("UPDATE tbl_input SET con='".$_POST['con']."'  WHERE truckid='$id'") or die (msql_error());
?>
<script>
	window.history.back();
</script>