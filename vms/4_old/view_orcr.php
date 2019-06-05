
<?php
	include('../connect.php');
		$query = mysql_query("Select * from tbl_truckorcr Where truckid='".$_GET['id']."' ") or die(mysql_error());
		$row = mysql_fetch_array($query);
?>
	<img src="../orcr/<?php echo $row['location'];?>" height="700px" width="100%">

	<center>
		
                <form method="post" onsubmit="window.open('print_orcr.php?id=<?php echo $row['orcrid'];?>','print_orcr.php?id=<?php echo $row['orcrid'];?>','width=600,height=600');">
<input type="submit" value="Print">
</form>
	</center>