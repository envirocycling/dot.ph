<?php
session_start();
if(!isset($_SESSION['bhead_username'])){
	header("Location: ../index.php");
	}
?>
	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
<?php
include('connect.php');


$delete =  mysql_query("Delete from tbl_trucktools Where ti = '".$_GET['ti']."'") or die (mysql_error());
 ?>
 <script>
 window.history.back();
 </script>
