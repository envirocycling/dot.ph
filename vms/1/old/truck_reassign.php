 <title>EFI Vehicles Report</title>
 <?php
 include('connect.php');
 ?>
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
<?php // auto submit if change==================================================================?>
<script>
function onSelectChange(){
 document.getElementById('frm').submit();
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
<?php //======================================================================================?>

	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
 <?php // headermenu==============?>
    <link rel="stylesheet" href="css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="js/header.js"></script>
   <img src="image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Truck</a></li>
   <li  ><a href="existing_truck.php">Existing Trucks</a></li>
      <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Truck Registration</a></li>
     <li class='active'><a href="truck_reassign.php">Truck Reassignment</a></li>
      <li><a href='inventory.php'>Inventory</a></li>

        <li>|                |</li> 
         <li><a href="registration_monitoring.php">Logout</a></li>
</ul>
</div><br /> 
<?php //startofcode===========================================================================?>
<br />

		<table align="center">
			<tr>
				<td colspan="2"><h3>Truck Reassignment</h3></td>
                <td></td>
            </tr>
  </table>
 <center>
 <table width="60%" >
 

<form id="frm"  action="a.php" method="post">
<tr>
<td>Select Plate No.
<select name="plate" onchange="onSelectChange();">
<option value="">NONE</option>
<?php
$query=mysql_query("Select * from tbl_truck_report") or die (mysql_error());
while($row = mysql_fetch_array($query)){?>
	
    <option value="<?php echo $row['truckplate'];?>"><?php echo $row['truckplate'];?></option><?php
	}
?>
</select></form></td>





</center>
</table>

<?php //endtofcode===========================================================================?>

<br /><br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<img src="image/footer.png" height="8%" width="100%">     