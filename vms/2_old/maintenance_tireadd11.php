<?php
session_start();
if(!isset($_SESSION['bhead_username'])){
	header("Location: ../index.php");
	}

?>
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
$select_tire= mysql_query("Select * from tbl_trucktires Where truckplate='".@$_GET['p']."' And tireid='11'")  or die (mysql_error());
$row_tire = mysql_fetch_array($select_tire);
$select_plate= mysql_query("Select * from tbl_truck_report Where id='".@$_GET['p']."' ") or die (mysql_error());
$row_plate = mysql_fetch_array($select_plate);
$num = mysql_num_rows($select_tire);
?>
<br />
<center><h3><?php echo $row_plate['truckplate'];?></h3></center>
<br />
<form action="maintenance_tireaddupdate.php?p=<?php echo $_GET['p'];?>" method="post" target="tire">
<table width="100%">
<tr>
<td colspan="2" align="center">Available Sapre:<b><?php echo $num;?></b></td>
</tr>
<tr>
<td>Tire ID:</td>
<td><input style="width:87%" type="text" name="tireid" value="11" disabled>
<input  type="hidden" name="tireid" value="11" ></td>
</tr>
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
<input type="submit" value="Update">
</form>
</center><?php if(!empty($row_tire['id'])){?>

<br />
<?php }?>
