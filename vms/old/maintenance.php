 <?php
 include('connect.php');
 ?>
 <?php // headermenu==============?>
    <link rel="stylesheet" href="css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="js/header.js"></script>
   <img src="image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Truck</a></li>
   <li ><a href="existing_truck.php">Existing Trucks</a></li>
      <li class='active'><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Truck Registration</a></li>
     <li><a href="truck_reassign.php">Truck Reassignment</a></li>
     <li><a href='inventory.php'>Inventory</a></li>

        <li>|                |</li> 
         <li><a href="logout.php.php">Logout</a></li>
</ul>
</div><br /> 
<?php //query =================================================
$plate=mysql_query("Select * from tbl_truck_report") or die (mysql_error());
?>

<?php //startofcode===========================================================================?>
<table  width="80%" align="center">
		<tr>
			<td align="center" colspan="2"><h3>Maintenance</h3></td>
			<td></td>
			</tr>
</table> 

<form action="maintenance_before.php" method="post"> 

<table width="60%"  align="center">
<tr>
<td><input type="submit" value="Filter" name="filter"></td>
<td>Plate No:<select name="plate">
<?php if(isset($_POST['filter'])){
		?><option value="<?php echo $_POST['plate'];?>"><?php echo $_POST['plate'];?></option><?php }
		 while ($row = mysql_fetch_array($plate)){
		 ?>
		<option value="<?php echo $row['truckplate']?>"><?php echo $row['truckplate'];?></option>
	<?php	}?>
	</select></td>
<td  width="70%"><select name="maintain">
<?php	if(isset($_POST['filter'])){
		?><option value="<?php echo $_POST['maintain'];?>"><?php echo $_POST['maintain'];?></option><?php } ?>
	<option value="TIRE">TIRE</option>
    <option value="TOOLS">TOOLS</option>
    <option value="BATTERY">BATTERY</option>
    </select></td>
</tr>
</table>
</form>

<?php //endtofcode===========================================================================?>
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />

<img src="image/footer.png" height="8%" width="100%">     