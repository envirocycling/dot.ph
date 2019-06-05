<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
?>

<?php
include('connect.php');
$name = mysql_query("Select * from tbl_users Where username='".$_SESSION['a_username']."'") or die (mysql_error());
$rowname = mysql_fetch_array($name);
 $id = $_GET['p'];
 @$timezone=+8;
@$date= gmdate('Y-m-d',time() + 3600*($timezone+date("I")));
 mysql_query("Insert into tbl_trucktires (tireid,truckplate,tirename,tiresize,description,dateadded,addedby,status,position)
 Values ('11','".$_GET['p']."','".$_POST['tirename']."','".$_POST['tiresize']."','".$_POST['description']."','$date','".$rowname['name']."','Spare','11')") or die(mysql_error());
?>
<script>
alert("Tire Added Successful.");
location.replace("inventory_tire2.php");
</script>
