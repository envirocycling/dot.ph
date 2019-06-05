<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}
include('../title.php');
?>

<link href="../css/table.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../css/table2.css" media="screen" rel="stylesheet" type="text/css" />
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

   <li  class='active'><a href="existing_truck.php">Existing Vehicles</a></li>
      <li><a href='maintenance.php'>Maintenance</a></li>
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
				<td align="center" colspan="2"><h3>Existing Vehicles</h3></td>
				<td></td>
			</tr>
	</table>  	
<?php
include('connect.php');

$selected = mysql_query("Select * from tbl_reassign Where approved='0' and noti_llr='0' Order by id Asc")or die (mysql_error());
if(mysql_num_rows($selected) > 0){
	include('notification.php');
	}
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
			$query = "Select * from tbl_truck_report Where truckplate LIKE '%$search%' or branch LIKE '%$search%' or ownersname LIKE '%$search%' or make LIKE '%$search%' or series LIKE '%$search%' or bodytype LIKE '%$search%' or yearmodel LIKE '%$search%' or suppliername LIKE '%$search%' ORDER BY branch,ending ASC LIMIT $start,$records_per_page";
			}else {
		$query = "Select * from tbl_truck_report ORDER BY branch,ending ASC LIMIT $start,$records_per_page";
			}
		$result = mysql_query($query) or die(mysql_error());
		$count = 1;
?>
	<script>
    function show_table(){
		if (document.getElementById('show_tally').checked){
			document.getElementById('sum_table').hidden=false;
			}else{
				document.getElementById('sum_table').hidden=true;
				}
		}
    </script>
<table width="30%"  align="right" >
<tr>
<td align="right">Show Vehicle Tally<input type="checkbox" id="show_tally" onclick="show_table();"></td>
</tr>
<tr>
<td>
<table class="CSSTableGenerator2" id="sum_table" hidden="">  
<tr>
<td width="30%">Branch</td>
<td align="center">Vehicle Assign to Branch</td>
<td align="center">Vehicle Given to Supplier</td>
<td align="center">Total per Branch</td>
</tr>
<?php 
include('connect_out.php');
$num2 = 0;
$num = 0;
$branch_num2 = 0;
$branches = mysql_query("Select * from branches order by branch_name Asc") or die (mysql_error());
while ($branches_row  = mysql_fetch_array($branches)){
	include('connect.php');
	$trucks = mysql_query("SELECT * from tbl_truck_report Where branch like '%".$branches_row['branch_name']."%' and class!='HE'") or die (mysql_error());
		while($row_trucks = mysql_fetch_array($trucks)){
		
			$trucks_branch= mysql_query("SELECT * from tbl_givento  Where truckid='".$row_trucks['id']."' and (suppliername = '1449' or suppliername = '1450' or suppliername = '1452' or suppliername = '1453'  or suppliername = '1454' or suppliername = '1455' or suppliername = '1456' or suppliername = '1458' or suppliername = '14025' or suppliername = '14066' or suppliername = '14317')") or die (mysql_error());
			
			$trucks_branch2= mysql_query("SELECT * from tbl_givento  Where truckid='".$row_trucks['id']."' and (suppliername != '1449' or suppliername != '1450' or suppliername != '1452' or suppliername != '1453'  or suppliername != '1454' or suppliername != '1455' or suppliername != '1456' or suppliername != '1458' or suppliername != '14025' or suppliername != '14066' or suppliername != '14317')") or die (mysql_error());
			
			//$brnch = strtoupper($branches_row['branch_name']);
			if(mysql_num_rows($trucks_branch) > 0){
				$branchs[$branches_row['branch_name']]++;
			}else
			if(mysql_num_rows($trucks_branch2) > 0){
				$givens[$branches_row['branch_name']]++;
			}
			
		}
	
	$tot_branch += $branchs[$branches_row['branch_name']]; 
	$tot_gives += $givens[$branches_row['branch_name']]; 
	$per_branch += $branchs[$branches_row['branch_name']] + $givens[$branches_row['branch_name']];
	
/*
$given_branch = mysql_query("Select * from tbl_givento Where name='".$branches_row['branch_name']."' And (suppliername = '1449' or suppliername = '1450' or suppliername = '1452' or suppliername = '1453'  or suppliername = '1454' or suppliername = '1455' or suppliername = '1456' or suppliername = '1458' or suppliername = '14025' or suppliername = '14066' or suppliername = '14317')") or die(mysql_error());

$given_branch_num = mysql_num_rows($given_branch);
$givento  = mysql_query("Select * from tbl_givento Where name='".$branches_row['branch_name']."'") or die(mysql_error());
$givento_row = mysql_num_rows($givento);
$given_num = mysql_num_rows($given_supp);

$branch_num = $given_branch_num;
$num = $givento_row
*/
?>
<tr>
<td><?php echo $branches_row['branch_name'];?></td>
<td><?php echo round($branchs[$branches_row['branch_name']]);?></td>
<td><?php echo round($givens[$branches_row['branch_name']]);?></td>
<td><?php echo round($branchs[$branches_row['branch_name']] + $givens[$branches_row['branch_name']]);?></td>
</tr>
<?php

}
?>
<tr>
<?php 
$total_supp = $total_given - $total_branch;
?>
<td colspan="4"></td>
</tr>
<tr>
<td>TOTAL:</td>
<td><?php echo $tot_branch;?></td>
<td><?php echo $tot_gives;?></td>
<td><?php echo $per_branch;?></td>
</tr>
<tr>
	<td colspan="4"><center><font color="#FF0000" size="2">Note: Truck with no Assign Supplier is not being counted.</font></center></td>
</tr>
</table>
<td width="10%"></td>
</td>
</tr>
</table>
<?php 
$elf= mysql_query("SELECT * from tbl_truck_report WHERE wheels='6' and series NOT LIKE '%FORWARD%' and class not like '%HE%' ") or die (mysql_error());
$elf_num = mysql_num_rows($elf);

$forward= mysql_query("SELECT * from tbl_truck_report WHERE wheels='6' and series LIKE '%FORWARD%' and class not like '%HE%'") or die (mysql_error());
$forward_num = mysql_num_rows($forward);

$ten= mysql_query("SELECT * from tbl_truck_report WHERE wheels='10' and class not like '%HE%'") or die (mysql_error());
$ten_num = mysql_num_rows($ten);

$motor= mysql_query("SELECT * from tbl_truck_report WHERE wheels='2' and class not like '%HE%'") or die (mysql_error());
$motor_num = mysql_num_rows($motor);

$company= mysql_query("SELECT * from tbl_truck_report WHERE  class like '%COMPANY%' and class not like '%HE%'") or die (mysql_error());
$company_num = mysql_num_rows($company);

$he= mysql_query("SELECT * from tbl_truck_report WHERE class like '%HE%'") or die (mysql_error());
$he_num = mysql_num_rows($he);
$all_vec = $elf_num + $forward_num + $ten_num + $motor_num + $he_num;

?>

<table  style="position:absolute; left:400px;">
	<tr>
		<td>
			<table class="CSSTableGenerator2"> 
			<tr>
				<td>SERVICE</td>
				<td>ELF</td>
				<td>FORWARD</td>
				<td>10 WHEELER</td>
				<td>MOTORCYCLE</td>
				<td>HEAVY EQPMNT.</td>
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
		</td>
	</tr>
</table>
     <br /><br /><br /><br />
    <table width="95%" align="center">
    <tr>

    <form action="" target="_self" method="post">
    <td ><input name="submit" type="submit" value="Search">
    <?php if(isset($_POST['submit'])){?><input type="text" id="text" onKeyUp="caps(this)" name="search"  placeholder="Type Here" value="<?php echo $_POST['search'];?>"><?php } else {?>
    <input type="text" name="search" placeholder="Type Here" id="text" onKeyUp="caps(this)"><?php } ?>
    </form>  </td>
    </tr>
         </table>    
        <table width="95%" align="center"><tr><td>
	<table width="95%"  border="1px" align="center" class="CSSTableGenerator">    
	
		<tr>
			<td align="center">Branch</td>
			<td align="center">Owner's Name</td>
            <td align="center" width="25%">Supplier Name</td>
			<td align="center">Vehicle Plate</td>
           	<td align="center">Make</td>
            <td align="center">Series</td>
            <td align="center">Body Type</td>
            <td align="center">Year Model</td>
			<td align="center">Acquisition Cost</td>
			<td align="center">Net Book Value</td>
			<td align="center">Selling Price</td>
			<td align="center" width="35%">Vehicle Condition</td>
			<td align="center" colspan="5" >Action</td>
			
		</tr>	 
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

                                              
                                              
 
		<tr class="<?php echo $css;?>">
				<form method="post" >
					<input type="hidden" value="<?php echo $row['id']; ?>">
				</form>
			<td align="center"><font size="-2"><?php echo strtoupper($row['branch']); ?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row['ownersname']); ?></td>
            <td align="center"><font size="-2"><?php 
			$suppname = mysql_query("Select * from tbl_givento Where truckid='".$row['id']."'") or die(mysql_error());
			$row_suppname = mysql_fetch_array($suppname);
			
			include("connect_out.php");
			$sql_supp = mysql_query("SELECt * from supplier_details WHERE supplier_id='".$row_suppname['suppliername']."'") or die (mysql_error());
			$supp_row = mysql_fetch_array($sql_supp);
			echo strtoupper($supp_row['supplier_id'].'_'.$supp_row['supplier_name']); 
			include("connect.php");?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row['truckplate']); ?></td>
            <td align="center"><font size="-2"><?php echo strtoupper($row['make']); ?></td>
            <td align="center"><font size="-2"><?php echo strtoupper($row['series']); ?></td>
            <td align="center"><font size="-2"><?php echo strtoupper($row['bodytype']); ?></td>
            <td align="center"><font size="-2"><?php echo strtoupper($row['yearmodel']); ?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row['aquisitioncost']); ?></td>
			<td><font size="-2"><center>---</center></font></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row['amount']); ?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row['truckcondition']); ?></td>
			
			
			
			<td align="center"><?php echo '<a href="profile.php?id='.$row['id'].'">' ?><input type="button" value="Profile"/></a></td>
            <td align="center"><a  onclick="window.open('edit_truck.php?id=<?php echo $row['id'];?>','edittruck','height=600, width=450');" ><input type="button" value="View"/></a></td> 
<td align="center" >
			<?php echo '<a href="truck_details.php?id='.$row['id'].'">' ?><input type="button" value="Images"/></a> 
</td>
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
<img style="vertical-align: baseline" src="../image/footer.png" height="8%" width="100%">
