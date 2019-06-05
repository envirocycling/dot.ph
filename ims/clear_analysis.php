<?php
session_start();

$_SESSION['analysis_from']='';
$_SESSION['analysis_to']='';

header("Location:".$_SERVER['HTTP_REFERER']);
?>