<title>EFI Vehicles Report</title>
<link href="css/table.css" media="screen" rel="stylesheet" type="text/css" />
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
   <li class='active'><a href="existing_truck.php">Existing Trucks</a></li>
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

$records_per_page = 1000;
	

(@!$_GET['start'])?$start=0 : $start = $_GET['start'];
$query = 'SELECT count(*) FROM tbl_truck_report';
$result = mysql_query($query) or die("Error in query : $query".mysql_error());
$row = mysql_fetch_row($result);
$total_records = $row[0];

	if(($total_records > 0) && ($start < $total_records))
	{
		if(isset($_POST['submit'])){
			$search = $_POST['search'];
			$query = "Select * from tbl_truck_report Where truckplate LIKE '$search%' or branch LIKE '$search%'  ORDER BY ID ASC LIMIT $start,$records_per_page";
			}else {
		$query = "Select * from tbl_truck_report ORDER BY ID ASC LIMIT $start,$records_per_page";
			}
		$result = mysql_query($query) or die(mysql_error());
		$count = 1;
?>
	

     <table  width="80%" align="center" >
		<tr>
				<td align="center" colspan="2"><h3>Existing Vehicles</h3></td>
				<td></td>
			</tr>
	</table>  	
    <table width="90%" align="center">
    <tr>
    <form action="" target="_self" method="post">
    <td ><input name="submit" type="submit" value="Search">
    <?php if(isset($_POST['submit'])){?><input type="text" id="text" onKeyUp="caps(this)" name="search" value="<?php echo $_POST['search'];?>"><?php } else {?>
    <input type="text" name="search" placeholder="Type here" id="text" onKeyUp="caps(this)"><?php } ?>
    </form>  </td>
    </tr>
         </table>    
        <table width="90%" align="center"><tr><td>
	<table width="95%"  border="1px" align="center" class="CSSTableGenerator">    
	
		<tr>
			<td align="center">Branch</td>
			<td align="center">Owner's Name</td>
			<td align="center">Vehicle Plate</td>
			<td align="center">Acquisition Cost</td>
			<td align="center">Net Book Value</td>
			<td align="center">Amount</td>
			<td align="center">Vehicle Condition</td>
			<td align="center" width="30%">Given To</td>
			<td align="center" colspan="3" width="10%">Action</td>
			
		</tr>	 
 <?php


	while($row=mysql_fetch_array($result))
  
	{
	$class = ($count%2 == 1)?'even':'odd';
		$count++;
  ?>
                                              
                                              
 
		<tr >
				<form method="post" >
					<input type="hidden" value="<?php echo $row['id']; ?>">
				</form>
			<td align="center"><font size="-2"><?php echo strtoupper($row['branch']); ?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row['ownersname']); ?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row['truckplate']); ?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row['aquisitioncost']); ?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row['netbookvalue']); ?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row['amount']); ?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row['truckcondition']); ?></td>
			
			<td align="center"><font size="-2"><?php 
				$given=mysql_query("Select * from tbl_givento Where truckid='".$row['id']."'");
				$given_row = mysql_fetch_array($given);
				echo strtoupper($given_row['suppliername']); 
												?></td>
			<td align="center" >
			<?php echo '<a href="truck_details.php?id='.$row['id'].'">' ?><input type="button" value="Details"/></a> 
</td>
			<td align="center"><?php echo '<a href="edit_truck.php?id='.$row['id'].'">' ?><input type="button" value="View/Edit"/></a> 

		</tr>




<?php
  }
  
  ?>

</table>
</td>
</tr>
</table>
</br></br>

 <?php
	}
	?>
   
<br />
<br />
<img style="vertical-align: baseline" src="image/footer.png" height="8%" width="100%">
