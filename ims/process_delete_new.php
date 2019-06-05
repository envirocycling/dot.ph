<?php
/*
if (!isset($_SESSION['username'])) {
    echo "<script>
window.location = 'index.php';
</script>";
}*/
include 'config.php';
$id = $_GET['id'];
$tbl = $_GET['tbl'];
if($tbl=='users'){
	if(mysql_query("Delete from $tbl WHERE user_id='$id'")){
	echo '<script>
			alert("Successful.");
			window.history.back();
		</script>';
		}
}else if($tbl=='sup_deliveries'){
	if(mysql_query("Delete from $tbl WHERE del_id='$id'")){
	echo '<script>
			alert("Successful.");
			window.history.back();
		</script>';
		}
}else if(mysql_query("Delete from $tbl WHERE log_id='$id'")){
	echo '<script>
			alert("Successful.");
			window.history.back();
		</script>';
}

?>