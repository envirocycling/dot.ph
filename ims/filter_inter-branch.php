<?php
session_start();
$_SESSION['inter-branch_from']=$_POST['from'];
$_SESSION['inter-branch_to']=$_POST['to'];
header("Location:".$_SERVER['HTTP_REFERER']);

?>