<?php
session_start();
?>
<?php
include('connect.php');

@$insurance= $_POST['insurance'];
@$stencil = $_POST['stencil'];
@$emission = $_POST['emission'];
@$location = $_POST['location'];
@$remarks = $_POST['remarks'];

$query = "Update tbl_truckregistration SET insurance='$insurance', stencil='$stencil', emission = '$emission', location='$location', remarks='$remarks' Where truckid = '".@$_GET['id']."'";
$result = mysql_query($query) or die("Error in query : $query".mysql_error());

//all fileds ok=================================
$all =  "SELECT * FROM tbl_truckregistration Where truckid='".$_GET['id']."'";
$a_result = mysql_query($all) or die("Error in query : $query".mysql_error());
$a_row = mysql_fetch_array($a_result);


//=============================================
?>
<script>
alert("Update Successful.");
location.replace("registration_monitoring.php");
</script>