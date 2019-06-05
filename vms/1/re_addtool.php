
<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
 $p = $_GET['p'];
 $timezone=+8;
	 $date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));
	 $plate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['p']."'") or die (mysql_error());
$row = mysql_fetch_array($plate);
$name = $_POST['tool'];
$same = mysql_query("Select * from tbl_trucktools Where toolname='".$_POST['tool']."' And truckid='".$row['id']."'") or die (mysql_error());
$same2 = mysql_query("Select * from tbl_toolreassign Where toolname='".$_POST['tool']."' And truckid='".$row['id']."'") or die (mysql_error());


$select_addtool = mysql_query("Select * from tbl_addinventorytool Where name='".$_POST['tool']."'") or die (mysql_error());
$row_toolname = mysql_fetch_array($select_addtool);
 $num1 = $_POST['qty'];
if(empty($row_toolname['avialable'])){

 $available = $num1;}
 else {
	 
 $available = $num2 - $num1;}
 $available;
$row_toolname['available'];
 $qty =$row_toolname['qty'] - $num1;
if($available == 0){
	mysql_query("Update tbl_addinventorytool Set zero='1' Where name='".$_POST['name']."'") or die (mysql_error());
	}else
if(mysql_num_rows($same) > 0 || mysql_num_rows($same2) > 0){
	?>
    <script>
alert("Tool Already Exist.");
location.replace("truck_reassignment1.php?p=<?php echo $p;?>");
</script>
    <?php
	}else{
$update = mysql_query("Update tbl_addinventorytool Set available ='$available', qty='$qty' Where name='$name' ") or die (mysql_error());

 mysql_query("Insert into tbl_toolreassign (truckid,toolname,dateadded,qty)
  Values('".$row['id']."','$name','$date','".$_POST['qty']."')") or die(mysql_error());
	
	header("Location: truck_reassignment1.php?p=$p");
	}
?>
