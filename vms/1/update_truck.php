<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
<?php
	include('connect.php');
		$id=$_POST['id'];
		$plate = $_POST['platenumber'];
		$acq = $_POST['acquisitioncost'];
		$net = $_POST['netbookvalue'];
		$amount = $_POST['amount'];
		$truckcondition = $_POST['truckcondition'];



	mysql_query("UPDATE tbl_truck_report SET truckplate='$plate', aquisitioncost='$acq', netbookvalue='$net', amount='$amount', truckcondition='$truckcondition' Where id='$id'");
			
?>

	<script type= "text/javascript">
		alert("Updated Successful.");
		location.replace('existing_truck.php');
	</script>