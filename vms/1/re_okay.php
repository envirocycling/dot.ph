<?php
include('connect.php');
$update =mysql_query("Update tbl_reassign Set ok='1' Where id='".$_GET['id']."'") or die(mysql_error());
$select = mysql_query("Select * from tbl_reassign Where id='".$_GET['id']."'") or die (mysql_error());
$rows = mysql_fetch_array($select);
if($rows['approved'] == 0 ){
?>
<script>
alert("Please Wait for Approval of the Management. Before you can Accept.");
window.history.back();
</script>
<?php }else {
?>
<script>
alert("You may now Accept.");
window.history.back();
</script>
<?php }?>