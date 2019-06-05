<?php
include ("config.php");
$request_id=$_GET['request_id'];
mysql_query("UPDATE requests set status='disapproved' where request_id='$request_id'");
echo "<script>

alert('PR has been disapproved...');
window.location = 'mechanic.php';
</script>";
?>
