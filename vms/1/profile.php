 <?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
?>
 <?php
 include('connect.php');
include('../title.php');
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
   <img src="../image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Vehicle</a></li>
   <li  class='active'><a href="existing_truck.php">Existing Vehicles</a></li>
      <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li><a href="truck_reassign.php">Vehicle Reassignment</a></li>
      <li><a href='summary.php'>Summary</a></li>
       <li><a href='trip.php'>Trip Schedule</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
            <li><a href='otheraccount.php'>Other Account</a></li>
         <li><a href="logout.php">Logout</a></li>
</ul></div><br /> 
<?php //query =================================================
$plate=mysql_query("Select * from tbl_truck_report") or die (mysql_error());
?>

<?php //startofcode===========================================================================?>
<table  width="80%" align="center">
		<tr>
			<td align="center" colspan="2"><h3>Existing Vehicle</h3></td>
			<td></td>
			</tr>
</table> 

<form action="maintenance_before.php" method="post" target="tire"> 
<br /><br />
<table width="25%" align="center">
<tr>

<td>
<?php
include('connect.php');
$profile_plate = mysql_query("Select * from tbl_truck_report Where id ='".$_GET['id']."'") or die(mysql_error());
$profile_plate_row = mysql_fetch_array($profile_plate);

$repair = mysql_query("Select * from tbl_forrepair Where truckid='".$_GET['id']."'") or die(mysql_error());
?>
<input type="hidden" name="plate" value="<?php echo $profile_plate_row['truckplate'];?>">
<font size="+1"><b>Plate:  &nbsp;<?php echo $profile_plate_row['truckplate'];?></b></font>
</td>
    <td align="center">
    <select name="maintain">
<?php	if(isset($_POST['filter'])){
		?><option value="<?php echo $_POST['maintain'];?>"><?php echo $_POST['maintain'];?></option><?php } ?>
          <option value=" ">SELECT</option>
    <option value="TOOLS">TOOLS</option>
	<option value="TIRE">TIRE</option>
    <option value="BATTERY">BATTERY</option>
   <?php if(mysql_num_rows($repair) > 0 ){?>
     <option value="FOR REPAIR">FOR REPAIR</option>
     <?php } ?>
    </select>
    <input type="submit" value="Filter" name="filter"></td>
</tr>
</table>
</form>
<center>
<br /><br />
<sa>
<iframe frameborder="0%" scrolling="auto" name="tire" height="100%" width="1200px" align="middle"></iframe>
</center>
<?php //endtofcode===========================================================================?>
<br /><br />



<img src="../image/footer.png" height="8%" width="100%">     