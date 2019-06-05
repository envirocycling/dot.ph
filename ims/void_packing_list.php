<?php
session_start();
include("config.php");
$str_no=$_GET['str_no'];
if(mysql_query("UPDATE bales set str_no=0, out_date='' where str_no='$str_no'")) {
    echo "<script>";
    echo "alert('Packing list with number $str_no has been deleted');";
    echo "window.location='bale_list.php';";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to void');";
    echo "window.history.back();";
    echo "</script>";
}

$_SESSION['isall']='no';
$_SESSION['bales_to_pack']=array();
?>