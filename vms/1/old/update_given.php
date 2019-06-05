<?php
include('connect.php');

$id=$_POST['truckid'];
$suppliername = $_POST['suppliername'];
$issuance = $_POST['issuancedate'];
$enddate = $_POST['enddate'];
$amortization = $_POST['amortization'];
$cashbond = $_POST['cashbond'];
$volume = $_POST['volume'];

mysql_query("UPDATE tbl_givento SET suppliername='$suppliername', issuancedate='$issuance' , enddate='$enddate', amortization='$amortization', cashbond='$cashbond', proposedvolume='$volume' Where id='$id'");
			
?>
<script type= "text/javascript">
	alert("Updated Successful.");
	location.replace('existing_truck.php');
</script>
