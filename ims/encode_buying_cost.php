<?php
session_start();
include('config.php');
$month=$_POST['month'];
$year=$_POST['year'];
$branch=$_POST['branch'];
$wp_grade=$_POST['wp_grade'];

$avg_cost=$_POST['avg_cost'];
$date_encoded=date('Y/m/d');
$user=$_SESSION['username'];
$month=$year."/".$month;

if(mysql_query("INSERT INTO buying_cost (month,year,branch,wp_grade,cost,enc_date,enc_by)
                                    VALUES('$month','$year','$branch','$wp_grade','$avg_cost','$date_encoded','$user')
")) {
    echo "<script>";
    echo "alert('Average buying cost has been recorded...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to record buying cost...');";
    echo "window.history.back();";
    echo "</script>";
}

?>