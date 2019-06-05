<?php
session_start();
$branch =  $_SESSION['user_branch'];
include('config.php');
$str=$_POST['str_no'];
$bales_to_pack=$_SESSION['bales_to_pack'];
$date_out=$_POST['date_out'];
$date_outs = date('Y/m', strtotime($date_out));
$counter=0;
foreach ($bales_to_pack as $bale_id) {
	$sql_bales  = mysql_query("SELECT * from bales WHERE log_id = '$bale_id'") or die(mysql_error());
	$row_bales = mysql_fetch_array($sql_bales);
	$date_bales = date('Y/m', strtotime($row_bales['date']));
	$myDate_out = $date_outs.'/01';
	$bale_weight = $row_bales['bale_weight'];
	$wp_grade = $row_bales['wp_grade'];
	$bale_ids = $row_bales['bale_id'];
	$str2 = '101010';
	if($date_bales == $date_outs){
			mysql_query("UPDATE bales set str_no='$str',out_date='$date_out' where log_id=$bale_id");	//echo $row_bales['bale_id'];
	}else{
			mysql_query("UPDATE bales set str_no='$str2',out_date='$myDate_out' where log_id=$bale_id");
			mysql_query("INSERT INTO bales (bale_id, bale_weight, wp_grade, str_no, date, branch, out_date)
						VALUES ('$bale_ids', '$bale_weight', '$wp_grade', '$str', '$myDate_out', '$branch', '$date_out')");
						//echo $row_bales['bale_id'].'</ br>';
	}
  
    $counter++;
}
$_SESSION['isall']='no';
$_SESSION['is_unpack_all']='no';
$_SESSION['bales_to_pack']=array();
echo "<script>";
echo "alert('Packing list has been generated...');";
echo "window.location='packing_list.php?str_no=".$str."';";
echo "</script>";

?>