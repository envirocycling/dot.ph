<html>
  <head>
  <?php include('../title.php');?>
    <meta charset=utf-8 />

    <link rel="stylesheet" href="http://www.jacklmoore.com/colorbox/example1/colorbox.css" />
  </head>
  <body  >
  
<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

	?>

<link rel="stylesheet" href="http://www.jacklmoore.com/colorbox/example1/colorbox.css" />
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
    <link rel="stylesheet" href="../css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
<img src="../image/header.png" height="25%" width="100%">

	
<div id='cssmenu'  onLoad="openColorBox()">
<ul>

   <li><a href="new_truck.php">New Vehicle</a></li>
   <li ><a href="existing_truck.php">Existing Vehicles</a></li>
      <li  class='active'><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li><a href="truck_reassign.php">Vehicle Reassignment</a></li>
      <li><a href='summary.php'>Summary</a></li>
       <li><a href='trip.php'>Trip Schedule</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
            <li><a href='otheraccount.php'>Other Account</a></li>
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
			$query = "Select * from tbl_truck_report Where  oil LIKE '%$search%' or repair LIKE '%$search%' or truckplate LIKE '%$search%' or branch LIKE '%$search%' or suppliername LIKE '%$search%' or series LIKE '%$search%' or bodytype LIKE '%$search%' ORDER BY ending ASC LIMIT $start,$records_per_page";
						$query_oil = "Select * from tbl_changeoil Where date LIKE '%$search%'";
			}else {
		$query = "Select * from tbl_truck_report ORDER BY ending ASC LIMIT $start,$records_per_page";
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
<br /><br />
     
    <table width="70%" align="center">
    <tr>

    <form action="" target="_self" method="post">
    <td ><input name="submit" type="submit" value="Search">
    <?php if(isset($_POST['submit'])){?><input type="text" id="text" onKeyUp="caps(this)" name="search"  placeholder="Type Here" value="<?php echo $_POST['search'];?>"><?php } else {?>
    <input type="text" name="search" placeholder="Type Here" id="text" onKeyUp="caps(this)"><?php } ?>
    </form>  </td>
    </tr>
         </table>    
        <table width="950" align="center"><tr><td>
	<table width="95%"  border="1px" align="center" class="CSSTableGenerator">    
	
		<tr>
        	<td align="center" width="10%">Plate</td>
            <td align="center">Type</td>
			<td align="center">Branch</td>
            <td align="center" width="30%">Deployment</td>
           	<td align="center" colspan="2" width="20%">Change Oil</td>
            <td align="center" colspan="2" width="20%">Record of Repairs</td>			
		</tr>	 
 <?php

	$timezone=+8;
	 $date= gmdate('Y-m-d',time() + 3600*($timezone+date("I")));
	while($row=mysql_fetch_array($result))
  
	{
	$class = ($count%2 == 1)?'even':'odd';
		$count++;
  $oil = mysql_query("Select * from tbl_changeoil Where truckid='".$row['id']."' order by date Desc LIMIT 1") or die(mysql_error());
  $oil_row = mysql_fetch_array($oil);
    $repair = mysql_query("Select * from tbl_repair Where truckid='".$row['id']."' order by date Desc LIMIT 1") or die(mysql_error());
  $repair_row = mysql_fetch_array($repair);
  ?>
                                              
                                              
 
		<tr >
				<form method="post" >
					<input type="hidden" value="<?php echo $row['id']; ?>">
				</form>
                	<td align="center"><font size="-2"><?php echo strtoupper($row['truckplate']); ?></td>
                     <td align="center"><font size="-2"><?php echo strtoupper($row['series'])."<br ?>".strtoupper($row['bodytype']); ?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row['branch']); ?></td>
          
		
            <td align="center"><font size="-2"><?php 
			$suppname = mysql_query("Select * from tbl_givento Where truckid='".$row['id']."'") or die(mysql_error());
			$row_suppname = mysql_fetch_array($suppname);
			
			echo strtoupper($row_suppname['suppliername']); ?></td>
             
			
            <td align="center"><font size="-2"><?php echo $oil_row['date'];?></td>
            <td align="center" width="10%"><font size="-2"><a href="m_changeoil.php?id=<?php echo $row['id'];?>"><input type="button" value="View/Update"></a></td>
            <td align="center"><font size="-2"><?php echo $repair_row['date'];?></td>
            <td align="center" width="10%"><font size="-2"><a href="m_repair.php?id=<?php echo $row['id'];?>"><input type="button" value="View/Update"></a></td>
		</tr>




<?php
  }
$timezone=+8;
 $date= gmdate('Y-m-d',time() + 3600*($timezone+date("I")));
$select_date = mysql_query("Select * from tbl_changeoil Where changes <= '$date'") or die (mysql_error());
if(mysql_num_rows($select_date) > 0){ 
  ?>
     <link rel="stylesheet" href="css/pop.css" />
    <script src="js/pop1.js"></script>
    <script src="http://www.jacklmoore.com/colorbox/jquery.colorbox.js"></script>
    <script>
      function openColorBox(){
        $.colorbox({iframe:true, width:"45%", height:"50%", href: "need_changeoil.php"});
      }
      setTimeout(openColorBox, 0);
    </script>
<?php }?>
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
   

	</body>
    </html>