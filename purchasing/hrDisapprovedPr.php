<?php include('config.php');

$request_id = $_GET['request_id'];

mysql_query("UPDATE requests SET status='cancelled' where request_id='$request_id'");

header('Location: hrPending.php');

?>