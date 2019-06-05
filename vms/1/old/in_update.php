<?php
include('connect.php');
$name = $_POST['name'];
$des = $_POST['des'];
$issued = $_POST['issued'];
$remaining = $des - $issued;
if($des > $_POST['old_qty']){
	mysql_query("Update tbl_addinventorytool Set zero=0 Where id='".$_GET['id']."'")or die (mysql_error());
	}
mysql_query("Update tbl_addinventorytool Set name='$name', qty='$des', available='$remaining' Where id='".$_GET['id']."'") or die(mysql_error());
?>
<script>
alert("Tool Updated Successful.");
location.replace("inventory.php");
</script>