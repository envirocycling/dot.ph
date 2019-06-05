<?php

session_start();
$branch=$_GET['branch'];
$_SESSION['pick_up_branch']=$branch;
header('Location:pick_up_report.php');

?>