<?php
include('connect.php');

@$insurance= $_POST['insurance'];
@$stencil = $_POST['stencil'];
@$emission = $_POST['emission'];

$query = "Update tbl_truckregistration SET insurance='$insurance', stencil='$stencil', emission = '$emission' Where truckid = '".@$_GET['id']."'";
$result = mysql_query($query) or die("Error in query : $query".mysql_error());

//all fileds ok=================================
$all =  "SELECT * FROM tbl_truckregistration Where truckid='".$_GET['id']."'";
$a_result = mysql_query($all) or die("Error in query : $query".mysql_error());
$a_row = mysql_fetch_array($a_result);

if($a_row['insurance'] == "OK" && $a_row['stencil'] == "OK" && $a_row['emission'] == "OK"){
	mysql_query("Update tbl_truckregistration Set status='1' Where truckid='".$_GET['id']."'") or die(mysql_error());
	}

//=============================================
?>
<script>
alert("Update Successful.");
location.replace("registration_monitoring.php");
</script>