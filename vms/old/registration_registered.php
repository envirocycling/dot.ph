	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
<?php
include('connect.php');
//===================================
$select = "Select * from tbl_truck_report Where id = '".@$_GET['id']."'";
$sresult = mysql_query($select) or die("Error in query : $query".mysql_error());
$srow=mysql_fetch_array($sresult);
?>

<br />
<center><h3> Vehicle Registration</h3></center>
<form action="registration_registeredtrans.php?id=<?php echo $_GET['id'];?>"  method="post">
<table>
<tr>
<td>PlateNumber:<td>
<td><?php echo $srow['truckplate'];?></td>
</tr>
<tr>
<td align="right">Location:<td>
<td><input type="text" name="location" id="text" onKeyUp="caps(this)" required>
</td>
</tr>
<tr>
<td align="right">Remarks:<td>
<td><textarea name="remarks" cols="22" rows="5" id="text" onKeyUp="caps(this)" required></textarea>
</td>
</tr>
</table>
<br />
<input type="submit" value="Registered">
</form>