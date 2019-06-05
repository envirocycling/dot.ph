<?php
session_start();

$_SESSION['pick_up_date']=date('Y/m');
header("Location: ".$_SERVER['HTTP_REFERER']);
?>