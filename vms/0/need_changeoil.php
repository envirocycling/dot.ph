<?php
session_start();
include('connect.php');
$timezone=+8;
 $date= gmdate('Y-m-d',time() + 3600*($timezone+date("I")));
$select_date = mysql_query("Select * from tbl_truck_report Where (oil_next <= '$date' or oil_next='') and status='' order by branch Asc ") or die (mysql_error());

if(isset($_POST['submit'])){
	mysql_query("UPDATE tbl_truck_report SET oil_next='".$_POST['date']."' WHERE id='".$_POST['id']."' ") or die(mysql_error());
	
	echo '<script>
				location.replace("need_changeoil.php");
		</script>';
}
?>
<center>
<br>
<link href="css/tables.css" media="screen" rel="stylesheet" type="text/css" />
<table width="95%">
<tr>
<td>
<table class="CSSTableGenerator">
<td width="15%">Plate</td>
<td width="15%">Branch</td>
<td>Action</td>
</tr>
<?php 
while($row = mysql_fetch_array($select_date)){
	// $plate = mysql_query("Select * from tbl_truck_report Where id = '".$row['truckid']."' and branch='".$_SESSION['owner']."'") or die(mysql_error());
	//$plate_row = mysql_fetch_array($plate);
	
	//	if(mysql_num_rows($plate) > 0){
	?>
	<tr>
    <td><?php echo $row['truckplate'];?></td>
    <td><?php echo $row['branch'];?></td>
    <td width="20%"><img src="../images/me.gif" width="50%" height="15%"></td>

	<?php /*if(empty($row['suppliername']) || $row['suppliername']=='1449' || $row['suppliername']=='1450' || $row['suppliername']=='1452' || $row['suppliername']=='1453' || $row['suppliername']=='1454' || $row['suppliername']=='1455' || $row['suppliername']=='1456'  || $row['suppliername']=='1458'  || $row['suppliername']=='14025'  || $row['suppliername']=='14066' || $row['suppliername']=='14317' ){?>
	<form action="" method="post"><input type="date" name="date" value="<?php echo $row['oil_next'];?>"><input type="hidden" value="<?php echo $row['id'];?>" name="id"> &nbsp;&nbsp;&nbsp;<input type="submit" value="Extend" onclick="return confirm('Do you want to proceed?');" name="submit" /></form><?php }else{ echo '<h3>No Action</h3>';}*/?>
    </tr>
	<?php
		//}
	}
?>
</table>
</td>
</tr>
</table>
</center>