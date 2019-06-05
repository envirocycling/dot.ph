<?php
session_start();
date_default_timezone_set("Asia/Singapore");
if(!isset($_SESSION['encoder_username'])){
	header("Location: ../index.php");
	}
$date = date('Y/m/d');
?>
<?php
	include('connect.php');

		@$id=$_POST['truckid'];
		@$reason = $_POST['reason'];
		@$ref_no = $_POST['ref_no'];
		@$ca_m=$_POST['cashbond_month'];
		@$a_m=$_POST['amortization_month'];
		@$class=$_POST['class'];
		@$suppliername = $_POST['suppliername'];
		@$issuance = $_POST['issuancedate'];
		@$enddate = $_POST['enddate'];
		@$amortization = $_POST['amortization'];
		@$cashbond = $_POST['cashbond'];
		@$volume = $_POST['volume'];
		@$id=$_POST['id'];
		@$plate = strtoupper($_POST['platenumber']);
		@$make = strtoupper($_POST['make']);
		@$series = strtoupper($_POST['series']);
		@$bodytype = strtoupper($_POST['bodytype']);
		@$yearmodel = strtoupper($_POST['yearmodel']);
		@$acq = $_POST['acquisitioncost'];
		@$net = $_POST['netbookvalue'];
		@$amount = $_POST['amount'];
		@$truckcondition = $_POST['truckcondition'];
		@$old_plate = $_POST['oldplatenumber'];
			@$supplier_name = $_POST['supplier_name'];
						@$branch = $_POST['branch'];
						@$wheels = $_POST['wheels'];
		
	@$selectplate = mysql_query("Select * from tbl_truck_report Where truckplate='$plate'") or die (mysql_error());
	@$r_selectplate = mysql_fetch_array($selectplate);

	@$selectplate = mysql_query("Select * from tbl_truck_report Where truckplate='$plate'") or die (mysql_error());
	@$r_selectplate = mysql_fetch_array($selectplate);
	
	if(@$r_selectplate['truckplate'] == @$plate && @$old_plate != @$plate){
	?>
		<script type= "text/javascript">
			alert("Truck Already Exist.");
			location.replace('existing_truck.php');
		</script>
	<?php 
	}else{

		@$updatetruck = mysql_query("UPDATE tbl_truck_report SET truckplate='$plate',suppliername='$supplier_name', make='$make' ,series='$series' ,bodytype='$bodytype', yearmodel='$yearmodel' ,aquisitioncost='$acq', netbookvalue='$net', amount='$amount', truckcondition='$truckcondition', wheels='$wheels',class='$class' Where id='$id'") or die (mysql_error());
	
	@$given = mysql_query("UPDATE tbl_givento SET name='$branch',suppliername='$supplier_name', issuancedate='$issuance' , enddate='$enddate', amortization='$amortization', cashbond='$cashbond', proposedvolume='$volume', remarks = '".$_POST['remarks']."', cashbond_month='$ca_m', amortization_month='$a_m', ref_no='$ref_no', date_encode='$date', up='0' Where truckid='$id'")or die (mysql_error());
	
	if($reason != 'Update'){
		mysql_query("INSERT INTO tbl_assigntosupp_history (truckid, suppliername, issuance_date, enddate, amortization, cashbond, proposedvolume, ref_no, status, remarks, given_id, date, cashbond_month, amortization_month)
						VALUES ('$id', '$supplier_name', '$issuance', '$enddate', '$amortization', '$cashbond', '$volume', '$ref_no', '$reason', '".$_POST['remarks']."', '$id','$date', '$ca_m' , '$a_m') ") or die(mysql_error());
	
	}	
	?>
		<script type= "text/javascript">
			alert("Updated Successful.");
			location.replace('existing_truck.php');
		</script>
<?php } ?>