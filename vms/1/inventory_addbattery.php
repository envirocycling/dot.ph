<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
$id = $_GET['id'];
$same = mysql_query("Select * from tbl_addbattery Where name='".$_POST['battery']."'") or die (mysql_error());
$srow = mysql_fetch_array($same);

if(empty($_POST['battery'])){
	header("Location: inventory_battery.php");
	exit;
	}
	if(($_POST['battery']) == $srow['name']){
	?>
	<script>
    alert("Battery Already Added.");
	location.replace("inventory_battery.php?id=<?php echo $id;?>");
    </script>
	<?php
	exit;
	}
 $timezone=+8;
	 $date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));
 mysql_query("Insert into tbl_addbattery (name,qty) Values('".$_POST['battery']."','".$_POST['qty']."')") or die(mysql_error());
 header("Location: inventory_battery.php?id=$id");
?>
