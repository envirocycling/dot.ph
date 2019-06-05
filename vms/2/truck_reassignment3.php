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
<?php include('layout/header.php'); include("connect.php");?>
<center>
			<div id="body">
			<table id="page1"><tr><td align="left">Reassignment<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<br />

<?php //startofcode===========================================================================?>
<br />


 <center>
 <table width="68%">
 <tr>
 <td align="center" colspan="3">
 <form   action="truck_reassign_submit1.php?p=<?php echo $_GET['p'];?>" method="post">
 Permanent<input type="radio" value="Permanent" name="status" required="required">
 &nbsp;&nbsp;&nbsp;&nbsp;
 Repair<input type="radio" value="For Repair" name="status"></td>
 </tr>

<tr>
<?php $select_id = mysql_query("Select * from tbl_truck_report Where truckplate='".$_POST['plate']."'") or die(mysql_error());
$row_id = mysql_fetch_array($select_id);
?>

<td >
  <input type="hidden" name="plate" value="<?php echo $row_id['id'];?>">

</tr>
<tr>
<tr><td><br /></td></tr>
<td>Plate No.<input  type="text"  value="<?php echo $_GET['p'];?>" name="plate"  disabled="disabled" id="button">
<input  type="hidden"  value="<?php echo $_GET['p'];?>" name="plate"  ></td>



         <td align="center">Sending Branch:<?php
	$given = mysql_query("Select * from tbl_truck_report Where truckplate='".@$_GET['p']."'") or die(mysql_error());
	$givenrow = mysql_fetch_array($given);
	$given_name = $givenrow['id'];
	$select = mysql_query("Select * from tbl_givento Where truckid='$given_name'") or die (mysql_error());
	$select_row = mysql_fetch_array($select);
	?><input type="text" value="<?php 	echo $givenrow['branch'];?>"  disabled="disabled" id="button">
    <input type="hidden" name="old_suppname" value="<?php 	echo $givenrow['branch'];?>"  >
    

   
    </td>
<td  align="left">Receiving Branch: <input type="text"  value="<?php echo $_POST['rec_branch'];?>" id="button" disabled>
<input type="hidden" name="suppliername" value="<?php echo $_POST['rec_branch'];?>" >

</td>
</tr>
</table><br /><br />
<?php

$givento = mysql_query ("SELECT * FROM tbl_givento Where truckid='".$select_row['id']."'");
$given_row = mysql_fetch_array($givento);
$timezone=+8;
	 $date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));

?>
<table>
<tr>
<td align="center" colspan="3"><font size="+1" style="text-decoration:underline">Inssuance Date: <?php echo date('F d, Y', strtotime($date));?></font></td>
</tr>
</table>
<br />
<br />
<center>
<table width="30%" align="center">
   	    <tr>
    <td align="center" colspan="3" width="30%"><h3>Inclusive Items</h3></td>
    </tr>
    <tr>
    <td>
   <table  class="CSSTableGenerator" >
    <tr>
    <td>Item</td>
    <td>Quantity</td>
    <td>Remarks</td>
    </tr>
 
<?php 
$plate  = mysql_query("Select * from tbl_truck_report Where truckplate = '".$_POST['plate']."'")  or die (mysql_error());
$plate_row = mysql_fetch_array($plate);
$tools = mysql_query("Select * from tbl_trucktools Where truckid = '".$plate_row['id']."' ")  or die (mysql_error());
while($tools_row =mysql_fetch_array($tools)){?>
	   <tr>
    <td><?php echo $tools_row['toolname'];?></td>
    <td><?php echo $tools_row['qty'];?></td>
    <td><?php echo $tools_row['toolname'];?></td>
    </tr>
	<?php }
?>

  </table>
  </td>
  </tr>
  </table>
  </center>
  <br />
<br />
<center>
<table align="center">
<tr>
<td colspan="5" rowspan="2"><br />Remarks:<br/><center><textarea name="remarks" cols="50" rows="5" id="text" onKeyUp="caps(this)"></textarea></center></td>
<tr>
<td><br /><br /></td>
</tr>
<tr>
</tr>

<tr>
<td><br /><br /></td>
</tr>
<tr><td colspan="2">
<script>
function back(){
	window.history.back();
	}
</script>
<input type="hidden" name="date" value="<?php echo $date;?>"> 
<td  colspan="3" align="right">
<input type="submit" value="Submit" onclick="return confirm('Do you want to Submit?');" id="button"></form></td>
<td></td>
<td></td>
</tr>
</table>





</center>

</table>

<?php //endtofcode===========================================================================?>
</div>
</center>
<?php include('layout/footer.php');?>
</body>
</html>