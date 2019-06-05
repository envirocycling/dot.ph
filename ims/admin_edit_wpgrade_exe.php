<?php


$wp_grade=$_POST['wp_grade'];
$wp_desc=$_POST['wp_desc'];
$grade_id=$_POST['grade_id'];
include ("config.php");
mysql_query("UPDATE wp_grades set wp_grade='$wp_grade',wp_desc='$wp_desc' where grade_id='$grade_id'");


header("Location:".$_SERVER['HTTP_REFERER']);
?>