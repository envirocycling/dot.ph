<?php
include('connect.php'); 
$id = $_GET['id'];
$day = $_POST['day'] + 1;
$day2 = $_POST['day'] + 2;
$in1 =$_POST['outs'];
$in2=$_POST['refill'];
$in3 = $in1 + $in2;
$up = mysql_query("Select * from tbl_trip Where truckid='".$_POST['pno']."' And day='".$_POST['day']."' And month='".$_POST['month']."' And year='".$_POST['year']."'") or die (mysql_error());
if(mysql_num_rows($up) > 0){
	$update = mysql_query("Update tbl_trip SET supplier='".$_POST['supplier']."',ton='".$_POST['ton']."',ins='".$_POST['ins']."',outs='".$_POST['outs']."',refill='".$_POST['refill']."',driver='".$_POST['driver']."',helper ='".$_POST['helper']."',remarks='".$_POST['remarks']."',cost='".$_POST['cost']."',updates='1',no='".$_POST['months']."' Where truckid='".$_POST['pno']."' And day='".$_POST['day']."' And month='".$_POST['month']."' And year='".$_POST['year']."' ") or die (mysql_error());
	
	$update2 = mysql_query("Update tbl_trip SET ins='$in3',updates='1' Where truckid='".$_POST['pno']."' And day='$day' And month='".$_POST['month']."' And year='".$_POST['year']."' ") or die (mysql_error());
	}else {
$insert = mysql_query("Insert into tbl_trip (truckid,day,month,year,supplier,ton,ins,outs,refill,driver,helper,remarks,cost,updates,no)
Values ('".$_POST['pno']."','".$_POST['day']."','".$_POST['month']."','".$_POST['year']."','".$_POST['supplier']."',
'".$_POST['ton']."','".$_POST['ins']."','".$_POST['outs']."','".$_POST['refill']."','".$_POST['driver']."','".$_POST['helper']."',
'".$_POST['remarks']."','".$_POST['cost']."','1','".$_POST['months']."')") or die (mysql_error());

$insert2 = mysql_query("Insert into tbl_trip (truckid,day,month,year,ins,refill,updates)
Values ('".$_POST['pno']."','$day','".$_POST['month']."','".$_POST['year']."','$in3','".$_POST['refill']."','1')") or die (mysql_error());

	}
$up2 = mysql_query("Select * from tbl_trip Where truckid='".$_POST['pno']."' And day='$day' And month='".$_POST['month']."' And year='".$_POST['year']."'") or die (mysql_error());	
if(mysql_num_rows($up2) > 0){
	
	$insert3 = mysql_query("Insert into tbl_trip (truckid,day,month,year,ins,refill)
Values ('".$_POST['pno']."','$day2','".$_POST['month']."','".$_POST['year']."','$in3','".$_POST['refill']."')") or die (mysql_error());
	}
	header("Location: trip_new.php?id=$id");
?>
