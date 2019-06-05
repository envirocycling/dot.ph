<?php 


include('connect.php');

mysql_query("Insert into tbl_repair (truckid,date,type,items,repairedby,remarks)
Values('".$_GET['id']."','".$_POST['date']."','".$_POST['type']."','".$_POST['items']."','".$_POST['repairedby']."','".$_POST['remarks']."')") or die(mysql_error());
$id=$_GET['id'];
?>
<script>
alert("Update Successful.");
window.history.back();
</script>