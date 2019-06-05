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
<?php include('layout/header.php');  ?>
<center>
			<div id="body">

<table id="page1"><tr><td align="left">Reassignment<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<br />

 <?php
 include('connect.php');
 	 mysql_query("UPDATE tbl_reassign SET noti_llr='1' Where approved='0' Order by id Asc")or die (mysql_error());
	

 ?>
<?php //startofcode===========================================================================?>
<?php 

$select = mysql_query("Select * from tbl_reassign Where approved='0' Order by id Asc")or die (mysql_error());?>
<table width="90%"  align="center">
<tr>
<td>
<?php if(mysql_num_rows($select) > 0){?>
<h5>Pending</h5><?php }else{?><h5>No Pending</h5><?php } ?>
<table  class="CSSTableGenerator">
<td >Sending Branch</td>
<td>Plate No.</td>
<td>Receiving Branch</td>
<td>Prepared By</td>
<td>Description</td>
<td colspan="3">Action</td>
</tr>
<?php 
while($rows = mysql_fetch_array($select)){
	$plate =mysql_query("Select * from tbl_truck_report Where id='".$rows['truckid']."' and status='' ") or die(mysql_error());
	$rowp = mysql_fetch_array($plate); 
	?>
    <tr>
        <td><?php echo $rowp['branch'];?></td>
    <td><?php echo $rowp['truckplate'];?></td>
    <td><?php echo $rows['suppliername'];?></td>
    <td ><?php echo $rows['preparedby']; ?></td>
    <td ><?php echo $rows['status']; ?></td>
  
        <td >
    <br />
     <form action="re_view.php?id=<?php echo $rows['id'];?>" method="post">
            
      <input type="submit" name="view" value="View Chat" ></form></td>

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
        <input type="submit" value="Approve" onClick="return confirm('Do you want to Approve?');">

   <td > <br />     <a href="cancel.php?id=<?php echo $rows['id'];?>"> <input type="button" value="Cancel" onClick="return confirm('Do you want to Cancel?');"></a></td></form>
   
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