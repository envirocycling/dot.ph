<?php
$del_id=$_GET['del_id'];
include ('config.php');
if(mysql_query("DELETE FROM incentive_scheme where del_id=$del_id")) {
    echo "<script>";
    echo "alert('Deleted successfully...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to delete record');";
    echo "window.history.back();";
    echo "</script>";
}


?>