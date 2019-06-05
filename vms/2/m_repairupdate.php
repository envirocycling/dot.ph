<link rel="stylesheet" href="css/styles.css">
<?php
include('connect.php');
?>
<br />
<center>
<h3>Record Repair</h3>
<br />
<br />
<form action="repairupdatetrans.php?id=<?php echo $_GET['id'];?>" method="post">
<table>
<tr>
<td>Date: </td>
<td><input type="date" id="text" name="date" style="width:100%" required></td>
</tr>
<tr>
<td>Type of Work: </td>
<td><span>
		<select id="text" name="type">
				<option value="RECONDITIONING">RECONDITIONING</option>
				<option value="REPLACEMENT">REPLACEMENT</option>
				<option value="OVERHAULING">OVERHAULING</option>
				<option value="REPAIR">REPAIR</option>
				<option value="CHECK-UP / SERVICING">CHECK-UP / SERVICING</option>
				<option value="OTHERS">OTHERS</option>
		</select>
	</span>
</td>
</tr>
<tr>
<td>Item: </td>
<td><input type="text" id="text" name="items" style="width:100%"  onKeyUp="caps(this)"  required></td>
</tr>
<tr>
<td>Repaired By: </td>
<td><input type="text" id="text" name="repairedby" style="width:100%"  onKeyUp="caps(this)"  required></td>
</tr>
<tr>
<td>Remarks: </td>
<td><textarea name="remarks" id="text" cols="22" rows="5"   onKeyUp="caps(this)"></textarea></td>
</tr>
<tr>
<td></td>
<td align="right"><br /><br /><input type="submit" id="button" value="Submit"></td>
</tr>
</table>
</form>
</center>