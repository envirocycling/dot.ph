<?php
include('config.php');
$id=$_GET['grade_id'];
mysql_query("DELETE FROM wp_grades where grade_id='$id'");
header("Location:".$_SERVER['HTTP_REFERER']);
?>