<?php
session_start();
if(!isset($_SESSION['public_username'])){
	header("Location: ../index.php");
	}

?>
<html>
<title>EFI Vehicles Report</title>
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
    <link rel="stylesheet" href="../css/header2.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
<body>
<br /> 

 <?php

include('connect.php');


$truck = mysql_query ("SELECT * FROM tbl_truck_report Where id='".$_GET['id']."'");
$truck_row = mysql_fetch_array($truck);

?>


<table align="center">
<tr>
				<td align="center" colspan="2"><h3>EFI Vehicles</h3></td>
				<td></td>
			</tr>
  <tr>
  <input type="hidden" name="id" value="<?php echo $truck_row['id']; ?>">
   
    <td >Plate Number: </td>
  <td><input type="text"  name="platenumber" value="<?php echo strtoupper($truck_row ['truckplate']); ?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" readonly="readonly">
  <input type="hidden"  name="oldplatenumber" value="<?php echo strtoupper($truck_row ['truckplate']); ?>" >
   <input type="hidden"  name="branch" value="<?php echo strtoupper($truck_row ['branch']); ?>" >
 </td>
  </tr>
  <td>Acquisition Cost (PhP):  </td>
   
  <td><input type="text"  name="acquisitioncost" value="<?php echo strtoupper($truck_row ['aquisitioncost']); ?>" id="extra7" onKeyPress="return isNumber(event)" readonly="readonly"></td>
   <tr>
  <td>Make: </td>
   
  <td><input type="text"  name="make" value="<?php echo strtoupper($truck_row ['make']); ?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" readonly="readonly"></td>
  </tr>
  <tr>
  <td>Series: </td>
   
  <td><input type="text"  name="series" value="<?php echo strtoupper($truck_row ['series']); ?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" readonly="readonly"></td>
  </tr>
  <tr>
  <td>Body Type: </td>
   
  <td><input type="text"  name="bodytype" value="<?php echo strtoupper($truck_row ['bodytype']); ?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" readonly="readonly"></td>
  </tr>
  <tr>
  <td>Year Model: </td>
   
  <td><input type="text"  name="yearmodel" value="<?php echo strtoupper($truck_row ['yearmodel']); ?>"  onKeyPress="return isNumber(event)" readonly="readonly"></td>
  </tr>
    <tr>
  <td>Wheels: </td>
   
  <td>
  <input type="text" value="<?php echo $truck_row ['wheels']; ?>" readonly="readonly">
  </tr>
   <tr>
  <td>Net Book Value (Php): </td>
   
  <td><input type="text"  name="netbookvalue" value="<?php echo strtoupper($truck_row ['netbookvalue']); ?>" id="extra7" onKeyPress="return isNumber(event)" readonly="readonly"></td>
  </tr>
  <tr>
  <td>Amount (Php): </td>
   
  <td><input type="text"  name="amount" value="<?php echo strtoupper($truck_row ['amount']); ?>" id="extra7" onKeyPress="return isNumber(event)" readonly="readonly"></td>
  </tr>
  <tr>
  <td>Vehicle Condition: </td>
   
  <td><textarea cols="22" rows="3" name="truckcondition" id="text"   onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" readonly="readonly"><?php echo strtoupper($truck_row ['truckcondition']); ?></textarea></td>
  </tr>
 
</table>



<?php
$givento = mysql_query ("SELECT * FROM tbl_givento Where truckid='".$_GET['id']."'") or die(mysql_error());
$given_row = mysql_fetch_array($givento);

?>
<br />

<table align="center">
<tr>
				<td align="center" colspan="2"><h3>Given To</h3></td>
				<td></td>
			</tr>
  <tr>
  <input type="hidden"  name="truckid" value="<?php echo $given_row['id']; ?>" id="text" onKeyUp="caps(this)">
   
  <!---beginning of select -->
<link rel="stylesheet" href="../cbFilter/cbCss.css" />
<script src="../cbFilter/jquery-1.8.3.js"></script>
<script src="../cbFilter/jquery-ui.js"></script>
<style>
    #sup_picker{
        font-size:14px;
        width:500px;
    }
    .ui-combobox {
        position: relative;
        display: inline-block;
    }
    .ui-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
        /* adjust styles for IE 6/7 */
        *height: 1.7em;
        *top: 0.1em;
    }
    .ui-combobox-input {
        margin: 0;
        padding: 0.3em;
    }
</style>
<?php
$select = mysql_query("Select * from tbl_truck_report Where ownersname LIKE '%ENVIROCYCLING FIBER%' and id = '".$_GET['id']."'") or die (mysql_error());
if(mysql_num_rows($select) >= 1){
include("connect_out.php");
$sql_supp = mysql_query("SELECT * from supplier_details WHERE supplier_id='".$given_row['suppliername']."'") or die (mysql_error());
$supp_row = mysql_fetch_array($sql_supp);
?>
 <td >Supplier Name: </td>
  <td>
<input type="text" value="<?php echo $supp_row['supplier_name'];?>" readonly="readonly">


<!---end of select -->
 </td>
  </tr>
  <td>Issuance Date:  </td>
   
  <td><input type="date"  name="issuancedate" value="<?php echo $given_row ['issuancedate']; ?>" readonly="readonly"></td>
   <tr>
  <td>End Date: </td>
   
  <td><input type="date"  name="enddate" value="<?php echo $given_row ['enddate']; ?>" readonly="readonly"></td>
  </tr>
  <tr>
  <td>Amortization: </td>
   
  <td><input type="text"  name="amortization" value="<?php echo strtoupper($given_row ['amortization']); ?>" id="text" onKeyUp="caps(this)" readonly="readonly" ></td>
  </tr>
  <tr>
  <td>Cash Bond: </td>
   
  <td><input type="text"  name="cashbond" value="<?php echo strtoupper($given_row ['cashbond']); ?>" id="extra7" onKeyPress="return isNumber(event)"readonly="readonly" ></td>
  </tr>
   <tr>
  <td>Proposed Volume: </td>
   
  <td><input type="text"  name="volume" value="<?php echo strtoupper($given_row ['proposedvolume']); ?>" id="text" onKeyUp="caps(this)" readonly="readonly"></td>
  </tr>
 <?php }else {
include("connect_out.php");
$sql_supp = mysql_query("SELECT * from supplier_details WHERE supplier_id='".$given_row['suppliername']."'") or die (mysql_error());
$supp_row = mysql_fetch_array($sql_supp);
?>
  <td >Supplier Name: </td>
  <td>
<input type="text" value="<?php echo $supp_row['supplier_name'];?>" readonly="readonly">
<!---end of select -->
 </td>
  </tr>
  <td>Issuance Date:  </td>
   
  <td><input type="date"  name="issuancedate" value="<?php echo $given_row ['issuancedate']; ?>" readonly="readonly"></td>
   <tr>
  <td>End Date: </td>
   
  <td><input type="date"  name="enddate" value="<?php echo $given_row ['enddate']; ?>" readonly="readonly"></td>
  </tr>
  <tr>
  <td>Amortization: </td>
   
  <td><input type="text"  name="amortization" value="<?php echo strtoupper($given_row ['amortization']); ?>" id="text" onKeyUp="caps(this)" readonly="readonly"></td>
  </tr>
  <tr>
  <td>Cash Bond: </td>
   
  <td><input type="text"  name="cashbond" value="<?php echo strtoupper($given_row ['cashbond']); ?>" id="extra7" onKeyPress="return isNumber(event)" readonly="readonly"></td>
  </tr>
   <tr>
  <td>Proposed Volume: </td>
   
  <td><input type="text"  name="volume" value="<?php echo strtoupper($given_row ['proposedvolume']); ?>" id="text" onKeyUp="caps(this)" readonly="readonly"></td>
  </tr>
 
 <?php }?>
     <tr>
  <td>Remarks: </td>
   
  <td><textarea  name="remarks" id="text" cols="22" rows="3"  onKeyUp="caps(this)" readonly="readonly"><?php echo strtoupper($given_row ['remarks']); ?></textarea></td>
  </tr>
 
 
</table>


 </td>
 
 <br /><br />                 
</body>
</html>                                     
												