<?php
include('connect.php');
$id= $_GET['id'];

$delete_tr = mysql_query("DELETE from tbl_truck_report WHERE id='$id'") or die(mysql_error());
$delete_ttools = mysql_query("DELETE from tbl_trucktools WHERE truckid='$id'") or die(mysql_error());
$delete_treg = mysql_query("DELETE from tbl_truckregistration WHERE truckid='$id'") or die(mysql_error());
$delete_torcr= mysql_query("DELETE from tbl_truckorcr WHERE truckid='$id'") or die(mysql_error());
$delete_tdeed= mysql_query("DELETE from tbl_truckdeedofsale WHERE truckid='$id'") or die(mysql_error());
$delete_gvto= mysql_query("DELETE from tbl_givento WHERE truckid='$id'") or die(mysql_error());

?>
<script>
alert("Successful");
location.replace("existing_truck.php");
</script>