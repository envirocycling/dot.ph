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
	</script>
</head>
<body>
<html>

<?php include('layout/header.php');?>
<center>
			<div id="body">
<?php
include('connect.php');



$records_per_page = 200;
	

(@!$_GET['start'])?$start=0 : $start = $_GET['start'];
$query = 'SELECT count(*) FROM tbl_truck_report';
$result = mysql_query($query) or die("Error in query : $query".mysql_error());
$row = mysql_fetch_row($result);
$total_records = $row[0];

	if(($total_records > 0) && ($start < $total_records))
	{
		if(isset($_POST['submit'])){
			$search = $_POST['search'];
			$query = "Select * from tbl_truck_report Where truckplate LIKE '%$search%' or branch LIKE '%$search%' or ownersname LIKE '%$search%' or make LIKE '%$search%' or series LIKE '%$search%' or bodytype LIKE '%$search%' or yearmodel LIKE '%$search%' or suppliername LIKE '%$search%' and status='' ORDER BY branch,ending ASC LIMIT $start,$records_per_page";
			}else {
		$query = "Select * from tbl_truck_report WHERE status='' ORDER BY branch,ending ASC LIMIT $start,$records_per_page";
			}
		$result = mysql_query($query) or die(mysql_error());
		$count = 1;
?>
	<script>
    function show_table(){
		if (document.getElementById('show_tally').checked){
			document.getElementById('sum_table').hidden=false;
			document.getElementById('sum_table2').hidden=false;
			}else{
				document.getElementById('sum_table').hidden=true;
				document.getElementById('sum_table2').hidden=true;
				}
		}
    </script>
	
	
	
	
	
	
<table id="page1"><tr><td align="left">Existing Vehicles<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<br />


<!---TALLY----------------------------------------------------->	
<?php
include('connect.php');

		$query = "Select * from tbl_truck_report  WHERE status=''";
		$result = mysql_query($query) or die(mysql_error());
		$count = 1;
?>
	<script>
    function show_table(){
		if (document.getElementById('show_tally').checked){
			document.getElementById('sum_table2').hidden=false;
			}else{
				document.getElementById('sum_table2').hidden=true;
				}
		}
    </script>
	
<table width="30%"  align="right" >
<tr>
<td align="right">Show Vehicle Tally<input type="checkbox" id="show_tally" onClick="show_table();"></td>
</tr>
<tr>
<td>
<?php 
include('connect.php');

$elf= mysql_query("SELECT * from tbl_truck_report WHERE wheels='6' and series NOT LIKE '%FORWARD%' and class not like '%HE%'  and status=''") or die (mysql_error());
$elf_num = mysql_num_rows($elf);

$forward= mysql_query("SELECT * from tbl_truck_report WHERE wheels='6' and series LIKE '%FORWARD%' and class not like '%HE%' and status=''") or die (mysql_error());
$forward_num = mysql_num_rows($forward);

$ten= mysql_query("SELECT * from tbl_truck_report WHERE wheels='10' and class not like '%HE%' and status=''") or die (mysql_error());
$ten_num = mysql_num_rows($ten);

$motor= mysql_query("SELECT * from tbl_truck_report WHERE wheels='2' and class not like '%HE%' and status=''") or die (mysql_error());
$motor_num = mysql_num_rows($motor);

$company= mysql_query("SELECT * from tbl_truck_report WHERE  class like '%COMPANY%' and class not like '%HE%' and status=''") or die (mysql_error());
$company_num = mysql_num_rows($company);

$he= mysql_query("SELECT * from tbl_truck_report WHERE class like '%HE%' and status=''") or die (mysql_error());
$he_num = mysql_num_rows($he);
$all_vec = $elf_num + $forward_num + $ten_num + $motor_num + $he_num;

?>
<center>

<table  style="border-collapse:collapse;" border="1px">
			<tr style="background-color:#2b2b2b; font-size:12px; color:#FFFFFF;">
				<td>SERVICE</td>
				<td>ELF</td>
				<td>FORWARD</td>
				<td>10 WHEELER</td>
				<td>MOTORCYCLE</td>
				<td>HEAVY EQPMNT</td>
			</tr>
			<tr>
				<td><?php echo $company_num;?></td>
				<td><?php echo $elf_num;?></td>
				<td><?php echo $forward_num;?></td>
				<td><?php echo $ten_num;?></td>
				<td><?php echo $motor_num;?></td>
				<td><?php echo $he_num;?></td>
			</tr>
</table>
</center>
<table width="100%" id="sum_table2" hidden="">
<tr align="right">
<td>
<br />
<?php 
include('connect_out.php');
$num2 = 0;
$branch_num2 = 0;
$branches = mysql_query("Select * from branches order by branch_name Asc") or die (mysql_error());
?>
<table  style="border-collapse:collapse;" border="1px" width="300px">
			<tr style="background-color:#2b2b2b; font-size:12px; color:#FFFFFF;">
				<td>BRANCH</td>
				<td>ASSIGN TO BRANCH</td>
				<td>GIVEN TO SUPPLIER</td>
				<td>VEHICLE PER BRANCH</td>
			</tr>
<?php while ($branches_row  = mysql_fetch_array($branches)){
		include('connect.php');
		$trucks = mysql_query("SELECT * from tbl_truck_report Where branch like '%".$branches_row['branch_name']."%' and class!='HE' and status=''") or die (mysql_error());
			while($row_trucks = mysql_fetch_array($trucks)){
					
					$trucks_branch= mysql_query("SELECT * from tbl_givento  Where truckid='".$row_trucks['id']."' and (suppliername = '1449' or suppliername = '1450' or suppliername = '1452' or suppliername = '1453'  or suppliername = '1454' or suppliername = '1455' or suppliername = '1456' or suppliername = '1458' or suppliername = '14025' or suppliername = '14066' or suppliername = '14317')") or die (mysql_error());
			
			$trucks_branch2= mysql_query("SELECT * from tbl_givento  Where truckid='".$row_trucks['id']."' and (suppliername != '1449' or suppliername != '1450' or suppliername != '1452' or suppliername != '1453'  or suppliername != '1454' or suppliername != '1455' or suppliername != '1456' or suppliername != '1458' or suppliername != '14025' or suppliername != '14066' or suppliername != '14317')") or die (mysql_error());
			if(mysql_num_rows($trucks_branch) > 0){
				@$branchs[$branches_row['branch_name']]++;
			}else if(mysql_num_rows($trucks_branch2) > 0){
				@$givens[$branches_row['branch_name']]++;
			}
			}
			@$tot_branch += $branchs[$branches_row['branch_name']]; 
			@$tot_gives += $givens[$branches_row['branch_name']]; 
			@$per_branch[$branches_row['branch_name']] += $branchs[$branches_row['branch_name']] + $givens[$branches_row['branch_name']];
			@$per_branchs+= $branchs[$branches_row['branch_name']] + $givens[$branches_row['branch_name']];
			 ?>
		 <tr>
				<td><?php echo $branches_row['branch_name'];?></td>
				<td><?php echo round(@$branchs[$branches_row['branch_name']]);?></td>
				<td><?php echo round(@$givens[$branches_row['branch_name']]);?></td>
				<td><?php echo round($per_branch[$branches_row['branch_name']]);?></td>
			</tr>		 
<?php }?>
	<tr style="background-color:#FFFF00;">
		<td>Total:</td>
		<td><?php echo $tot_branch;?></td>
		<td><?php echo $tot_gives;?></td>
		<td><?php echo $per_branchs;?></td>
	</tr>
	<tr>
		<td colspan="4" style="color:#FF0000; font-size:12.5px;" align="center">Note: Heavy Equiment and Truck with no Assign Supplier are not being Counted.</td>
	</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
     
<!---TALLY----------------------------------------------------->	



								<center>
					<form action="save_new_truck.php" method="post">
			<br /><br /><br />	
<table width="100%">
<tr>
<td>
	<table  class="data display datatable">    
	
		<thead>
			<tr class="data">
			<th class="data">Branch</th>
			<th class="data">Owner's Name</th>
			<th class="data">Supplier Name</th>
			<th class="data">Plate Number</th>
			<th class="data">Make</th>
			<th class="data">Series</th>
			<th class="data">Body Type</th>
			<th class="data">Year Model</th>
			<th class="data">Acquisition Cost</th>
			<th class="data">Net Book Value</th>
			<th class="data">Selling Price</th>
			<th class="data">Vehicle Condition</th>	
			<th class="data">Action</th>	
		</tr>
		</thead>
 <?php


	while($row=mysql_fetch_array($result))
  
	{
	$class = ($count%2 == 1)?'even':'odd';
		$count++;
		
		
		$css = 'mytd2';
?>

<style>
.mytd2{
	background-color:#ffff;
}
.mytd2:hover{
	background-color:#d3e9ff;
}
	</style>

                                              
                                              
 
		<tr class="data">
				<form method="post" >
					<input type="hidden" value="<?php echo $row['id']; ?>">
				</form>
			<td class="data"><?php echo strtoupper($row['branch']); ?></font></td>
			<td class="data"><?php echo strtoupper($row['ownersname']); ?></td>
            <td class="data"><?php 
			include("connect.php");
			$suppname = mysql_query("Select * from tbl_givento Where truckid='".$row['id']."'") or die(mysql_error());
			$row_suppname = mysql_fetch_array($suppname);
			include("connect_out.php");
			$sql_supp = mysql_query("SELECT * from supplier_details WHERE supplier_id='".$row_suppname['suppliername']."'") or die (mysql_error());
			$supp_row = mysql_fetch_array($sql_supp);
			
			echo strtoupper($supp_row['supplier_id'].'_'.$supp_row['supplier_name']); ?></td>
			<td class="data"><font size="-2"><?php echo strtoupper($row['truckplate']); ?></td>
            <td class="data"><font size="-2"><?php echo strtoupper($row['make']); ?></td>
            <td class="data"><font size="-2"><?php echo strtoupper($row['series']); ?></td>
            <td class="data"><font size="-2"><?php echo strtoupper($row['bodytype']); ?></td>
            <td class="data"><font size="-2"><?php echo strtoupper($row['yearmodel']); ?></td>
			<td class="data"><font size="-2"><?php echo strtoupper($row['aquisitioncost']); ?></td>
			<td class="data"><center><font size="-2">---</font></center></td>
			<td class="data"><font size="-2"><?php echo strtoupper($row['amount']); ?></td>
			<td class="data"><font size="-2"><?php echo strtoupper($row['truckcondition']); ?></td>
			
			
			
			<td align="center"><center><?php echo '<a href="profile.php?id='.$row['id'].'&page=existing">' ?><input type="button" value="Profile"/></a><?php echo '<a href="edit_truck.php?id='.$row['id'].'&page=existing">' ?><input type="button" value="View"/></a>	<?php echo '<a href="truck_details.php?id='.$row['id'].'&page=existing">' ?><input type="button" value="Images"/></a> </center></td>
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
			</div>
</center>
<?php include('layout/footer.php');?>
</body>
</html>

