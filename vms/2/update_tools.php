<link rel="stylesheet" href="css/styles.css">
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
		<td><input type="text" value="<?php echo $row['toolname'];?>" name="tool" id="text"></td>
	</tr>
	<tr>
		<td>Quantity:</td>
		<td><input type="number" min="1" value="<?php echo $row['qty'];?>" id="text" name="qty"></td>
	</tr>
	<tr>
		<td><br /><input type="submit" value="Submit" id="button"></td>
	</tr>
</table>
</form>