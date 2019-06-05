<?php
session_start();
if(!isset($_SESSION['username']))
header("Location : ../index.php");

include('connect.php');

	$updated= mysql_query("Update tbl_reassign Set approved='1' Where id='".$_GET['id']."'") or die(mysql_error());


?>
<script>
alert("Successful.");
location.replace("truck_reassign.php");
</script>