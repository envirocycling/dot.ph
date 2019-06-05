<?php
$id=$_GET['log_id'];
include('config.php');
if(mysql_query("DELETE FROM monthly_target where log_id=$id")) {
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