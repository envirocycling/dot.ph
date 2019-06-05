<?php
session_start();
?>

 	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>

<?php
include('connect.php');
$id = $_GET['id'];
$qty = mysql_query("Select * from tbl_truckbattery Where bid='$id'") or die (mysql_error());
$rqty = mysql_fetch_array($qty);
 $plate = mysql_query(" Select * from tbl_truck_report Where id='".$rqty['truckid']."' ") or die (mysql_error()); 
 $rows = mysql_fetch_array($plate);
/*/echo $new_qty = $rqty['qty'] + $rname['qty'];
echo $new_issued = $rname['issued'] - $rqty['qty'];
echo  $new_available = $rname['available'] + $rqty['qty'] ;
/*/

//$update = mysql_query("Insert into tbl_history (truckid,name,description,reason,remarks) 
//						Values('".$rqty['truckid']."','".$_POST['batname']."','".$rqty['description']."','".$_POST['reason']."','B')") or die (mysql_error());
$delete = mysql_query("Delete from tbl_truckbattery Where bid= '$id'") or die (mysql_error());;
 $ids = $rows['truckplate'];
 ?>
 <script>
window.history.back();
 </script>
 <?php
/*/?>
<center>
<form action="" target="_self" method="post">
<table align="center">
<tr>
<td colspan="2" align="center"><h4>Remove Battery</h4></td>
</tr>
<tr>
<td align="center" colspan="2"><h6><?php echo $rqty['batteryname'];?></h6><input type="hidden" name="batname" value="<?php echo $rqty['batteryname'];?>"></td>
</tr>
<tr>
<td>Reason:</td>
<td><textarea name="reason" cols="20" rows="5" required="required" onkeyup="caps(this)"></textarea></td>
</tr>
<tr>
<td >
<br /><br /><a href="maintenance_battery.php?id=<?php echo $rows['truckplate'];?>"><input type="button" name="cancel" value="Cancel" /></td>
<td></td>
<td colspan="2" align="right"><br /><br /><input type="submit" name="submit" value="Submit" onclick="return confirm('Do you want to Remove?');"></td>
</tr>
</table>
</form>

</center>