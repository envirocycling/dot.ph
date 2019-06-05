<?php
include('connect.php');
//vehicles info
$branch = $_POST['branch'];
$ownersname= $_POST['ownersname'];
 $truckplate =$_POST['truckplate'];
 $ending = $_POST['ending'];
$quisition = $_POST['aquisitioncost'];
$net = $_POST['netbookvalue'];
$amount = $_POST['amount'];
$truckcondition = $_POST['truckcondition'];
@$timezone=+8;
@$date= gmdate('Y-m-d',time() + 3600*($timezone+date("I")));

//vehicle info
$new = 
mysql_query("Insert Into tbl_truck_report (branch,ownersname,truckplate,ending,aquisitioncost,netbookvalue,amount,truckcondition,dateadded)
	Values ('$branch','$ownersname','$truckplate','$ending','$quisition','$net','$amount','$truckcondition','$date')");
	
	
$res =("Select * from tbl_truck_report Order by id Desc LIMIT 1 ");
	$results = mysql_query($res) or die(mysql_error());
	$row=mysql_fetch_array($results);
	
$given=mysql_query("Insert Into tbl_givento (truckid)
	Values ('".$row['id']."')");	
	
$orcr=mysql_query("Insert Into tbl_truckorcr (truckid)
	Values ('".$row['id']."')");	
	
$deed=mysql_query("Insert Into tbl_truckdeedofsale (truckid)
	Values ('".$row['id']."')");	
	
$reg=mysql_query("Insert Into tbl_truckregistration (truckid)
	Values ('".$row['id']."')");	
	
$bat=mysql_query("Insert Into tbl_truckbattery (truckid)
	Values ('".$row['id']."')");	
	
	

	?>
<script type= "text/javascript">
	alert("Truck Added Successfully.");
	location.replace('new_truck.php');
</script>