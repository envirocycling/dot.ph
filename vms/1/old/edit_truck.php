<html>
<title>EFI Vehicles Report</title>
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
<body>
<img src="image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Truck</a></li>
   <li  class='active'><a href="existing_truck.php">Existing Trucks</a></li>
      <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Truck Registration</a></li>
     <li><a href="truck_reassign.php">Truck Reassignment</a></li>
      <li><a href='inventory.php'>Inventory</a></li>

        <li>|                |</li> 
         <li><a href="registration_monitoring.php">Logout</a></li>
</ul>
</div><br /> 

 <?php

include('connect.php');


$truck = mysql_query ("SELECT * FROM tbl_truck_report Where id='".$_GET['id']."'");
$truck_row = mysql_fetch_array($truck);

?>
<form action="update_truck.php" method="post">

<table align="center">
<tr>
				<td align="center" colspan="2"><h3>EFI Vehicles</h3></td>
				<td></td>
			</tr>
  <tr>
  <input type="hidden" name="id" value="<?php echo $truck_row['id']; ?>">
    <td >Plate Number: </td>
  <td><input type="text"  name="platenumber" value="<?php echo strtoupper($truck_row ['truckplate']); ?>" id="text" onKeyUp="caps(this)" required></td>
  </tr>
  <td>Acquisition Cost (PhP):  </td>
   
  <td><input type="text"  name="acquisitioncost" value="<?php echo strtoupper($truck_row ['aquisitioncost']); ?>" id="extra7" onKeyPress="return isNumber(event)"></td>
   <tr>
  <td>Net Book Value (Php): </td>
   
  <td><input type="text"  name="netbookvalue" value="<?php echo strtoupper($truck_row ['netbookvalue']); ?>" id="extra7" onKeyPress="return isNumber(event)"></td>
  </tr>
  <tr>
  <td>Amount (Php): </td>
   
  <td><input type="text"  name="amount" value="<?php echo strtoupper($truck_row ['amount']); ?>" id="extra7" onKeyPress="return isNumber(event)"></td>
  </tr>
  <tr>
  <td>Vehicle Condition: </td>
   
  <td><input type="text"  name="truckcondition" value="<?php echo strtoupper($truck_row ['truckcondition']); ?>" id="text" onKeyUp="caps(this)"></td>
  </tr>
  <tr>
  <td><input type="submit" value="Update"></td>
  </tr>
</table>
</form>

<form action="update_given.php"  method="post">
<?php
$givento = mysql_query ("SELECT * FROM tbl_givento Where truckid='".$_GET['id']."'");
$given_row = mysql_fetch_array($givento);

?>

<table align="center">
<tr>
				<td align="center" colspan="2"><h3>Given To</h3></td>
				<td></td>
			</tr>
  <tr>
  <input type="hidden"  name="truckid" value="<?php echo $given_row['id']; ?>" id="text" onKeyUp="caps(this)">
    <td >Supplier Name: </td>
  <td><input type="text"  name="suppliername" value="<?php echo strtoupper($given_row ['suppliername']); ?>" id="text" onKeyUp="caps(this)"></td>
  </tr>
  <td>Issuance Date:  </td>
   
  <td><input type="date"  name="issuancedate" value="<?php echo $given_row ['issuancedate']; ?>" ></td>
   <tr>
  <td>End Date: </td>
   
  <td><input type="date"  name="enddate" value="<?php echo $given_row ['enddate']; ?>" ></td>
  </tr>
  <tr>
  <td>Amortization: </td>
   
  <td><input type="text"  name="amortization" value="<?php echo strtoupper($given_row ['amortization']); ?>" id="text" onKeyUp="caps(this)"></td>
  </tr>
  <tr>
  <td>Cash Bond: </td>
   
  <td><input type="text"  name="cashbond" value="<?php echo strtoupper($given_row ['cashbond']); ?>" id="extra7" onKeyPress="return isNumber(event)"></td>
  </tr>
   <tr>
  <td>Proposed Volume: </td>
   
  <td><input type="text"  name="volume" value="<?php echo strtoupper($given_row ['proposedvolume']); ?>" id="text" onKeyUp="caps(this)"></td>
  </tr>
  <tr>
  <td><br /><input type="submit" value="Update" > </form></td>
    <td><?php echo '<a href="#?id='.@$row['id'].'">' ?><br /><input type="button" value="Delete" ></a></td>
  </tr>
</table>

<br /><br />
<img src="image/footer.png" height="8%" width="100%">                       
</body>
</html>                                     
												