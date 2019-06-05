<?php

session_start();
$branch=$_GET['branch'];
$_SESSION['selected_branch']=$branch;

header('Location:prev_inventory_analysis.php');
?>