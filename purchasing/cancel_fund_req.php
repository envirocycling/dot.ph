<?php
$check_req_id=$_GET['check_req_id'];
include('config.php');

if(mysql_query("DELETE FROM fund_req where log_id=$check_req_id")) {
    echo "<script>";
    echo "alert('Deleted successfully...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to delete record...');";
    echo "window.history.back();";
    echo "</script>";
}

?>