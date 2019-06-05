 <?php
	 
include('connect.php');
$id = $_GET['id'];
$plate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
$row = mysql_fetch_array($plate);
$timezone=+8;
	 $date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));

$same = mysql_query("Select * from tbl_trucktools Where toolname='".$_POST['tool']."' And truckid='".$row['truckplate']."'") or die (mysql_error());
$rsame = mysql_fetch_array($same);

$issued_old= mysql_query("Select * from tbl_addinventorytool Where name='".$_POST['tool']."' ") or die (mysql_error());
$rissued_old = mysql_fetch_array($issued_old);
if($_POST['tool'] == $rsame['toolname']){
	?>
    <script>
alert("Tool Already Exist.");
location.replace("maintenance_tools.php?id=<?php echo $id;?>");
</script>
    <?php
	}else{


$num2 = $_POST['qty'];
$num1 = $_POST['remaining'];
$issued =$_POST['qty'] + $rissued_old['issued'] ;
$remaining = $num1 - $num2;
if($remaining == 0){
	$update = mysql_query("Update tbl_addinventorytool Set zero='1' Where name='".$_POST['tool']."'")or die (mysql_error());
	}
	
$go = mysql_query("Insert into tbl_trucktools (truckid,toolname,dateadded,qty) Values('".$row['truckplate']."','".$_POST['tool']."','$date','".$_POST['qty']."')") or die (mysql_error());
 mysql_query("Update tbl_addinventorytool Set available='$remaining', issued='$issued' Where name='".$_POST['tool']."'") or die (mysql_error());
header("Location: maintenance_tools.php?id=$id");
	}
?>