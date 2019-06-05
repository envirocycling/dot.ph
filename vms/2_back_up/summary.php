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
   <link href="css/table.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
<html>

<?php include('layout/header.php');include('connect.php'); include("css/drop_down.php");?>

<center>
			<div id="body">
				<table id="page1"><tr><td align="left">Summary<td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
								<center>
<br /><br />
<form action="" method="post" target="_self">
View History: 
<select name="plate" id="summary" required>
<?php if(isset($_POST['submit'])){?><option value="<?php echo @$_POST['plate'];?>"><?php echo @$_POST['plate'];?></option>
<?php
}else{?>
<option value="" selected="selected" disabled="disabled">--PleaseSelect--</option>
<?php
}
$query=mysql_query("Select * from tbl_truck_report") or die (mysql_error());
while($row = mysql_fetch_array($query)){
?>

    <option value="<?php echo $row['truckplate'];?>"><?php echo $row['truckplate'];?></option><?php
	}
	$query2 = mysql_query("Select DISTINCT(driver) from tbl_trip") or die (mysql_error());
	while($row2 = mysql_fetch_array($query2)){
		?>

    <option value="<?php echo $row2['driver'];?>"><?php echo $row2['driver'];?></option><?php
		}
			$query3 = mysql_query("Select DISTINCT(helper) from tbl_trip") or die (mysql_error());
	while($row3 = mysql_fetch_array($query3)){
		?>

    <option value="<?php echo $row3['helper'];?>"><?php echo $row3['helper'];?></option><?php
		}
?>
</select>
</td>
<td><input value="View Summary" type="submit" name="submit" id="button"></form></td>
</tr>
</table>
<?php
if(isset($_POST['submit'])){
	$plate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_POST['plate']."'") or die (mysql_error());
	if(mysql_num_rows($plate) > 0){
?>
	<br />
    <br />
    <center>
    <table width="60% "> 
    <tr>
    <td>
	<table class="CSSTableGenerator">
    <tr>
    <td colspan="2">Date</td>
    <td >Plate</td>
    <td>Branch</td>
    <td>Remarks</td>
    <td>Description</td>
    </tr>
    <?php

	$rows = mysql_fetch_array($plate);
        $select = mysql_query("Select * from tbl_reassignmenthistory Where truckplate = '".$rows['id']."' Order by id Asc") or die(mysql_error());

        $sql_assign_supp = mysql_query("Select * from tbl_assigntosupp_history Where truckid = '".$rows['id']."' Order by id Asc") or die(mysql_error());
	
	$num = 1;
	while($row_his = mysql_fetch_array($select)){
		$num++;
		?>
       <tr>
       <td><?php echo $num;?></td>
        <td><?php echo date('F d, Y', strtotime($row_his['date_approved']));?></td>
       <td><?php echo $_POST['plate'];?></td>
       <td><?php echo $row_his['branch'];?></td>
       <td><?php echo strtoupper($row_his['remarks']);?></td>
       <td><?php echo $row_his['status'];?></td>
       </tr> 
        <?php
		}
        while($row_assign = mysql_fetch_array($sql_assign_supp)){ ?>
            <tr>
       <td><?php echo $num;?></td>
        <td><?php echo date('F d, Y', strtotime($row_his['date_submitted']));?></td>
       <td><?php echo $_POST['plate'];?></td>
       <td><?php echo $row_his['branch'];?></td>
       <td colspan="2"><?php echo strtoupper($row_his['description']);?></td>
       </tr> 
       <?php $num++;}
	 }else {?>
	 <br />
    <br />
    <iframe src="summary2.php?plate=<?php echo $_POST['plate'];?>" width="100%" height="600px" frameborder="0" name="summary"></iframe>
    <?php }?>
       </table>
    </td>
    </tr>
    </table>

<?php
}

?>

<!---end of select -->
   </center>
<?php //endtofcode===========================================================================?>
			</div>

<?php include('layout/footer.php');?>
</center>
</body>
</html>
