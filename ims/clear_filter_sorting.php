<?php
session_start();

$_SESSION['sorting_date']=date('Y/m');
header("Location: ".$_SERVER['HTTP_REFERER']);
?>