<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
$grade=$_GET['grade'];
$_SESSION['selected_grade']=$grade;

header('Location:wp_receiving.php');
?>