<?php
include('connect.php');
$query = mysql_query(" Select * from tbl_truck_report Where id='".$_GET['id']."'") or die(mysql_error());
$row = mysql_fetch_array($query);
?>
<br></br><center>
<h4>Truck Images</h4>
<table>
<?php 
if(!empty($row['finame']) && empty($row['siname']) && empty($row['tiname'])){
?>
<tr>
<td align="center"><img src="trucks/<?php echo $row['finame'];?>" height="40%" width="200px"><form action="delete_finame.php?id=<?php echo $_GET['id'];?>" method="post"><input type="hidden" name="name" value="<?php echo $row['finame'];?>"><input type="submit" value="Delete Image"></form></td>
</tr>
<?php } else if(!empty($row['finame']) && !empty($row['siname']) && empty($row['tiname']) ){
?>
<tr><td align="center"><img src="trucks/<?php echo $row['finame'];?>" height="40%" width="200px"><form action="delete_finame.php?id=<?php echo $_GET['id'];?>" method="post"><input type="hidden" name="name" value="<?php echo $row['finame'];?>"><input type="submit" value="Delete Image"></form></td>
<td align="center"><img src="trucks/<?php echo $row['siname'];?>" height="40%" width="200px"><form action="delete_siname.php?id=<?php echo $_GET['id'];?>" method="post"><input type="hidden" name="name" value="<?php echo $row['siname'];?>"><input type="submit" value="Delete Image"></form></td></tr>
<?php }  
else if(!empty($row['finame']) && !empty($row['siname']) && !empty($row['tiname'])){
?>

<tr>
<td align="center"><img src="trucks/<?php echo $row['finame'];?>" height="40%" width="200px"><a href="truck_detailsdeleteimage.php?name=<?php echo $row['finame']; ?>"><form action="delete_finame.php?id=<?php echo $_GET['id'];?>" method="post"><input type="hidden" name="name" value="<?php echo $row['finame'];?>"><input type="submit" value="Delete Image"></form></a></td>
<td align="center"><a href="truck_detailsdeleteimage.php?name=<?php echo $row['siname']; ?>"><img src="trucks/<?php echo $row['siname'];?>" height="40%" width="200px"><form action="delete_siname.php?id=<?php echo $_GET['id'];?>" method="post"><input type="hidden" name="name" value="<?php echo $row['siname'];?>"><input type="submit" value="Delete Image"></form></a></td>
<td align="center"><a href="truck_detailsdeleteimage.php?name=<?php echo $row['tiname']; ?>"><img src="trucks/<?php echo $row['tiname'];?>" height="40%" width="200px"><form action="delete_tiname.php?id=<?php echo $_GET['id'];?>" method="post"><input type="hidden" name="name" value="<?php echo $row['tiname'];?>"><input type="submit" value="Delete Image"></form></a></td>
</tr>
<?php } ?>
</table>


</center>