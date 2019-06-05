<?php
include("config.php");
$del_id=$_POST['del_id'];
$notation=$_POST['notation'];
if(mysql_query("Update sup_deliveries set notations='$notation' where del_id=$del_id")){
    echo "<script>";
    echo "alert('Inserted successfully...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to insert notation...');";
    echo "window.history.back();";
    echo "</script>";
    
}

?>