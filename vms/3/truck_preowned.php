<?php
include("connect.php");

$id = $_GET['id'];

$sql_truck = mysql_query("SELECT * from tbl_truck_report WHERE id='$id'") or die(mysql_error());
$row_truck = mysql_fetch_array($sql_truck);

?>
<style>
	.txt{
		text-transform:uppercase;
	}
</style>
<center>
	<form action="truck_preowned_pro.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<input type="hidden" name="branch" value="<?php echo $row_truck['branch'];?>">
		<table>
			<tr>
				<td colspan="2" align="center"><h2><?php echo $row_truck['truckplate'];?></h2></td>
			</tr>
			<tr>
				<td>Date:</td>
				<td><input type="date" name="date"  style="width:100%;" required></td>
			</tr>
			<tr>
				<td>Remarks:</td>
				<td><textarea name="remarks" class="txt" rows="5" style="width:100%;" required></textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><input type="submit" name="submit"></td>
			</tr>
		</table>
	</form>
</center>