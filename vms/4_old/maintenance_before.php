<?php
session_start();
if(!isset($_SESSION['encoder_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
$id =$_POST['plate'];
$select = mysql_query("Select * from tbl_truck_report Where truckplate='".$_POST['plate']."'") or die (mysql_error());
$bodytype = mysql_query("Select * from tbl_truck_report Where bodytype LIKE '%motor%' And truckplate='".$_POST['plate']."' ") or die(mysql_error());
$wagon = mysql_query("Select * from tbl_truck_report Where bodytype LIKE '%wagon%' And truckplate='".$_POST['plate']."' ") or die(mysql_error());
$series = mysql_query("Select * from tbl_truck_report Where series LIKE '%mio%'  And truckplate='".$_POST['plate']."' ") or die(mysql_error());
$row = mysql_fetch_array($select);
 $_POST['maintain'];

if($_POST['maintain'] == 'TOOLS'){
	unset ($_SESSION['set']);
	header("Location: maintenance_tools.php?id=$id");
	}
else if($_POST['maintain'] == 'BATTERY'){
	unset ($_SESSION['set']);
	header("Location: maintenance_battery.php?id=$id");
	}
	
else if($_POST['maintain'] == 'TIRE'){
	isset ($_SESSION['set']);
		if($row['wheels'] == '6'){
				header("Location: maintenance_tire6.php?id=$id");}
	
		else if($row['wheels'] == '10'){
				header("Location: maintenance_tire.php?id=$id");}
 	
		else if($row['wheels'] == '4'){
	
					if(mysql_num_rows($wagon) > 0){
						header("Location: other.php?id=$id");}
		
					else { header("Location: maintenance_tire4.php?id=$id");}
			
		
		}else if($row['wheels'] == '2'){
					if(mysql_num_rows($bodytype) > 0){
						header("Location: motorcycle.php?id=$id");}
					else if(mysql_num_rows($series) > 0){
						header("Location: mio.php?id=$id");}
			}
	
} if($_POST['maintain'] == 'FOR REPAIR'){
	header("Location: maintenance_forrepair.php?id=$id");
	}
?>
