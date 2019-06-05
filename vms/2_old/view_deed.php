
<?php
session_start();
	include('../connect.php');
		$query = mysql_query("Select * from tbl_truckdeedofsale Where truckid='".$_GET['id']."' ") or die(mysql_error());
		$row = mysql_fetch_array($query);
		$select  = mysql_query("SELECT * from tbl_truck_report WHERE id='".$_GET['id']."'") or die (mysql_error());
		$rows = mysql_fetch_array($select);
?>
	<img src="../deedofsale/<?php echo $row['location'];?>" height="1000px" width="100%">
	<center>
	<?php
	if($_SESSION['owner'] == $rows['branch'] || $_SESSION['owner'] == 'PAMPANGA'){
	?>
		<form action="delete_deed.php?id=<?php echo $_GET['id'];?>" method="post">
			<input type="submit" value="Delete Image" onclick="return confirm('Do you want to delete this photo?');">
			<input type="hidden" name="name" value="<?php echo $row['location'];?>">
		</form>
	<?php }?>
        <form method="post" onsubmit="window.open('print_deed.php?id=<?php echo $row['dosid'];?>','print_deed.php?id=<?php echo $row['dosid'];?>','width=600,height=600');">
<input type="submit" value="Print">
</form>
	</center>
    