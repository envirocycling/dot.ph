 <?php
session_start();
if(!isset($_SESSION['a_username'])){
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



$plate = mysql_query("Select * from tbl_truck_report Where truckplate = '".$_POST['id']."'") or die(mysql_error());
$rowplate = mysql_fetch_array($plate);
$id = $rowplate['truckplate'] ;
//$insert = mysql_query("Insert into tbl_history (truckid,name,reason,remarks)
//Values ('".$rowplate['id']."','".$_POST['tool']."','".$_POST['reason']."','T')") or die(mysql_error());	
$delete =  mysql_query("Delete from tbl_trucktools Where ti = '".$_GET['ti']."'") or die (mysql_error());;

 header("Location: maintenance_tools.php?id=$id");
/*/?>
<!--
<br />
<br />
<center>
<h3>Remove Tools</h3>
<h5><?php echo $_POST['toolname'];?></h5>
<form action="" target="_self" method="post">
<input type="hidden" name="id" value="<?php echo $_POST['id'];?>">
<input type="hidden" name="tool" value="<?php echo $_POST['toolname'];?>">
<table>
<tr>
<td>
Reason :</td> 
<td><textarea cols="20" rows="4" name="reason" required="required" onkeyup="caps(this)"></textarea></td>
<tr>
<td >
<br /><br /><a href="maintenance_tools.php?id=<?php echo $_POST['id'];?>"><input type="button" name="cancel" value="Cancel" /></td>
<td></td>
<td ><br /><br /><input type="submit" name="remove" value="Submit" /></td>
</tr>
</table>
</form></center>