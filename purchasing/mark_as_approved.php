<?php
session_start();
$log_id=$_GET['id'];
include('config.php');
$username=$_SESSION['username'];

$name=$_SESSION['name'];


if(mysql_query("UPDATE check_req set approved_signature='".$name."' where log_id=$log_id")) {
    echo "<script>";
    echo "alert('Check Requesition has been marked as approved...');";
    echo "window.history.back();";
    echo "</script>";

}else {
    echo "<script>";
    echo "alert('Failed to mark Check Requesition as approved...');";
    echo "window.history.back();";
    echo "</script>";
}

?>