<?php
session_start();
if(!isset($_SESSION['encoder_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
$year = date('Y');
$query = "Update tbl_truckregistration SET insurance=' ', stencil=' ', emission = ' ', location=' ' , remarks=' ', status='0' Where truckid = '".@$_GET['id']."'";
$result = mysql_query($query) or die("Error in query : $query".mysql_error());

$delete = mysql_query("DELETE from tbl_registration_history WHERE truckid = '".@$_GET['id']."' and date='$year'") or die(mysql_error());
?>
<script>
alert("Registration Canceled Successful.");
location.replace("registration_monitoring.php");
</script>