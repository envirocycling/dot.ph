
<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
  <?php
include('connect.php');

$id = $_GET['id'];
echo $p=$_POST['plate'];
$new = mysql_query("Delete FROM tbl_truck_report WHERE id = '$id'"); 
$given = mysql_query("Delete FROM tbl_givento WHERE truckid = '$id'"); 
	  
	?><script type= "text/javascript">
	alert("Deleted Successful.");
	location.replace('existing_truck.php');
</script>



  

	  