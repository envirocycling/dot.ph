<?php

session_start();
$branch=$_GET['branch'];
$_SESSION['paper_buying_branch']=$branch;
header('Location:paper_buying_reports.php');

?>