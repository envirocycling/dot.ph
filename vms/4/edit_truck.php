<!doctype html>
<html lang=''>
<head>
	<title>Vehicle Management System</title>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <script src="js/header.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
   <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
	<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
	<script src="js/setup.js" type="text/javascript"></script>

</head>
<body>


<?php include('layout/header.php');?>

<center>
			<div id="body">
<table id="page1"><tr><td align="left">Existing Vehicles : View Info<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<br />
 <?php

include('connect.php');


$truck = mysql_query ("SELECT * FROM tbl_truck_report Where id='".$_GET['id']."'");
$truck_row = mysql_fetch_array($truck);

?>
<form action="update_given.php" method="post">

<table align="center" width="500px">
<tr>
				<td align="center" colspan="2"><h3>EFI Vehicles</h3></td>
				<td></td>
			</tr>
  <tr>
  <input type="hidden" name="id" value="<?php echo $truck_row['id']; ?>">
   
    <td >Plate Number: </td>
  <td><input type="text"  name="platenumber" value="<?php echo strtoupper($truck_row ['truckplate']); ?>" id="text" readonly style="width:50%;">
  <input type="hidden"  name="oldplatenumber" value="<?php echo strtoupper($truck_row ['truckplate']); ?>" >
   <input type="hidden"  name="branch" value="<?php echo strtoupper($truck_row ['branch']); ?>" >
 </td>
  </tr>
  <td>Acquisition Cost (PhP):  </td>
   
  <td><input type="text"  name="acquisitioncost" required value="<?php echo strtoupper($truck_row ['aquisitioncost']); ?>" id="text" readonly style="width:50%;"></td>
   <tr>
  <td>Make: </td>
   
  <td><input type="text"  name="make" required value="<?php echo strtoupper($truck_row ['make']); ?>" id="text" readonly style="width:50%;"></td>
  </tr>
  <tr>
  <td>Series: </td>
   
  <td><input type="text"  name="series" required value="<?php echo strtoupper($truck_row ['series']); ?>" id="text" readonly style="width:50%;"></td>
  </tr>
  <tr>
  <td>Body Type: </td>
   
  <td><input type="text"  name="bodytype" required value="<?php echo strtoupper($truck_row ['bodytype']); ?>" id="text" readonly style="width:50%;"></td>
  </tr>
  <tr>
  <td>Year Model: </td>
   
  <td><input type="text"  name="yearmodel" required value="<?php echo strtoupper($truck_row ['yearmodel']); ?>"  id="text" readonly style="width:50%;"></td>
  </tr>
   <tr>
  <td>Net Book Value (Php): </td>
   
  <td><input type="text"  name="netbookvalue" required value="<?php echo strtoupper($truck_row ['netbookvalue']); ?>" id="text" readonly style="width:50%;"></td>
  </tr>
  <tr>
  <td>Amount (Php): </td>
   
  <td><input type="text"  name="amount" required value="<?php echo strtoupper($truck_row ['amount']); ?>" id="text" readonly style="width:50%;"></td>
  </tr>
  <tr>
  <td>Vehicle Condition: </td>
   
  <td><textarea cols="22" rows="3" required name="truckcondition" id="text" readonly style="width:50%;"><?php echo strtoupper($truck_row ['truckcondition']); ?></textarea></td>
  </tr>
 
</table>



<?php
$givento = mysql_query ("SELECT * FROM tbl_givento Where truckid='".$_GET['id']."'") or die(mysql_error());
$given_row = mysql_fetch_array($givento);

?>
<br />

<table align="center" width="500px">
<tr>
				<td align="center" colspan="2"><h3>Given To</h3></td>
				<td></td>
			</tr>
  <tr>
  <input type="hidden"  name="truckid" value="<?php echo $given_row['id']; ?>" id="text" onKeyUp="caps(this)">
    <td >Supplier Name: </td>
  <td>

<?php  include('connect_out.php');
$selectp = mysql_query("Select * from supplier_details Order by supplier_id Asc") or die(mysql_error());
$sql_supp = mysql_query("SELECT * from supplier_details WHERE supplier_id='".$given_row['suppliername']."'") or die (mysql_error());
$supp_row = mysql_fetch_array($sql_supp);

?>
<input type="text" readonly value="<?php echo $supp_row['supplier_id'].'_'.$supp_row['supplier_name'];?>"  id="text" style="width:100%;">

 </td>
  </tr>
  <td>Issuance Date:  </td>
   
  <td><input type="date" required  name="issuancedate" value="<?php echo $given_row ['issuancedate']; ?>" id="text" readonly style="width:50%;"></td>
   <tr>
  <td>End Date: </td>
   
  <td><input type="date"  required name="enddate" value="<?php echo $given_row ['enddate']; ?>" id="text" readonly style="width:50%;"></td>
  </tr>
  <tr>
  <td>Amortization: </td>
   
  <td><input type="text" required  name="amortization" value="<?php echo strtoupper($given_row ['amortization']); ?>" id="text" readonly style="width:50%;"></td>
  </tr>
  <tr>
  <td>Cash Bond: </td>
   
  <td><input type="text" required  name="cashbond" value="<?php echo strtoupper($given_row ['cashbond']); ?>"  id="text" readonly style="width:50%;"></td>
  </tr>
   <tr>
  <td>Proposed Volume: </td>
   
  <td><input type="text"  required name="volume" value="<?php echo strtoupper($given_row ['proposedvolume']); ?>"  id="text" readonly style="width:50%;"></td>
  </tr>
     <tr>
  <td>Remarks: </td>
   
  <td><textarea   name="remarks" id="text" cols="22" rows="3"  readonly style="width:50%;"> <?php echo strtoupper($given_row ['remarks']); ?></textarea></td>
  </tr>
 
 
</table>

 <center>
 <br /> </form></td>
  </center>
 <br /><br />                   
</div>

<?php  include('layout/footer.php');?>
</center>
</body>
</html>
									