<!doctype html>
<html lang=''>
<head>
	<title>Vehicle Management System</title>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <script src="js/header.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
</head>
<body>
<html>

<?php include('layout/header.php');include('../connect.php');
$num = 0;
$num2 = 0;
$selectedss = mysql_query("Select * from tbl_contract Where status LIKE 'approved%' and 3_noti='0' Order by id Asc")or die (mysql_error());
    while($row_contract = mysql_fetch_array($selectedss)){
        $sql_truck = mysql_query("SELECT * from tbl_truck_report WHERE id = '".$row_contract['truck_id']."'") or die(mysql_error());
                if(mysql_num_rows($sql_truck) > 0){
                   $num++;
                }
    }
 $selecteds = mysql_query("Select * from tbl_contract Where status LIKE 'pending%' and 3_noti='0' Order by id Asc")or die (mysql_error());
    while($row_contract = mysql_fetch_array($selecteds)){
        $sql_truck = mysql_query("SELECT * from tbl_truck_report WHERE id = '".$row_contract['truck_id']."'") or die(mysql_error());
                if(mysql_num_rows($sql_truck) > 0){
                   $num2++;
                }
    }
    if($num2 > 0){
        include('notification_contract_pending.php');
    }
    if($num > 0){
        include('notification_contract.php');
    }
?>

<center>
			<div id="body">
			<br/>
				<table id="page2"><tr><td align="left"><td></td></table>
				<br/><br/>
					<img src="../EFI BANNER.jpg" width="100%" height="100%">
					<br><br/><br/>
				<table id="page"><tr><td align="left"><td></td></table><br/>
			</div>

<?php include('layout/footer.php');?>
</center>
</body>
</html>


