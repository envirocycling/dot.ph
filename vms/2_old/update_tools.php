<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
<?php
include('connect.php');
$id = $_GET['id'];
$select = mysql_query("SELECT * from tbl_trucktools Where ti='$id'") or die (mysql_error());
$row = mysql_fetch_array($select);
?>
<br>
<form action="tools.php?id=<?php echo $id;?>" method="post">
<table>
	<tr>
		<td>Tool Name:</td>
		<td><input type="text" value="<?php echo $row['toolname'];?>" name="tool" onKeyUp="caps(this);"></td>
	</tr>
	<tr>
		<td>Quantity:</td>
		<td><input type="number" min="1" value="<?php echo $row['qty'];?>" name="qty"></td>
	</tr>
	<tr>
		<td><br /><input type="submit" value="Submit"></td>
	</tr>
</table>
</form>