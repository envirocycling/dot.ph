 <?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
include('../title.php');
?>

  <link href="../css/tables.css" media="screen" rel="stylesheet" type="text/css" />
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


  <?php 
include('connect.php');
$qplate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
$rplate = mysql_fetch_array($qplate);
?>
<title>EFI Vehicles Report</title>
<form  action="maintenance_battery2.php?id=<?php echo $_GET['id'];?>" id="frm" method="post">
 <table width="50%"  align="center">
<tr>
<td>Select Tool:<select name="name" onChange="onSelectChange()">
<option value="<?php echo $_POST['name'];?>"><?php echo $_POST['name'];?></option>
<?php
$select = mysql_query("Select * from tbl_addbattery ") or die (mysql_query());
while($row = mysql_fetch_array($select)){
?>
<option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
<?php } ?>
<select></td>

</form>
 <br />

 </td>
 <form action="add_selectbattery.php?id=<?php echo $_GET['id'];?>" method="post" name="form">
 <input type="hidden" name="plate" value="<?php echo $rplate['truckplate'];?>">
 <input type="hidden" name="name" value="<?php echo $_POST['name'];?>">
<?php
$qtools = mysql_query("Select * from tbl_addbattery Where name='".$_POST['name']."'") or die (mysql_error());
$row = mysql_fetch_array($qtools);
 $qty = $row['qty'];
 $issued = $row['issued'];
$remaining = $qty - $issued;
  ?>
<td>Quantity: <input style="width:30%" min="1" max="<?php echo $remaining;?>" value="1" type="number" name="qty" id="extra7" onKeyPress="return isNumber(event)" required></td>
<td>Available:
<?php
$qtools = mysql_query("Select * from tbl_addbattery Where name='".$_POST['name']."'") or die (mysql_error());
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
              <td align="center" colspan="2"><h4>List of Tools</h4></td>
           
			</tr>
            </table>
             <table width="40%" align="center"><tr><td>
<table  width="30%" border="1px" align="center" class="CSSTableGenerator">
<tr>
<td align="center">Tool Name</td>
<td width="10%" align="center">Quantity</td>
<td width="25%" align="center">Date Added</td>
<td width="10%" align="center">Action</td>
</tr>

<?php
$view = mysql_query("Select * from tbl_trucktools Where truckid='".$rplate['id']."'") or die (mysql_error());
while($vrow = mysql_fetch_array($view)){
	?>
    <tr><td><?php echo $vrow['toolname'];?></td>
     <td align="center"><?php 
	 if($vrow['reassign'] == 0){
	 echo $vrow['qty'];} else if ($vrow['reassign'] >=1 ){ echo $vrow['reassign'];}?> </td>
      <td align="center"><?php echo $vrow['dateadded'];?></td>
      <form action="maintenance_removebat.php?id=<?php echo $_GET['id'];?>" method="post">
     <input type="hidden" name="qty" value="<?php echo $vrow['qty'];?>">
      <input type="hidden" name="id" value="<?php echo $vrow['bid'];?>">
       <input type="hidden" name="id" value="<?php echo $vrow['dateadded'];?>">
     <td><input type="submit" value="Remove" onclick="return confirm('Do you want to Remove?');"></td>
     </tr>
</form>
	<?php }
?>

</table>
</td>
</tr>
 </table>
