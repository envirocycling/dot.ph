<?php
session_start();
include('config.php');
echo "<h1>Loading... Please wait...   :)</h1>";
foreach($_SESSION['outgoing_log_ids'] as $log_id) {
    $query="SELECT is_marked FROM outgoing where log_id=$log_id";
    $result=mysql_query($query);
    if($row = mysql_fetch_array($result)) {
        $mark="";
        if($row['is_marked']!='!') {
            $mark='!';
        }else {
            $mark="";
        }

        mysql_query("UPDATE outgoing set is_marked='$mark' where log_id=$log_id");
        echo "<script>";
        echo "window.history.back();";
        echo "</script>";

    }else {
        echo "<script>";
        echo "alert('Failed to highlight records...');";
        echo "window.history.back();";
        echo "</script>";
    }

}
echo "<script>";
echo "alert('No record to highlight...');";
echo "window.history.back();";
echo "</script>";



?>