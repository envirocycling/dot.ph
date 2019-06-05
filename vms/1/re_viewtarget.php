<?php 
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location:  ../index.php");
	}
include ('connect.php');
$assign = mysql_query("Select * from tbl_reassign Where id ='".$_GET['id']."'") or die(mysql_error()); 
$ass_row = mysql_fetch_array($assign);

$plate = mysql_query("Select * from tbl_truck_report Where id='".$ass_row['truckid']."'") or die (mysql_error());
$rows = mysql_fetch_array($plate);
?>
    <link rel="stylesheet" href="../css/tables.css">
<table width="68%" >
 

<tr>


<td >
  <input type="hidden" name="plate" value="<?php echo $rows['truckid'];?>">

</tr>
<tr>
<tr><td><br /></td></tr>
<td>Plate No.<input  type="text"  value="<?php echo $rows['truckplate'];?>"   disabled="disabled">
</td>



         <td align="center">Sending Branch:<?php
	$given = mysql_query("Select * from tbl_truck_report Where truckplate='".@$rows['truckplate']."'") or die(mysql_error());
	$givenrow = mysql_fetch_array($given);
	$given_name = $givenrow['id'];
	$select = mysql_query("Select * from tbl_reassign Where truckid='$given_name'") or die (mysql_error());
	$select_row = mysql_fetch_array($select);
	?><input type="text" value="<?php 	echo $select_row['name'];?>"  disabled="disabled">
    <input type="hidden" name="old_suppname" value="<?php 	echo $select_row['name'];?>"  >

   
    </td>
<td  align="left">Receiving Branch: <input type="text"  value="<?php echo $ass_row['suppliername'];?>"  disabled>
<input type="hidden" name="suppliername" value="<?php echo $ass_row['suppliername'];?>" >

</td>
</tr>
</table><br /><br />
<?php

$givento = mysql_query ("SELECT * FROM tbl_givento Where truckid='".$select_row['id']."'");
$given_row = mysql_fetch_array($givento);
$timezone=+8;
	 $date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));

?>
<center>
<table>
<tr>
<td align="center" colspan="3"><font size="+1" style="text-decoration:underline">Inssuance Date: <?php echo $ass_row['issuancedate'];?></font></td>
</tr>
</table>
</center>
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
    <td>Condition</td>
    </tr>
 
<?php 
$plate  = mysql_query("Select * from tbl_truck_report Where truckplate = '".$rows['truckplate']."'")  or die (mysql_error());
$plate_row = mysql_fetch_array($plate);
$tools = mysql_query("Select * from tbl_trucktools Where truckid = '".$plate_row['id']."' ")  or die (mysql_error());
while($tools_row =mysql_fetch_array($tools)){?>
	   <tr>
    <td><?php echo $tools_row['toolname'];?></td>
    <td><?php echo $tools_row['qty'];?></td>
    <td><?php echo $tools_row['remarks'];?></td>
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
<td colspan="5" rowspan="2"><br />Remarks:<br/><center><textarea name="remarks" cols="50" rows="5" readonly="readonly" style="text-align:center"><?php echo $ass_row['remarks'];?></textarea></center></td>
<tr>
<td><br /><br /></td>
</tr>
<tr>
<td><br /><br /></td>
</tr>
</table>