<script>
function isNum(evt)
           {
               var charCode = (evt.which) ? evt.which : event.keyCode
 
               if (charCode == 46)
               {
                   var inputValue = $("#inputfield").val()
                   if (inputValue.indexOf('.') < 1)
                   {
                       return true;
                   }
                   return false;
               }
               if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
               {
                   return false;
               }
               return true;
           }
</script>
	<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}
include('../title.php');
?>


  <link href="../css/table1.css" media="screen" rel="stylesheet" type="text/css" />
  <style>
  	#total:hover{
	background-color:#FFFF00;
	}
  </style>
 <?php
 include('connect.php');
 ?>
 
<?php // auto submit if change==================================================================?>
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
<?php //disabledfileds=====-=-=--=-==-===---------------------------[?>
<script>
function active(){
  if(document.getElementById('checkbox').checked){
   ;
	      document.getElementById('pdate').disabled=false;
	 document.getElementById('adate').disabled=false;
	  document.getElementById('quantity').disabled=false;
	   document.getElementById('reassign').disabled=false;
	    document.getElementById('sold').disabled=false;

}else{
   
	   document.getElementById('pdate').disabled=true;
	   	   document.getElementById('adate').disabled=true;
	   	  document.getElementById('quantity').disabled=true;
	   document.getElementById('reassign').disabled=true;
	    document.getElementById('sold').disabled=true;
	   }
}</script>
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
<?php //======================================================================================?>

	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
 <?php // headermenu==============?>
    <link rel="stylesheet" href="../css/header2.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
   <img src="../image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li ><a href="existing_truck.php">Existing Vehicles</a></li>
      <li ><a href='maintenance.php'>Maintenance</a></li>
   <li ><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li><a href="truck_reassign.php">Vehicle Reassignment</a></li>
	<li><a href='summary.php'>Summary</a></li>
     <li  class="active"><a href='trip.php'>Trip Schedule</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
         <li><a href="logout.php">Logout</a></li>
</ul>
</div><br /> 
<?php //startofcode===========================================================================?>
 <center>
<?php
include('connect.php');
$timezone=+8;
$m = $_GET['id'];
$id = explode('-',$m);
$year= $id[3];
?>
	
<table  width="80%" align="center" >
		<tr>
				<td align="center" colspan="2"><h3>Trip Schedule</h3></td>
				<td></td>
			</tr>
	</table>  
    <br /><br /><br />
    
<table width="180px"	>
<tr>
<td width="40%" align="right">Month :</td>
<td align="left"><font size="+2" style="text-decoration:underline"><?php echo $id[1];?></font></td>
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
$ms = $id[1];
$input = mysql_query("Select * from tbl_input Where	truckid='".$plateid['id']."' ") or die (mysql_error());

$rows = mysql_fetch_array($input);
if(mysql_num_rows($input) == 0){
?>

    <?php  }else {  $row = mysql_fetch_array($input);
				echo 'Diesel Conversation : '.'<b>'.$rows['con'].'</b>';
	} ?>
<table width="1330px">
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
<td width="5%"><?php echo $ms.'-'.$day;?></td>

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
<tr bgcolor="#FFFF00" class="total">
	<td><b>Total :</b></td>
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
	<td colspan="5"></td>
</tr>
</table>
</td>
</tr>
<table>

</center>
 
<?php //endtofcode===========================================================================?>
<br /><br />
<img src="../image/footer.png" height="8%" width="100%">     