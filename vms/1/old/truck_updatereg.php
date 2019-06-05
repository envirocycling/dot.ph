<?php
include('connect.php');

//truck palte number =============================================
$truck_plate = "SELECT * FROM tbl_truck_report Where id='".$_GET['id']."'";
$result_plate = mysql_query($truck_plate) or die("Error in query : $query".mysql_error());
$tprow = mysql_fetch_array($result_plate);
//===============================================================

//status========================================
$registration = "SELECT * FROM tbl_truckregistration Where truckid='".$_GET['id']."' ";
$result_registration = mysql_query($registration) or die("Error in query : $query".mysql_error());
$rrrow = mysql_fetch_array($result_registration);
														
//============================================
$query = "SELECT * FROM tbl_truckregistration Where truckid='".$_GET['id']."'";
$result = mysql_query($query) or die("Error in query : $query".mysql_error());
$row = mysql_fetch_array($result);
?>
<br />
<center><h3>Update Vehicle Registration</h3></center>
<form action="registration_update.php?id=<?php echo $_GET['id'];?>" method="post">
<table>
<tr>
<td>Plate Number:<td>
<td><?php echo $tprow['truckplate'];?></td>
</tr>
<tr>

<td align="right">Insurance:<td>
<td><?php if($rrrow['insurance'] == 'OK'){?><input type="checkbox" name="insurance" value="OK" checked="checked" disabled="disabled">
<input type="hidden" name="insurance" value="OK">
<?php }else{?> <input type="checkbox" name="insurance" value="OK"> <?php } ?>
</td>
</tr>
<tr>
<td align="right">Stencil:<td>
<td><?php if($rrrow['stencil'] == 'OK'){?><input type="checkbox" name="stencil" value="OK" checked="checked" disabled="disabled">
	<input type="hidden" name="stencil" value="OK">
<?php }else{?><input type="checkbox" name="stencil" value="OK"><?php } ?></td>
</tr>
<tr>
<td align="right">Emission:<td>
<td><?php if($rrrow['emission'] == 'OK'){?><input type="checkbox" name="emission" value="OK" checked="checked" disabled="disabled">
<input type="hidden" name="emission" value="OK">
<?php }else{?><input type="checkbox" name="emission" value="OK"><?php } ?></td>
</tr>
<tr>
</tr>
</table>
<br />

<input type="submit" value="Save Update">
</form>
