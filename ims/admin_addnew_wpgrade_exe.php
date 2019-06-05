<?php
include("config.php");
$wp_grade=$_POST['wp_grade'];
$wp_desc=$_POST['wp_desc'];
mysql_query("INSERT INTO wp_grades(wp_grade,wp_desc) VALUES ('$wp_grade','$wp_desc')");
header("Location:".$_SERVER['HTTP_REFERER']);
?>