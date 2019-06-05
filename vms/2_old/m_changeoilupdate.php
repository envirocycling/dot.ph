<?php
session_start();
if(!isset($_SESSION['bhead_username'])){
	 header("Location: ../index.php");
	}
include('connect.php');
?>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
		

	</script>
<br />
<center>
<h3>Change Oil Update</h3>
<br />
<br />

<form action="changeoilupdatetrans.php?id=<?php echo $_GET['id'];?>" method="post" >
<table>
<tr>
<td>Date: </td>
<td><input type="date" name="date" style="width:100%" required></td>
</tr>
<tr>
<td>Performed By: </td>
<td><input type="text" name="performedby" style="width:100%"  onKeyUp="caps(this)"  required></td>
</tr>
<tr>
<td>From (Km): </td>
<td><input type="text" name="from" style="width:100%"  onKeyPress="return isNumber(event)" ></td>
</tr>
<tr>
<td>Remarks: </td>
<td><textarea name="remarks" cols="22" rows="5"   onKeyUp="caps(this)"></textarea></td>
</tr>
<tr>
<td></td>
<td align="right"><br /><br /><input type="submit"  value="Submit" ></td>
</tr>
</table>
</form>
</center>