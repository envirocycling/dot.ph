<?php
$id=$_GET['id'];
include('config.php');
if(mysql_query("UPDATE supplier_details set status='inactive', branch_update='' where supplier_id=$id")) {
    echo "<script>";
    echo "alert('Supplier $id has been hidden successfully... The changes will take effect when you reload the page...But to avoid inconvenience, just reload the page once your done updating...');";
    echo "window.close();";
    echo "</script>";

}else {
    echo "<script>";
    echo "alert('Failed hide supplier $id...');";
    echo "window.close();";
    echo "</script>";
}
?>  