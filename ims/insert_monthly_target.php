<?php
$month=$_POST['year']."/".$_POST['month'];
$branch=$_POST['branch'];
$wp_grade=$_POST['wp_grade'];
$tonnage=$_POST['target'];
include('config.php');
if(mysql_query("INSERT INTO monthly_target(month,branch,wp_grade,target) values ('$month','$branch','$wp_grade','$tonnage');")) {
    echo "<script>";
    echo "alert('Inserted successfully...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to insert record...');";
    echo "window.history.back();";
    echo "</script>";

}
?>