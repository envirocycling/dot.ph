<?php
session_start();
$date=$_POST['date'];
$_SESSION['sorting_date']=$date;
header("Location: ".$_SERVER['HTTP_REFERER']);
?>