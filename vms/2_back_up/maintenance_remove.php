
<?php
include('connect.php');


$delete =  mysql_query("Delete from tbl_trucktools Where ti = '".$_GET['ti']."'") or die (mysql_error());
 ?>
 <script>
 window.history.back();
 </script>
