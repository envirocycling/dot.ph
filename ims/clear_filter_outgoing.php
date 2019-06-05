<?php
session_start();

$_SESSION['outgoing_date']=date('Y/m/d');
$_SESSION['outgoing_grade']='';
$_SESSION['delivered_to']='';
header("Location: ".$_SERVER['HTTP_REFERER']);
?>