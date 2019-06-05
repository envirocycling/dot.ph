<?php
include('config.php');

mysql_query("UPDATE requests SET mecha_signature='RB' where request_id=".$_POST['request_number']."");
echo "<script>

alert('Submitted successfully...');
window.location = 'electric.php';
</script>";


?>