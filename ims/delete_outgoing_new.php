<?php 
include('config.php');
$trans_id = $_POST['trans_id'];

?>
<a href="http://192.168.10.200/paymentsystem/user-login/admin/outgoing.php"><button>Back To LocalHost</button></a>
<table>
	<tr><h2>Actual</h2></tr>
	<tr>
		<td>Trans Id</td>
		<td>Str</td>
		<td>Date</td>
		<td>Delivered To</td>
		<td>Plate Number</td>
		<td>Grade</td>
		<td>Correct Weight</td>
		<td>Branch</td>
		<td>Action</td>
	</tr>
<?php
$select  = mysql_query("SELECT * from actual WHERE trans_id='$trans_id'") or die (mysql_error());
while($row = mysql_fetch_array($select)){
	?>
	<tr>
		<td><?php echo $row['trans_id'];?></td>
		<td><?php echo $row['str_no'];?></td>
		<td><?php echo $row['date'];?></td>
		<td><?php echo $row['delivered_to'];?></td>
		<td><?php echo $row['plate_number'];?></td>
		<td><?php echo $row['wp_grade'];?></td>
		<td><?php echo $row['weight'];?></td>
		<td><?php echo $row['branch'];?></td>
		<td><a href="delete_me.php?id=<?php echo $row['log_id'].'&del=actual';?>"><button>Delete</button></a></td>
	</tr>
	<?php
}
?>
</table>


<table>
	<tr><h2>Outgoing</h2></tr>
	<tr>
		<td>Trans Id</td>
		<td>Str</td>
		<td>Date</td>
		<td>Delivered To</td>
		<td>Plate Number</td>
		<td>Grade</td>
		<td>Correct Weight</td>
		<td>Branch</td>
		<td>Action</td>
	</tr>
<?php
$select  = mysql_query("SELECT * from outgoing WHERE trans_id='$trans_id'") or die (mysql_error());
while($row = mysql_fetch_array($select)){
	?>
	<tr>
		<td><?php echo $row['trans_id'];?></td>
		<td><?php echo $row['str'];?></td>
		<td><?php echo $row['date'];?></td>
		<td><?php echo $row['trucking'];?></td>
		<td><?php echo $row['plate_number'];?></td>
		<td><?php echo $row['wp_grade'];?></td>
		<td><?php echo $row['weight'];?></td>
		<td><?php echo $row['branch'];?></td>
		<td><a href="delete_me.php?id=<?php echo $row['log_id'].'&del=outgoing';?>"><button>Delete</button></a></td>
	</tr>
	<?php
}
?>
</table>
<a href="http://192.168.10.200/paymentsystem/user-login/admin/outgoing.php"><button>Back To LocalHost</button></a>