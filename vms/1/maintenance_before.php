<?php
session_start();
if(!isset($_SESSION['bhead_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
echo $id =$_POST['plate'];
$select = mysql_query("Select * from tbl_truck_report Where truckplate='".$_POST['plate']."'") or die (mysql_error());
$bodytype = mysql_query("Select * from tbl_truck_report Where bodytype LIKE '%motor%' And truckplate='".$_POST['plate']."' ") or die(mysql_error());
$wagon = mysql_query("Select * from tbl_truck_report Where bodytype LIKE '%wagon%' And truckplate='".$_POST['plate']."' ") or die(mysql_error());
$series = mysql_query("Select * from tbl_truck_report Where series LIKE '%mio%'  And truckplate='".$_POST['plate']."' ") or die(mysql_error());
$row = mysql_fetch_array($select);
 $_POST['maintain'];

if($_POST['maintain'] == 'TOOLS'){
	unset ($_SESSION['set']);?>
    <script>
	location.replace("maintenance_tools.php?id=$id");
	</script>
	<?php
    }
else if($_POST['maintain'] == 'BATTERY'){
	unset ($_SESSION['set']);
	?>
    <script>
	location.replace("maintenance_battery.php?id=$id");
	</script>
	<?php
	}
	
else if($_POST['maintain'] == 'TIRE'){
	isset ($_SESSION['set']);
		if($row['wheels'] == '6'){
				?>
    <script>
	location.replace("maintenance_tire6.php?id=$id");
	</script>
	<?php
				}
	
		else if($row['wheels'] == '10'){
				
					?>
    <script>
	location.replace("maintenance_tire.php?id=$id");
	</script>
	<?php
				}
 	
		else if($row['wheels'] == '4'){
	
					if(mysql_num_rows($wagon) > 0){
						
				
						?>
    <script>
	location.replace("other.php?id=$id");
	</script>
	<?php
						}
		
					else {
					?>
    <script>
	location.replace("maintenance_tire4.php?id=$id");
	</script>
	<?php
			
					}
			
		
		}else if($row['wheels'] == '2'){
					if(mysql_num_rows($bodytype) > 0){
					
						?>
    <script>
	location.replace("motorcycle.php?id=$id");
	</script>
	<?php
						}
					else if(mysql_num_rows($series) > 0){
						
						?>
    <script>
	location.replace("mio.php?id=$id");
	</script>
	<?php
						}
			}
	
} if($_POST['maintain'] == 'FOR REPAIR'){
	?>
    <script>
	location.replace("maintenance_forrepair.php?id=$id");
	</script>
	<?php
		
	}
?>
