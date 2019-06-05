<?php
session_start();
include 'config.php';
if (isset ($_GET['trans_id'])) {
    $que = $_GET['trans_id'];
    $details = preg_split("/[_]/",$que);
    $sup_id = $details[0];
    $oot_id = $details[1];
    $oot_name = $details[2];
    mysql_query("UPDATE sup_deliveries SET supplier_id='$oot_id',supplier_name='$oot_name' WHERE supplier_id='$sup_id'");
    mysql_query("DELETE FROM supplier_details WHERE supplier_id='$sup_id'");
    echo "<script>";
    echo "alert('Successfully Added.');";
    echo "window.close();";
    echo "</script>";
}
if (isset ($_GET['del_id'])) {
    echo "<script>";
    echo "window.close();";
    echo "</script>";
}
$branch = $_SESSION['user_branch'];
$ott = "One Time Transaction ".$branch;
$sql = mysql_query("SELECT * FROM supplier_details WHERE supplier_name='$ott'");
$count = mysql_num_rows($sql);
if ($count == '1') {
    $rs = mysql_fetch_array($sql);
    $ott_id = $rs['supplier_id'];
    $ott_name = $rs['supplier_name'];
    $que = $_GET['sup_id'];
    $details = preg_split("/[_]/",$que);
    $sup_id = $details[0];
    $sup_name = $details[1];
    $trans_id = $sup_id."_".$ott_id."_".$ott_name;
    echo "<br>";
    echo "<h3>Are you sure you want to add $que to One Time Transaction $branch?</h3>";
    echo "<a href='one_time_transaction.php?trans_id=$trans_id'><button>Yes</button></a>&nbsp;&nbsp;&nbsp;
    <a href='one_time_transaction.php?del_id=$que'><button>No</button></a>";
} else {
    echo "<br>";
    echo "<h3>You dont have an One Time Transaction Supplier ID, Please contact the programmer to get an id for your One Time Transaction Supplier.</h3>";
}
?>