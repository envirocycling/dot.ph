<?php
include('../config.php');
 $id = $_GET['id'];
	
	if(mysql_query("DELETE from tbl_deleted_data WHERE id='$id'")){
		?>
		<script>
			alert("Data Deleted Permanently.");
			window.history.back();
		</script>
		<?php
	}else{
	?>
		<script>
			alert("System Error.");
			window.history.back();
		</script>
	<?php
	}
?>