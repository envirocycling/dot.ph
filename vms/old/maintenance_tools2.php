
<title>EFI Vehicles Report</title>
  <link href="css/tables.css" media="screen" rel="stylesheet" type="text/css" />
<?php // type numbers only==================================================================?>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
<?php // auto submit if change==================================================================?>
<script>
function onSelectChange(){
 document.getElementById('frm').submit();
}</script>
<?php // type numbers only==================================================================?>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
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

  <?php 
include('connect.php');
$qplate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
$rplate = mysql_fetch_array($qplate);
?>
<title>EFI Vehicles Report</title>
<table  width="80%" align="center">
		<tr>
			<td align="center" colspan="2"><h3>Maintenance</h3></td>
      			<td></td>
			</tr>
            <tr>
              <td align="center" colspan="2"><h4>Tools</h4></td>
              <td></td>
			</tr>
</table> 
<form  action="maintenance_tools2.php?id=<?php echo $_GET['id'];?>" id="frm" method="post">
<table align="center" width="50%" >
<tr>
<td><h4>Plate No.<?php echo $rplate['truckplate'];?></h4></td>
</tr>
</table>
 <table width="50%"  align="center">
<tr>
<td>Select Tool:<select name="tool" onChange="onSelectChange()">
<option value="<?php echo $_POST['tool'];?>"><?php echo $_POST['tool'];?></option>
<?php
$select = mysql_query("Select * from tbl_addinventorytool Where zero=0") or die (mysql_query());
while($row = mysql_fetch_array($select)){
?>
<option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
<?php } ?>
<select></td>

</form>
 <br />

 </td>
 <form action="add_selecttool.php?id=<?php echo $_GET['id'];?>" method="post" name="form">
 <input type="hidden" name="tool" value="<?php echo $_POST['tool'];?>">
<?php
$qtools = mysql_query("Select * from tbl_addinventorytool Where name='".$_POST['tool']."'") or die (mysql_error());
$row = mysql_fetch_array($qtools);
 $qty = $row['qty'];
 $issued = $row['issued'];
$remaining = $qty - $issued;
  ?>
<td>Quantity: <input style="width:30%" min="1" max="<?php echo $remaining;?>" type="number" name="qty" id="extra7" onKeyPress="return isNumber(event)" required></td>
<td>Available:
<?php
$qtools = mysql_query("Select * from tbl_addinventorytool Where name='".$_POST['tool']."'") or die (mysql_error());
$row = mysql_fetch_array($qtools);
 $qty = $row['qty'];
 $issued = $row['issued'];
$remaining = $qty - $issued;
echo $remaining; ?>
</td>
</tr>
</table>
<table align="center" width="50%">
<tr>
<td colspan="3" align="center">
<br />
 <input type="hidden" name="remaining" value="<?php echo $remaining;?>">
<input type="submit" name="add" value="ADD"> </td>
</form>

</tr>
</table>

<br />
<table  width="80%" align="center" >
            <tr>
              <td align="center" colspan="2"><h4>List of Added Tools</h4></td>
           
			</tr>
            </table>
             <table width="30%" align="center"><tr><td>
<table  width="30%" border="1px" align="center" class="CSSTableGenerator">
<tr>
<td align="center">Tool Name</td>
<td width="10%" align="center">Quantity</td>
<td width="10%" align="center">Action</td>
</tr>

<?php
$view = mysql_query("Select * from tbl_trucktools Where truckid='".$rplate['truckplate']."'") or die (mysql_error());
while($vrow = mysql_fetch_array($view)){
	?>
    <tr><td><?php echo $vrow['toolname'];?></td>
     <td align="center"><?php echo $vrow['qty'];?></td>
     <td><input type="submit" value="Remove"></td>
     </tr>
	<?php }
?>

</table>
</td>
</tr>
 </table>
 <br /><br />
<br /><br />




<img style="vertical-align: baseline" src="image/footer.png" height="8%" width="100%">
