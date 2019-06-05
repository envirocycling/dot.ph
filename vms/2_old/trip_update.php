<?php
include('connect.php'); 

$day1 = $_POST['day'] + 1;
$day2 = $_POST['day'] + 2;
$in1 =$_POST['out'];
$in2=$_POST['refill'];
$in3 = $_POST['out3'];
$supplier=$_POST['supplier'];
$pno = $_POST['pno'];
$days = $_POST['day'];
$month = $_POST['month'];
$month1 = $_POST['month1'];
$km = $_POST['km'];
$kmlit = $_POST['kmlit'];
$year = $_POST['year'];
$ton = $_POST['ton'];
$out = $_POST['out'];
$in=$_POST['in'];
$refill = $_POST['refill'];
$cost =$_POST['cost'];
$remarks = $_POST['remarks'];
$violation = $_POST['violation'];
$driver = $_POST['driver'];
$helper = $_POST['helper'];

$up = mysql_query("Select * from tbl_trip Where truckid='$pno' And day='$days' And month='$month' And year='$year' ") or die (mysql_error());	

if(mysql_num_rows($up) > 0){
	
	$update = mysql_query("Update tbl_trip SET supplier='$supplier',ton='$ton',ins='$out',outs='$in',refill='$refill',driver='$driver',helper ='$helper',remarks='$remarks',cost='$cost',updates='1',no='$month',km='$km',kmlit='$kmlit', violation='$violation' Where truckid='$pno' And day='$days' And month='$month' And year='$year' ") or die (mysql_error());
	
	$update2 = mysql_query("Update tbl_trip SET ins='$in3' Where truckid='$pno' And day='$day1' And month='$month' And year='$year' ") or die (mysql_error());
	
	$del =mysql_query("Delete from tbl_trip  WHERE day='$day1' and update='0'");
	$ups = mysql_query("Select * from tbl_trip Where truckid='$pno' And day='$day1' And month='$month' And year='$year' ") or die (mysql_error());	
	
	if(mysql_num_rows($ups) == 0){
			$insert2 = mysql_query("Insert into tbl_trip (truckid,day,month,year,ins,updates,no)
			Values ('$pno','$day1','$month','$year','$in3','0','$month1')") or die (mysql_error());
		}

}else {
$insert = mysql_query("Insert into tbl_trip (truckid,day,month,year,supplier,ton,ins,outs,refill,driver,helper,remarks,cost,updates,no,km,kmlit,violation)
Values ('$pno','$days','$month','$year','$supplier','$ton','$out','$in','$refill','$driver','$helper','$remarks','$cost','1','$month1','$km','$kmlit','$violation')") or die (mysql_error());


	}

?>
