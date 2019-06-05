<?php
session_start();

$_SESSION['tat_date']=date('Y/m/t');
header("Location: ".$_SERVER['HTTP_REFERER']);
?>