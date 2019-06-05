<?php
 $supplier_id=$_POST['supplier_id'];
 $desc=$_POST['desc'];
include('config.php');
if(mysql_query("UPDATE supplier_details set description='$desc' where supplier_id=$supplier_id")) {
    echo "<script>";
    echo "alert('Supplier $id description has been successfully... The changes will take effect when you reload the page...But to avoid inconvenience, just reload the page once your done updating...');";
    echo "window.close();";
    echo "</script>";

}else {
    echo "<script>";
    echo "alert('Failed update description for supplier $id...');";
    echo "window.close();";
    echo "</script>";
}
?>