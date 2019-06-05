<?php
session_start();
include('config.php');

$bales_to_pack=$_SESSION['bales_to_unpack'];

$counter=0;
foreach ($bales_to_pack as $bale_id) {
    mysql_query("UPDATE bales set str_no=0 , out_date='' where log_id=$bale_id");
    $counter++;
}
$_SESSION['isall']='no';
$_SESSION['is_unpack_all']='no';
echo "<script>";
echo "alert('Bales have been removed to their list...');";
echo "window.location='out_bales.php';";
echo "</script>";
?>