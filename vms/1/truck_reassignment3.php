	<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
include('../title.php');
?>
 <?php
 include('connect.php');

 ?>
 <link href="../css/tables.css" media="screen" rel="stylesheet" type="text/css" />
 <?php //facebox==========================================================================?>

<script src="../js/jquery.min.js" type="text/javascript"></script>
<link href="../css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../js/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage: '../src/loading.gif',
            closeImage: '../src/closelabel.png'
        })
    })
</script>
<?php //=====================================================?>
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
    <link rel="stylesheet" href="../css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
   <img src="../image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Vehicle</a></li>
   <li ><a href="existing_truck.php">Existing Vehicles</a></li>
      <li ><a href='maintenance.php'>Maintenance</a></li>
   <li ><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li  class='active'><a href="truck_reassign.php">Vehicle Reassignment</a></li>
      <li><a href='inventory.php'>Inventory</a></li>
       <li><a href='trip.php'>Trip Schedule</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
            <li><a href='otheraccount.php'>Other Account</a></li>
         <li><a href="logout.php">Logout</a></li>
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
 <table width="68%">
 <tr>
 <td align="center" colspan="3">
 <form   action="truck_reassign_submit1.php?p=<?php echo $_GET['p'];?>" method="post">
 Permanent<input type="radio" value="Permanent" name="status" required="required">
 &nbsp;&nbsp;&nbsp;&nbsp;
 Repair<input type="radio" value="For Repair" name="status"></td>
 </tr>

<tr>
<?php $select_id = mysql_query("Select * from tbl_truck_report Where truckplate='".$_POST['plate']."'") or die(mysql_error());
$row_id = mysql_fetch_array($select_id);
?>

<td >
  <input type="hidden" name="plate" value="<?php echo $row_id['id'];?>">

</tr>
<tr>
<tr><td><br /></td></tr>
<td>Plate No.<input  type="text"  value="<?php echo $_GET['p'];?>" name="plate"  disabled="disabled">
<input  type="hidden"  value="<?php echo $_GET['p'];?>" name="plate"  ></td>



         <td align="center">Sending Branch:<?php
	$given = mysql_query("Select * from tbl_truck_report Where truckplate='".@$_GET['p']."'") or die(mysql_error());
	$givenrow = mysql_fetch_array($given);
	$given_name = $givenrow['id'];
	$select = mysql_query("Select * from tbl_givento Where truckid='$given_name'") or die (mysql_error());
	$select_row = mysql_fetch_array($select);
	?><input type="text" value="<?php 	echo $givenrow['branch'];?>"  disabled="disabled">
    <input type="hidden" name="old_suppname" value="<?php 	echo $givenrow['branch'];?>"  >
    

   
    </td>
<td  align="left">Receiving Branch: <input type="text"  value="<?php echo $_POST['rec_branch'];?>"  disabled>
<input type="hidden" name="suppliername" value="<?php echo $_POST['rec_branch'];?>" >

</td>
</tr>
</table><br /><br />
<?php

$givento = mysql_query ("SELECT * FROM tbl_givento Where truckid='".$select_row['id']."'");
$given_row = mysql_fetch_array($givento);
$timezone=+8;
	 $date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));

?>
<table>
<tr>
<td align="center" colspan="3"><font size="+1" style="text-decoration:underline">Inssuance Date: <?php echo $date;?></font></td>
</tr>
</table>
<br />
<br />
<center>
<table width="30%" align="center">
   	    <tr>
    <td align="center" colspan="3" width="30%"><h3>Inclusive Items</h3></td>
    </tr>
    <tr>
    <td>
   <table  class="CSSTableGenerator" >
    <tr>
    <td>Item</td>
    <td>Quantity</td>
    <td>Remarks</td>
    </tr>
 
<?php 
$plate  = mysql_query("Select * from tbl_truck_report Where truckplate = '".$_POST['plate']."'")  or die (mysql_error());
$plate_row = mysql_fetch_array($plate);
$tools = mysql_query("Select * from tbl_trucktools Where truckid = '".$plate_row['id']."' ")  or die (mysql_error());
while($tools_row =mysql_fetch_array($tools)){?>
	   <tr>
    <td><?php echo $tools_row['toolname'];?></td>
    <td><?php echo $tools_row['qty'];?></td>
    <td><?php echo $tools_row['toolname'];?></td>
    </tr>
	<?php }
?>

  </table>
  </td>
  </tr>
  </table>
  </center>
  <br />
<br />
<center>
<table align="center">
<tr>
<td colspan="5" rowspan="2"><br />Remarks:<br/><center><textarea name="remarks" cols="50" rows="5" id="text" onKeyUp="caps(this)"></textarea></center></td>
<tr>
<td><br /><br /></td>
</tr>
<tr>
</tr>

<tr>
<td><br /><br /></td>
</tr>
<tr><td colspan="2">
<script>
function back(){
	window.history.back();
	}
</script>
<input type="hidden" name="date" value="<?php echo $date;?>"> 
<input type="button" value="Back" onclick="back();"></td>
<td  colspan="3" align="right">
<input type="submit" value="Submit" onclick="return confirm('Do you want to Submit?');"></form></td>
<td></td>
<td></td>
</tr>
</table>





</center>

</table>

<?php //endtofcode===========================================================================?>
    <br /><br />
<img src="../image/footer.png" height="8%" width="100%"> 