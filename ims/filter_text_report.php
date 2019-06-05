<?php
session_start();
$date=$_POST['date'];
$_SESSION['text_report_date']=$date;
header("Location: ".$_SERVER['HTTP_REFERER']);
?>