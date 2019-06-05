<?php
include("config.php");

    $supplier_id = $_POST['supplier_id'];
    $branch = $_POST['branch'];
    $starting_volume = $_POST['starting_volume'];

    mysql_query("INSERT INTO `sup_starting_volume`(`supplier_id`, `starting_volume`, `starting_volume_date`, `branch`)
        VALUES ('$supplier_id','$starting_volume','Avg Last 6 Months',$branch')");
    echo "<script>";
    echo "alert('Updated successfully...');";
    echo "window.close();";
    echo "</script>";


?>