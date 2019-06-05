<?php
$id=$_POST['report_id'];
$action_taken=$_POST['action_taken'];
$date_updated=$_POST['date_updated'];
include('config.php');
mysql_query("UPDATE delinquencies set action_taken='$action_taken' , status='Action Taken',date_updated='$date_updated' where report_id='$id'");
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>