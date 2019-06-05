<?php
include('connect.php');
$tire_id = $_GET['tireid'];
$tire_status = $_GET['status'];
$truck_plate = $_GET['plate_id'];


if($tire_status == 'new'){

echo $brand = $_POST['brand'];
echo $code = $_POST['code'];
echo $part = $_POST['part'];
echo $date = $_POST['date'];

$chk_tire =  mysql_query("SELECt * from tbl_trucktires WHERE tireid = '$tire_id' and truckplate = '$truck_plate'") or die(mysql_error());
if(mysql_num_rows($chk_tire) == 0){
	mysql_query("INSERT INTO tbl_trucktires (tireid,truckplate,tirename,tiresize,description,dateadded) VALUES('$tire_id','$truck_plate','$brand','$code','$part','$date')") or die (mysql_error());
}else{
	mysql_query("UPDATE tbl_trucktires SET tirename='$brand', tiresize='$code', description='$part', dateadded='$date'") or die(mysql_error());
}
?>		<script>
			alert("Successful.");
			window.close();
		</script>
<?php
}else if($tire_status == 'change'){

$reason = $_POST['reason_change'];
$brand = $_POST['brand_change'];
$code = $_POST['code_change'];
$part = $_POST['part_change'];
$date = $_POST['date_change'];

$select_tire = mysql_query("SELECT * from tbl_trucktires WHERE tireid='$tire_id' and truckplate='$truck_plate'") or die(mysql_error());
$tire_row = mysql_fetch_array($select_tire);

$date1 = $tire_row['dateadded'];
$date2 = $date;

$ts1 = strtotime($date1);
$ts2 = strtotime($date2);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$day1 = date('d', $ts1);
$day2 = date('d', $ts2);
if($day1 > $day2){
$day = $day1 - $day2;
}else{
$day = $day2 - $day1;
}

$number = cal_days_in_month(CAL_GREGORIAN, $month2, $year2);

$num = $number/$day;
$num1 = round($day,2);

$lifespan = (($year2 - $year1) * 12) + ($month2 - $month1) + $num1;

	
	mysql_query("INSERT INTO tbl_changeswaps (tireid,truckid,tirename,tiresize,description,dateadded,reason,date_change,lifespan,remarks) VALUES('".$tire_row['tireid']."','".$tire_row['truckplate']."','".$tire_row['tirename']."','".$tire_row['tiresize']."','".$tire_row['description']."','".$tire_row['dateadded']."','$reason','$date','$lifespan','change')") or die (mysql_error());
	mysql_query("UPDATE tbl_trucktires SET truckplate='$truck_plate',tirename='$brand',tiresize='$code',description='$part',dateadded='$date' WHERE tireid='$tire_id' and truckplate='$truck_plate'") or die (mysql_error());
	?>
	<script>
			alert("Successful.");
			window.close();
		</script>
<?php
}else if($tire_status == 'swap'){
$swap_id = $_POST['swap_tire'];
$swap_reason = $_POST['swap_reason'];
$swap_date = $_POST['swap_date'];

	mysql_query("UPDATE tbl_trucktires SET swap_to='' WHERE truckplate='$truck_plate' and (tireid='$tire_id' or tireid='$swap_id')") or die (mysql_error());
	mysql_query("UPDATE tbl_trucktires SET tireid='$swap_id',swap_to='$tire_id',reason='$swap_reason',date_swap='$swap_date' WHERE truckplate='$truck_plate' and tireid='$tire_id'") or die (mysql_error());
	mysql_query("UPDATE tbl_trucktires SET tireid='$tire_id',swap_to='$swap_id' WHERE truckplate='$truck_plate' and tireid='$swap_id' and swap_to='' ") or die (mysql_error());
	
	$my_tire = mysql_query("SELECT * from tbl_changeswaps WHERE tireid='$tire_id' and truckid='$truck_plate'") or die (mysql_error());
		while($my_row = mysql_fetch_array($my_tire)){
			mysql_query("UPDATE tbl_changeswaps SET tireid='$swap_id' WHERE tireid='$tire_id' and truckid='$truck_plate'") or die (mysql_error());
		}
	mysql_query("INSERT INTO tbl_changeswaps (tireid,truckid,reason,date_change,swapto) VALUES('$swap_id','$truck_plate','$swap_reason','$swap_date','$tire_id')") or die (mysql_error());
	?>
		<script>
			alert("Successful.");
			window.close();
		</script>
	<?php
}
?>
 
