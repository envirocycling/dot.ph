<?php 
session_start();
if(!isset($_SESSION['encoder_username'])){
	header("Location: ../index.php");
	}

include('connect.php');

$id=$_GET['id'];

$month = explode('-',$_POST['date']);
	 $nums = $month[1] + 3;
	  
	if($nums > 12){
		$m =$month[0] + 1;
		$num = $nums - 12 ;
		}else{$num = $nums;
			$m = $month[0];}
			$mm = $month[2];
	  if($month[2] < 8){
	  $mm = $month[2] + 21;
	  $num = $num - 1;
	  		if($num == 0){
	  			$m = $m - 1;
	 		    $num = 12;
	  		}
	  }else { $mm = $month[2] - 7;}
	  if($mm < 10){
	  $mm = '0'.$mm;
	  }
	 if($num < 10){
		 $num1 = '0'.$num;
	 $date = $m.'-'.$num1.'-'.$mm;

		 }else{
		$date = $m.'-'.$num.'-'.$mm;
		 }

 $select = mysql_query("Select * from tbl_changeoil Where truckid='".$_GET['id']."'  Order by id Desc LIMIT 1 ") or die(mysql_error());
	   $rows = mysql_fetch_array($select);
	   if(mysql_num_rows($select) > 0){
		   mysql_query("Update tbl_changeoil Set tos='".$_POST['from']."' Where id='".$rows['id']."'") or die(mysql_error());
		   }
		
$oil = mysql_query("Insert into tbl_changeoil (truckid,date,performedby,remarks,froms)
Values('".$_GET['id']."','".$_POST['date']."','".$_POST['performedby']."','".$_POST['remarks']."','".$_POST['from']."')") or die(mysql_error());

$ch = mysql_query("Update tbl_changeoil Set changes='$date' Where truckid='".$_GET['id']."'") or die (mysql_error());
$select = mysql_query("Select * from tbl_changeoil Where truckid='$id' Order by date Desc LIMIT 1") or die (mysql_error());
$row = mysql_fetch_array($select);

if(mysql_num_rows($select) == 1){
$upadate = mysql_query("Update tbl_truck_report Set oil='".$row['date']."' Where id='".$_GET['id']."'") or die(mysql_error());
	}
?>
<script>
alert("Update Successful.");
location.replace("m_changeoil.php?id=<?php echo $id;?>");
</script>