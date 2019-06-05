<?php
session_start();
$date=$_POST['date'];
$grade=$_POST['wp_grade'];


$_SESSION['receiving_date']=$date;
$_SESSION['receiving_grade']=$grade;
header("Location: ".$_SERVER['HTTP_REFERER']);
?>