<?php

session_start();
$branch=$_GET['branch'];
$_SESSION['selected_branch']=$branch;

if($branch=='Pasay' || $branch=='Pampanga' || $branch=='Makati') {
    header('Location:p_inventory_analysis.php');
}else {
    header('Location:inventory_analysis.php');

}
?>