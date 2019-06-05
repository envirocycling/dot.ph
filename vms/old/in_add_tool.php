<?php
include('connect.php');
$name = $_POST['name'];
$des = $_POST['des'];

mysql_query(" Insert into tbl_tool (name,decription) Values ('$name','$des')") or die (mysql_error());
?>
<script>
alert("Tool Added Successful.");
location.replace("inventory.php");
</script>