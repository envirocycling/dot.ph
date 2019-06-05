
<?php
session_start();
if(!isset($_SESSION['encoder_username'])){
	header("Location: ../index.php");
	}
?>
<?php
include('connect.php');
//pageload=======================

$timezone=+8;
$year= gmdate('Y',time() + 3600*($timezone+date("I")));

$query = "Update tbl_truckregistration SET insurance='OK', stencil='OK', emission = 'OK', location='".$_POST['location']."' , remarks='".$_POST['remarks']."', status='1', year='$year' Where truckid = '".@$_GET['id']."'";
$result = mysql_query($query) or die("Error in query : $query".mysql_error());

$insert = mysql_query("INSERT INTO tbl_registration_history (truckid,date,status) VALUES('".$_GET['id']."','$year','Registered')") or die(mysql_error());

?>
<script>
alert("Registration Successful.");
location.replace("registration_monitoring.php");
</script>