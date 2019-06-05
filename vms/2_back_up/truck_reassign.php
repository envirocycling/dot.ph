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
<?php include('layout/header.php'); include("css/drop_down.php"); ?>
<center>
			<div id="body">

<table id="page1"><tr><td align="left">Reassignment<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<br />

 <?php
 include('connect.php');
 	
	$chk_sen = mysql_query("SELECT * from tbl_reassign WHERE name='".$_SESSION['owner']."' ") or die (mysql_error());
	$chk_rec = mysql_query("SELECT * from tbl_reassign WHERE suppliername='".$_SESSION['owner']."' ") or die (mysql_error());
	
  	if(mysql_num_rows($chk_sen) > 0){
			mysql_query("UPDATE tbl_reassign SET noti_send='1' Where name='".$_SESSION['owner']."' ")or die (mysql_error());
	}
	if(mysql_num_rows($chk_rec) > 0){
		   mysql_query("UPDATE tbl_reassign SET noti_rec='1' Where  suppliername='".$_SESSION['owner']."' ")or die (mysql_error());
	}

 ?>
<?php //startofcode===========================================================================?>
<br />
<form action="b.php" method="post" id="frm">
 <center>
 <table width="100%" >
 


<tr align="center">
<td >
Plate No.
<select id="plate" name="plate" required>
	<option value="" disabled="disabled" selected="selected">Please Select</option>
<?php
$query=mysql_query("Select * from tbl_truck_report Where branch='".$_SESSION['owner']."' and status=''") or die (mysql_error());
while($row = mysql_fetch_array($query)){
	$select_pending = mysql_query("Select * from tbl_reassign Where truckid='".$row['id']."'  order by id Asc") or die(mysql_error());
	if(mysql_num_rows($select_pending) > 0){}else{
	?>

    <option value="<?php echo $row['truckplate'];?>"><?php echo $row['truckplate'];?></option><?php
	}}
?>
</select>
<input type="submit" value="Submit" id="button"></td>





</center>
</table>
</form>
<br /><br />
<?php 

$select = mysql_query("Select * from tbl_reassign Where name='".$_SESSION['owner']."' or suppliername='".$_SESSION['owner']."' Order by id Asc")or die (mysql_error());?>
<table width="80%"  align="center">
<tr>
<td>
<?php if(mysql_num_rows($select) > 0){?>
<h5>Pending</h5><?php 
}else{?><h5>No Pending</h5><?php } ?>
<table  class="CSSTableGenerator">
<td >Sending Branch</td>
<td>Plate No.</td>
<td>Receiving Branch</td>
<td>Prepared By</td>
<td>Description</td>
<td>Status</td>
<td colspan="3">Action</td>
</tr>
<?php 
while($rows = mysql_fetch_array($select)){
	$plate =mysql_query("Select * from tbl_truck_report Where id='".$rows['truckid']."' and status='' ") or die(mysql_error());
	$rowp = mysql_fetch_array($plate); 
	
	$status = 'Pending to GM';
	if($rows['approved'] == 1){
		$status = 'Approved by GM';
	}
	?>
    <tr>
        <td><?php echo $rowp['branch'];?></td>
    <td><?php echo $rowp['truckplate'];?></td>
    <td><?php echo $rows['suppliername'];?></td>
    <td ><?php echo $rows['preparedby']; ?></td>
    <td ><?php echo $rows['status']; ?></td>
	<td ><?php echo $status; ?></td>
  
        <td >
    <br />
            
     <a href="re_view.php?id=<?php echo $rows['id'];?>"><input type="button" name="view" value="View Chat"  /></a></td>
<?php	if($_SESSION['owner'] != $rows['name']){?>
        <td ><br />
                  <form action="re_approve.php?id=<?php echo $rows['id'];?>" method="post">
    <input type="hidden" name="plate" value="<?php echo $rowp['truckplate'];?>">
     <input type="hidden" name="id" value="<?php echo $rowp['id'];?>">
     <input type="hidden" name="sendingbranch" value="<?php echo $rowp['branch'];?>">
     <?php
     $given = mysql_query("Select * from tbl_givento Where truckid='".$rowp['id']."'") or die(mysql_error());
	 $given_row =mysql_fetch_array($given);
	 ?>
     <input type="hidden" name="branch2" value="<?php echo $given_row['name'];?>">
     <input type="hidden" name="truckid" value="<?php echo $given_row['truckid'];?>">
     <input type="hidden" name="suppliername2" value="<?php echo $given_row['suppliername'];?>">
     <input type="hidden" name="issuancedate2" value="<?php echo $given_row['issuancedate'];?>"
     <input type="hidden" name="enddate2" value="<?php echo $given_row['enddate'];?>">
     <input type="hidden" name="amortization2" value="<?php echo $given_row['amortization'];?>">
     <input type="hidden" name="cashbond2" value="<?php echo $given_row['cashbond'];?>">
     <input type="hidden" name="proposedvolume2" value="<?php echo $given_row['proposedvolume'];?>">
        
        
    <input type="hidden" name="branch" value="<?php echo $rows['suppliername'];?>">
       <input type="hidden" name="issuancedate" value="<?php echo $rows['issuancedate'];?>">
         <input type="hidden" name="enddate" value="<?php echo $rows['enddate'];?>">
           <input type="hidden" name="amortization" value="<?php echo $rows['amotization'];?>">
             <input type="hidden" name="cashbond" value="<?php echo $rows['cashbond'];?>">
               <input type="hidden" name="proposedvolume" value="<?php echo $rows['proposedvolume'];?>">
    <input type="hidden" name="preparedby" value="<?php echo $rows['preparedby'];?>">
    <input type="hidden" name="remarks" value="<?php echo $rows['remarks'];?>">   
        <?php 

		if($rows['approved'] == 1 ){?>
        <input type="submit" value="Accept" onClick="return confirm('Do you want to Accept?');">
        <?php }else {?>
		  <input type="submit" value="Accept" disabled="disabled">
		<?php }?></td>
		<?php }?>
   <td >      <br /><a href="cancel.php?id=<?php echo $rows['id'];?>"> <input type="button" value="Cancel" onClick="return confirm('Do you want to Cancel?');"></a></td></form>
   
    </tr>
	<?php }
?>
</table>
</td>
</tr>
</table>

<?php //endtofcode===========================================================================?>

</div>
</center>
<?php include('layout/footer.php');?>
</body>
</html>