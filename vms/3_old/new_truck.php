
<?php
session_start();
if(!isset($_SESSION['encoder_username'])){
	header("Location: ../index.php");
	}

?>
<title>EFI Vehicles Report</title>


<?php
include('connect_out.php');
?>
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
 <?php // headermenu==============?>
    <link rel="stylesheet" href="../css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
 <?php // type numbers only==================================================================?>
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
    <link rel="stylesheet" href="../css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
<img src="../image/header.png" height="25%" width="100%">
	 
<div id='cssmenu'>
<ul>

   <li  class='active'><a href="new_truck.php">New Vehicle</a></li>
   <li><a href="existing_truck.php">Existing Vehicles</a></li>
      <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li><a href="truck_reassign.php">Vehicle Reassignment</a></li>
      <li><a href='summary.php'>Summary</a></li>
      <li><a href='trip.php'>Trip Schedule</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
         <li><a href="logout.php">Logout</a></li>
</ul>
</div>
<br />
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
               <td><select name="branch" style="width:100%" required>
			   <option value="" selected="selected" disabled="disabled">Please Select</option>
                <?php $select_branch = mysql_query("Select * from branches ORDER by branch_name ASC ") or die (mysql_error());
				while($row_branch = mysql_fetch_array($select_branch)){
				?>
				<option value="<?php echo strtoupper($row_branch['branch_name']);?>"><?php echo strtoupper($row_branch['branch_name']);?></option>
                <?php } ?>
                </td>
			</tr>
			<tr>
				<td>Owner's Name</td>
				<td><input type="text"  name="ownersname" id="text" onKeyUp="caps(this)" style="width:100%" required></td>
			</tr>
         
			<input type="hidden"  name="suppliername" id="text" onKeyUp="caps(this)" style="width:100%" required>
		
			<tr>
				<td>Vehicle Plate</td>
				<td><input type="text"  name="truckplate" id="text" onKeyUp="caps(this)" style="width:100%" onKeyPress="return isNumbers(event)"  required></td>
			</tr>
            <tr>
				<td>Month of Registration</td>
				<td><select name="ending" style="width:100%" required>
				<option value="" selected="selected" disabled="disabled">Please Select</option>
                 <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                </select></td>
			</tr>
            <tr>
				<td>Make</td>
				<td><input type="text" style="width:100%"  name="make" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)"></td>
			</tr>
			<tr>
				<td>Series</td>
				<td><input type="text" style="width:100%"  name="series" id="text" onKeyUp="caps(this)"></td>
			</tr>
			<tr>	
            <td>Body  Type</td>
				<td><input type="text" style="width:100%"  name="bodytype" id="text" onKeyUp="caps(this)"></td>
			</tr>
            <tr>	
            <td>Wheels</td>
				<td><select style="width:100%"   name="wheels" id="text" required>
				<option value="" selected="selected" disabled="disabled">Please Select</option>
                <option  value="2">2</option>
                 <option  value="4">4</option>
                <option  value="6">6</option>
                <option  value="10">10</option>
                </select></td>
			</tr>
			 <tr>	
            <td>Class</td>
				<td><select style="width:100%"   name="class" id="text"	required>
				<option value="" selected="selected" disabled="disabled">Please Select</option>
                <option  value="COMPANY">COMPANY</option>
                 <option  value="TRUCK">TRUCK</option>
                <option  value="HE">HEAVY EQPMNT</option>
                </select></td>
			</tr>
            <td>Year Model</td>
				<td><input type="text" style="width:100%"  name="yearmodel"  onKeyPress="return isNumber(event)"></td>
			</tr>
			<tr>	
			<tr>
				<td>Aquisition Cost (Php)</td>
				<td><input type="text"  style="width:100%" name="aquisitioncost" id="text" onKeyUp="caps(this)" onKeyPress="return isNumber(event)" ></td>
			</tr>
			<tr>
            
				<td>Net Book Value (Php)</td>
				<td><input type="text"  style="width:100%" name="netbookvalue" id="extra7" onKeyPress="return isNumber(event)" ></td>
			</tr>
			<tr>
				<td>Amount (Php)</td>
				<td><input type="text" style="width:100%"  name="amount" id="extra7" onKeyPress="return isNumber(event)" ></td>
			</tr>
              <tr>
				<td>Vehicle Condition</td>
				<td><textarea name="truckcondition" style="width:100%" cols="22" rows="3" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" ></textarea></td>
			</tr>
   </table>
   <br />
   <br />
<input type="submit" value="Save New Truck"  name="savenewtruck">
</form>
<img style="vertical-align:bottom" src="../image/footer.png" height="8%" width="100%">
</center>

</body>
</html>