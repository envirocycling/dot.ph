<?php
include('config.php');
$passcode=$_POST['passcode'];
$bale_id=$_POST['bale_id'];
$log_id=$_POST['log_id'];
$bale_weight=$_POST['bale_weight'];
$wp_grade=$_POST['wp_grade'];
//if($passcode=='supervisory123') {
    if(mysql_query("UPDATE bales set bale_id='$bale_id',bale_weight='$bale_weight',wp_grade='$wp_grade' where log_id='$log_id'")) {
        echo "<script>";
        echo "alert('Updated Successfully...');";
        echo "window.history.go(-2);";
        echo "</script>";
    }else {
        echo "<script>";
        echo "alert('Failed to Update Bale Details...');";
        echo "window.history.go(-2);";
        echo "</script>";

    }
	/*
}else {
    echo "<script>";
    echo "alert('Invalid Supervisor Code...');";
    echo "window.history.go(-2);";
    echo "</script>";
}
*/

?>