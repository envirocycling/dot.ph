<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
include('connect.php');
$selects = mysql_query("Select * from tbl_users Where Name='".$_POST['name']."' ") or die(mysql_error());
$selects1 = mysql_query("Select * from tbl_users Where  username='".$_POST['username']."'") or die(mysql_error());

$select = mysql_query("Select * from tbl_users Where id='".$_GET['id']."'") or die (mysql_error());
$row = mysql_fetch_array($select);

if($_POST['username']== $row['username'] && $_POST['name']== $row['Name'] && $_POST['type'] != 2){
	
	
			mysql_query("Update tbl_users Set Name = '".$_POST['name']."', username = '".$_POST['username']."', password='".$_POST['password']."', type='".$_POST['type']."', branch=' ' Where id='".$_GET['id']."'") or die(mysql_error());
			?>
			<script>
	alert("User Account Updated Successful.");
	location.replace("otheraccount.php");
	</script>
			<?php }else if($_POST['username']== $row['username'] && $_POST['name']== $row['Name'] && $_POST['type'] == 2){
	
	
			mysql_query("Update tbl_users Set Name = '".$_POST['name']."', username = '".$_POST['username']."', password='".$_POST['password']."', type='".$_POST['type']."',  branch='".$_POST['branch']."' Where id='".$_GET['id']."'") or die(mysql_error());
			?>
			<script>
	alert("User Account Updated Successful.");
	location.replace("otheraccount.php");
	</script>
			<?php  }
?>