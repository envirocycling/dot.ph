<?php
include('connect.php');
session_start();
$timezone=+8;
$date= gmdate('m',time() + 3600*($timezone+date("I")));
if($date < 10){
	$m=substr($date,1);
}else{
	$m= $date;
	}

 $select = mysql_query("Select * from tbl_truckregistration Where status='0' ") or die (mysql_error());

?>
<center>

<br>
<link href="css/table.css" media="screen" rel="stylesheet" type="text/css" />
<table width="100%">
<tr>
<td>
<table class="CSSTableGenerator">
<td >Branch</td>
<td>Plate</td>
<td>Insurance</td>
<td>Stencil</td>
<td>Emission</td>
<td>Description</td>
</tr>
<?php 
while($row = mysql_fetch_array($select)){
	$plate = mysql_query("Select * from tbl_truck_report Where id ='".$row['truckid']."' And ending='$m' and  class!='HE' and branch='".$_SESSION['owner']."' and status=''") or die(mysql_error());
	$rplate = mysql_fetch_array($plate);
	 if(mysql_num_rows($plate) > 0){
	?>
	<tr>
        <td><?php echo $rplate['branch'];?></td>
    <td><?php echo $rplate['truckplate'];?></td>
    <td><?php echo $row['insurance'];?></td>
     <td><?php echo $row['stencil'];?></td>
     <td><?php echo $row['emission'];?></td>
    <td width="20%"><img src="../images/register.gif" width="100%" height="15%"></td>
    </tr>
	<?php
	}
}
?>
</table>
</td>
</tr>
</table>
</center>