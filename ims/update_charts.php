<?php
session_start();
 $date=$_POST['date'];
$date_array=preg_split("[/]",$date);
 $month=$date_array[0]."/".$date_array[1];



$_SESSION['planning_month']=$month;
$_SESSION['planning_as_of']=$date;

header("Location:".$_SERVER['HTTP_REFERER']);



?>