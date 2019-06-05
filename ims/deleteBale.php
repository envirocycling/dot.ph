<?php
session_start();
$log_id=$_POST['log_id'];
$branch =  $_SESSION['user_branch'];
$passcode=$_POST['passcode'];
$date_rebaled=$_POST['date_rebaled'];
$myDate_rebale = date('Y/m', strtotime($date_rebaled));
include('config.php');
$sql_bale = mysql_query("SELECT * from bales WHERE log_id = '$log_id'") or die(mysql_error());
$row_bale = mysql_fetch_array($sql_bale);
$myDate = date('Y/m', strtotime($row_bale['date']));
$myDate2 = date('Y/m/t', strtotime($row_bale['date']));
$bale_ids = $row_bale['bale_id'];
$bale_weight = $row_bale['bale_weight'];
$wp_grade = $row_bale['wp_grade'];
$strs = '101010';

if($passcode=='a') {
	if($myDate == $myDate_rebale){
			if(mysql_query("UPDATE bales set  date_rebaled='$date_rebaled', out_date='$date_rebaled', str_no='$strs' where log_id=".$log_id.";")) {
				echo "<script>";
				echo "alert('Bale has been destroyed successfully...');";
				echo "window.history.go(-2);";
				echo "</script>";
			}else {
				echo "<script>";
				echo "alert('Failed to destroy bale...');";
				echo "window.history.go(-2);";
				echo "</script>";
			}
	}else{
			mysql_query("UPDATE bales set out_date='$myDate2', str_no='$strs' where log_id='$log_id'") or die (mysql_error());
			mysql_query("INSERT INTO bales (bale_id, bale_weight, wp_grade, str_no, date, branch, out_date, date_rebaled)
						VALUES ('$bale_ids', '$bale_weight', '$wp_grade', '$strs', '$myDate2', '$branch', '$date_rebaled', '$date_rebaled')");
				echo "<script>";
				echo "alert('Bale has been destroyed successfully...');";
				echo "window.history.go(-2);";
				echo "</script>";


	}
}else {
    echo "<script>";
    echo "alert('Invalid code...');";
    echo "window.history.go(-2);";
    echo "</script>";

}
?>