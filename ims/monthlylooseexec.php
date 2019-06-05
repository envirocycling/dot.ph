<?php
session_start();
include('config.php');
$month=$_POST['month'];
$year=$_POST['year'];
$branch=$_POST['branch'];
$wp_grade=$_POST['wp_grade'];
$weight=$_POST['loose_weight'];
$user=$_SESSION['username'];
$date_encoded=date('Y/m/d');

$month_end_date=$year."/".$month;

    if(mysql_query("INSERT INTO month_end_loose (month_end_date,branch,wp_grade,weight,date_encoded,user)
                                    VALUES('$month_end_date','$branch','$wp_grade','$weight','$date_encoded','$user')
    ")) {
        echo "<script>";
        echo "alert('Month-End Loose weight has been accounted...');";
        echo "window.history.back();";
        echo "</script>";
    }else {
        echo "<script>";
        echo "alert('Failed to account month-end loose...');";
        echo "window.history.back();";
        echo "</script>";
    }

?>