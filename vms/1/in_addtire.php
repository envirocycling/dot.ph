<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
?>
<script>
function isNumbers(evt) {
       var ew = event.which;
    if(ew == 32)
        return true;
    if(48 <= ew && ew <= 57)
        return true;
    if(65 <= ew && ew <= 90)
        return true;
    if(97 <= ew && ew <= 122)
        return true;
    return false;
}</script>
<?php //======================================================================================?>
	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>

<?php
include('connect.php');

$select_wheels = mysql_query("Select * from tbl_truck_report Where id='".$_GET['p']."'") or die (mysql_error());
$row = mysql_fetch_array($select_wheels);
?>
<br /><br />
<form action="in_addsparetire.php?p=<?php echo $_GET['p'];?>" method="post" target="in_tire">
<table>
<tr>
<td colspan="2" align="center">Add Spare Tire</td>
</tr>
<tr>
<td>Tire Name</td>
<td><input type="text" name="tirename" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" required="required"	></td>
</tr>
<tr>
<td>Tire Size</td>
<td><input type="text" name="tiresize" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" required="required"	></td>
</tr>
<tr>
<td>Description</td>
<td><input type="text" name="description" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" required="required"	></td>
</tr>
<tr>
</tr>
<tr>
<td colspan="2" align="center"><br /><input type="submit" value="Add Tire"></td>
</tr>
</table>
</form>