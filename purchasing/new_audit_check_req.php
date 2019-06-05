<?php

session_start();
$log_id = $_GET['id'];
$type = $_GET['type'];
include('config.php');
$username = $_SESSION['username'];
$name = $_SESSION['name'];
if ($type == 'auditor') {
    if (mysql_query("UPDATE check_req set audited_signature='" . $name . "',status='approved' where log_id=$log_id")) {
        echo "<script>";
        echo "alert('Check Requesition has been marked as audited...');";
        echo "window.history.back();";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert('Failed to mark Check Requesition as audited...');";
        echo "window.history.back();";
        echo "</script>";
    }
}
if ($type == 'approver') {
    if (mysql_query("UPDATE check_req set approved_signature='" . $name . "',status='approved' where log_id=$log_id")) {
        echo "<script>";
        echo "alert('Check Requesition has been marked as approved...');";
        echo "window.history.back();";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert('Failed to mark Check Requesition as approved...');";
        echo "window.history.back();";
        echo "</script>";
    }
}
?>