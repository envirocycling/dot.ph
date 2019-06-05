<?php
include 'config.php';

$id = $_GET['id'];

$sql =  mysql_query("SELECT * from sup_deliveries WHERE del_id='$id'");
$row = mysql_fetch_array($sql);
?>
<center>
<form action="" method="post">
	<table>
	<tr>
			<td>Supplier Id</td>
			<td><input type="text" name="supplier_id" value="<?php echo $row['supplier_id'];?>"></td>
		</tr>
		<tr>
			<td>Supplier Name</td>
			<td><input type="text" name="supplier_name" value="<?php echo $row['supplier_name'];?>"></td>
		</tr>
		<tr>
			<td>Wp Grade</td>
			<td><input type="text" name="wp_grade" value="<?php echo $row['wp_grade'];?>"></td>
		</tr>
		<tr>
			<td>Weight</td>
			<td><input type="text" name="weight" value="<?php echo $row['weight'];?>"></td>
		</tr>
		<tr>
			<td>Branch Delivered</td>
			<td><input type="text" name="branch_delivered" value="<?php echo $row['branch_delivered'];?>"></td>
		</tr>
		<tr>
			<td>Date Received</td>
			<td><input type="text" name="date_received" value="<?php echo $row['date_delivered'];?>"></td>
		</tr>
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
$day = date('d',strtotime($_POST['date_received']));
$month = date('F',strtotime($_POST['date_received']));
$year = date('Y',strtotime($_POST['date_received']));
	if(isset($_POST['submit'])){
		if(mysql_query("UPDATE sup_deliveries SET date_delivered='".$_POST['date_received']."',wp_grade='".$_POST['wp_grade']."',weight='".$_POST['weight']."',branch_delivered='".$_POST['branch_delivered']."',month_delivered='$day',day_delivered='$monht',year_delivered='$year'  WHERE del_id='$id'") or die (mysql_error())){
			echo '<script>
						alert("Successful.");
						window.close();
				</script>';
		}
	}
?>