<?php
include('connect.php');
mysql_query("Delete from tbl_trip Where id='".$_GET['id']."'") or die(mysql_error()); 
?>
<script>
window.history.back();
</script>