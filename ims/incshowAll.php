<?php
session_start();
$_SESSION['inc_criteria_status']='';
$_SESSION['inc_criteria_grade']=$_POST['wp_grade']='';

header("Location:".$_SERVER['HTTP_REFERER']);


?>