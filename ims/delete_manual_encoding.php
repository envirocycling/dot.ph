<?php
include('config.php');
$branch=$_POST['branch'];
$from=$_POST['from'];
$to=$_POST['to'];




    if(mysql_query("DELETE FROM outgoing where branch='$branch' and date between '$from' and '$to' and mark ='manually_encoded' ")) {
        echo "<script>";
        echo "alert('Deleted successfully...');";
        echo "window.location='outgoing_report.php';";
        echo "</script>";
    }else {
        echo "<script>";
        echo "alert('Failed to delete records...');";
        echo "window.location='outgoing_report.php';";
        ;
        echo "</script>";
    }



?>