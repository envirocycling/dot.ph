<html>
<title>Update Supplier Cavite</title>
	<body>
<?php

include("config.php");

$insert = 0;
@$branch = $_GET['branch'];
$toDate = date('Y/m/d');
//$fromDate = date('Y/m/d', strtotime('-7 day', strtotime($toDate)));
$myBranch2 = $branch.'/';

?>

<?php

if(!empty($_GET['up_supp'])){
	$updated =  mysql_query("SELECT * from supplier_details WHERE  supplier_id='".$_GET['up_supp']."'") or die (mysql_error());
	$row_updated = mysql_fetch_array($updated);
	$myBranch = $row_updated['branch_update'].$myBranch2;
	mysql_query("UPDATE supplier_details SET branch_update='$myBranch' WHERE  supplier_id='".$_GET['up_supp']."'") or die (mysql_error());
}

	
		$sql_supp = mysql_query("SELECT * FROM supplier_details WHERE (date_added <= '$toDate' or date_updated <= '$toDate') and (supplier_name != '' or supplier_name != ' ') and branch_update NOT LIKE '%$branch%' ORDER BY supplier_id DESC LIMIT 1") or die (mysql_error());
		$row_supp = mysql_fetch_array($sql_supp);
		
		$sql_supp2 = mysql_query("SELECT * FROM supplier_details WHERE (date_added <= '$toDate' or date_updated <= '$toDate') and (supplier_name != '' or supplier_name != ' ') and branch_update NOT LIKE '%$branch%' ORDER BY supplier_id DESC LIMIT 1") or die (mysql_error());
	
	if(mysql_num_rows($sql_supp) > 0){
	
		
		echo "<form action='http://192.168.16.5/ts/update_supp.php' method='POST' name='myForm'>";	
					
			echo "<input type='hidden' name='supplier_id' value='".$row_supp['supplier_id']."'>";
			echo "<input type='hidden' name='supplier_name' value='".$row_supp['supplier_name']."'>";
			echo "<input type='hidden' name='classification' value='".$row_supp['classification']."'>";
			echo "<input type='hidden' name='branch' value='".$row_supp['branch']."'>";
			echo "<input type='hidden' name='address' value='".$row_supp['address']."'>";
			echo "<input type='hidden' name='street' value='".$row_supp['street']."'>";
			echo "<input type='hidden' name='municipality' value='".$row_supp['municipality']."'>";
			echo "<input type='hidden' name='province' value='".$row_supp['province']."'>";
			echo "<input type='hidden' name='owner' value='".$row_supp['owner']."'>";
			echo "<input type='hidden' name='owner_contact' value='".$row_supp['owner_contact']."'>";
			echo "<input type='hidden' name='plate_number' value='".$row_supp['plate_number']."'>";
			echo "<input type='hidden' name='plate_number' value='".$row_supp['plate_number']."'>";
			echo "<input type='hidden' name='bank' value='".$row_supp['bank']."'>";
			echo "<input type='hidden' name='account_name' value='".$row_supp['acct_name']."'>";
			echo "<input type='hidden' name='account_number' value='".$row_supp['acct_no']."'>";
			echo "<input type='hidden' name='date_added' value='".$row_supp['date_added']."'>";
		
		echo "</form>";
		echo "<script>document.myForm.submit();</script>";
	
	}else if(empty($row_supp['supplier_name']) || mysql_num_rows($sql_supp2) == 0){

	echo '<script>
			location.replace("http://192.168.16.5/ts/export_receiving_ims.php");
			</script>';
}else{
		$page = $_SERVER['PHP_SELF'];
		$sec = "10";
		header("Refresh: $sec; url=$page");
}

?>
	</body>
</html>