<?php
$date_received=$_POST['date_received'];
$priority_number=$_POST['priority_number'];
$supplier_id=$_POST['supplier_id'];
$supplier_name=$_POST['supplier_name'];
$plate_number=$_POST['plate_number'];
$wp_grade=$_POST['wp_grade'];
$corrected_weight=$_POST['corrected_weight'];
$unit_cost=$_POST['unit_cost'];
$branch=$_POST['branch'];
$paper_buying=$_POST['paper_buying'];
include('config.php');
if(mysql_query("INSERT INTO paper_buying (date_received,priority_number,supplier_id,supplier_name,plate_number,wp_grade,corrected_weight,unit_cost,paper_buying,branch,notes)
                                             VALUES('$date_received','$priority_number','$supplier_id','$supplier_name','$plate_number','$wp_grade','$corrected_weight','$unit_cost','$paper_buying','$branch','manually_encoded')")) {
    echo "<script>";
    echo "alert('Inserted successfully...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to insert record...');";
    echo "window.history.back();";
    echo "</script>";
}
?>