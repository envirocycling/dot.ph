<?php
session_start();
$_SESSION['pricing_against_competitors_start_date']=$_POST['start_date'];
$_SESSION['pricing_against_competitors_end_date']=$_POST['end_date'];
header("LOCATION:dashboard_pricing_competitors_report.php");
?>