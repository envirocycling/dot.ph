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
	<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
	function decimal(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 46 || (charCode > 47 && charCode < 58)) {
        return true;
    }
    return false;
}
	</script>
	<link href="css/select2.min.css" rel="stylesheet">

</head>
<body>
<html>
<script type="text/javascript" src="js/jquery.min.js"></script>

 </script>
<?php include('layout/header.php'); include("css/drop_down.php");?>
<center>
			<div id="body">

<table id="page1"><tr><td align="left">Existing Vehicles : Assign<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<br />
 <?php

include('connect.php');


$truck = mysql_query ("SELECT * FROM tbl_truck_report Where id='".$_GET['id']."'");
$truck_row = mysql_fetch_array($truck);

?>
<form action="update_given.php" method="post">

<table align="center" hidden>
<tr>
				<td align="center" colspan="2"><h3>EFI Vehicles</h3></td>
				<td></td>
			</tr>
  <tr>
  <input type="hidden" name="id" value="<?php echo $truck_row['id']; ?>">
   
    <td >Plate Number: </td>
  <td><input type="text"  name="platenumber" value="<?php echo strtoupper($truck_row ['truckplate']); ?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" >
  <input type="hidden"  name="oldplatenumber" value="<?php echo strtoupper($truck_row ['truckplate']); ?>" >
   <input type="hidden"  name="branch" value="<?php echo strtoupper($truck_row ['branch']); ?>" >
 </td>
  </tr>
  <td>Acquisition Cost (PhP):  </td>
   
  <td><input type="text"  name="acquisitioncost"  value="<?php echo strtoupper($truck_row ['aquisitioncost']); ?>" id="extra7" onKeyPress="return decimal(event)"></td>
   <tr>
  <td>Make: </td>
   
  <td><input type="text"  name="make"  value="<?php echo strtoupper($truck_row ['make']); ?>" id="text" onKeyUp="caps(this)"  ></td>
  </tr>
  <tr>
  <td>Series: </td>
   
  <td><input type="text"  name="series"   value="<?php echo strtoupper($truck_row ['series']); ?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" ></td>
  </tr>
  <tr>
  <td>Body Type: </td>
   
  <td><input type="text"  name="bodytype"  value="<?php echo strtoupper($truck_row ['bodytype']); ?>" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" ></td>
  </tr>
  <tr>
  <td>Year Model: </td>
   
  <td><input type="text"  name="yearmodel" value="<?php echo strtoupper($truck_row ['yearmodel']); ?>"  onKeyPress="return isNumber(event)"></td>
  </tr>
    <tr>
  <td>Wheels: </td>
   
  <td>
  <select name="wheels">
  <option value="<?php echo $truck_row ['wheels']; ?>"><?php echo $truck_row ['wheels']; ?></option>
  <option value="2">2</option>
    <option value="4">4</option>
  <option value="6">6</option>
 <option value="10">10</option></td>
 </select>
  </tr>
  <tr>
  <td>Class: </td>
   
  <td>
  <select name="class">
  <option value="<?php echo $truck_row ['class']; ?>"><?php if($truck_row ['class'] == 'HE'){echo "HEAVY EQPMNT"; }else{ echo $truck_row ['class'];}?></option>
  <option value="COMPANY">COMPANY</option>
    <option value="TRUCK">TRUCK</option>
  <option value="HE">HEAVY EQPMNT</option>
 </select>
   </td>
  </tr>
   <tr>
  <td>Net Book Value (Php): </td>
   
  <td><input type="text"   name="netbookvalue" value="<?php echo strtoupper($truck_row ['netbookvalue']); ?>" id="extra7" onKeyPress="return isNumber(event)" ></td>
  </tr>
  <tr>
  <td>Selling Price (Php): </td>
   
  <td><input type="text"  name="amount" value="<?php echo strtoupper($truck_row ['amount']); ?>" id="extra7" onKeyPress="return isNumber(event)" ></td>
  </tr>
  <tr>
  <td>Vehicle Condition: </td>
   
  <td><textarea cols="22" rows="3" name="truckcondition" id="text"  onKeyUp="caps(this)" onKeyPress="return isNumbers(event)"><?php echo strtoupper($truck_row ['truckcondition']); ?></textarea></td>
  </tr>
 
</table>



<?php
$givento = mysql_query ("SELECT * FROM tbl_givento Where truckid='".$_GET['id']."'") or die(mysql_error());
$given_row = mysql_fetch_array($givento);

$select = mysql_query("Select * from tbl_contract Where status LIKE 'pending%' and truck_id='".$_GET['id']."' Order by id Asc") or die(mysql_error());

?>
<br />

<table align="center">
			   <tr>
  <td>Reason for Updating: </td>
   
  <td>
      <select name="reason"  style="width:100%;" id="text" required>
			<option value="" selected="selected" disabled="disabled">Please Select</option>
			<option value="Pre-Terminated Contract">Pre-Terminated Contract</option>
			<!--<option value="Assign to Supplier">Assign to New Supplier</option>--->
			<option value="Update">Update the Data</option>
  		</select>
  </td>
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

<script>
function am(){
	var end_date = document.getElementById('sup_end').value;
	var issuance_date = document.getElementById('sup_issuance').value;
	
	var new_enddate = new Date(end_date);
	var new_issuancedate = new Date(issuance_date);
	//var dd1 = new_enddate.getDate();
	//var dd2 = new_issuancedate.getDate();
	var mm = new_issuancedate.getMonth();
	var mm2 = new_enddate.getMonth();
	var yy = new_issuancedate.getFullYear();
	var yy2 = new_enddate.getFullYear();
	var m = (mm2 - mm);
	var m3 =String(m); 
	//var m2 = m3.replace("-","");
	//var m4 = Number(m2);
	var months = ((yy2 - yy) * 12) + (m);
	document.getElementById('e_am').value=months;
	
	//alert(months);
};
	function maxl(){
		var a_m = document.getElementById('e_am').value;
		var ca_m = document.getElementById('e_cm').value;
		var l_am = a_m.length;
		var l_cam = ca_m.length;
		
		if(l_am > 3){
			var a_m2 = a_m.substring(0,3);
			alert("Maximum of 3 characters long.");
			document.getElementById('e_am').value=a_m2;
		}
		if(l_cam > 3){
			var ca_m2 = ca_m.substring(0,3);
			alert("Maximum of 3 characters long.");
			document.getElementById('e_cm').value=ca_m2;
		}

	};
</script>

<select id="supp_drop_down" name="supplier_name" required>
<option value="<?php echo $supp_row['supplier_id'];?>"><?php echo $supp_row['supplier_id'].'_'.$supp_row['supplier_name'];?></option>
<?php
while($rowp = mysql_fetch_array($selectp)){
?>
<option value="<?php echo $rowp['supplier_id'];?>"><?php echo $rowp['supplier_id'].'_'.$rowp['supplier_name'];?></option>
<?php }?>
</select>
</span>

<!---end of select -->
 </td>
  </tr>
  <td>Issuance Date:  </td>
   
  <td><input type="date" required id="sup_issuance"  name="issuancedate" value="<?php echo $given_row ['issuancedate']; ?>" onChange="am();"></td>
   <tr>
  <td>End Date: </td>
   
  <td><input type="date" required id="sup_end"  name="enddate" value="<?php echo $given_row ['enddate']; ?>" onChange="am();"></td>
  </tr>
  <tr>
  <td>Amortization: </td>
   
  <td><input type="text"  name="amortization" value="<?php echo strtoupper($given_row ['amortization']); ?>" id="text" onKeyPress="return decimal(event)" required></td>
  
  <td>Month/s: </td>
   <td><input type="number" onKeyUp="maxl();" id="e_am"  name="amortization_month"  maxlength="3" value="<?php if(empty($given_row ['amortization_month'])){ echo $diff;}else{ echo $given_row['amortization_month'];} ?>" style="width:50px;" required></td>
  </tr>
  <tr>
  <td>Cash Bond: </td>
   
  <td><input type="text" required name="cashbond" id="text"  value="<?php echo strtoupper($given_row ['cashbond']); ?>" id="extra7" onKeyPress="return decimal(event)"></td>
  
  <td>Month/s: </td>
   <td><input onKeyUp="maxl();" type="number" id="e_cm"  name="cashbond_month" value="<?php if(!empty($given_row ['cashbond_month'])){ echo  $given_row ['cashbond_month'];}?>" style="width:50px;"  required></td>
  </tr>
   <tr>
  <td>Proposed Volume: </td>
   
  <td><input type="text" required name="volume" value="<?php echo strtoupper($given_row ['proposedvolume']); ?>" id="text" onKeyPress="return decimal(event)"></td>
   <td>Penalty: </td>
   
  <td><input type="text"  name="penalty" value="<?php echo strtoupper($given_row['penalty']); ?>" id="text" onKeyPress="return decimal(event)"></td>
  </tr>
  <tr>
  <td>Reference No: </td>
   
  <td><input type="text"  name="ref_no" value="<?php echo strtoupper($given_row ['ref_no']); ?>" id="text" onKeyUp="caps(this)"></td>
  </tr>
     <tr>
  <td>Remarks: </td>
   
  <td><textarea  name="remarks" id="text" cols="22" rows="3"  onKeyUp="caps(this)"><?php echo strtoupper($given_row ['remarks']); ?></textarea></td>
  </tr>
 
 
</table> 

	<center>
 <br />
 <?php
 include('connect.php');
 $queryss=mysql_query("Select * from tbl_truck_report Where branch LIKE '%".$_SESSION['owner']."%' and id='".$_GET['id']."'") or die (mysql_error());
 if(mysql_num_rows($queryss) > 0){
 ?>
 <?php
 if(mysql_num_rows($select) > 0 ){
     echo '<i><font color="red">Details can be updated when terminated contract request was already approved.</i></font>';
 }else{
     echo '<input type="submit" value="Update" id="button">';
 }
 ?></form>
  </center>
  <?php }?>
 <br /><br />
</div>
</center>
<?php include('layout/footer.php');?>
</body>
</html>