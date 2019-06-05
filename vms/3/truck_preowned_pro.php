<?php
include("connect.php");

$id = $_POST['id'];
$remarks = mysql_real_escape_string($_POST['remarks']);

$sql_truck = mysql_query("SELECT * from tbl_truck_report WHERE id='$id'") or die(mysql_error());
$row_truck = mysql_fetch_array($sql_truck);

	if(mysql_query("INSERT INTO tbl_reassignmenthistory (truckplate, branch, date_approved, remarks, status)
		VALUES('$id', '".$_POST['branch']."', '".$_POST['date']."', '$remarks', 'Pre-owned')") or die(mysql_error())){
			mysql_query("UPDATE tbl_truck_report SET status='Pre-owned' WHERE id='$id'") or die(mysql_error());
			echo '<script>
					alert("Successful.");
					window.history.back();
				</script>';
	}

?>