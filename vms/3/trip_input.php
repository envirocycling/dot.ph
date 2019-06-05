<?php
include('connect.php');
$id = $_GET['id'];
$con = $_POST['out_1'].'.'.$_POST['out_2'];
mysql_query("Insert into tbl_input (truckid,con,month,year)
Values ('".$_POST['pno']."','$con','".$_POST['m']."','".$_POST['y']."')") or die(mysql_error());
?>
<script>
alert('Successful.');
location.replace('trip_new.php?id=<?php echo $id;?>');
</script>