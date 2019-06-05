<?php
include('connect.php');
//pageload=======================

$query = "Update tbl_truckregistration SET insurance='OK', stencil='OK', emission = 'OK', location='".$_POST['location']."' , remarks='".$_POST['remarks']."', status='1' Where truckid = '".@$_GET['id']."'";
$result = mysql_query($query) or die("Error in query : $query".mysql_error());

?>
<script>
alert("Registration Successful.");
location.replace("registration_monitoring.php");
</script>