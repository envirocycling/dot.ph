<?php
include('config.php');

$from=$_POST['from'];
$to=$_POST['to'];


if(mysql_query("DELETE FROM actual where  date between '$from' and '$to'  and dr_number!=''")) {
    echo "<script>";
    echo "alert('Deleted successfully...');";
    echo "window.location='admin_outgoing_management.php';";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to delete records...');";
    echo "window.location='admin_outgoing_management.php';";

    echo "</script>";
}


?>