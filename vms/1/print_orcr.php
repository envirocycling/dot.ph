<?php
include('connect.php');
$select = mysql_query("Select * from tbl_truckorcr Where orcrid='".$_GET['id']."'") or die (mysql_error());
$row = mysql_fetch_array($select);
$name= $row['location'];
?>
<script>
function prints(){
	window.print() ;
	}
</script>
<img src="../orcr/<?php echo $name;?>" height="100%" width="100%" onLoad="prints()" />