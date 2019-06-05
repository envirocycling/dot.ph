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

<form id="frm" action="add_selecttool.php?id=<?php echo $_GET['id'];?>" method="post">
<table align="center" width="50%" >

<tr><td>
</td>
</tr>
</table>
<table width="30%"  align="center">
<tr>
<td>Item Name:</td>
<td width="70%"><input style="width:100%" type="text" name="tool" id="text" required="required"></td>
</tr>
<input style="width:100%" type="hidden" name="remarks" value=" ">
</tr>
<tr>
<td>Quantity:</td>
<td><input type="number" name="qty" style="width:30%" id="text" min="1" ></td>
</tr>
<tr>
<td colspan="2" align="right"><input type="submit" id="button" value="Submit" /></td>
</tr>
</table>


</form>

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
<td width="10%" align="center" colspan="2">Action</td>
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
	   <td><a onClick="window.open('update_tools.php?id=<?php echo $vrow['ti'];?>','','height=200px, width=300px, top=200px, left=500px')"><input type="button" value="Update"></a></td>
        <form action="maintenance_remove.php?ti=<?php echo $vrow['ti'];?>" method="post">
        <td>
        <input type="hidden" name="toolname" value="<?php echo $vrow['toolname'];?>">
        <input type="hidden" name="id" value="<?php echo $del;?>">
        <input type="hidden" name="ti" value="<?php echo $vrow['ti'];?>">
        <input type="submit" value="Remove" onClick="return confirm('Do you want to Remove?');">
   
        </td>
        
        </form>
     </tr>

	<?php }

?>


</table>
</td>
</tr>
   </table>  
  
 
 