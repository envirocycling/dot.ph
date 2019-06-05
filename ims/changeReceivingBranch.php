<?php

session_start();
$branch=$_GET['branch'];
$_SESSION['receiving_branch']=$branch;
header('Location:receiving_report.php');

?>