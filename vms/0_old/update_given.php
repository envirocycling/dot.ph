<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}

?>
<?php
	include('connect.php');

		@$id=$_POST['truckid'];
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

		@$updatetruck = mysql_query("UPDATE tbl_truck_report SET truckplate='$plate',suppliername='$supplier_name', make='$make' ,series='$series' ,bodytype='$bodytype', yearmodel='$yearmodel' ,aquisitioncost='$acq', netbookvalue='$net', amount='$amount', truckcondition='$truckcondition' Where id='$id'") or die (mysql_error());
	
	@$given = mysql_query("UPDATE tbl_givento SET name='$branch',suppliername='$supplier_name', issuancedate='$issuance' , enddate='$enddate', amortization='$amortization', cashbond='$cashbond', proposedvolume='$volume', remarks = '".$_POST['remarks']."' Where truckid='$id'")or die (mysql_error());
			
	?>
		<script type= "text/javascript">
			alert("Updated Successful.");
			location.replace('existing_truck.php');
			window.close('edittruck');
		</script>
<?php } ?>