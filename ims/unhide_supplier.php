<?php
$supplier_id=$_GET['sup_id'];
include("config.php");
if(mysql_query("UPDATE supplier_details set status='' where supplier_id=$supplier_id")) {
    echo "<script>";
    echo "alert('Supplier $supplier_id has been marked as active...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to unhide Supplier number: $supplier_id');";
    echo "window.history.back();";
    echo "</script>";

}

?>