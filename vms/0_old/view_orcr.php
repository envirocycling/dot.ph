<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}
?>
<?php
	include('../connect.php');
		$query = mysql_query("Select * from tbl_truckorcr Where truckid='".$_GET['id']."' ") or die(mysql_error());
		$row = mysql_fetch_array($query);
?>
	<img src="../orcr/<?php echo $row['location'];?>" height="500px" width="900px">

	<center>
		<form action="delete_orcr.php?id=<?php echo $_GET['id'];?>" method="post">
		<input type="hidden" name="name" value="<?php echo $row['location'];?>">
		<input type="submit" value="Delete Image" onclick="return confirm('Do you want to delete this photo?');">
		</form>
                <form method="post" onsubmit="window.open('print_orcr.php?id=<?php echo $row['orcrid'];?>','print_orcr.php?id=<?php echo $row['orcrid'];?>','width=600,height=600');">
<input type="submit" value="Print">
</form>
	</center>