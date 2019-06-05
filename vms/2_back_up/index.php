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


<?php include('layout/header.php'); include('connect.php');
$num = 0;
$selected = mysql_query("Select * from tbl_reassign Where  noti_rec='0' and suppliername='".$_SESSION['owner']."' and approved='1' Order by id Asc")or die (mysql_error());
$selecteds = mysql_query("Select * from tbl_reassign Where approved='0' and noti_send='0' and name = '".$_SESSION['owner']."' Order by id Asc")or die (mysql_error());

$selectedss = mysql_query("Select * from tbl_contract Where status LIKE 'pending%' and branch_noti='0' Order by id Asc")or die (mysql_error());
    while($row_contract = mysql_fetch_array($selectedss)){
        $sql_truck = mysql_query("SELECT * from tbl_truck_report WHERE branch LIKE '".$_SESSION['owner']."' and id = '".$row_contract['truck_id']."'") or die(mysql_error());
                if(mysql_num_rows($sql_truck) > 0){
                   $num++;
                }
    }

if(mysql_num_rows($selected) > 0){
	include('notification_re.php');
	}
if(mysql_num_rows($selecteds) > 0){
	include('notification_sen.php');
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

<?php  include('layout/footer.php');?>
</center>
</body>
</html>


