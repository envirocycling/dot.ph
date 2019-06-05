
	<?php
session_start();
include('../title.php');
?>

  <link href="../css/table.css" media="screen" rel="stylesheet" type="text/css" />
 <?php
 include('connect.php');
 ?>
 <script>
window.addEventListener("load", function(){
 var load_screen = document.getElementById("load_screen");
 document.body.removeChild(load_screen);
});
</script>
    <script language="JavaScript">
function readCookie(name){
return(document.cookie.match('(^|; )'+name+'=([^;]*)')||0)[2]
}
</script>



<body onScroll="document.cookie='ypos=' + window.pageYOffset" onLoad="window.scrollTo(0,readCookie('ypos'))">
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

});
</script>
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
<script src="../js/update_all.js" type="text/javascript"></script>
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
   <li ><a href="registration_monitoring.php">Vehicle Registration</a></li>
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
$year= gmdate('Y',time() + 3600*($timezone+date("I")));
$m = $_GET['id'];
$id = explode('-',$m);
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
<td align="left">
<input value='<?php echo $id[1];?>' id='my' type='hidden'>
<font size="+2" style="text-decoration:underline"><?php echo $id[1];?></font></td>
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

<form action="trip_input.php?id=<?php echo $_GET['id'];?>" method="post">
<input type="hidden" value="0" id="inputs">
<input type="hidden" name="pno" value="<?php echo $plateid['id'];?>">
<input type="hidden" name="y" value="<?php echo $year;?>">
<input type="hidden" name="m" value="<?php echo $id[1];?>">

    <?php   $row = mysql_fetch_array($input);
				echo 'Diesel Conversation : '.'<b>'.$rows['con'].'</b>';?>
<input type="hidden" value="<?php echo $rows['con'];?>" id="con_">	
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
<td width="5%">OUT (cm)</td>
<td width="5%">IN (cm)</td>
<td width="5%">Refill (cm)</td>
<td width="5%">Km</td>
<td width="5%">Km/Lit</td>
<td width="5%">Diesel Cost (Php)</td>
<td>Driver</td>
<td>Helper</td>
<td width="9%">Remarks</td>
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
<td width="5%"><?php echo $ms.'-'.$day;?></td>
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


	<td><?php if(empty($trips_row['supplier'])){ echo "<center>- - - - -</center>";}else{ echo $trips_row['supplier'];}?></td>
	<td width="5%"><?php  if(empty($trips_row['ton'])){echo "None";}else {echo @$trips_row['ton'];}?></td>

	<td><?php  if(!empty($trips_row['outs'])) {echo @$trips_row['ins'];}?></td>
	<td><?php  if(empty($trips_row['outs'])){echo "None";}else {echo @$trips_row['outs'];}?></td> 
	<td><?php  if(empty($trips_row['refill'])){echo "None";}else {echo @$trips_row['refill'];}?></td>  
	<td><?php  if(empty($trips_row['km'])){echo "<center>---</center>";}else {echo @$trips_row['km'];}?></td>  
	<td><?php  if(!empty($trips_row['kmlit'])) {echo @$trips_row['kmlit'];}?></td> 
	<td><?php  if(empty($trips_row['cost'])){echo "None";}else {echo @$trips_row['cost'];}?></td>  
	<td><?php  if(empty($trips_row['driver'])){echo "None";}else {echo @$trips_row['driver'];}?></td>  
	<td><?php  if(empty($trips_row['helper'])){echo "None";}else {echo @$trips_row['helper'];}?></td>  
	<td><?php  if(empty($trips_row['remarks'])){echo "None";}else {echo @$trips_row['remarks'];}?></td>  
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
<tr>
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
	<td colspan="4"></td>
</tr>
<table>


</center>
 
<?php //endtofcode===========================================================================?>
<br /><br />
<img src="../image/footer.png" height="55px" width="100%">     