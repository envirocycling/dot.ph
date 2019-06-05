<?php
include('config.php');
?>
<center>
<form action="" method="post">
	<table>
	<tr>
			<td>User Id</td>
			<td><input type="text" name="user_id" value="<?php echo $row['str'];?>"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="text" name="password" value="<?php echo $row['date'];?>"></td>
		</tr>
		<tr>
			<td>Name</td>
			<td><input type="text" name="name" value="<?php echo $row['trucking'];?>"></td>
		</tr>
		<tr>
			<td>Branch</td>
			<td><input type="text" name="branch" value="<?php echo $row['plate_number'];?>"></td>
		</tr>
		<tr>
			<td>Initial</td>
			<td><input type="text" name="initial" value="<?php echo $row['wp_grade'];?>"></td>
		</tr>
		<tr>
			<td>Position</td>
			<td><input type="text" name="position" value="<?php echo $row['weight'];?>"></td>
		</tr>
		<tr>
			<td>User Type</td>
			<td><input type="text" name="user_type" value="<?php echo $row['branch'];?>"></td>
		</tr>
	</table>
	<br />
	<input type="submit" name="submit">
</form>
</center>
<?php
	if(isset($_POST['submit'])){
		if(mysql_query("INSERT INTO users (user_id,password,name,branch,initial,position,user_type) VALUES('".$_POST['user_id']."','".$_POST['password']."','".$_POST['name']."','".$_POST['branch']."','".$_POST['initial']."','".$_POST['position']."','".$_POST['user_type']."')") or die (mysql_error())){
			echo '<script>
						alert("Successful.");
				</script>';
		}
	}
?>