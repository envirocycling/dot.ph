<?php
include('config.php');
$del_id=$_POST['del_id'];
$weight=$_POST['weight'];
$remarks=$_POST['remarks'];
$date=$_POST['date'];

if(trim($remarks)!='') {
    $query="SELECT * from sup_deliveries where del_id=$del_id";
    $result=mysql_query($query);
    $current_weight=0;
    if($row = mysql_fetch_array($result)) {
        $current_weight=$row['weight'];
    }
    $weight_to_update=0;
    $weight_to_update=$current_weight-$weight;
    $remarks=$remarks." last ".$date;
    if(mysql_query("UPDATE sup_deliveries set weight='$weight_to_update',remarks='$remarks' where del_id=$del_id")) {
        echo "<script>";
        echo "alert('Backload has been accounted successfully...');";
        echo "window.history.go(-2);";
        echo "</script>";
    }else {
        echo "alert('Failed to record backload details...');";
        echo "window.history.back();";
        echo "</script>";
    }

}else {
    echo "<script>";
    echo "alert('Please fill out all the fields properly...');";
    echo "window.history.back();";
    echo "</script>";

}
?>