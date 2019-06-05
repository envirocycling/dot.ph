<?php
$date=$_POST['date'];
$wp_grade=$_POST['wp_grade'];
$weight=$_POST['adjustment'];
$desc=$_POST['desc'];
$branch=$_POST['branch'];


include("config.php");

if(mysql_query("INSERT INTO adjustment(date,description,wp_grade,weight,branch)VALUES('$date','$desc','$wp_grade','$weight','$branch')")) {
    echo "<script>";
    echo "alert('Adjustment entry has been entered successfully...');";
    echo "window.history.back();";
    echo "</script>";

}else {
    echo "<script>";
    echo "alert('Failed to account adjustment entry');";
    echo "window.history.back();";
    echo "</script>";

}

?>