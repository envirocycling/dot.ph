<?php 
session_start();
if(!isset($_SESSION['bhead_username'])){
	header("Location:  ../index.php");
	}
include ('connect.php');



$repair = mysql_query("Select * from tbl_forrepair Where id='".$_GET['id']."'") or die (mysql_error());
$rows = mysql_fetch_array($repair);


$plate = mysql_query("Select * from tbl_truck_report Where id='".$rows['truckid']."'") or die (mysql_error());
$rowp = mysql_fetch_array($plate);
?>
    <link rel="stylesheet" href="../css/tables.css">
<table width="68%" >
 

<tr>


<td >


</tr>
<tr>
<tr><td><br /></td></tr>
<td>Plate No.<input  type="text"  value="<?php echo $rowp['truckplate'];?>"   disabled="disabled">
</td>



         <td align="center">Sending Branch:
    <input type="text" name="sending" value="<?php 	echo $rows['sendingbranch'];?>" disabled="disabled" >

   
    </td>
<td  align="left">Receiving Branch:     <input type="text" name="receive" value="<?php 	echo $rows['receivingbranch'];?>" disabled="disabled" >

</tr>
</table><br /><br />
<center>
<table>
<tr>
<td align="center" colspan="3"><font size="+1" style="text-decoration:underline">Date Receive: <?php echo $rows['datereceive'];?></font></td>
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
$tools = mysql_query("Select * from tbl_trucktools Where truckid = '".$rowp['id']."' ")  or die (mysql_error());
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
<td colspan="5" rowspan="2"><br />Remarks:<br/><center><textarea name="remarks" cols="50" rows="5" readonly style="text-align:center"><?php echo $rows['remarks'];?></textarea></center></td>
<tr>
<td><br /><br /></td>
</tr>
<tr>
<td><br /><br /></td>
</tr>
</table>