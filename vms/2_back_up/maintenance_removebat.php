<?php
session_start();
?>

 	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>

<?php
include('connect.php');
$id = $_GET['id'];
$qty = mysql_query("Select * from tbl_truckbattery Where bid='$id'") or die (mysql_error());
$rqty = mysql_fetch_array($qty);
 $plate = mysql_query(" Select * from tbl_truck_report Where id='".$rqty['truckid']."' ") or die (mysql_error()); 
 $rows = mysql_fetch_array($plate);

$delete = mysql_query("Delete from tbl_truckbattery Where bid= '$id'") or die (mysql_error());;
 $ids = $rows['truckplate'];
 ?>
 <script>
 location.replace("maintenance_battery.php?id=<?php echo $ids;?>");
 </script>
