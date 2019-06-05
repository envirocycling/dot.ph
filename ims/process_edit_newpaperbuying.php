<?php
include 'config.php';

$id = $_GET['id'];

$sql =  mysql_query("SELECT * from paper_buying WHERE log_id='$id'");
$row = mysql_fetch_array($sql);
?>
<center>
<form action="" method="post">
	<table>
	<tr>
			<td>Date Received</td>
			<td><input type="text" name="date_received" value="<?php echo $row['date_received'];?>"></td>
		</tr>
	<tr>
			<td>Supplier Id</td>
			<td><input type="text" name="supplier_id" value="<?php echo $row['supplier_id'];?>"></td>
		</tr>
		<tr>
			<td>Supplier Name</td>
			<td><input type="text" name="supplier_name" value="<?php echo $row['supplier_name'];?>"></td>
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
			<td>Corrected Weight</td>
			<td><input type="text" name="corrected_weight" value="<?php echo $row['corrected_weight'];?>"></td>
		</tr>
		<tr>
			<td>Unit Cost</td>
			<td><input type="text" name="unit_cost" value="<?php echo $row['unit_cost'];?>"></td>
		</tr>
		<tr>
			<td>Paper Buying</td>
			<td><input type="text" name="paper_buying" value="<?php echo $row['paper_buying'];?>"></td>
		</tr>
		<tr>
			<td>Branch</td>
			<td><input type="text" name="branch" value="<?php echo $row['branch'];?>"></td>
		</tr>
		<tr>
			<td>Trans Id</td>
			<td><input type="text" name="trans_id" value="<?php echo $row['trans_id'];?>"></td>
		</tr>
		<tr>
			<td>Detail Id</td>
			<td><input type="text" name="detail_id" value="<?php echo $row['detail_id'];?>"></td>
		</tr>
	</table>
	<br />
	<input type="submit" name="submit">
</form>
</center>
<?php
	if(isset($_POST['submit'])){
		if(mysql_query("UPDATE paper_buying SET supplier_id='".$_POST['supplier_id']."',date_received='".$_POST['date_received']."',supplier_name='".$_POST['supplier_name']."',plate_number='".$_POST['plate_number']."',wp_grade='".$_POST['wp_grade']."',corrected_weight='".$_POST['corrected_weight']."',branch='".$_POST['branch']."',unit_cost='".$_POST['unit_cost']."', paper_buying = '".$_POST['paper_buying']."' ,trans_id='".$_POST['trans_id']."', detail_id='".$_POST['detail_id']."'  WHERE log_id='$id'") or die (mysql_error())){
			echo '<script>
						alert("Successful.");
						window.close();
				</script>';
		}
	}
?>