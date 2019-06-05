<?php
session_start();
$branch=$_GET['branch'];
$_SESSION['selected_branch']=$branch;

header('Location:text_report.php');
?>