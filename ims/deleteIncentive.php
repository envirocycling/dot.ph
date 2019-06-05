<?php
$del_id=$_GET['del_id'];
include ('config.php');
$num = 0;
$err = 0;

$sql_inc = mysql_query("SELECT * from incentive_scheme WHERE del_id=$del_id") or die(mysql_error());
$row_inc = mysql_fetch_array($sql_inc);
if($row_inc['wp_grade'] != 'all_grades'){
	$sql_paper = mysql_query("SELECT * from paper_buying WHERE supplier_id='".$row_inc['sup_id']."' and date_received >='".$row_inc['start_date']."' and date_received <='".$row_inc['end_date']."' and wp_grade='".$row_inc['wp_grade']."'") or die(mysql_error());
}else{
	$sql_paper = mysql_query("SELECT * from paper_buying WHERE supplier_id='".$row_inc['sup_id']."' and date_received >='".$row_inc['start_date']."' and date_received <='".$row_inc['end_date']."'") or die(mysql_error());
}
while($row_paper = mysql_fetch_array($sql_paper)){
	if(mysql_query("UPDATE paper_buying SET prev_unit_cost='', unit_cost='".$row_paper['prev_unit_cost']."' WHERE log_id='".$row_paper['log_id']."'")){
		$num++;
		echo $row_paper['prev_unit_cost'].'-'.$row_paper['log_id'].'<br />';
	}else{
		$err++;
		echo '-error-';
	}
}

if($err == 0) {
	mysql_query("DELETE FROM incentive_scheme where del_id=$del_id");
    echo "<script>";
    echo "alert('Deleted successfully...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to delete record');";
    echo "window.history.back();";
    echo "</script>";
}


?>