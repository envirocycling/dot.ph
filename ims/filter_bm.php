<?php
session_start();
$from=$_POST['from'];
$to=$_POST['to'];
$_SESSION['bm_from']=$from;
$_SESSION['bm_to']=$to;

header("Location:".$_SERVER['HTTP_REFERER']);
?>