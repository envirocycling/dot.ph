<?php
session_start();
include 'config.php';
$branch = $_POST['branch'];
$wp_grade = $_POST['wp_grade'];
$addtl_price = $_POST['addtl_price'];
$expctd_vol = $_POST['expctd_vol'];
$date = $_POST['date'];

mysql_query("DELETE FROM weekly_target WHERE branch='$branch' and wp_grade='$wp_grade' and date_effective='$date'");
mysql_query("INSERT INTO `weekly_target`(`branch`, `target`, `unit_cost`, `wp_grade`, `date_effective`, `date_updated`, `updated_by`)
    VALUES ('$branch','$expctd_vol','$addtl_price','$wp_grade','$date','".date("Y/m/d")."','".$_SESSION['username']."')");

?>