<?php
session_start();

$_SESSION['receiving_date']=date('Y/m/d');
$_SESSION['receiving_grade']='';
header("Location: ".$_SERVER['HTTP_REFERER']);
?>