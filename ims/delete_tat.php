<?php
include('config.php');
$branch=$_POST['branch'];
$from=$_POST['from'];
$to=$_POST['to'];


if(mysql_query("DELETE FROM tat where branch='$branch' and date between '$from' and '$to'  ")) {
    echo "<script>";
    echo "alert('Deleted successfully...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to delete records...');";
    echo "window.history.back();";
    echo "</script>";
}


?>