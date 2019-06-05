<?php
session_start();
include('connect.php');
 $user = mysql_query("Select * from tbl_users Where username='".$_SESSION['a_username']."'") or die (mysql_error());
 $row = mysql_fetch_array($user);
	$timezone=+8;
 $date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));
$time= gmdate('h:i A',time() + 3600*($timezone));
$sent = "  [".$date."] , [".$time."]";
$id = $_GET['id'];
	$name = $row['Name'];
	$text = $_POST['comment'];

	$insert = mysql_query("Insert into tbl_forrepair (name,text,datetime,truckid) 
	Values('$name','$text','$sent','".$_POST['id']."')") or die(mysql_error());
	header("Location: maintenance_forrepair.php?id=$id");
?>

