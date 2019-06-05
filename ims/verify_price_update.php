<?php
$type=$_GET['type'];
$log_id=$_GET['log_id'];
include('config.php');

if($type=='verify_only') {
    if(mysql_query("UPDATE pricing_against_competitors set verified_status='verified' where log_id=$log_id")) {
        echo "<script>";
        echo "alert('Verified Successfully...');";
        echo "window.history.back();";
        echo "</script>";
    }else {
        echo "<script>";
        echo "alert('Failed to verify request...');";
        echo "window.history.back();";
        echo "</script>";
    }

}else if($type=='approve_only') {
    if(mysql_query("UPDATE pricing_against_competitors set approved_status='approved' where log_id=$log_id")) {
        echo "<script>";
        echo "alert('Approved Successfully...');";
        echo "window.history.back();";
        echo "</script>";

    }else {
        echo "<script>";
        echo "alert('Failed to verify request...');";
        echo "window.history.back();";
        echo "</script>";
    }
}else if($type=='disapprove') {
    if(mysql_query("UPDATE pricing_against_competitors set approved_status='disapproved', verified_status='disapproved' where log_id=$log_id")) {
        echo "<script>";
        echo "alert('Disapproved Successfully...');";
        echo "window.history.back();";
        echo "</script>";
    }else {
        echo "<script>";
        echo "alert('Failed to verify request...');";
        echo "window.history.back();";
        echo "</script>";
    }
}



?>