<?php
include 'config.php';
$id = $_GET['id'];

$sql =  mysql_query("SELECT * from outgoing WHERE log_id='$id'");
$row = mysql_fetch_array($sql);
?>
<center>
<form action="" method="post">
	<table>
	<tr>
			<td>Str</td>
			<td><input type="text" name="str" value="<?php echo $row['str'];?>"></td>
		</tr>
		<tr>
			<td>Date</td>
			<td><input type="text" name="date" value="<?php echo $row['date'];?>"></td>
		</tr>
		<tr>
			<td>Trucking</td>
			<td><input type="text" name="trucking" value="<?php echo $row['trucking'];?>"></td>
		</tr>
		<tr>
			<td>Plate Number</td>
			<td><input type="text" name="plate_number" value="<?php echo $row['plate_number'];?>"></td>
		</tr>
		<tr>
			<td>WP Grade</td>
			<td><input type="text" name="wp_grade" value="<?php echo $row['wp_grade'];?>"></td>
		</tr>
		<tr>
			<td>Weight</td>
			<td><input type="text" name="weight" value="<?php echo $row['weight'];?>"></td>
		</tr>
		<tr>
			<td>Branch</td>
			<td><input type="text" name="branch" value="<?php echo $row['branch'];?>"></td>
		</tr>
	</table>
	<br />
	<input type="submit" name="submit">
</form>
</center>
<?php
	if(isset($_POST['submit'])){
		if(mysql_query("UPDATE outgoing SET str='".$_POST['str']."',date='".$_POST['date']."',trucking='".$_POST['trucking']."',plate_number='".$_POST['plate_number']."',wp_grade='".$_POST['wp_grade']."',weight='".$_POST['weight']."',branch='".$_POST['branch']."'  WHERE log_id='$id'") or die (mysql_error())){
			echo '<script>
						alert("Successful.");
				</script>';
		}
	}
?>