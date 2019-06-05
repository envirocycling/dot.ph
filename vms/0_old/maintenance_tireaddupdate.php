<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
$bodytype = mysql_query("Select * from tbl_truck_report Where bodytype LIKE '%motor%' And id='".$_GET['p']."' ") or die(mysql_error());
$wagon = mysql_query("Select * from tbl_truck_report Where bodytype LIKE '%wagon%' And id='".$_GET['p']."' ") or die(mysql_error());
$series = mysql_query("Select * from tbl_truck_report Where series LIKE '%mio%'  And id='".$_GET['p']."' ") or die(mysql_error());
$name = mysql_query("Select * from tbl_users Where username='".$_SESSION['username']."'") or die (mysql_error());
$rowname = mysql_fetch_array($name);

$selects = mysql_query("Select * from tbl_truck_report Where id='".$_GET['p']."'") or die (mysql_error());
$rows = mysql_fetch_array($selects);
$select = mysql_query("Select * from tbl_trucktires Where truckplate='".$_GET['p']."' And tireid='".$_POST['tireid']."'") or die(mysql_error());
$row = mysql_fetch_array($select);
$id = $rows['truckplate'];

if($_POST['tireid'] == 11){
$status = 'Spare';}else{
$status = 'In Used';}
if($_POST['tireid'] == $row['tireid']){
	$update = mysql_query("Update tbl_trucktires Set tirename='".$_POST['tirename']."', tiresize ='".$_POST['tiresize']."', description ='".$_POST['description']."', dateadded='".$_POST['dateadded']."', addedby='".$rowname['Name']."' Where truckplate='".$_GET['p']."' And tireid='".$_POST['tireid']."'") or die(mysql_error());
	}else {
		
		
		$insert =  mysql_query("Insert into tbl_trucktires (tireid,truckplate,tirename,tiresize,description,dateadded,addedby,position,status)
		Values ('".$_POST['tireid']."','".$rows['id']."','".$_POST['tirename']."','".$_POST['tiresize']."','".$_POST['description']."','".$_POST['dateadded']."','".$rowname['Name']."','".$_POST['tireid']."','$status')") or die(mysql_error());
		}
if($rows['wheels'] == '6'){
	header("Location: maintenance_tire6.php?id=$id");}
	if($rows['wheels'] == '10'){
	header("Location: maintenance_tire.php?id=$id");}
	if($rows['wheels'] == '4'){
		if(mysql_num_rows($wagon) > 0){
	header("Location: other.php?id=$id");
			}else{
	header("Location: maintenance_tire4.php?id=$id");}}	
	if($rows['wheels'] = '2'){
		if(mysql_num_rows($bodytype) > 0){
			header("Location: motorcycle.php?id=$id");
			}else if(mysql_num_rows($series) > 0){
				header("Location: mio.php?id=$id");
				}
		}
?>