
<?php
	include('../connect.php');
		$query = mysql_query("Select * from tbl_truckdeedofsale Where truckid='".$_GET['id']."' ") or die(mysql_error());
		$row = mysql_fetch_array($query);
?>
	<img src="../deedofsale/<?php echo $row['location'];?>" height="1000px" width="100%">
	<center>
		
        <form method="post" onsubmit="window.open('print_deed.php?id=<?php echo $row['dosid'];?>','print_deed.php?id=<?php echo $row['dosid'];?>','width=600,height=600');">
<input type="submit" value="Print">
</form>
	</center>
    