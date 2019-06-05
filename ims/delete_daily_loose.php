<?php
$log_id=$_GET['log_id'];
include('config.php');
if(mysql_query("DELETE FROM loose_papers where log_id=$log_id")) {
    echo "<script>";
    echo "alert('Deleted successfully...');";
    echo "window.history.back();";

    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to delete daily loose paper...');";
    echo "window.history.back();";

    echo "</script>";
}

?>