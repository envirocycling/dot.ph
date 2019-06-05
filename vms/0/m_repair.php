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
	<link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="js/facebox.js" type="text/javascript"></script>
	<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage: '../src/loading.gif',
            closeImage: '../src/closelabel.png'
        })
    })
</script>
	<link href="css/select2.min.css" rel="stylesheet" />
	<link href="css/table.css" rel="stylesheet">

</head>
<body>
<html>
<script type="text/javascript" src="js/jquery.min.js"></script>

 </script>
<?php include('layout/header.php');?>
<center>
			<div id="body">
			<table id="page1"><tr><td align="left">Maintenance: Repair<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<?php

include('connect.php');
$plate = mysql_query("Select * from tbl_truck_report Where id ='".$_GET['id']."'") or die(mysql_error());
$plate_row = mysql_fetch_array($plate);
?>
<br />
<br />
<center>
<table  width="70%">

<tr>
<td colspan="2">
<table class="CSSTableGenerator">
<tr>
<td>Date</td>
<td>Type of Work Done</td>
<td>Items</td>
<td>Repaired By</td>
<td>Remarks</td>
</tr>

<?php 
$oil = mysql_query("Select * from tbl_repair Where truckid='".$_GET['id']."' Order by date Desc") or die(mysql_error());
while($row = mysql_fetch_array($oil)){
	?>
    <tr>
    <td width="20%"><?php echo date('F d, Y,', strtotime($row['date']));?></td>
     <td><?php echo $row['type'];?></td>
       <td width="20%"><?php echo $row['items'];?></td>
    <td><?php echo $row['repairedby'];?></td>
    <td><?php echo $row['remarks'];?></td>
	</tr>    
    
    <?php
	}
?>

</table>
</td>
</tr>
</table>
</center>
   
<br />
<br />
</div>
</center>
<?php include('layout/footer.php');?>
</body>
</html>
