<?php
include("config.php");

    $supplier_id = $_POST['supplier_id'];
    $branch = $_POST['branch'];
    $starting_volume = $_POST['starting_volume'];
    
    mysql_query("UPDATE sup_starting_volume SET starting_volume='$starting_volume', starting_volume_date='Avg Last 6 Months' WHERE supplier_id='$supplier_id'");
   
    echo "<script>";
    echo "alert('Updated successfully...');";
    echo "window.close();";
    echo "</script>";


?>