<?php
session_start();
$answer=$_GET['answer'];
$_SESSION['show_affected_suppliers']=$answer;
$_SESSION['pricing_against_competitors_branch']=$_POST['branch_affected'];
header("Location:".$_SERVER['HTTP_REFERER']);
?>