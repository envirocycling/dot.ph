
<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
	
	
include('connect.php');

$select =mysql_query("Select * from tbl_users Where id='".$_GET['id']."'") or die (mysql_error());
$row = mysql_fetch_array($select);
?>
<br /><br />
<center>
<h3>Edit User Account</h3>
</center>
<form action="update_user.php?id=<?php echo $_GET['id'];?>" method="post">
<table align="center">
<tr>
<td>Name:</td>
<td><input type="text" name="name"  id="text" onKeyUp="caps(this)" value="<?php echo $row['Name'];?>"></td>
</tr>
<tr>
<td>Username:</td>
<td><input type="text" name="username" value="<?php echo $row['username'];?>"></td>
</tr>
<tr>
<td>Password:</td>
<td><input type="text" name="password" value="<?php echo $row['password'];?>"></td>
</tr>
<tr>
<td>Type:</td>
<td>
<select name="type" class="country">
<option value="<?php echo $row['type'];?>"><?php echo $row['type'];?></option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select>
</td>
</tr>
<tr>
<td>Branch:</td>
<td>
<select name="branch">
<option value="<?php echo strtoupper($row['branch']);?>"><?php echo strtoupper($row['branch']);?></option>
<?php include('connect_out.php');
$select_b =mysql_query("Select * from branches") or die (mysql_error());
while ($row_b = mysql_fetch_array($select_b)){?>
<option value="<?php echo strtoupper($row_b['branch_name']);?>"><?php echo strtoupper($row_b['branch_name']);?></option>
<?php }?>
</select>
</td>
</tr>
<tr>
<td colspan="2" align="right"><br /><input type="submit" name="Submit"></td>
</tr>
</table>

</form>