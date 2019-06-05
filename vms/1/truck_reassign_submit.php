<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');

$_POST['old_suppname'];
$suppliername =$_POST['new_suppname'];

 $_POST['new_branch'];
 $_POST['new_suppname'];
$truck_id = mysql_query("Select * from tbl_truck_report Where truckplate ='".$_GET['p']."'") or die (mysql_error());
$truck_row=mysql_fetch_array($truck_id);

 $id=$truck_row['id'];
$issuance = $_POST['issuancedate'];
$enddate = $_POST['enddate'];
$amortization = $_POST['amortization'];
$cashbond = $_POST['cashbond'];
$volume = $_POST['volume'];
$plate= $_GET['p'];


$given = mysql_query("UPDATE tbl_givento SET name='".$_POST['new_branch']."',suppliername='$suppliername', issuancedate='$issuance' , enddate='$enddate', amortization='$amortization', cashbond='$cashbond', proposedvolume='$volume' Where truckid='$id'")or die(mysql_error());



	$truck_ = mysql_query("Update tbl_truck_report  SET branch ='".$_POST['new_suppname']."', suppliername ='".strtoupper($_POST['new_branch'])."' Where id='$id'") or die (mysql_error());


$history=mysql_query("Insert into tbl_reassignmenthistory (truckplate,suppname,branch,issuancedate,enddate,amortization,cashbond,proposedvolume,prepared,remarks) 
Values('".$_GET['p']."','".$_POST['old_branch']."','".$_POST['new_suppname']."','$issuance','$enddate','$amortization','$cashbond','$volume','".$_POST['prepared']."','".@$_POST['remarks']."') ");



header("Location: truck_reassignment1.php?p=$plate");
?>

