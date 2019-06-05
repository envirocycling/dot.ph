<?php
session_start();
include('config.php');
if (isset ($_GET['id'])) {
    $log_id=$_GET['id'];
    $username=$_SESSION['username'];

    $name=$_SESSION['name'];

    if(mysql_query("UPDATE fund_req set audited_signature='".$name."',status='audited' where log_id=$log_id")) {
        echo "<script>";
        echo "alert('Check Requesition has been marked as audited...');";
        echo "window.history.back();";
        echo "</script>";

    }else {
        echo "<script>";
        echo "alert('Failed to mark Check Requesition as audited...');";
        echo "window.history.back();";
        echo "</script>";
    }
} else {
    $log_id=$_GET['del_id'];
    $username=$_SESSION['username'];

    if(mysql_query("UPDATE fund_req set audited_signature='',status='' where log_id=$log_id")) {
        echo "<script>";
        echo "alert('Check Requesition has been marked as unaudited...');";
        echo "window.history.back();";
        echo "</script>";

    }else {
        echo "<script>";
        echo "alert('Failed to mark Check Requesition as audited...');";
        echo "window.history.back();";
        echo "</script>";
    }
}


?>