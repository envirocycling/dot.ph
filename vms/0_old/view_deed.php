<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}
?>
<?php
	include('../connect.php');
		$query = mysql_query("Select * from tbl_truckdeedofsale Where truckid='".$_GET['id']."' ") or die(mysql_error());
		$row = mysql_fetch_array($query);
?>
	<img src="../deedofsale/<?php echo $row['location'];?>" height="500px" width="900px">
	<center>
		<form action="delete_deed.php?id=<?php echo $_GET['id'];?>" method="post">
			<input type="submit" value="Delete Image" onclick="return confirm('Do you want to delete this photo?');">
			<input type="hidden" name="name" value="<?php echo $row['location'];?>">
		</form>
        <form method="post" onsubmit="window.open('print_deed.php?id=<?php echo $row['dosid'];?>','print_deed.php?id=<?php echo $row['dosid'];?>','width=600,height=600');">
<input type="submit" value="Print">
</form>
	</center>
    