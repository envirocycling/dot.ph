<?php
include 'config.php';

$id = $_GET['id'];

$sql =  mysql_query("SELECT * from actual WHERE log_id='$id'");
$row = mysql_fetch_array($sql);
?>
<center>
<form action="" method="post">
	<table>
	<tr>
			<td>Str</td>
			<td><input type="text" name="str_no" value="<?php echo $row['str_no'];?>"></td>
		</tr>
		<tr>
			<td>Date</td>
			<td><input type="text" name="date" value="<?php echo $row['date'];?>"></td>
		</tr>
		<tr>
			<td>Delivered To</td>
			<td><input type="text" name="delivered_to" value="<?php echo $row['delivered_to'];?>"></td>
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
		<tr>
			<td>DR#</td>
			<td><input type="text" name="dr_number" value="<?php echo $row['dr_number'];?>"></td>
		</tr>
		<tr>
			<td>MC</td>
			<td><input type="text" name="mc" value="<?php echo $row['mc'];?>"></td>
		</tr>
		<tr>
			<td>Dirt</td>
			<td><input type="text" name="dirt" value="<?php echo $row['dirt'];?>"></td>
		</tr>
		<tr>
			<td>Newt Wt</td>
			<td><input type="text" name="net_wt" value="<?php echo $row['net_wt'];?>"></td>
		</tr>
		<tr>
			<td>Comment</td>
			<td><input type="text" name="comments" value="<?php echo $row['comments'];?>"></td>
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
		if(mysql_query("UPDATE actual SET str_no='".$_POST['str_no']."',date='".$_POST['date']."',delivered_to='".$_POST['delivered_to']."',plate_number='".$_POST['plate_number']."',wp_grade='".$_POST['wp_grade']."',weight='".$_POST['weight']."',branch='".$_POST['branch']."', dr_number='".$_POST['dr_number']."', mc='".$_POST['mc']."', dirt='".$_POST['dirt']."', net_wt='".$_POST['net_wt']."', comments='".$_POST['comments']."', trans_id='".$_POST['trans_id']."', detail_id='".$_POST['detail_id']."'  WHERE log_id='$id'") or die (mysql_error())){
			echo '<script>
						alert("Successful.");
						window.close();
				</script>';
		}
	}
?>