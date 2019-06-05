<?php session_start();

include('../connect.php');

//Bail machine info
$branch = strtoupper($_POST['branch']);
$owner_name= strtoupper($_POST['owner_name']);
$series_no = strtoupper($_POST['series_no']);
$aquisition_cost = $_POST['aquisition_cost'];
//$quota = $_POST['quota'];
$motor = $_POST['motor'];
$cylinder = $_POST['cylinder'];
$tonne = $_POST['tonne'];
$capacity = $_POST['capacity'];
$condition = strtoupper($_POST['condition']);
$date_purchased = $_POST['date_purchased'];
$date_release = $_POST['date_release'];
//$cash_bond = $_POST['cash_bond'];
$date_added = date('Y/m/d');


//Bail Machine Info
$select_series_no = mysql_query("Select * from tbl_bm_report Where series_no='$series_no'") or die (mysql_error());
$r_select_series_no = mysql_fetch_array($select_series_no);

if(mysql_num_rows($select_series_no) > 0) { ?>
	<script type= "text/javascript">
		alert("Bail Machine Already Exist.");
		window.history.back();
	</script>
<?php }else {

mysql_query("INSERT INTO `tbl_bm_report`(`branch`, `owner_name`, `series_no`, `motor`, `cylinder`, `tonne`, `capacity`, `date_purchased`, `date_release`, `aquisition_cost`, `condition`, `date_added`, `repair`, `status`) VALUES ('$branch','$owner_name','$series_no','$motor', '$cylinder', '$tonne','$capacity','$date_purchased','$date_release','$aquisition_cost',  '$condition','$date_added', '', '')") or die(mysql_error());

$res =("SELECT * FROM tbl_bm_report ORDER BY id DESC LIMIT 1 ");
$results = mysql_query($res) or die(mysql_error());
$row=mysql_fetch_array($results);
	
$given=mysql_query("INSERT INTO tbl_bm_givento (bm_id) VALUES ('".$row['id']."')");

?>

<script type= "text/javascript">
	alert("Baling Machine Added Successfully.");
	location.replace('existing_bm.php');
</script>

<?php } ?>