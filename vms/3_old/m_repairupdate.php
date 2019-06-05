<?php
session_start();
if(!isset($_SESSION['encoder_username'])){
	 header("Location: ../index.php");
	}
include('connect.php');
?>
<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
<br />
<center>
<h3>Record Repair</h3>
<br />
<br />
<form action="repairupdatetrans.php?id=<?php echo $_GET['id'];?>" method="post">
<table>
<tr>
<td>Date: </td>
<td><input type="date" name="date" style="width:100%" required></td>
</tr>
<tr>
<td>Type of Work Done: </td>
<td><input type="text" name="type" style="width:100%"  onKeyUp="caps(this)"  required></td>
</tr>
<tr>
<td>Item: </td>
<td><input type="text" name="items" style="width:100%"  onKeyUp="caps(this)"  required></td>
</tr>
<tr>
<td>Repaired By: </td>
<td><input type="text" name="repairedby" style="width:100%"  onKeyUp="caps(this)"  required></td>
</tr>
<tr>
<td>Remarks: </td>
<td><textarea name="remarks" cols="22" rows="5"   onKeyUp="caps(this)"></textarea></td>
</tr>
<tr>
<td></td>
<td align="right"><br /><br /><input type="submit"  value="Submit"></td>
</tr>
</table>
</form>
</center>