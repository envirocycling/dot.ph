
	
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
}
</script>
<script>
	function history(){
		if(document.getElementById('history').checked){
			document.getElementById('tbl_new').hidden=true;
			document.getElementById('tbl_history').hidden=false;
			document.getElementById('change').disabled=true;
			document.getElementById('swap').disabled=true;
		}else{
			document.getElementById('tbl_new').hidden=false;
			document.getElementById('tbl_history').hidden=true;
			document.getElementById('change').disabled=false;
			document.getElementById('swap').disabled=false;
		}
	}

	function dis(){
		if(document.getElementById('change').checked){
			document.getElementById('swap').disabled=true;
			document.getElementById('tbl_swap').hidden=true;
			document.getElementById('tbl_new').hidden=true;
			document.getElementById('tbl_change').hidden=false;
			document.getElementById('history').disabled=true;
		}else{
			document.getElementById('swap').disabled=false;
			document.getElementById('tbl_change').hidden=true;
			document.getElementById('tbl_new').hidden=false;
			document.getElementById('history').disabled=false;
		}
		if(document.getElementById('swap').checked){
			document.getElementById('change').disabled=true;
			document.getElementById('tbl_swap').hidden=false;
			document.getElementById('tbl_new').hidden=true;
			document.getElementById('history').disabled=true;
		}else{
			document.getElementById('change').disabled=false;
			document.getElementById('tbl_swap').hidden=true;
		}
	
	}

</script>
<?php
include('connect.php');
$truck_id = $_GET['id'];
$tire_id = $_GET['tire'];
$txt_plate = $_GET['p'];

$select_tire = mysql_query("SELECT * from tbl_trucktires WHERE truckplate='$truck_id' and tireid='$tire_id'") or die (mysql_error());
$row_tire = mysql_fetch_array($select_tire);

if(mysql_num_rows($select_tire) == 0){
$val = 'disabled';
}else{
$val='';
}

$select_swap = mysql_query("SELECT * from tbl_trucktires WHERE tireid!='$tire_id' and truckplate='$truck_id' order by tireid ASC") or die(mysql_error());

$select_history = mysql_query("SELECT * from tbl_changeswaps WHERE tireid='$tire_id' and truckid='$truck_id' and remarks='change' order by date_change") or die (mysql_error());


?>
<br />
<center>
<table>
	<tr align="center">
		<h3><?php echo $txt_plate;?></h3>
		Change<input type="checkbox" value="change" name="change" id="change" onclick="dis();" <?php echo $val;?>> | Swap<input id="swap" type="checkbox" name="swap" value="swap" onclick="dis();" <?php echo $val;?>> | History<input type="checkbox" name="history" id="history" onclick="history();">
		<h6>Tire <?php echo $tire_id;?></h6>
	</tr>
</table>

<table id="tbl_new" name="tbl_new1">
<form action="maintenance_tireaddupdate.php?status=new&tireid=<?php echo $tire_id.'&plate_id='.$truck_id;?>" method="post">
	<tr>
		<td>Brand :</td>
		<td><input type="text" style="width:100%;" name="brand" onkeyup="caps(this)" value="<?php echo $row_tire['tirename'];?>" required></td>
	</tr>
	<tr>
		<td>Code No :</td>
		<td><input type="text" style="width:100%;" name="code" onkeyup="caps(this)" value="<?php echo $row_tire['tiresize'];?>" required></td>
	</tr>
	<tr>
		<td>Part No :</td>
		<td><input type="text" style="width:100%;" name="part" onkeyup="caps(this)" value="<?php echo $row_tire['description'];?>" required></td>
	</tr>
	<tr>
		<td>Date Installed :</td>
		<td><input type="date" style="width:100%;" name="date" value="<?php echo $row_tire['dateadded'];?>" required></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><br/><?php if($val != ''){?><input type="submit" onclick="return confirm('Do you want to proceed?');"  value="Insert" /><?php }else{ echo "<input type='submit' value='Update' onclick=\"return confirm('Do you want to proceed?');\"  />";}?></td>
	</tr>
	</form>
</table>

<table id="tbl_change"  hidden>
	<form action="maintenance_tireaddupdate.php?status=change&tireid=<?php echo $tire_id.'&plate_id='.$truck_id;?>" method="post">
	<tr>
		<td>Reason :</td>
		<td><input type="text" style="width:100%; font-size:10px;" name="reason_change" onkeyup="caps(this)" required></td>
	</tr>
	<tr>
		<td>Brand :</td>
		<td><input type="text" style="width:100%;" name="brand_change" onkeyup="caps(this)" required></td>
	</tr>
	<tr>
		<td>Code No :</td>
		<td><input type="text" style="width:100%;" name="code_change" onkeyup="caps(this)" required></td>
	</tr>
	<tr>
		<td>Part No :</td>
		<td><input type="text" style="width:100%;" name="part_change" onkeyup="caps(this)" required></td>
	</tr>
	<tr>
		<td>Date Installed :</td>
		<td><input type="date" style="width:100%;" name="date_change" required></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><br/><input type="submit" value="Change Tire" onclick="return confirm('Do you want to proceed?');"  /></td>
	</tr>
	</form>
</table>

<table id="tbl_swap" hidden width="100%">
	<form action="maintenance_tireaddupdate.php?status=swap&tireid=<?php echo $tire_id.'&plate_id='.$truck_id;?>" method="post">
	<tr>
		<td>Reason:</td>
	</tr>
	<tr>
		<td><input type="text" name="swap_reason" style="width:70%; font-size:10px;" onkeyup="caps(this);" required></td>
	</tr>	
	<tr>
		<td>Date Swap:</td>
	</tr>
	<tr>
		<td><input type="date" name="swap_date" style="width:70%;" required></td>
	</tr>	
	<tr>
		<td colspan="2">Select Tire :</td>
	</tr>
	<tr>
		<td colspan="2">
		<select name="swap_tire" style="width:70%;" required>
			<?php 
			if(mysql_num_rows($select_swap) == 0){
				echo "<option value=''  disabled>No Tire Found</option>";
			}else{
			while($swap_row = mysql_fetch_array($select_swap)){
			echo "<option value='".$swap_row['tireid']."'>".$swap_row['tireid']." - ".$swap_row['tirename']."</option>";
			}}?>
			 </select>&nbsp;&nbsp;<input type="submit" style="width:75px;" onclick="return confirm('Do you want to proceed?');" value="Swap Tire"></td>
	</tr>
	</form>
</table>

<table id="tbl_history" hidden width="100%" style="border-collapse:collapse;" border="">
	<tr>
		<td colspan="5" align="center"><h4>Change</h4></td>
	</tr>
	<tr bgcolor="#333333" style="color:#FFFFFF;">
		<td align="center" colspan="2">Date</td>
		<td>Lifespan</td>
		<td rowspan="2" width="35%" align="center">Brand</td>
		<td rowspan="2" align="center">Reason</td>
	</tr>	
	<tr bgcolor="#333333" style="color:#FFFFFF; font-size:11px;">
		<td>Installed</td>
		<td>Replace</td>
		<td align="center">Month</td>
	</tr>
	<?php 
		while($history_row = mysql_fetch_array($select_history)){
		
		$ins_date = date('M d,Y',strtotime($history_row['dateadded']));
		$rep_date = date('M d,Y',strtotime($history_row['date_change']));
		?>
		
		<tr  style="font-size:14px;">
			<td><?php echo $ins_date;?></td>
			<td><?php echo $rep_date;?></td>
			<td align="center"><?php echo $history_row['lifespan'];?></td>
			<td><?php echo $history_row['tirename'];?></td>
			<td><?php echo $history_row['reason'];?></td>
	  </tr>
		<?php
		}
	?>
	<tr>
		<td align="center" colspan="5"><br /><h4>Swap</h4></td>
	</tr>
	<tr bgcolor="#333333" style="color:#FFFFFF; font-size:12px;">
		<td colspan="2">Date</td>
		<td width="100%">Swap To</td>
		<td colspan="2">Reason</td>
	</tr>
	<?php
	$swap_se = mysql_query("SELECT * from tbl_changeswaps WHERE truckid='$truck_id' and tireid='$tire_id'") or die (mysql_error());
	while($se_row = mysql_fetch_array($swap_se)){
	$select_tire2 = mysql_query("SELECT * from tbl_trucktires WHERE tireid='".$se_row['swapto']."' and truckplate='".$se_row['truckid']."' ") or die (mysql_error());
	$tire2_row= mysql_fetch_array($select_tire2);
	?>
	<tr style="font-size:12px;">
		<td colspan="2"><?php echo $se_row['date_change'];?></td>
		<td><?php echo $se_row['swapto'].'-'.$tire2_row['tirename'];?></td>
		<td colspan="2"><?php echo $se_row['reason'];?></td>
	</tr>
	<?php
	}
	?>

</table>

</center>
<br />
