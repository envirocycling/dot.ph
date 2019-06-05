<?php
include('connect.php');
$same = mysql_query("Select * from tbl_addinventorytool Where name='".$_POST['tools']."'") or die (mysql_error());
$srow = mysql_fetch_array($same);

if(empty($_POST['tools'])){
	header("Location: inventory.php");
	exit;
	}
	if(($_POST['tools']) == $srow['name']){
	?>
	<script>
    alert("Tool Already Added.");
	location.replace("inventory.php");
    </script>
	<?php
	exit;
	}
 $timezone=+8;
	 $date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));
 mysql_query("Insert into tbl_addinventorytool (name,qty,dateencode) Values('".$_POST['tools']."','".$_POST['qty']."','$date')") or die(mysql_error());
 header("Location: inventory.php");
?>
