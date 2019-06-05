<?php
session_start();
if(!isset($_SESSION['bhead_username'])){
	header("Location: ../index.php");
	}

?>
 <?php
	 
include('connect.php');
$id = $_GET['id'];
$plate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
$row = mysql_fetch_array($plate);
$timezone=+8;
	 $date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));

$same = mysql_query("Select * from tbl_trucktools Where toolname='".$_POST['tool']."' And truckid='".$row['id']."'") or die (mysql_error());
$rsame = mysql_fetch_array($same);

$issued_old= mysql_query("Select * from tbl_addinventorytool Where name='".$_POST['tool']."' ") or die (mysql_error());
$rissued_old = mysql_fetch_array($issued_old);


if(mysql_num_rows($same) > 0){
	?>
    <script>
alert("Tool Already Exist.");
location.replace("maintenance_tools.php?id=<?php echo $id;?>");
</script>
    <?php
	}else{


@$num2 = $_POST['qty'];
@$num1 = $_POST['remaining'];
$issued =$_POST['qty'] + $rissued_old['issued'] ;
@$remaining = $num1 - $num2;


$go = mysql_query("Insert into tbl_trucktools (truckid,toolname,dateadded,qty,remarks) Values('".$row['id']."','".$_POST['tool']."','$date','".$_POST['qty']."','".$_POST['remarks']."')") or die (mysql_error());

 $gore = mysql_query("Insert into tbl_toolreassign (truckid,branch,suppname,toolname,dateadded,qty) Values('".$row['id']."','".$row['branch']."','".$row['suppliername']."','".$_POST['tool']."','$date','".$_POST['qty']."')") or die (mysql_error());
 mysql_query("Update tbl_addinventorytool Set available='$remaining', issued='$issued' Where name='".$_POST['tool']."'") or die (mysql_error());
?>
    <script>
location.replace("maintenance_tools.php?id=<?php echo $id;?>");
</script>
    <?php 

	}
?>