<?php
include('connect.php');
$select = mysql_query("Select * from tbl_truckdeedofsale Where dosid='".$_GET['id']."'") or die (mysql_error());
$row = mysql_fetch_array($select);
$name= $row['location'];
?>
<script>
function prints(){
	window.print() ;
	}
</script>
<img src="../deedofsale/<?php echo $name;?>" height="100%" width="100%" onLoad="prints()" />