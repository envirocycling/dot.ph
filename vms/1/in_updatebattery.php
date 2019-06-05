<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
$name = $_POST['name'];
$des = $_POST['des'];
$issued = $_POST['issued'];
$remaining = $des - $issued;

mysql_query("Update tbl_addbattery Set name='$name', qty='$des', available='$remaining' Where id='".$_GET['id']."'") or die(mysql_error());
?>
<script>
alert("Tool Updated Successful.");
location.replace("inventory_battery.php?id=BATTERY");
</script>