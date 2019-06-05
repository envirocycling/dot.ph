<?php
session_start();
if(!isset($_SESSION['bhead_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
$query = mysql_query(" Select * from tbl_truckimage Where id='".$_GET['id']."'") or die(mysql_error());
$row = mysql_fetch_array($query);
?>
<center>
<h4>Truck Images</h4>
<br />
<img src="../trucks/<?php echo $row['name'];?>" height="450px" width="700px"><form action="delete_image.php?id=<?php echo $row['id'];?>" method="post">
<input type="hidden" value="<?php echo $row['name'];?>" name="name">
<input type="hidden" value="<?php echo $row['truckid'];?>" name="id">
<input type="submit" value="Delete Image" onclick="return confirm('Do you want to delete this photo?');"></form>
<form method="post" onsubmit="window.open('tryprint.php?id=<?php echo $row['id'];?>','tryprint.php?id=<?php echo $row['id'];?>','width=600,height=600');">
<input type="hidden" name="iname" value="<?php echo $row['name'];?>">
<input type="hidden" name="path" value="<?php echo "../trucks/";?>">
<input type="submit" value="Print">
</form>
</center>