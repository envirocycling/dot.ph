<?php
include("connect.php");
$id = $_POST['id'];
$truckid = $_POST['truckid'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$supplier = $_POST['supplier'];
$ton = $_POST['ton'];
$remarks = $_POST['remarks'];
$ins = $_POST['ins'];
$outs = $_POST['outs'];
$refill = $_POST['refill'];
$cost = $_POST['cost'];
$driver = $_POST['helper'];
$updates = $_POST['updates'];
$no = $_POST['no'];
$km = $_POST['km'];
$kmlit = $_POST['kmlit'];


	if(mysql_query("INSERT INTO tbl_trip (truckid,day,month,year,supplier,ton,remarks,ins,outs,refill,cost,driver,updates,no,km,kmlit)
		VALUES ('$truckid','$day','$month','$year','$supplier','$ton','$remarks','$ins','$outs','$refill','$cost','$driver','$updates','$no','$km','$kmlit')") or die(mysql_error())){
		echo '<script>
					location.replace("http://192.168.10.201/tms/update_encoded.php?update=ok&id='.$id.'");
			</script>';	
	}else{
		echo '<script>
					location.replace("http://192.168.10.201/tms/update_encoded.php");
			</script>';	
	}
?>