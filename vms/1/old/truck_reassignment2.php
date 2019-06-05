 <title>EFI Vehicles Report</title>
 <?php
 include('connect.php');
 ?>
 <script>
function getData(dropdown) {
var value = dropdown.options[dropdown.selectedIndex].value;
if (value != 'none'){
document.getElementById("name").style.display = "block";
document.getElementById("name").disabled = false;
}else if(value == 'none'){
	document.getElementById("name").disabled = true;
	} 
}
</script>

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
<script>
function onSelectChange(){
 document.getElementById('frm').submit();
}</script>
<?php //======================================================================================?>

	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
 <?php // headermenu==============?>
    <link rel="stylesheet" href="css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="js/header.js"></script>
   <img src="image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Truck</a></li>
   <li  ><a href="existing_truck.php">Existing Trucks</a></li>
     <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Truck Registration</a></li>
     <li class='active'><a href="truck_reassign.php">Truck Reassignment</a></li>
      <li><a href='inventory.php'>Inventory</a></li>
 
        <li>|                |</li> 
         <li><a href="registration_monitoring.php">Logout</a></li>
</ul>
</div><br /> 

<?php //startofcode===========================================================================?>
<br />

		<table align="center">
			<tr>
				<td colspan="2"><h3>Truck Reassignment</h3></td>
                <td></td>
            </tr>
  </table>
 <center>
 <table width="60%">
 

<tr>

<form id="frm" action="a.php?p=<?php echo $_GET['p'];?>" method="post">
<td>Select Other Plate No.
<select name="plate" onchange="onSelectChange();" >

<option value="<?php echo $_POST['p'];?>"><?php echo $_GET['p'];?></option>
<?php

$query=mysql_query("Select * from tbl_truck_report") or die (mysql_error());
while($row = mysql_fetch_array($query)){?>
	
    <option value="<?php echo $row['truckplate'];?>"><?php echo $row['truckplate'];?></option><?php
	}
?>
</select></form>  

<form action="truck_reassign_submit.php?p=<?php echo $_GET['p'];?>" method="post">
  <input type="hidden" name="plate" value="<?php echo $_POST['plate']?>">
</tr>
<tr>
<tr><td><br /></td></tr>
<td>Plate No.<input  type="text" name="f_palte" value="<?php echo $_GET['p'];?>" readonly="readonly"></td>



         <td  width="40%" align="left">Suppliername:<?php
	$given = mysql_query("Select * from tbl_truck_report Where truckplate='".@$_GET['p']."'") or die(mysql_error());
	$givenrow = mysql_fetch_array($given);
	$given_name = $givenrow['id'];
	$select = mysql_query("Select * from tbl_givento Where truckid='$given_name'") or die (mysql_error());
	$select_row = mysql_fetch_array($select);
	?><input type="text" name="suppname_old" value="<?php 	echo $select_row['suppliername'];?>" readonly="readonly">
   
    </td>
<td  align="left">Branch: <input type="text" name="branch" value="<?php echo $givenrow['branch'];?>" / readonly="readonly"></td>
</tr>
</table><br /><br />
<?php

$givento = mysql_query ("SELECT * FROM tbl_givento Where truckid='".$select_row['id']."'");
$given_row = mysql_fetch_array($givento);

?>
<table>
<td>Reassign To:  </td>
   
  <td><select name="suppname" >
  <option value="none">NONE</option>
  <?php 
													$branch =  mysql_query("Select * from branches") or die (mysql_error());
													while(	$branch_row = mysql_fetch_array($branch)){
														?>
                                                <option value="<?php echo strtoupper($branch_row['branch_name']);?>" onclick=""><?php echo strtoupper($branch_row['branch_name']);?></option>
														<?php }
													?>
                                                    </select></td>
                                                    </tr>
   <tr>
   <td>Name:</td>

   <td><select name="new_name">
   <?php $q = mysql_query("Select * from supplier_details Where branch='".$_POST['suppname']."'") or die(mysql_error());
   echo $_POST['suppname'];
   	while($rq=mysql_fetch_array($q)){
	?>
      <option value="<?php echo $rq['supplier_name'];?>"><?php echo $rq['supplier_name'];?></option>
    <?php } ?>
 
   </select></td>
   </tr>
<tr>
<td>Issuance Date:  </td>
   
  <td><input type="date"  name="issuancedate" value="<?php echo $given_row ['issuancedate']; ?>" ></td>
   <tr>
  <td>End Date: </td>
   
  <td><input type="date"  name="enddate" value="<?php echo $given_row ['enddate']; ?>" ></td>
  </tr>
  <tr>
  <td>Amortization: </td>
   
  <td><input type="text"  name="amortization" value="<?php echo strtoupper($given_row ['amortization']); ?>" id="extra7" onKeyPress="return isNumber(event)" ></td>
  </tr>
  <tr>
  <td>Cash Bond: </td>
   
  <td><input type="text"  name="cashbond" value="<?php echo strtoupper($given_row ['cashbond']); ?>" id="extra7" onKeyPress="return isNumber(event)" ></td>
  </tr>
   <tr>
  <td>Proposed Volume: </td>
   
  <td><input type="text"  name="volume" value="<?php echo strtoupper($given_row ['proposedvolume']); ?>" id="extra7" onKeyPress="return isNumber(event)" ></td>
</tr>
</table>
<br />
<table align="center" width="70%"><tr><td>List of Tools:</td></tr>

		<?php $c=0;
		$tool = mysql_query("Select * from tbl_trucktools Where truckid ='".$_GET['p']."'") or die (mysql_error());
		while($t_row = mysql_fetch_array($tool)){
			$c++;
			?>
            <table align="center"  width="60%"></tr>
       	<tr>
        <td><input type="hidden" name="toolname" value="<?php echo $t_row['toolname'];?>" readonly="readonly"/><?php echo $t_row['toolname'];?></td>
        <td>Quantity:&nbsp;&nbsp;<input value="<?php echo $t_row['qty'];?>" style="width:25%"  type="hidden" name="qty"><?php echo $t_row['qty'];?></td>
        <td align="right">Reassign:</td>
        <td ><input style="width:100%" value="<?php echo $t_row['qty'];?>" max="<?php echo $t_row['qty'];?>"   min="0" value="0" type="number" name="reassign"></td>
        <td align="right">Sold:</td>
        <td ><input style="width:100%" value="0"min="0" max="<?php echo $t_row['qty'];?>" type="number" name="sold"></td>  
           <td width="8%"><input  type="button" value="Update"></td>
           <td width="8%"><input type="button" value="Remove"></td>        
        </tr>
		<?php
		}
		?>


<table>
<tr>
<td><br /><br /></td>
</tr>
<tr>
<tr>
<td><br /></td>
</tr>
<td><table align="right" >
<tr><td><td><br /><br /><br /><br /></td></td></tr>
<tr>
<td>
Prepared By:</td>
<td><input type="text" name="prepared" id="text" onKeyUp="caps(this)" required="required"></td>
</tr>
<tr>

<td colspan="2"><br />Remarks:<br/><center><textarea name="remarks" cols="50" rows="5" id="text" onKeyUp="caps(this)"></textarea></center></td>
<td></td>
<td></td>
</tr>
<tr><td align="center" colspan="2"><input type="submit" value="Submit"></form></td>
<td></td>
<td></td>
</tr>
</table>
<table width="20%" align="left">
<tr><td align="right"><form action="re_addtool.php?p=<?php echo $_GET['p'];?>" method="post">
	<td><input type="submit" name="add" value="Add Tool"></td>
	<input type="hidden" name="plate" value="<?php echo $_POST['plate'];?>"></td>
<td><select name="tools">
		<?php 
		$tool = mysql_query("Select * from tbl_tool") or die (mysql_error());
		while($t_row = mysql_fetch_array($tool)){
			?>
       	<option value="<?php echo $t_row['name'];?>"><?php echo $t_row['name'];?></option>
		<?php
		}
		?></select><form></td>


</tr>
</table>





</center>
</table>

<?php //endtofcode===========================================================================?>
<br /><br />
<img src="image/footer.png" height="8%" width="100%">     