<?php
session_start();
$date=$_POST['date'];
$_SESSION['pick_up_date']=$date;
header("Location: ".$_SERVER['HTTP_REFERER']);
?>