<?php
include "config.php";
$supplier_id=$_POST['supplier_id'];
$classification = $_POST['character'];
//$sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$supplier_id'");
//$rs_sup = mysql_fetch_array($sql_sup);
//if ($rs_sup['classification'] != $classification) {
//    if ($rs_sup['classification_history'] == '') {
//        $history = $rs_sup['classification']."_".$classification."|".date("Y/m/d");
//    } else {
//        $history = $rs_sup['classification_history']."_".$classification."|".date("Y/m/d");
//    }
//    mysql_query("Update supplier_details set classification='$classification',classification_history='$history',style='$classification' where supplier_id=$supplier_id");
//    echo "<script>";
//    echo "alert('Updated successfully...');";
//    echo "window.close();";
//    echo "</script>";
//} else {

$sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$supplier_id'");
$rs_sup = mysql_fetch_array($sql_sup);
if ($rs_sup['classification'] != $classification) {
    mysql_query("INSERT INTO sup_class_movement (`supplier_id`, `classification`, `date`)
                VALUES ('$supplier_id','$classification','".date("Y/m/d")."')");


    mysql_query("Update supplier_details set classification='$classification',style='$classification',date_updated='".date("Y/m/d")."' where supplier_id=$supplier_id");
    echo "<script>";
    echo "alert('Updated successfully...');";
    echo "window.close();";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('No Changes.');";
    echo "window.location='frmEditCharacter.php?id=$supplier_id';";
    echo "</script>";
}
//}

?>
