<?php
session_start();
$date=$_POST['date'];
$paper_buying_grade = $_POST['wp_grade'];
$_SESSION['paper_buying_date']=$date;
$_SESSION['paper_buying_grade']=$paper_buying_grade;
header("Location: ".$_SERVER['HTTP_REFERER']);
?>