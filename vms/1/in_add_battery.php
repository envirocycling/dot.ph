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
$id =$_GET['id'];
mysql_query(" Insert into tbl_battery (name,description) Values ('$name','$des')") or die (mysql_error());
?>
<script>
alert("Battery Added Successful.");
location.replace("inventory_battery.php?id=<?php echo $id;?>");
</script>