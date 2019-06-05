<?php
include('connect.php');
$select = mysql_query("Select * from tbl_truckimage Where id='".$_GET['id']."'") or die (mysql_error());
$row = mysql_fetch_array($select);
$name= $row['name'];
?>
<script>
function prints(){
	window.print() ;
	}
</script>
<img src="../trucks/<?php echo $name;?>" height="100%" width="100%" onLoad="prints()" />