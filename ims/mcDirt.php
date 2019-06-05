<?php
include('config.php');
$del_id=$_POST['del_id'];
$mc_percentage=$_POST['mc_percentage'];
$dirt_percentage=$_POST['dirt_percentage'];
$mc_weight=$_POST['mc_weight'];
$dirt_weight=$_POST['dirt_weight'];
$corrected_weight=$_POST['corrected_weight'];
$remarks=$_POST['remarks'];



if(mysql_query("UPDATE sup_deliveries set mc_weight='$mc_weight',dirt_weight='$dirt_weight',dirt_percentage='$dirt_percentage',mc_percentage='$mc_percentage',corrected_weight='$corrected_weight',last_remarks='$remarks' where del_id=$del_id")) {
    echo "<script>";
    echo "alert('Corrected Weight has been accounted successfully...');";
     echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to record corrected weight...');";
    echo "window.history.back();";
    echo "</script>";
}


?>