
<?php
session_start();
	include('../connect.php');
		$query = mysql_query("Select * from tbl_truckdeedofsale Where truckid='".$_GET['id']."' ") or die(mysql_error());
		$row = mysql_fetch_array($query);
		$select  = mysql_query("SELECT * from tbl_truck_report WHERE id='".$_GET['id']."'") or die (mysql_error());
		$rows = mysql_fetch_array($select);
?>
	<img src="../deedofsale/<?php echo $row['location'];?>" height="1000px" width="100%">
	<style>
	@media print{
		.button{
			display:none;
		}
	}
</style>
	<center>

		<form action="delete_deed.php?id=<?php echo $_GET['id'];?>" method="post">
			<input type="submit" value="Delete Image" onclick="return confirm('Do you want to delete this photo?');" class="button">
			<input type="hidden" name="name" value="<?php echo $row['location'];?>">
		</form>

     
<input type="button" value="Print" onclick="print();" class="button">
	</center>
    