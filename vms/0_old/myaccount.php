<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}

?>
<?php 
include('connect.php');
$query = mysql_query("Select * from tbl_users Where username='".$_SESSION['username']."' ") or die (mysql_error());
$row = mysql_fetch_array($query);
?>
<br />
<form action="update_account.php" method="post">
<table align="center">
<tr>
<td colspan="2" align="center"><h4>My Account</h4></td>
</tr>
<tr>
<td>Username:</td>
<td><input type="text" onkeyup="caps(this)" name="username" value="<?php echo $row['username'];?>" required></td>
</tr>
<tr>
<td>Password:</td>
<td><input type="password" name="password" value="<?php echo $row['password'];?>" required></td>
</tr>
<td></td>
<td><input type="password" placeholder="Type Current Password" name="oldpassword"  required></td>
</tr>
</table>
<br />
<center>
<input type="submit" value="Update">
</form>
</center>