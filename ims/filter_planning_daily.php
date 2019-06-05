<?php
session_start();

$_SESSION['planning_date']=$_POST['date'];
header("Location:".$_SERVER['HTTP_REFERER']);


?>