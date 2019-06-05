<?php
session_start();
require_once 'connection.php';

$from_id = $_POST['from_id'];
$message = $_POST['message'];
$to_id = $_POST['to_id'];
$date = date("Y/m/d h:i A");

$sql = "INSERT INTO messages
	(from_id, to_id, content, time)
	VALUES
	(:a,:b,:c,:d)";
$qry = $con->prepare($sql);
$qry->execute(array(':a'=>$from_id,':b'=>$to_id,':c'=>$message,':d'=>$date));

?>