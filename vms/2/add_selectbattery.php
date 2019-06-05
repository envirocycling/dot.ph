<?php
session_start();
?>
 <?php
	 
include('connect.php');
$id = $_GET['id'];
$plate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
$row = mysql_fetch_array($plate);

$timezone=+8;
$date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));

$same = mysql_query("Select * from tbl_truckbattery Where batteryname='".$_POST['name']."' And truckid='".$row['id']."'") or die (mysql_error());
$rsame = mysql_fetch_array($same);

$issued_old= mysql_query("Select * from tbl_addbattery Where name='".$_POST['name']."' ") or die (mysql_error());
$rissued_old = mysql_fetch_array($issued_old);
if($_POST['name'] == $rsame['batteryname']){
	?>
    <script>
alert("Tool Already Exist.");
location.replace("maintenance_battery.php?id=<?php echo $id;?>");
</script>
    <?php
	}else{


@$num2 = $_POST['qty'];
@$num1 = $_POST['remaining'];
@$issued =$_POST['qty'] + $rissued_old['issued'] ;

	$name = mysql_query("Select * from tbl_users Where username='".$_SESSION['bhead_username']."'") or die (mysql_error());
$rowname = mysql_fetch_array($name);
$go = mysql_query("Insert into tbl_truckbattery (truckid,batteryname,description,dateadded,qty,addedby) Values('".$row['id']."','".$_POST['name']."','".$_POST['description']."','$date','".$_POST['qty']."','".$rowname['Name']."')") or die (mysql_error());

?>
    <script>
alert("Successful.");
location.replace("maintenance_battery.php?id=<?php echo $id; ?>");
</script>
    <?php
	}
?>