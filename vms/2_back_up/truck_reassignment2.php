
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
	<link href="css/select2.min.css" rel="stylesheet">
	<link href="css/tables.css" rel="stylesheet">
	<script>
function onSelectChange(){
 document.getElementById('frm').submit();
}</script>

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

 <center>
 <table width="70%" >
 

<tr><td><br /></td></tr>
<tr>
<form id="frm" action="truck_reassignment3.php?p=<?php echo $_GET['p'].'&page=reassign';?>" method="post">
  <input type="hidden" name="plate" value="<?php echo $_POST['plate']?>">  </td>
<td>Plate No.<input  type="text"  value="<?php echo $_GET['p'];?>" id="text" disabled="disabled">
<input  type="hidden" name="plate" value="<?php echo $_GET['p'];?>" ></td>



      <?php
	$given = mysql_query("Select * from tbl_truck_report Where truckplate='".@$_GET['p']."'") or die(mysql_error());
	$givenrow = mysql_fetch_array($given);
	$given_name = $givenrow['id'];
	$select = mysql_query("Select * from tbl_givento Where truckid='$given_name'") or die (mysql_error());
	$select_row = mysql_fetch_array($select);
	?>
    <input type="hidden" name="suppname_old" value="<?php 	echo $select_row['suppliername'];?>" >
   

<td  align="left">Branch: <input type="text" name="branch" value="<?php echo $givenrow['branch'];?>" id="text" disabled="disabled">
			<input type="hidden" name="branch" value="<?php echo $givenrow['branch'];?>">
</td>


<?php

$givento = mysql_query ("SELECT * FROM tbl_givento Where truckid='".$select_row['id']."'");
$given_row = mysql_fetch_array($givento);

?>
</tr>
<tr>
<td colspan="3" align="center">
<br /><br />
Reassign To:  
   

  
  <select name="rec_branch"  onchange="onSelectChange();" id="text" required>
  <option value="" selected="selected" disabled="disabled">--Please Select--</option>
  <?php  
    include('connect.php');
  $user = mysql_query("Select * from tbl_users Where username='".$_SESSION['bhead_username']."' ") or die (mysql_error());
$user_row = mysql_fetch_array($user);
  include('connect_out.php');
													$branch =  mysql_query("Select * from branches Where branch_name!='".$user_row['branch']."' order by branch_name Asc") or die (mysql_error());
													while(	$branch_row = mysql_fetch_array($branch)){
														?>
                                                <option value="<?php echo strtoupper($branch_row['branch_name']);?>" onClick=""><?php echo strtoupper($branch_row['branch_name']);?></option>
														<?php }
													?>
                                                    </select>  </td>
                                                    </tr>
   <tr>
  </table>
 </div>
</center>
<?php include('layout/footer.php');?>
</body>
</html>