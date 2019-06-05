<?php
include ('config.php');

$str=$_POST['str'];
$date=$_POST['date'];
$trucking=$_POST['trucking'];
$plate_number=$_POST['plate_number'];
$wp_grade=$_POST['wp_grade'];
$weight=$_POST['weight'];
$branch=$_POST['branch'];


if(mysql_query("INSERT INTO outgoing(str,date,trucking,plate_number,wp_grade,weight,branch,mark)   VALUES('$str','$date','$trucking','$plate_number','$wp_grade','$weight','$branch','manually_encoded')")) {
    echo "<script>";
    echo "alert('Outgoing record has been inserted successfully...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to insert record...');";
    echo "window.history.back();";
    echo "</script>";

}





?>