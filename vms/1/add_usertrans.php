
<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
	
include('connect.php');
$select = mysql_query("Select * from tbl_users Where Name='".$_POST['name']."'") or die(mysql_error());
if(mysql_num_rows($select) > 1){?>
<script>
alert("ERROR: User Name already Exist.");
window.history.back();
</script>

<?php }

else if ($_POST['type'] !=2) {
 mysql_query("Insert into tbl_users Set Name='".$_POST['name']."', username='".$_POST['username']."',password='".$_POST['password']."',type='".$_POST['type']."'") or die (mysql_error());
 ?>
 <script>
 alert("User added Successfully.");
 location.replace("otheraccount.php");
 </script>
 <?php
}else if ($_POST['type'] ==2) {
 mysql_query("Insert into tbl_users Set Name='".$_POST['name']."', username='".$_POST['username']."',password='".$_POST['password']."',type='".$_POST['type']."',branch = '".$_POST['branch']."'") or die (mysql_error());
 ?>
 <script>
 alert("User added Successfully.");
 location.replace("otheraccount.php");;
 </script>
 <?php
} 
?>