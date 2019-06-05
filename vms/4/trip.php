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
   <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
	<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
	<script src="js/setup.js" type="text/javascript"></script>
	<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
	</script>
	<link href="css/select2.min.css" rel="stylesheet">
	<link href="css/tables.css" rel="stylesheet">

</head>
<body>
<html>
<script type="text/javascript" src="js/jquery.min.js"></script>

 </script>
<?php include('layout/header.php'); include("css/drop_down.php"); include("connect.php"); ?>
<center>
			<div id="body">

<table id="page1"><tr><td align="left">Trip Schedule<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<br /><br /><br /><br />


<form action="trip_bef.php" method="post" name="trip">



<table  width="650px">
<tr>
<td>
<span id="sup_picker">
Plate No.
<select name="plate" id="plate" required>
<option value="" selected="selected" disabled="disabled">Please Select</option>
<?php
$query=mysql_query("Select * from tbl_truck_report") or die (mysql_error());
while($row = mysql_fetch_array($query)){
	$select_pending = mysql_query("Select * from tbl_reassign Where truckid='".$row['id']."'") or die(mysql_error());
	if(mysql_num_rows($select_pending) > 0){}else{
	?>

    <option value="<?php echo $row['truckplate'];?>"><?php echo $row['truckplate'];?></option><?php
	}}
?>
</select>

</span>
</div>
</td>
<td>
<?php
$timezone=+8;
$date= gmdate('F',time() + 3600*($timezone+date("I")));
$dates= gmdate('m',time() + 3600*($timezone+date("I")));

?>

Month & Year:<input type="month" name="month" id="text" required/>
</td>
<td width="15%" align="right"><input value="Proceed" type="submit" name="submit"  id="button"onclick="return val_trip();"></form></td>
</tr>
</table>
<br /><br /><br />
<!--<input type="button" value="Update All Encoded Trip Schedule" onclick="submits();"> --->
<br /><br />

<?php //endtofcode===========================================================================?>
<br /><br />
</div>
</center>
<?php include('layout/footer.php');?>
</body>
</html> 