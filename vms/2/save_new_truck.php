<?php
session_start();

include('../connect.php');
//vehicles info
$branch = strtoupper($_POST['branch']);
$ownersname= strtoupper($_POST['ownersname']);
$truckplate1 =strtoupper($_POST['truckplate']);

$truckplate2 =trim($truckplate1," ");
preg_match_all('/(\d)|(\w)/', $truckplate2, $matches);

$numbers = implode($matches[1]);
$letters = implode($matches[2]);

$truckplate = $letters . " " . $numbers;
$ending = $_POST['ending'];
$quisition = $_POST['aquisitioncost'];
$net = $_POST['netbookvalue'];
$amount = $_POST['amount'];
$class = $_POST['class'];
@$suppliername = $_POST['suppliername'];
$truckcondition = strtoupper($_POST['truckcondition']);
$make = strtoupper($_POST['make']);
$series = strtoupper($_POST['series']);
$bodytype = strtoupper($_POST['bodytype']);
$yearmodel = strtoupper($_POST['yearmodel']);
@$timezone=+8;
@$date= gmdate('Y-m-d',time() + 3600*($timezone+date("I")));
$date_purchased = $_POST['date'];
$soSched = @$_POST['soSched'];

//vehicle info
$selectplate = mysql_query("Select * from tbl_truck_report Where truckplate='$truckplate'") or die (mysql_error());
$r_selectplate = mysql_fetch_array($selectplate);
if(mysql_num_rows($selectplate) > 0){
	?>
<script type= "text/javascript">
	alert("Truck Already Exist.");
	window.history.back();
	// location.replace('new_truck.php');
</script>
<?php 
	}else{

$new = 
mysql_query("Insert Into tbl_truck_report (date_purchased,branch,ownersname,suppliername,truckplate,ending,make,series,bodytype,yearmodel,aquisitioncost,netbookvalue,amount,truckcondition,dateadded,wheels,class,coSet)
	Values ('$date_purchased', '$branch','$ownersname','$suppliername','$truckplate','$ending','$make','$series','$bodytype','$yearmodel','$quisition','$net','$amount','$truckcondition','$date','".$_POST['wheels']."','$class','$soSched')") or die(mysql_error());
	
	
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
	
	

	?>
<script type= "text/javascript">
	alert("Truck Added Successfully.");
	location.replace('new_truck.php');
</script>
<?php } ?>