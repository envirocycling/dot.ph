<?php
$date=$_POST['date'];
$wp_grade=$_POST['wp_grade'];
$weight=$_POST['loose_weight'];
$passcode=$_POST['passcode'];
$branch=$_POST['branch'];


include("config.php");

if(mysql_query("INSERT INTO loose_papers(date,wp_grade,weight,branch,date_encode)VALUES('$date','$wp_grade','$weight','$branch','".date("Y/m/d")."')")) {
    echo "<script>";
    echo "alert('Loose weight has been accounted...');";
    echo "window.history.back();";
    echo "</script>";

}else {
    echo "<script>";
    echo "alert('Failed to account loose weight');";
    echo "window.history.back();";
    echo "</script>";

}

?>