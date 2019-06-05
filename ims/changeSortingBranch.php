<?php

session_start();
$branch=$_GET['branch'];
$_SESSION['sorting_branch']=$branch;
header('Location:sorting_report.php');

?>