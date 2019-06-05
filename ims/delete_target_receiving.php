<?php
include('config.php');
$log_id=$_GET['log_id'];
if(mysql_query("DELETE FROM target_receiving where log_id=$log_id")) {
    echo "<script>";
    echo "alert('Deleted Successfully...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to delete record...');";
    echo "window.history.back();";
    echo "</script>";
}
?>