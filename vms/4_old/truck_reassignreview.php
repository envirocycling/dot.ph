<?php
session_start();
if(!isset($_SESSION['encoder_username'])){
	header("Location: ../index.php");
	}

?>
 <title>EFI Vehicles Report</title>
 <?php
 include('connect.php');

 ?>
     <link rel="stylesheet" href="../css/tables.css">

   <script src="../js/val_tools.js" type="text/javascript"></script>
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

   <li><a href="new_truck.php">New Truck</a></li>
   <li  ><a href="existing_truck.php">Existing Trucks</a></li>
     <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Truck Registration</a></li>
     <li class='active'><a href="truck_reassign.php">Truck Reassignment</a></li>
      <li><a href='inventory.php'>Inventory</a></li>
 
        <li>|                |</li> 
        <li><a href='myaccount.php' rel='facebox'>MyAccount</a></li>
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
    <table width="70%" >
 

<tr><td><h4>Recent Assign:</h4></td></tr>
<td>Plate No.<input  type="text" name="f_palte" value="<?php echo $_GET['p'];?>" readonly="readonly"></td>



         <td   align="left">Suppliername:<?php
	$given = mysql_query("Select * from tbl_truck_report Where truckplate='".@$_GET['p']."'") or die(mysql_error());
	$givenrow = mysql_fetch_array($given);
	$given_name = $givenrow['id'];
	$select = mysql_query("Select * from tbl_givento Where truckid='$given_name'") or die (mysql_error());
	$select_row = mysql_fetch_array($select);
	?><input type="text" name="suppname_old" value="<?php 	echo $select_row['suppliername'];?>" disabled="disabled">
   
    </td>
<td  align="left">Branch: <input type="text" name="branch" value="<?php echo $givenrow['branch'];?>" disabled="disabled"></td>
</tr>
</table>
<br />
<?php
$select = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['p']."'") or die(mysql_error());
$row_select = mysql_fetch_array($select);

 $select_tblreassign = mysql_query("Select * from tbl_reassign Where truckid='".$row_select['id']."' ") or die(mysql_error());
 $select_tblreassign_row = mysql_fetch_array($select_tblreassign);
 
 $select_tbltoolreassign = mysql_query("Select * from tbl_toolreassign Where truckid='".$row_select['id']."' And reassign !=0 ") or die(mysql_error());


 $select_tbltoolreassign2 = mysql_query("Select * from tbl_trucktools Where truckid='".$row_select['id']."' And reassign !=0 ") or die(mysql_error());

 ?>
 <br />
<table >
<tr>
<td><h4>Re-Assign To:</h4></td>
</tr>
<tr>
<td>Suppliername:
<?php if(mysql_num_rows($select_tblreassign) > 0){?>
<input type="text" name="suppliername" value="<?php echo $select_tblreassign_row['name'];?>" disabled="disabled"></td>
<td>Branch:<input type="text" name="branch" value="<?php echo $select_tblreassign_row['suppliername'];?>" disabled="disabled"></td>
<?php }else if(mysql_num_rows($select_tblreassign) == 0){
	$selects = mysql_query("Select * from tbl_givento Where truckid='".$row_select['id']."'") or die (mysql_error());
	$rows =mysql_fetch_array($selects);
	?>
<input type="text" name="suppliername" value="<?php echo $rows['suppliername'];?>" disabled="disabled"></td>
<td>Branch:<input type="text" name="branch" value="<?php echo $rows['name'];?>" disabled="disabled"></td>
<?php }?>
</tr>
</table>
<br />
<table width="30%" align="center">
<tr>
<td>
<table class="CSSTableGenerator">
<tr>
<td>Toolname</td>
<td width="30%">Quantity</td>
</tr>
<form action="" method="post">
<?php while($select_tbltoolreassign_row = mysql_fetch_array($select_tbltoolreassign)){ ?>
<tr>
<td><?php echo $select_tbltoolreassign_row['toolname'];?>
	<input type="hidden" name="toolname" value="<?php echo $select_tbltoolreassign_row['toolname'];?>">
    </td>
<td><?php if($select_tbltoolreassign_row['reassign'] == 0){
	echo $select_tbltoolreassign_row['qty'];
	?><input type="hidden" name="qty" value="<?php echo $select_tbltoolreassign_row['qty'];?>"><?php
	}else{echo $select_tbltoolreassign_row['reassign'];
	?><input type="hidden" name="qty" value="<?php echo $select_tbltoolreassign_row['reassign'];?>"><?php
	}?></td>
</tr>
<?php } ?>
<?php while($select_tbltoolreassign_row2 = mysql_fetch_array($select_tbltoolreassign2)){ ?>
<tr>
<td><?php echo $select_tbltoolreassign_row2['toolname'];?>
	<input type="hidden" name="toolname" value="<?php echo $select_tbltoolreassign_row2['toolname'];?>">
    </td>
<td><?php if($select_tbltoolreassign_row2['reassign'] == 0){
	echo $select_tbltoolreassign_row2['qty'];
	?><input type="hidden" name="qty" value="<?php echo $select_tbltoolreassign_row2['qty'];?>"><?php
	}else{echo $select_tbltoolreassign_row2['reassign'];
	?><input type="hidden" name="qty" value="<?php echo $select_tbltoolreassign_row2['reassign'];?>"><?php
	}?></td>
</tr>
<?php } ?>

</table>
<tr>
<td><br /><br /></td>
</tr>
<tr>
<td colspan="2"></form></td>
</tr>
</td>
</tr>
</table>
<table>
<tr>
<td><a href="truck_reassignment1.php?p=<?php echo $_GET['p'];?>"><input type="button" value="BACK"></a></td>
<td width="60%"></td>
<td>
<a href="truck_reassign.php"><input type="button" value="OKAY"></a>
</td>
</tr>
</table>
<br /><br />
<?php

$givento = mysql_query ("SELECT * FROM tbl_givento Where truckid='".$select_row['id']."'");
$given_row = mysql_fetch_array($givento);

?>

<table>
 <br />


<?php //endtofcode===========================================================================?>
<br /><br />
<br /><br />
<img src="../image/footer.png" height="8%" width="100%">     