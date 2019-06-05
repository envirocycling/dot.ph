
<?php
session_start();
?>
<?php
include('connect.php');
//pageload=======================

$timezone=+8;
$year= gmdate('Y',time() + 3600*($timezone+date("I")));

$query = "Update tbl_truckregistration SET insurance='OK', stencil='OK', emission = 'OK', location='".$_POST['location']."' , remarks='".$_POST['remarks']."', status='1', year='$year' Where truckid = '".@$_GET['id']."'";
$result = mysql_query($query) or die("Error in query : $query".mysql_error());

?>
<script>
alert("Registration Successful.");
location.replace("registration_monitoring.php");
</script>