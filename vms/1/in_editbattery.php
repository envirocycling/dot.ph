<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
<?php // type numbers only==================================================================?>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
<?php //======================================================================================?>
	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
<?php
include('connect.php');

$id = $_GET['id'];
$tool = mysql_query("Select * from tbl_addbattery Where id = '$id' ") or die(mysql_error);
$row = mysql_fetch_array($tool);
?>
<form action="in_updatebattery.php?id=<?php echo $_GET['id'];?>" method="post">
<table align="center">
<tr>
<td align="center" colspan="2"><h4>Edit Battery</h4></td>
<tr>
<td>Tool Name:</td>
<td><input type="text" value="<?php echo $row['name'];?>" name="name" id="text" onKeyUp="caps(this)"></td>
</tr>
<tr>
<td>Quantity:</td>
<td><input type="number" name="des" min="<?php echo $row['issued'];?>" value="<?php echo $row['qty'];?>" id="extra7" onKeyPress="return isNumber(event)" >
<input type="hidden" name="old_qty" value="<?php echo $row['qty'];?>"  >
<input type="hidden" name="issued" value="<?php echo $row['issued'];?>"  >
<input type="hidden" name="toolname" value="<?php echo $_GET['id'];?>">
</td>
</tr>
</tr>
</table>
<center>
<input type="submit" value="Update">
</center>
</form>