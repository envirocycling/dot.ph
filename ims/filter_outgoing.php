<?php
session_start();
$date=$_POST['date'];
$delivered_to=$_POST['delivered_to'];
$wp_grade=$_POST['wp_grade'];
$_SESSION['outgoing_date']=$date;
$_SESSION['outgoing_grade']=$wp_grade;
$_SESSION['delivered_to']=$delivered_to;
header("Location: ".$_SERVER['HTTP_REFERER']);
?>