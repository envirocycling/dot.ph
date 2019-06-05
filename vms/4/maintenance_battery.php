 <?php
 include('connect.php');
 session_start();
 ?>
<!doctype html>
<html lang=''>
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <script src="js/header.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
   <link href="css/tables.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
<html>

  <?php 
include('connect.php');
$qplate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
$rplate = mysql_fetch_array($qplate);
?>



<table  width="80%" align="center" >
            <tr>
              <td align="center" colspan="2"><h4>List of Battery</h4></td>
           
			</tr>
            </table>
            <table width="40%" align="center"><tr><td>

<table   class="CSSTableGenerator" >
<tr>
<td align="center">Battery    Name</td>
<td width="10%" align="center">Quantity</td>
<td width="25%" align="center">Date Added</td>
<td width="25%" align="center">Description</td>

</tr>

<?php
$view = mysql_query("Select * from tbl_truckbattery Where truckid='".$rplate['id']."'") or die (mysql_error());
while($vrow = mysql_fetch_array($view)){
	?>
   
    <tr><td><?php echo $vrow['batteryname'];?></td>
     <td align="center"><?php 
	 if($vrow['reassign'] == 0){
	 echo $vrow['qty'];} else if ($vrow['reassign'] >=1 ){ echo $vrow['reassign'];}?> 
     </td>
     <td><?php echo $vrow['dateadded'];?></td>
         <td><?php echo $vrow['description'];?></td>
   </tr>
	<?php }
?>


</table>
</td>
</tr>
   </table>  
