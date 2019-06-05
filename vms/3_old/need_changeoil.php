<?php
include('connect.php');

$timezone=+8;
 $date= gmdate('Y-m-d',time() + 3600*($timezone+date("I")));
 //$select_date = mysql_query("Select from tbl_truck_report Where oil_next <= '$date' or oil_next = '' Order by oil_next Desc ") or die (mysql_error());
 $select_date = mysql_query("SELECT * from tbl_truck_report WHERE oil_next='' or oil_next <= '$date'") or die(mysql_error());

?>
<center>
<table width="100%" bgcolor="#000066" border="">
<tr>
<td valign="middle" align="center"><h2><font face="Castellar" color="#FFFFFF">Need to Change Oil</font></h2></td>
</tr>
</table>
<br>
<link href="../css/table.css" media="screen" rel="stylesheet" type="text/css" />
<table width="95%">
<tr>
<td>
<table class="CSSTableGenerator">
<td width="25%">Plate</td>
<td width="25%">Branch</td>
<td>Action</td>
</tr>
<?php 
while($row = mysql_fetch_array($select_date)){
	// $plate = mysql_query("Select * from tbl_truck_report Where id = '".$row['truckid']."'") or die(mysql_error());
//	$plate_row = mysql_fetch_array($plate);
	?>
	<tr>
    <td><?php echo $row['truckplate'];?></td>
    <td><?php echo $row['branch'];?></td>
    <td width="20%"><img src="../images/me.gif" width="100%" height="20%"></td>
    </tr>
	<?php
	}
?>
</table>
</td>
</tr>
</table>
</center>