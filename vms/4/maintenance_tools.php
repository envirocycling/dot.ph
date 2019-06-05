 <?php
 include('connect.php');
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


<center>
 <?php
if(is_numeric($_GET['id'])){
$qplate = mysql_query("Select * from tbl_truck_report Where id='".$_GET['id']."'") or die (mysql_error());
$d_row = mysql_fetch_array($qplate);
$del = $d_row['truckplate'];
}else{
	$qplate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
	$del = $_GET['id'];
	}
$rplate = mysql_fetch_array($qplate);
?>
<center>
<br />


 <br />
<table  width="80%" align="center" >
            <tr>
              <td align="center" colspan="2"><h4>Inclusive Items</h4></td>
           
			</tr>
            </table>
            <table width="65%" align="center"><tr><td>

<table   class="CSSTableGenerator" >
<tr>
<td align="center">Tool Name</td>
<td width="10%" align="center">Quantity</td>
<td width="25%" align="center">Date Added</td>
</tr>

<?php
$view = mysql_query("Select * from tbl_trucktools Where truckid='".$rplate['id']."' And sold=0") or die (mysql_error());
while($vrow = mysql_fetch_array($view)){
	?>
   
    <tr><td><?php echo $vrow['toolname'];?></td>
     <td align="center"><?php 
	 if($vrow['reassign'] == 0){
	 echo $vrow['qty'];} else if ($vrow['reassign'] >=1 ){ echo $vrow['reassign'];}?> 
     </td>
       <td><?php echo $vrow['dateadded'];?></td>
	  
       
     </tr>

	<?php }

?>


</table>
</td>
</tr>
   </table>  
  
 
 