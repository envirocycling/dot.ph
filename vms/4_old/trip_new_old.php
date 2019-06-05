
	<?php
session_start();
if(!isset($_SESSION['encoder_username'])){
	header("Location: ../index.php");
	}
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
}</script>
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
    <link rel="stylesheet" href="../css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
   <img src="../image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Vehicle</a></li>
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
$input = mysql_query("Select * from tbl_input Where	truckid='".$plateid['id']."' And month='$ms' And year='$year'") or die (mysql_error());

$rows = mysql_fetch_array($input);
if(mysql_num_rows($input) == 0){
?>
<form action="trip_input.php?id=<?php echo $_GET['id'];?>" method="post">
<input type="hidden" name="pno" value="<?php echo $plateid['id'];?>">
<input type="hidden" name="y" value="<?php echo $year;?>">
<input type="hidden" name="m" value="<?php echo $id[1];?>">
<table align="left" width="550px" >
    <tr>
        <td><font size="-1">Please Input the ff:</font></td>
    </tr>
    <tr>
     <td>Diesel Conversation:</td>
    <td>
    <input type="text" maxlength="3" id="out1" min="0" name="out1" onKeypress="return isNumber(event)" style="width:15%" required><font size="+3">.</font><input type="text" maxlength="2" id="out2" name="out2"  pattern=".{2,}"  title="2 characters minimum"  onKeypress="return isNumber(event)" style="width:15%"  required></td>
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
<td width="5%">Diesel Cost(Php)</td>
<td>Driver</td>
<td>Helper</td>
<td width="10%">Remarks</td>
<td colspan="2">Action</td>
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
<form method="post" action="trip_update.php?id=<?php echo $_GET['id'];?>">
<input type="hidden" name="day" value="<?php echo $day;?>">
<input type="hidden" name="month" value="<?php echo $id[1];?>">
<input type="hidden" name="months" value="<?php echo $id[2];?>">
<input type="hidden" name="pno" value="<?php echo $plateid['id'];?>">
<input type="hidden" name="year" value="<?php echo $year;?>">
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
?>
Cm: <input type="text"  style="width:100%;font-size:90%;"" value="<?php echo $cm;?>" disabled/></td>
<td>Lit:<input type="text" style="width:100%;font-size:90%;"" value="<?php echo $con;?>"  disabled/></td>
<td>Peso/s:<input type="text" style="width:100%;font-size:100%;"  disabled value="<?php echo $lit;?>" /></td>


<td><input type="text" onKeyUp="caps(this)" style="width:105%; font-size:10px;" name="supplier" value="<?php echo @$trips_row['supplier'];?>"  required></td>
<td width="5%"><input style="width:100%" value="<?php echo $trips_row['ton'];?>" type="text" name="ton" required></td>

<td><input type="text" name="ins" id="beg"  onKeyPress="return isNum(event)" value="<?php echo @$trips_row['ins'];?>"  style="width:100%;" required></td>
<td><input type="text" name="outs" id="end"  onKeyPress="return isNum(event)" style="width:100%;" value="<?php echo @$trips_row['outs'];?>" required> </td> 
<td>
<?php if(!empty($trips_row['ins'])  && !empty($trips_row['supplier'])){?>
<input type="text" name="refill" value="<?php echo $trips_row['refill'];?>" onKeypress="return isNum(event)" style="width:100%;"><?php }else { ?><input type="hidden" name="refill" value="0" ><?php echo "N/A"; }?></td>  
<td>
<?php if($trips_row['cost'] == ''){?>
<input type="text" name="cost" value="<?php echo $rows['cost']?>" style="width:100%" />
<?php
}else{?>
<input type="text" name="cost"  value="<?php echo $trips_row['cost']?>" style="width:100%" />
<?php }?>
</td>  
<td><input value="<?php echo @$trips_row['driver'];?>" type="text" onKeyUp="caps(this)" name="driver" style="width:100%" /></td>  
<td><input type="text" onKeyUp="caps(this)" value="<?php echo @$trips_row['helper'];?>" name="helper" style="width:100%" /></td>  
<td><textarea name="remarks" onKeyUp="caps(this)" rows="3" style="width:100%" /><?php echo @$trips_row['remarks'];?></textarea></td>  
<td><input type="submit" value="Update"></form></td>
<form action="trip_deletes.php?id=<?php echo $_GET['id'];?>" method="post">
<input type="hidden" name="ids" value="<?php echo $trips_row['id'];?>">
<td><input type="submit" value="Delete" onClick="return confirm('Do you want to Delete?');">

</td> </form>
</tr>

<?php
	$day++;
	}
?>
</table>
</td>
</tr>
<table>

</center>
 
<?php //endtofcode===========================================================================?>
<br /><br />
<img src="../image/footer.png" height="8%" width="100%">     