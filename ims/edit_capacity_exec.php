<?php
session_start();
include("config.php");
$supplier_id=$_POST['supplier_id'];
$wp_grade=$_POST['wp_grade'];
$capacity=$_POST['capacity'];
$delivers_to=$_POST['delivers_to'];
$potential_to_lose=$_POST['potential_to_lose'];
$updated_by=$_SESSION['username'];
$date_updated=date('Y/m/d');
$date_effective=$_POST['date_effective'];
$competitor_price=$_POST['competitor_price'];


if(mysql_query("INSERT INTO supplier_capacity (supplier_id,wp_grade,capacity,delivers_to,potential_to_lose,updated_by,date_effective,date_updated,competitor_price)
                                        VALUES('$supplier_id','$wp_grade','$capacity','$delivers_to','$potential_to_lose','$updated_by','$date_effective','$date_updated','$competitor_price');
")) {
    echo "<script>";
    echo "alert('Updated successfully...');";
    echo "window.close();";
    echo "</script>";

}else {
    echo "<script>";
    echo "alert('Failed to update record...');";
    echo "window.history.back();";

    echo "</script>";
}

?>