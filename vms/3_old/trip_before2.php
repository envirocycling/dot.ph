<?php
include('connect.php');
$select = mysql_query("Select * from tbl_trip Where id='".$_GET['id']."'") or die(mysql_error());
$select_row = mysql_fetch_array($select);
$plate = mysql_query("Select * from tbl_truck_report Where id='".$select_row['truckid']."' ") or die(mysql_error());
$plate_row = mysql_fetch_array($plate);


$diesel = $_POST['cost1'].'.'.$_POST['cost2'];
$id=$plate_row['truckplate'];
mysql_query("Update tbl_trip Set date='".$_POST['date']."',supplier='".$_POST['supplier']."',location='".$_POST['location']."',beg='".$_POST['beg']."',end='".$_POST['end']."',diesel='$diesel',driver='".$_POST['driver']."',helper='".$_POST['helper']."',remarks='".$_POST['remarks']."' Where id='".$_GET['id']."'") or die (mysql_error());

?>
<script>
alert("Update Successful.");
location.replace("trip_table.php?id=<?php echo $id;?>");
</script>