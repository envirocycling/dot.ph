<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");

	}
include('../title.php');
?>

<link href="../css/table.css" media="screen" rel="stylesheet" type="text/css" />
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
    <link rel="stylesheet" href="../css/header2.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
<img src="../image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li ><a href="existing_truck.php">Existing Vehicles</a></li>
      <li  class='active'><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li><a href="truck_reassign.php">Vehicle Reassignment</a></li>
      <li><a href='summary.php'>Summary</a></li>
       <li><a href='trip.php'>Trip Schedule</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
         <li><a href="logout.php">Logout</a></li>
</ul>
</div><br />
<table  width="80%" align="center" >
		<tr>
				<td align="center" colspan="2"><h3>Maintenance</h3></td>
				<td></td>
			</tr>
	</table>  	
<?php

include('connect.php');
$plate = mysql_query("Select * from tbl_truck_report Where id ='".$_GET['id']."'") or die(mysql_error());
$plate_row = mysql_fetch_array($plate);
?>
<br />
<br />
<center>
<table  width="60%">
<tr>
<td align="center" colspan="2"><h4>Records of Repairs</h4></td>
</tr>
<tr>
<td><br /><br /><font size="+1"><b>Plate No. <?php echo "<font style='text-decoration:underline'>".$plate_row['truckplate']."</font>";?></b></font></td>

</tr>
<tr>
</tr>
<tr>
<td colspan="2">
<table class="CSSTableGenerator">
<tr>
<td>Date</td>
<td>Type of Work Done</td>
<td>Items</td>
<td>Repaired By</td>
<td>Remarks</td>
</tr>

<?php 
$oil = mysql_query("Select * from tbl_repair Where truckid='".$_GET['id']."' Order by date Desc") or die(mysql_error());
while($row = mysql_fetch_array($oil)){
	?>
    <tr>
    <td><?php echo $row['date'];?></td>
     <td><?php echo $row['type'];?></td>
       <td width="20%"><?php echo $row['items'];?></td>
    <td><?php echo $row['repairedby'];?></td>
    <td><?php echo $row['remarks'];?></td>
	</tr>    
    
    <?php
	}
?>

</table>
</td>
</tr>
</table>
</center>
   
<br />
<br />
<img style="vertical-align: baseline" src="../image/footer.png" height="8%" width="100%">
