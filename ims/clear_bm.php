<?php
session_start();

$_SESSION['bm_from']='';
$_SESSION['bm_to']='';

header("Location:".$_SERVER['HTTP_REFERER']);
?>