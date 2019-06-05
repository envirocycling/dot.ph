<?php

session_start();
$branch=$_GET['branch'];
$_SESSION['tat_branch']=$branch;
header('Location:tat_report.php');

?>