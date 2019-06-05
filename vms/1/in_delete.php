<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
mysql_query("Delete from tbl_tool Where id='".$_GET['id']."'")or die(mysql_error());
?>
<script>
alert("Tool Deleted Successful.");
location.replace("inventory.php");
</script>