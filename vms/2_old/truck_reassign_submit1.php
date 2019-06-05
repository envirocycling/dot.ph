<?php
session_start();
if(!isset($_SESSION['bhead_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
$user = mysql_query("Select * from tbl_users Where username='".$_SESSION['bhead_username']."'") or die(mysql_error());
$user_row = mysql_fetch_array($user);

$truckplate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['p']."'") or die (mysql_error());
$row = mysql_fetch_array($truckplate);
@$_POST['old_suppname'];
@$suppliername =$_POST['new_suppname'];

 echo $_POST['new_branch'];
 echo $_POST['new_suppname'];


@$id=$_GET['p'];
@$prepared = $_POST['prepared'];
$plate= $_GET['p'];
$select = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['p']."'") or die(mysql_error());
$row_select = mysql_fetch_array($select);


$given = mysql_query("Insert into tbl_reassign (name,truckid,suppliername,issuancedate,preparedby,remarks,status) Values('".$_POST['old_suppname']."','".$row_select['id']."','".$_POST['suppliername']."','".$_POST['date']."','".$user_row['Name']."','".@$_POST['remarks']."','".$_POST['status']."')")or die(mysql_error());
header("Location: truck_reassign.php");

?>

