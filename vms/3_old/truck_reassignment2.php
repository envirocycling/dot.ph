<?php
session_start();
if(!isset($_SESSION['encoder_username'])){
	header("Location: ../index.php");
	}

?>
 <title>EFI Vehicles Report</title>
 <?php
 include('connect.php');

 ?>
     <link rel="stylesheet" href="../css/tables.css">
 <script>
function getData(dropdown) {
var value = dropdown.options[dropdown.selectedIndex].value;
if (value != 'none'){
document.getElementById("name").style.display = "block";
document.getElementById("name").disabled = false;
}else if(value == 'none'){
	document.getElementById("name").disabled = true;
	} 
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
 <?php // auto submit if change==================================================================?>
<script>
function onSelectChange(){
 document.getElementById('frm').submit();
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
     <li  class='active'><a href="truck_reassign.php">Vehicle Reassignment</a></li>
      <li><a href='summary.php'>Summary</a></li>
       <li><a href='trip.php'>Trip Schedule</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
         <li><a href="logout.php">Logout</a></li>
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
 <table width="70%" >
 

<tr><td><br /></td></tr>
<tr>
 <form action="truck_reassign.php" method="post">
<td>

<input type="submit" value="Select Other Plate No.">
</td>
</form>
<form id="frm" action="truck_reassignment3.php?p=<?php echo $_GET['p'];?>" method="post">
  <input type="hidden" name="plate" value="<?php echo $_POST['plate']?>">  </td>
<td>Plate No.<input  type="text"  value="<?php echo $_GET['p'];?>" disabled="disabled">
<input  type="hidden" name="plate" value="<?php echo $_GET['p'];?>" ></td>



      <?php
	$given = mysql_query("Select * from tbl_truck_report Where truckplate='".@$_GET['p']."'") or die(mysql_error());
	$givenrow = mysql_fetch_array($given);
	$given_name = $givenrow['id'];
	$select = mysql_query("Select * from tbl_givento Where truckid='$given_name'") or die (mysql_error());
	$select_row = mysql_fetch_array($select);
	?>
    <input type="hidden" name="suppname_old" value="<?php 	echo $select_row['suppliername'];?>" >
   

<td  align="left">Branch: <input type="text" name="branch" value="<?php echo $givenrow['branch'];?>"  disabled="disabled">
			<input type="hidden" name="branch" value="<?php echo $givenrow['branch'];?>">
</td>


<?php

$givento = mysql_query ("SELECT * FROM tbl_givento Where truckid='".$select_row['id']."'");
$given_row = mysql_fetch_array($givento);
  echo $givenrow['branch'];
?>
</tr>
<tr>
<td colspan="3" align="center">
<br /><br />
Reassign To:  
   

  
  <select name="rec_branch"  onchange="onSelectChange();">
  <option value="none">--Select Branch--</option>
  
  <?php 


   include('connect_out.php');
													$branch =  mysql_query("Select * from branches  order by branch_name Asc") or die (mysql_error());
													while(	$branch_row = mysql_fetch_array($branch)){
														if(strtoupper($branch_row['branch_name']) != $givenrow['branch']){
														?>
                                                <option value="<?php echo strtoupper($branch_row['branch_name']);?>" onclick=""><?php echo strtoupper($branch_row['branch_name']);?></option>
														<?php }}
													?>
                                                    </select>  </td>
                                                    </tr>
   <tr>
  </table>

 

<?php //endtofcode===========================================================================?>
<br /><br />
<br /><br />
<img src="../image/footer.png" height="8%" width="100%">     