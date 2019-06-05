<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../login.php");
	}

?>
<title>EFI Vehicles Report</title>

<?php //facebox==========================================================================?>

<script src="js/jquery.min.js" type="text/javascript"></script>
<link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="js/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage: 'src/loading.gif',
            closeImage: 'src/closelabel.png'
        })
    })
</script>
<?php //=====================================================?>
 <?php // headermenu==============?>
    <link rel="stylesheet" href="css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="js/header.js"></script>
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

   <li  class='active'><a href="new_truck.php">New Truck</a></li>
   <li><a href="existing_truck.php">Existing Trucks</a></li>
      <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Truck Registration</a></li>
     <li><a href="truck_reassign.php">Truck Reassignment</a></li>
      <li><a href='inventory.php'>Inventory</a></li>
        <li>|                |</li> 
         <li><a href="logout.php">Logout</a></li>
</ul>
</div><br />
<br />

<center>
	<br />

		<table>
			<tr>
				<td align="center" colspan="2"><h3>New Vehicle</h3></td>
                <td></td>
            </tr>
  </table>
  	<form action="save_new_truck.php" method="post">

  <table>
             <tr>
				<td align="center" colspan="2"><h4>Vehicle's Info</h4></td>
			</tr>
			<tr>
				<td>Branch</td>
				<td><input name="branch"  id="text" onKeyUp="caps(this)" required></td>
			</tr>
			<tr>
				<td>Owner's Name</td>
				<td><input type="text"  name="ownersname" id="text" onKeyUp="caps(this)"></td>
			</tr>
			<tr>
				<td>Vehicle Plate</td>
				<td><input type="text"  name="truckplate" id="text" onKeyUp="caps(this)" required></td>
			</tr>
            <tr>
				<td>Month of Registration</td>
				<td><select name="ending">
                 <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="0">October</option>
                </select></td>
			</tr>
			<tr>
				<td>Acquisition Cost (Php)</td>
				<td><input type="text"  name="aquisitioncost" id="extra7" onKeyPress="return isNumber(event)"></td>
			</tr>
			<tr>
				<td>Net Book Value (Php)</td>
				<td><input type="text"  name="netbookvalue" id="extra7" onKeyPress="return isNumber(event)"></td>
			</tr>
			<tr>
				<td>Amount (Php)</td>
				<td><input type="text"  name="amount" id="extra7" onKeyPress="return isNumber(event)" ></td>
			</tr>
              <tr>
				<td>Vehicle Condition</td>
				<td><input type="text"  name="truckcondition" id="text" onKeyUp="caps(this)"></td>
			</tr>
   </table>
   <br />
   <br />
<input type="submit" value="Save New Truck"  name="savenewtruck">
</form>
<img style="vertical-align:bottom" src="image/footer.png" height="8%" width="100%">
</center>

</body>
</html>