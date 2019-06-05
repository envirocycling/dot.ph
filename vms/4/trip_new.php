
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
   <style>
   	.txtbox{
		text-transform:uppercase;
	}
	.text{
		text-transform:uppercase;
		font-size:10px;
	}
   </style>

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
?>
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
<td width="5%">OUT(cm)</td>
<td width="6%">IN(cm)</td>
<td width="5%">Refill(cm)</td>
<td width="5%">Km</td>
<td width="5%">Km/Lit</td>
<td width="5%">Diesel Cost(Php)</td>
<td>Driver</td>
<td>Helper</td>
<td width="7%">LTO Amount</td>
<td width="8%">Violation / Remarks</td>
</tr>

<?php


$number = cal_days_in_month(CAL_GREGORIAN, $id[2], $year); 
$day = 1;
$num=0;
while($day <= $number ){
	$trip = mysql_query("Select * from tbl_trip Where truckid='".$plateid['id']."' And month='$ms' And year='$year' And day='$day' And cost=''") or die (mysql_error());
	$trip_row = mysql_fetch_array($trip);
	
	$trips = mysql_query("Select * from tbl_trip Where truckid='".$plateid['id']."' And month='$ms' And year='$year' And day='$day' And updates='1' ") or die (mysql_error());
		
	
	$trips_row = mysql_fetch_array($trips);
	$num ++;
?>                          
<form method="post" action="trip_update.php?id=<?php echo $_GET['id'];?>" onsubmit="return cons();">
<input type="hidden" name="day" value="<?php echo $day;?>">
<input type="hidden" name="month" value="<?php echo $id[1];?>">
<input type="hidden" name="months" value="<?php echo $id[2];?>">
<input type="hidden" name="pno" value="<?php echo $plateid['id'];?>">
<input type="hidden" name="year" value="<?php echo $year;?>">
<tr id="<?php echo $trips_row['id'];?>">
<td width="5%"><?php echo $day;?></td>

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
?>
<td>Cm: <input type="text"  style="width:100%;font-size:90%;" value="<?php echo round($cm,2);?>" disabled/></td>
<td>Lit:<input type="text" style="width:100%;font-size:90%;" value="<?php echo $con;?>" disabled></td>
<td>Peso/s:<input type="text" style="width:100%;font-size:100%;"  disabled value="<?php echo round($lit,2);?>"  /></td>


<td><?php echo @$trips_row['supplier'];?> </td>
<td width="5%"><?php echo $trips_row['ton'];?></td>

<td><?php echo @$trips_row['ins'];?></td>
<td><?php echo @$trips_row['outs'];?></td> 
<td>
<?php if(!empty($trips_row['ins'])  && !empty($trips_row['supplier'])){?>
<?php echo $trips_row['refill'];} else { echo "N/A"; }?></td>  
<td><?php echo @$trips_row['km'];?></td>
<td><?php echo @$trips_row['kmlit'];?></td>  
<td>
<?php if($trips_row['cost'] == ''){?>
<?php echo $rows['cost']?>
<?php
}else{?>
<?php echo $trips_row['cost']?>
<?php }?>
</td>  
<td><?php echo @$trips_row['driver'];?></td>  
<td><?php echo @$trips_row['helper'];?></td>  
<td><?php echo @$trips_row['remarks'];?></td>  
<td><?php echo @$trips_row['violation'];?></td>  
</tr>

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
<tr class="total">
	<td style="background-color:#FFFF00;"><b>Total:</b></td>
	<td style="background-color:#FFFF00;"><b><?php echo number_format($total_cm);?></b></td>
	<td style="background-color:#FFFF00;"><b><?php echo number_format($total_lit,2);?></b> </td>
	<td style="background-color:#FFFF00;"><b><?php echo number_format($total_peso,2);?></b></td>
	<td style="background-color:#FFFF00;"></td>
	<td style="background-color:#FFFF00;"><b><?php echo number_format($total_tonnage);?></b></td>
	<td style="background-color:#FFFF00;"></td>
	<td style="background-color:#FFFF00;"></td>
	<td style="background-color:#FFFF00;"><b><?php echo number_format($total_refill);?></b></td>
	<td style="background-color:#FFFF00;"><b><?php echo number_format($total_km);?></b></td>
	<td style="background-color:#FFFF00;"><b><?php echo number_format($total_kmlit,2);?></b></td>
	<td style="background-color:#FFFF00;" colspan="5"></td>
</tr>
</table>
</td>
</tr>
<table>
 
<?php //endtofcode===========================================================================?>
<br /><br />
 <br /><br />
</div>
</center>
<?php include('layout/footer.php');?>
</body>
</html>