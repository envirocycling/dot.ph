<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
<?php
include('connect.php');
 $_POST['branch'];
 $_POST['suppname_old'];
 
 $p=$_POST['toolname'];
$plate = $_GET['p'];


 
 

$select = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['p']."'") or die(mysql_error());
$row_select = mysql_fetch_array($select);
$num = $_POST['sold'] + $_POST['reassign'];
$timezone=+8;
	 $date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));
	 	if($_POST['sold'] == $_POST['qty'] ){
 mysql_query("Delete from tbl_toolreassign Where truckid='$plate' And toolname='$p' ") or die(mysql_error());
	}

if($_POST['sold'] >=1 ){
 mysql_query("Insert into tbl_soldtools  (truckid,suppname,branch,toolname,qty,encodeby) 
 Values ('$plate','".$_POST['branch']."','".$_POST['suppname_old']."','$p','".$_POST['sold']."','') ") or die(mysql_error());
	}
	
else if($num != $_POST['qty']){
	?>
    <script>
    alert("Invalid Input.");
	location.replace("truck_reassignment1.php?p=<?php echo $plate;?>");
	</script>
    <?php
	}else{

 mysql_query("Update tbl_toolreassign Set branch='".$_POST['branch']."', suppname='".$_POST['suppname_old']."', reassign='".$_POST['reassign']."', sold='".$_POST['sold']."' Where toolname='$p' And truckid='".$row_select['id']."' ") or die(mysql_error());

header("Location: truck_reassignment1.php?p=$plate");
}
?>