<html>
<title>WP Inventory System</title>
<link rel="shortcut icon" type="image/x-icon" href="../images/icon/logo.png" />
	<body>
<?php
include("config.php");

$page = $_SERVER['PHP_SELF'];
		$sec = "200";
		header("Refresh: $sec; url=$page");
		
@$from = $_GET['from'];
@$to = $_GET['to'];
$insert = 0;

?>

<center>
	<div style="font-size:40px;font-weight:bold; color:#006600;">System is Updating</div>
	<div style="font-size:25px;font-weight:bold;">Supplier</div>
	<div><img src="../images/loading.gif"></div>
	<div style="font-size:25px;font-weight:bold; color:#FF0000;">Do not Close this Window</div>
</center>


<?php


if(!empty($_GET['up_supp'])){
	if(mysql_query("UPDATE supplier_details SET up_supp='1' WHERE  supplier_id='".$_GET['up_supp']."'") or die (mysql_error())){
		$insert = 1;
	}
}else{
//	if(mysql_query("UPDATE supplier_details SET up_supp='0' WHERE supplier_name !='' or supplier_name !=' '") or die (mysql_error())){
	if(mysql_query("UPDATE supplier_details SET up_supp='0' WHERE (supplier_name !='' or supplier_name !=' ') and (branch like '%Urdaneta%' or branch like '%Mangaldan%')") or die (mysql_error())){
		$insert = 1;
	}
}

		
		$sql_supp = mysql_query("SELECT * FROM supplier_details WHERE up_supp='0' and (supplier_name != '' or supplier_name != ' ')  and (branch like '%Urdaneta%' or branch like '%Mangaldan%') ORDER BY supplier_id DESC LIMIT 1") or die (mysql_error());
		$row_supp = mysql_fetch_array($sql_supp);
		if(mysql_num_rows($sql_supp) > 0){
		echo "<form action='http://192.168.8.100/wpis/user/iframe/update_supp.php' method='POST' name='myForm'>";	
			
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
			echo "<input type='hidden' name='date_added' value='".$row_supp['date_added']."'>";
		
		echo "</form>";
		echo "<script>document.myForm.submit();</script>";
	}



if(empty($row_supp['supplier_name']) || mysql_num_rows($sql_supp)==0){
	echo '<script>
			alert("Suppliers Updated Successful.");
			window.close();
		</script>';
}

?>
	</body>
</html>