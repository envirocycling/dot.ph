<?php
include('config.php');
$weight=$_POST['weight'];
$wp_grade=$_POST['wp_grade'];
$period=$_POST['period'];
$branch=$_POST['branch'];
$date=$_POST['date'];


if(mysql_query("INSERT INTO target_receiving (weight,wp_grade,period,branch,date) VALUES ('$weight','$wp_grade','$period','$branch','$date') ")) {
    echo "<script>";
    echo "alert('Recorded Successfully...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to record target...');";
    echo "window.history.back();";
    echo "</script>";
}





?>