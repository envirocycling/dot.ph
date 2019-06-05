
<!doctype html>
<html lang=''>
<head>
	<title>Vehicle Management System</title>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/tables2.css">
   <script src="js/header.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
   <script src="../js/update_all.js" type="text/javascript"></script>
   <style>
   	.txtbox{
		text-transform:uppercase;
	}
	.text{
		text-transform:uppercase;
		font-size:10px;
	}
   </style>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function decimal(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 46 || (charCode > 47 && charCode < 58)) {
        return true;
    }
    return false;
}
</script>
</head>
<body>
<html>

<?php include('layout/header.php');include('connect.php');?>

<center>
			<div id="body">
				<table id="page1"><tr><td align="left">Trip Schedule : View<td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
				<br/>


<?php //startofcode===========================================================================?>
 <center>
<?php
include('connect.php');
$timezone=+8;
$m = $_GET['id'];
$id = explode('-',$m);
$year= $id[3];
?>
	

    <br /><br /><br />
    
<table width="100%"	>
<tr>
<td width="40%" align="right">Month :</td>
<td align="left">
<input value='<?php echo $id[1];?>' id='my' type='hidden'>
<font size="+2" style="text-decoration:underline"><?php echo $id[1].', '.$id[3];?></font></td>
</tr>
<tr>
<td align="right">Plate No :</td>
<td align="left"><font size="+1" style="text-decoration:underline"><?php echo $id[0];?></font></td>
</tr>
</table>
<br /><br />

<?php 
$select = mysql_query("Select * from tbl_truck_report Where truckplate = '".$id[0]."'") or die (mysql_error());
$plateid = mysql_fetch_array($select);
?>
<input type="hidden" name="pno" id='pno' value="<?php echo $plateid['id'];?>">
<input type="hidden" name="y" id='year' value="<?php echo $year;?>">
<input type="hidden" name="m" id="month" value="<?php echo $id[1];?>">
<?php
$ms = $id[1];
$input = mysql_query("Select * from tbl_input Where	truckid='".$plateid['id']."' order by id ASC LIMIT 1 ") or die (mysql_error());

$rows = mysql_fetch_array($input);
if(mysql_num_rows($input) >= 1){?>
	<input type="hidden" value="1" id="inputs">
<?php }
if(mysql_num_rows($input) == 0){
?>

<form action="trip_input.php?id=<?php echo $_GET['id'];?>" method="post">
<input type="hidden" value="0" id="inputs">
<input type="hidden" name="pno" value="<?php echo $plateid['id'];?>">
<input type="hidden" name="y" value="<?php echo $year;?>">
<input type="hidden" name="m" value="<?php echo $id[1];?>">
<table align="left" width="550px" >
    <tr>
        <td><font size="-1">Please Input the ff:</font></td>
    </tr>
    <tr>
     <td>Diesel Convertion:</td>
    <td>
    <input type="text" maxlength="3" id="out_1" min="0" name="out_1" onKeypress="return isNumber(event)" style="width:15%" required><font size="+3">.</font><input type="text" maxlength="2" id="out_2" name="out_2"  pattern=".{2,}"  title="2 characters minimum" placeholder="decimal"  onKeypress="return isNumber(event)" style="width:15%"  required></td>
    </tr>
    <tr>
    <td>
    </td>
     <td>
     <br />
    <input type="submit" value="Submit">
    </td>
    </tr>
    </table>
    </form>
    <?php  }else {  $row = mysql_fetch_array($input);
				echo 'Diesel Conversation : '.'<b>'.$rows['con'].'</b>';?>
<input type="hidden" value="<?php echo $rows['con'];?>" id="con_">	
<a rel="facebox" href="change_input_new.php?select=<?php echo $plateid['id'];?>"><button style="font-size:0.7em; width:50px; height:17px;">Change</button></a>
	<?php } ?>
<table width="100%">
<tr>
<td>
   <br /><br />
<table class="CSSTableGenerator">
<tr>
<td>Day</td>
<td colspan="3">Consumption</td>
<td width="10%">Activity / Destination</td>
<td>Tonnage</td>
<td width="5%">OUT (cm)</td>
<td width="5%">IN (cm)</td>
<td width="5%">Refill (cm)</td>
<td>Km</td>
<td>Km/Lit</td>
<td>Diesel Cost (Php)</td>
<td>Driver</td>
<td>Helper</td>
<td>LTO Amount</td>
<td width="9%">Violations / Remarks</td>
<td>Action</td>
</tr>
<input type="hidden" name="day" id='dayed' value="<?php echo $day;?>">
<input type="hidden" name="month" value="<?php echo $id[1];?>">
<input type="hidden" id="months" value="<?php echo $id[2];?>">
<input type="hidden" name="pno" value="<?php echo $plateid['id'];?>">
<input type="hidden" name="year" value="<?php echo $year;?>">
<?php


$number = cal_days_in_month(CAL_GREGORIAN, $id[2], $year); 
$day = 1;
$num=0;
$mune = array();
while($day <= $number ){
	?>
	<form method="post" action="trip_update.php?id=<?php echo $_GET['id'];?>">
	<?php
	
	$trip = mysql_query("Select * from tbl_trip Where truckid='".$plateid['id']."' And month='$ms' And year='$year' And day='$day' And cost=''") or die (mysql_error());
	$trip_row = mysql_fetch_array($trip);
	
	$trips = mysql_query("Select * from tbl_trip Where truckid='".$plateid['id']."' And month='$ms' And year='$year' And day='$day'  ") or die (mysql_error());
		
	
	$trips_row = mysql_fetch_array($trips);
	$num ++;
?>                          


<tr id="<?php echo $trips_row['id'];?>">
<td><?php echo $day;?></td>
<td>
<?php 
$cm1 = @$trips_row['ins'];
$cm2 = @$trips_row['outs'];
$cm = $cm1 - $cm2;

if(mysql_num_rows($trip) > 0){
	$lit1 = $rows['cost'];
	}else{
		$lit1 =$trips_row['cost'];
		}
		
$con1 = $rows['con'];
$con2 = $cm;
$con = $con1 * $con2;

$lit2 = $con;
$lit = $lit1 * $lit2;
$menu[] = array(
        "day" => $day, 
        "parentid" => @$trips_row['supplier']);
?>
Cm: <input type="text"  style="width:100%;font-size:90%;" value="<?php echo round($cm,2);?>" id="cms" disabled></td>
<td>Lit:<input type="text" style="width:100%;font-size:90%;" value="<?php echo round($con,2);?>" id="lits"  disabled></td>
<td>Peso/s:<input type="text" style="width:100%;font-size:100%;"  disabled value="<?php echo round($lit,2);?>" id="<?php echo 'pesos'.$day;?>"  /></td>


<td>
<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'supp'.$day;?>" class="editting"><?php if(empty($trips_row['supplier'])){ echo "<center>- - - - -</center>";}else{ echo $trips_row['supplier'];}?></div></span>
            <div id="<?php echo 'supps_'.$day;?>" class="editbox"><input onKeyPress="return isNum(event)" onKeyUp="caps(this);" class="txtbox" type="text" name="rebaless" id="<?php echo 'supp_'.$day;?>" value="<?php echo $trips_row['supplier'];?>" autocomplete="off" style="width:100%;">
			 <input type="hidden" value="<?php echo $day;?>" id="<?php echo 'd'.$day?>">
			</div>
			<span  id="<?php echo $day;?>" class="editbox2"> <div id="<?php echo 'supps2_'.$day;?>" class="editbox2"></div></span>
			
  </td>
<td width="5%">
<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'ton'.$day;?>" class="editting"><?php  if(empty($trips_row['ton'])){echo "None";}else {echo @$trips_row['ton'];}?></div></span>
<div id="<?php echo 'tons_'.$day;?>" class="editbox"><input class="txtbox" type="text"  name="uptimess" id="<?php echo 'ton_'.$day;?>"   value="<?php echo @$trips_row['ton'];?>" onKeypress="return decimal(event)" style="width:100%;" autocomplete="off"></div>
<span  id="<?php echo $day;?>" class="editbox2"> <div id="<?php echo 'ton2_'.$day;?>" class="editbox2"></div></span>
</td>

<td>
<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'out'.$day;?>" class="editting"><?php  if(!empty($trips_row['outs'])) {echo @$trips_row['ins'];}?></div></span>
<div id="<?php echo 'outs_'.$day;?>" class="editbox"><input type="text" name="outs" id="<?php echo 'out_'.$day;?>" onKeypress="return decimal(event)" style="width:100%;" value="<?php echo @$trips_row['ins'];?>" required></div>
<span  id="<?php echo $day;?>" class="editbox2"> <div id="<?php echo 'out2_'.$day;?>" class="editbox2"></div></span>

</td>
<td>

<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'in'.$day;?>" class="editting"><?php  if(empty($trips_row['outs'])){echo "None";}else {echo @$trips_row['outs'];}?></div></span>
<div id="<?php echo 'ins_'.$day;?>" class="editbox"><input type="text" name="outs" id="<?php echo 'in_'.$day;?>"  onKeypress="return decimal(event)" style="width:100%;" value="<?php echo @$trips_row['outs'];?>" required></div>
<span  id="<?php echo $day;?>" class="editbox2"> <div id="<?php echo 'in2_'.$day;?>" class="editbox2"></div></span>
 </td> 
<td>

<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'refill'.$day;?>" class="editting"><?php  if(empty($trips_row['refill'])){echo "None";}else {echo @$trips_row['refill'];}?></div></span>
<div id="<?php echo 'refills_'.$day;?>" class="editbox"><input type="text" name="refill" id="<?php echo 'refill_'.$day;?>"  value="<?php echo $trips_row['refill'];?>" onKeypress="return decimal(event)" style="width:100%;">
</div>
<span  id="<?php echo $day;?>" class="editbox2"> <div id="<?php echo 'refill2_'.$day;?>" class="editbox2"></div></span>
<input type="hidden" name="refill" value="0" ></td>  
<td>

<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'km'.$day;?>" class="editting"><?php  if(empty($trips_row['km'])){echo "<center>---</center>";}else {echo @$trips_row['km'];}?></div></span>
<div id="<?php echo 'kms_'.$day;?>" class="editbox"><input type="text" name="refill" id="<?php echo 'km_'.$day;?>"  value="<?php echo $trips_row['km'];?>" onKeypress="return decimal(event)" style="width:100%;">
</div>
<span  id="<?php echo $day;?>" class="editbox2"> <div id="<?php echo 'km2_'.$day;?>" class="editbox2"></div></span>
</td>  
<td>

<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'kmlit'.$day;?>" class="editting"><?php  if(!empty($trips_row['kmlit'])) {echo @$trips_row['kmlit'];}?></div></span>
<div id="<?php echo 'kmlits_'.$day;?>" class="editbox"><input type="text" name="refill" id="<?php echo 'kmlit_'.$day;?>"  value="<?php echo $trips_row['kmlit'];?>"  style="width:100%;">
</div>
<span  id="<?php echo $day;?>" class="editbox2"> <div id="<?php echo 'kmlit2_'.$day;?>" class="editbox2"></div></span>
</td> 
<td>

<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'cost'.$day;?>" class="editting"><?php  if(empty($trips_row['cost'])){echo "None";}else {echo @$trips_row['cost'];}?></div></span>
<div id="<?php echo 'costs_'.$day;?>" class="editbox"><input type="text" name="cost" id="<?php echo 'cost_'.$day;?>" onKeypress="return decimal(event)" value="<?php echo $trips_row['cost']?>" style="width:100%" />
</div>
<span  id="<?php echo $day;?>" class="editbox2"> <div id="<?php echo 'cost2_'.$day;?>" class="editbox2"></div></span>
</td>  
<td>
<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'driver'.$day;?>" class="editting"><?php  if(empty($trips_row['driver'])){echo "None";}else {echo @$trips_row['driver'];}?></div></span>
<div id="<?php echo 'drivers_'.$day;?>" class="editbox"><input value="<?php echo @$trips_row['driver'];?>" id="<?php echo 'driver_'.$day;?>"  class="text" type="text" onKeyUp="caps(this)" name="driver" style="width:100%" />
</div>
<span  id="<?php echo $day;?>" class="editbox2"> <div id="<?php echo 'driver2_'.$day;?>" class="editbox2"></div></span>
</td>  
<td>
<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'helper'.$day;?>" class="editting"><?php  if(empty($trips_row['helper'])){echo "None";}else {echo @$trips_row['helper'];}?></div></span>
<div id="<?php echo 'helpers_'.$day;?>" class="editbox"><input type="text" id="<?php echo 'helper_'.$day;?>" class="text"  onKeyUp="caps(this)" value="<?php echo @$trips_row['helper'];?>" name="helper" style="width:100%" />
</div>
<span  id="<?php echo $day;?>" class="editbox2"> <div id="<?php echo 'helper2_'.$day;?>" class="editbox2"></div></span>
</td>  
<td>
<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'remarks'.$day;?>" class="editting"><?php  if(empty($trips_row['remarks'])){echo "None";}else {echo @$trips_row['remarks'];}?></div></span>
<div id="<?php echo 'remarkss_'.$day;?>" class="editbox"><textarea name="remarks" class="text" id="<?php echo 'remarks_'.$day;?>" onKeyUp="caps(this)" rows="3" style="width:100%" /><?php echo @$trips_row['remarks'];?></textarea>
</div>
<span  id="<?php echo $day;?>" class="editbox2"> <div id="<?php echo 'remarks2_'.$day;?>" class="editbox2"></div></span>
</td> 
<td>
<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'violation'.$day;?>" class="editting"><?php  if(empty($trips_row['violation'])){echo "None";}else {echo @$trips_row['violation'];}?></div></span>
<div id="<?php echo 'violations_'.$day;?>" class="editbox"><textarea name="remarks" class="text"  id="<?php echo 'violation_'.$day;?>" onKeyUp="caps(this)" rows="3" style="width:100%" /><?php echo @$trips_row['violation'];?></textarea>
</div>
<span  id="<?php echo $day;?>" class="editbox2"> <div id="<?php echo 'violation2_'.$day;?>" class="editbox2"></div></span>
</td>  
<td></form>
<span class="editting" id="<?php echo $day;?>"><div id="<?php echo 'btn'.$day;?>" class="editting"><button id="<?php echo $day;?>" disabled>Save</button></div></span>
<div id="<?php echo 'btn_'.$day;?>" class="editbox"><button id="<?php echo $day;?>">Save</button>
</div>

<?php if(mysql_num_rows($trips) > 0){?>
<a href="delete_new.php?id=<?php echo $trips_row['id'];?>"><input type="button" value="Delete" onClick="return confirm('Do you want to Delete?');"></a>
<?php }else{?>
	<input type="button" value="Delete" disabled="disabled">
<?php }?>
</td>
</tr>
 </form>
<?php
	$day++;
	@$total_cm +=$cm;
	@$total_lit +=$con;
	@$total_peso += $lit;
	@$total_tonnage += $trips_row['ton'];
	@$total_refill += $trips_row['refill'];
	@$total_km += $trips_row['km'];
	@$total_kmlit += $trips_row['kmlit'];
	}
?>
<tr>
	<td><b>Total:</b></td>
	<td><b><?php echo number_format($total_cm);?></b></td>
	<td><b><?php echo number_format($total_lit,2);?></b> </td>
	<td><b><?php echo number_format($total_peso,2);?></b></td>
	<td></td>
	<td><b><?php echo number_format($total_tonnage);?></b></td>
	<td></td>
	<td></td>
	<td><b><?php echo number_format($total_refill);?></b></td>
	<td><b><?php echo number_format($total_km);?></b></td>
	<td><b><?php echo number_format($total_kmlit,2);?></b></td>
	<td colspan="6"></td>
</tr>
</table>
</td>
</tr>
</table>
<?php
$day = $day - 1;
?>
<input type="hidden" value="<?php echo $day ;?>" id="num_of_days">
</center>
 
<?php //endtofcode===========================================================================?>
<br /><br />
 <br /><br />
</div>
</center>
<?php include('layout/footer.php');?>
</body>
</html>