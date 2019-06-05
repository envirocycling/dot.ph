<?php
session_start();
include ('config.php');
$log_id=$_GET['log_id'];
$sql_actual = mysql_query("SELECT * from actual WHERE log_id='$log_id'") or die(mysql_error());
	$row_actual =  mysql_fetch_array($sql_actual);	

if(mysql_query("INSERT INTO tbl_deleted_data (str_no, date, delivered_to, plate_number, wp_grade, weight,  branch, mc, dirt, net_weight, comments, trans_id, detail_id, performed_by,table_name) VALUES ('".$row_actual['str_no']."', '".$row_actual['date']."', '".$row_actual['delivered_to']."', '".$row_actual['plate_number']."', '".$row_actual['wp_grade']."', '".$row_actual['weight']."', '".$row_actual['branch']."', '".$row_actual['mc']."', '".$row_actual['dirt']."', '".$row_actual['net_wt']."', '".$row_actual['comments']."', '".$row_actual['trans_id']."', '".$row_actual['detail_id']."', '".$_SESSION['username']."', 'actual')"))){
	mysql_query("DELETE FROM actual where log_id=$log_id"
    echo "<script>";
    echo "alert('Deleted successfully...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to delete record...');";
    echo "window.history.back();";
    echo "</script>";
}

?>