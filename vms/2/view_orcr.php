
<?php
session_start();
	include('../connect.php');
		$query = mysql_query("Select * from tbl_truckorcr Where truckid='".$_GET['id']."' ") or die(mysql_error());
		$row = mysql_fetch_array($query);
		
		$select  = mysql_query("SELECT * from tbl_truck_report WHERE id='".$_GET['id']."'") or die (mysql_error());
		$rows = mysql_fetch_array($select);
?>
	<img src="../orcr/<?php echo $row['location'];?>" height="700px" width="100%">
<style>
	@media print{
		.button{
			display:none;
		}
	}
</style>
	<center>
	<?php
	if($_SESSION['owner'] == $rows['branch'] || $_SESSION['owner'] == 'PAMPANGA'){
	?>
		<form action="delete_orcr.php?id=<?php echo $_GET['id'];?>" method="post">
		<input type="hidden" name="name" value="<?php echo $row['location'];?>">
		<input type="submit" value="Delete Image" onclick="return confirm('Do you want to delete this photo?');" class="button">
		</form>
		
	<?php }?>
                
<input type="button" value="Print" onclick="print();" class="button">

	</center>