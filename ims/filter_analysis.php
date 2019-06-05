<?php
session_start();
$from=$_POST['from'];
$to=$_POST['to'];

$_SESSION['analysis_from']=$from;
$_SESSION['analysis_to']=$to;
header("Location:".$_SERVER['HTTP_REFERER']);
?>