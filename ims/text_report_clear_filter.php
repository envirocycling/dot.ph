<?php
session_start();

$_SESSION['text_report_date']=date('Y/m/d');
header("Location: ".$_SERVER['HTTP_REFERER']);
?>