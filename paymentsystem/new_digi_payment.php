<?php
date_default_timezone_set("Asia/Singapore");
include("configPhp.php");

$myDate = $_POST['date'];
	
$array_digi = array();
$sql_digi = mysql_query("SELECT * from payment WHERE date='$myDate' and  status LIKE '%generated%' and branch_code NOT LIKE '%Pampanga%' ORDER BY branch_code Asc") or die (mysql_error());
	while( $row_digi = mysql_fetch_array($sql_digi) ){
		$arr_branch = explode("-", $row_digi['branch_code']);
		$branch = strtoupper($arr_branch[0]);
		$arr_branch2[$branch] += $row_digi['grand_total'];
		
		/*$sql_count = mysql_query("SELECT * from payment WHERE date='$myDate' and  status LIKE '%generated%' and branch_code LIKE '%$branch%'") or die (mysql_error());
		$row_nums = mysql_num_rows($sql_count);
			while($row_count = mysql_fetch_array($sql_count)){
			$row_count2 = explode("-", $row_count['branch_code']);
			$branch2 = strtoupper($row_count2[0]);
				$arr_branch2[$branch2] += $row_count['grand_total'];
			}*/
		
		/*echo $array_val = $branch.'+'.$row_nums.'+'.$arr_branch2[$branch].'-<br>';
		
	 	array_push($array_digi,$array_val); */
	}
?>

	<?php
		$sql_branch = mysql_query("SELECT * from branches WHERE branch_id!='7' and branch_id!='10'") or die(mysql_error());
			while($row_branch = mysql_fetch_array($sql_branch)){
				$sql_count = mysql_query("SELECT * from payment WHERE date='$myDate' and  status LIKE '%generated%' and branch_code LIKE '%".$row_branch['branch_name']."%'") or die(mysql_error()); 
				$myBranch = strtoupper($row_branch['branch_name']);
				$row_nums = mysql_num_rows($sql_count);
				$array_val = $myBranch.'-'.$row_nums.'-'.$arr_branch2[$myBranch];
				array_push($array_digi,$array_val);
			}
		//	$ctr = 1;
	echo '<form action="http://192.168.10.200/paymentsystem/user-login/ic/digi_payment.php" method="post" name="myForm">';
		echo '<input type="hidden" value="'.$myDate.'" name="myDate">';
		foreach($array_digi as $val){
			$branch1 = explode("-",$val);
			$branch = strtoupper($branch1[0]);
			echo '<input type="hidden" value="'.$val.'" name="'.$branch.'">';
			echo '<input type="hidden" value="1" name="pro">';
			//$ctr++;
		}
			//echo '<input type="text" name="ctr" value="'.$ctr.'">';
	echo '</form>';
	?>
<br /><br /><br />
<center><h1>Please Wait 5 to 15 minuets</h1><br /><br /><img src="images/slack-opt.gif" width="50%" height="250px"></center>
<script>
	document.myForm.submit();
</script>
