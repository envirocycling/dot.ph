<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>	<script>
		function view(){
    if(document.getElementById('history').checked){
		document.getElementById('wt').hidden=true;
		document.getElementById('wt1').hidden=true;
		document.getElementById('wt2').hidden=false;
		document.getElementById('b1').hidden=true;
		}else{
			document.getElementById('wt').hidden=false;
				document.getElementById('wt1').hidden=false;
				document.getElementById('wt2').hidden=true;
					document.getElementById('bt1').hidden=false;
			}
		}
	</script>

<script>
		function show(){
    if(document.getElementById('change').checked){
		document.getElementById('t1').hidden=false;
		document.getElementById('t2').hidden=false;
		document.getElementById('t3').hidden=false;
		}else{
			document.getElementById('t1').hidden=true;
				document.getElementById('t2').hidden=true;
					document.getElementById('t3').hidden=true;
			}
	   if(document.getElementById('swap').checked){
		document.getElementById('t11').hidden=false;
		document.getElementById('t22').hidden=false;
		document.getElementById('t33').hidden=false;
		}else{
			document.getElementById('t11').hidden=true;
				document.getElementById('t22').hidden=true;
					document.getElementById('t33').hidden=true;
			}
			}
	</script>
<?php //======================================================================================?>
	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>

<script>
function isNumbers(evt) {
       var ew = event.which;
    if(ew == 32)
        return true;
    if(48 <= ew && ew <= 57)
        return true;
    if(65 <= ew && ew <= 90)
        return true;
    if(97 <= ew && ew <= 122)
        return true;
    return false;
}</script>
<?php
include('connect.php');
$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$_GET['p']."' And tireid='3' And remarks='swap' Order by id Desc LIMIT 1") or die (mysql_error());
$row = mysql_fetch_array($select);

$select_swapto = mysql_query("Select * from tbl_changeswaps Where  truckid='".$_GET['p']."' And swapto='3' And remarks='swap' Order by id Desc LIMIT 1") or die (mysql_error());

if(mysql_num_rows($select_swapto) > 0){
	$row_swapto = mysql_fetch_array($select_swapto);
	$select_tire = mysql_query("Select * from tbl_trucktires Where truckplate='".$_GET['p']."' And tireid='".$row_swapto['tireid']."'") or die (mysql_error());
	
	}

else if(mysql_num_rows($select) > 0){
	$select_tire= mysql_query("Select * from tbl_trucktires Where truckplate='".@$_GET['p']."' And tireid='".$row['swapto']."'") or die (mysql_error());
	}else{
$select_tire= mysql_query("Select * from tbl_trucktires Where truckplate='".@$_GET['p']."' And tireid='3'") or die (mysql_error());}
$row_tire = mysql_fetch_array($select_tire);
$select_plate= mysql_query("Select * from tbl_truck_report Where id='".@$_GET['p']."' ") or die (mysql_error());
$row_plate = mysql_fetch_array($select_plate);
?>
<br />
<form action="maintenance_tireaddupdate.php?p=<?php echo $_GET['p'];?>" method="post" target="tire">
<center><h3><?php echo $row_plate['truckplate'];?></h3>
View History<input type="checkbox" id="history" onchange="view()">
</center>
<br /><br /><br />
<?php $select_historys = mysql_query("Select * from tbl_changeswaps Where remarks='swap' order by id Desc LIMIT 1") or die(mysql_error());
$row_historys = mysql_fetch_array($select_historys);

$select_historyc= mysql_query("Select * from tbl_changeswaps Where remarks='change' And tireid='3' order by id Desc LIMIT 1") or die(mysql_error());
$row_historyc = mysql_fetch_array($select_historyc);
$num = mysql_num_rows($select_historyc);


$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$_GET['p']."' And tireid='3'  And remarks='swap' Order by id Desc LIMIT 1") or die (mysql_error());
$rows =mysql_fetch_array($selects); 
?>
<table id="wt2" hidden="">
<?php if(mysql_num_rows($select_historyc) > 0){?>

<tr>
<td><center><h4>Change Tire</h4></center></td>
</tr>
<tr>
<td>
No.of Change Tire/s:</td>
<td><?php echo $num; ?></td>
</tr>
<tr>
</tr>
<tr>
<td >Last Tire:</td>
<td><?php echo $row_historyc['tirename'];?></td>
</tr>
<tr>
<td></td>
<td><?php echo $row_historyc['tiresize']."  ".$row_historyc['description'];?></td>
</tr>
<tr>
<td >Life Span:</td>
<td><?php 
$sp = "/";
$date = explode("-",$row_historyc['lifespan']);
echo $date[0]." month".$sp."s  ".$date[1]." day".$sp."s";?></td>
</tr>
<tr>
<td>Reason</td>
<td><?php echo $row_historyc['reason'];?></td>
</tr>
</tr>
<tr>
<td colspan="3">_________________________________</td></tr>
<?php }


if(mysql_num_rows($selects) > 0){?>
<tr>
<td align="center">
<h4>Swap Tire</h4></td>
</tr>
<tr>
<td>Swap To:</td>
<td>3</td>
</tr>
<tr>
<td>Reason:</td>
<td><?php echo $rows['reason'];?></td>
</tr>
<?php }?>
</table>
<?php
$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$_GET['p']."' And tireid='3' Order by id Desc LIMIT 1") or die (mysql_error());
$rows =mysql_fetch_array($selects); 
?>
<table width="100%" id="wt" ><?php
if(mysql_num_rows($selects) > 0){?>
<tr>
<td align="right">Remarks:</td>
<td ><?php
 echo strtoupper($rows['remarks']);?></td>
</tr>
<?php } ?>
<tr>
<td>Tire ID:</td>
<td>
<?php if(!empty($row_tire['tireid'])){?>
<input style="width:87%" type="text"  value="<?php echo $row_tire['tireid']?>" disabled>
<input  type="hidden" name="tireid" value="<?php echo $row_tire['tireid']?>" ><?php }else{?>
<input style="width:87%" type="text"  value="3" disabled>
<input  type="hidden" name="tireid" value="3" >
<?php } ?>
</td></tr>
<tr>
<td>Brand:</td>
<td><input type="text" style="width:87%" name="tirename" value="<?php echo @$row_tire['tirename'];?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" required="required"	></td>
</tr>
<tr>
<td>Code No:</td>
<td><input type="text" style="width:87%" name="tiresize" value="<?php echo @$row_tire['tiresize'];?>"  id="text" onKeyUp="caps(this)"  required="required"	></td>
</tr>
<tr>
<td width="45%">Part No:</td>
<td><input type="text" style="width:87%" name="description" value="<?php echo @$row_tire['description'];?>"  id="text" onKeyUp="caps(this)"  required="required"	 /></td>
</tr>
<tr>
<td width="45%">Date Installed:</td>
<td><input type="date" style="width:87%" name="dateadded" value="<?php echo @$row_tire['dateadded'];?>"  required="required"	></td>
</tr>

</table>
<br/>
<center>
<input type="submit" value="Update" id="b1">
</center>
</form>
<br />
<?php if(!empty($row_tire['id'])){?>

<br />
<form action="change_swap.php?p=<?php echo $_GET['p'];?>" method="post">
<input type="hidden" name="tirename" value="<?php echo  $row_tire['tirename'];?>">
<input type="hidden" name="tiresize" value="<?php echo  $row_tire['tiresize'];?>">
<input type="hidden" name="description" value="<?php echo  $row_tire['description'];?>">
<input type="hidden" name="addedby" value="<?php echo  $row_tire['addedby'];?>">
<input type="hidden" name="dateadded" value="<?php echo  $row_tire['dateadded'];?>">
<input type="hidden" name="post" value="<?php echo  $row_tire['position'];?>">

<table width="100%" id="wt1">

<input type="hidden" name="id" value="<?php echo $row_tire['id'];?>">
<input type="hidden" name="tireid" value="<?php echo $row_tire['tireid'];?>">
<tr><td>
<input type="radio" name="radio" id="change" onchange="show()" value="change">Change Tire
</td>
<td>
<input type="radio" name="radio" id="swap" onchange="show()" value="swap">Swap Tire
</td>
</tr>
<tr id="t1" hidden="">
<td><br />Select Spare:</td>
<td><br />
<?php $selected = mysql_query("Select * from tbl_trucktires Where status='Spare' And truckplate='".$_GET['p']."'") or die(mysql_error());
$selecteds = mysql_query("Select * from tbl_trucktires Where status='Spare' And truckplate!='".$_GET['p']."'") or die(mysql_error());	?>
<select name="spare">
<?php while($row_selected = mysql_fetch_array($selected)){
$select_id = mysql_query("Select * from tbl_truck_report Where id='".$row_selected['truckplate']."'") or die (mysql_error());
$row1 =mysql_fetch_array($select_id);
?>
<option value="<?php echo $row_selected['id']."-".$row_selected['truckplate'];?>"><?php echo $row_selected['tirename']."-".$row1['truckplate'];?></option>
<?php } ?>
<?php while($row_selecteds = mysql_fetch_array($selecteds)){
$select_ids = mysql_query("Select * from tbl_truck_report Where id='".$row_selecteds['truckplate']."'") or die (mysql_error());
$row11 =mysql_fetch_array($select_ids);
?>
<option value="<?php echo $row_selected['id']."-".$row_selected['truckplate']."-".$row_selected['id'];?>"><?php echo $row_selected['tirename']."-".$row1['truckplate'];?></option>
<?php } ?>
</select>
</td>
</td>
<tr id="t2" hidden="">
<td>Reason:</td>
<td><select name="reasons">
<option value="Worn Out/ Pudpod">Worn Out/ Pudpod</option>
<option value="Broken">Broken</option>
</select></td>

</tr>
<tr>
<td colspan="1" hidden="" align="center" id="t3">
<br />
<input type="submit" value="Change Tire"></td></tr>
<tr id="t11" hidden="">
<td><br />Select In Used :</td>
<td><br /><select name="inused">
<?php
$select_inused = mysql_query("Select * from tbl_trucktires Where truckplate='".$_GET['p']."' And status='In Used'") or die(mysql_error());
while ($row_inused = mysql_fetch_array($select_inused)){
	if($row_inused['tireid'] != $row_tire['tireid']){
?><option value="<?php echo $row_inused['tireid'];?>"><?php echo $row_inused['tireid'];?></option><?php }
}
?>
</select></td>
</td>
<tr id="t22" hidden="">
<td>Reason:</td>
<td><select name="reason">
<option value="Worn Out/ Pudpod">Worn Out/ Pudpod</option>
<option value="Broken">Broken</option>
<option value="Flat">Flat</option>
</select></td>
</tr>
<tr>
<td colspan="2" hidden="" align="center" id="t33">
<br />
<input type="submit" value="Swap Tire" ></td></tr>

</table>
</form>


<?php }?>