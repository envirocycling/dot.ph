 <?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
include('../title.php');
?>

  <link href="../css/tables.css" media="screen" rel="stylesheet" type="text/css" />
<?php // auto submit if change==================================================================?>
<script>
function onSelectChange(){
 document.getElementById('frm').submit();
}</script>
<?php // type numbers only==================================================================?>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
 
 	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>

  <?php 
include('connect.php');
$qplate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
$rplate = mysql_fetch_array($qplate);
?>
<title>EFI Vehicles Report</title>


<form  action="add_selectbattery.php?id=<?php echo $_GET['id'];?>" method="post">
<table align="center" width="50%" >

<tr><td>
</td>
</tr>
</table>
<table width="30%"  align="center">
<tr>
<td>Battery Name:</td>
<td><input type="text" name="name" onkeyup="caps(this)" required="required"></td>
</tr>
<tr>
<td>Description:</td>
<td><input type="text" name="description" onkeyup="caps(this)" required="required"></td>
</tr>
<tr>
<td>Quantity:</td>
<td><input style="width:30%" type="number" name="qty" onkeypress="return isNumber(event)" required="required" autocomplete="off"></td>
</tr>
<td colspan="2" align="right"><input type="submit"  value="Submit"></td>
</tr>
</table>
</form>
 <br />
<table  width="80%" align="center" >
            <tr>
              <td align="center" colspan="2"><h4>List of Battery</h4></td>
           
			</tr>
            </table>
            <table width="40%" align="center"><tr><td>

<table   class="CSSTableGenerator" >
<tr>
<td align="center">Tool Name</td>
<td width="10%" align="center">Quantity</td>
<td width="25%" align="center">Date Added</td>
<td width="25%" align="center">Description</td>
<td width="10%" align="center">Action</td>
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
      <form action="maintenance_removebat.php?id=<?php echo  $vrow['bid'];?>" method="post">
     <input type="hidden" name="qty" value="<?php echo $vrow['qty'];?>">
     <input type="hidden" name="qty" value="<?php echo $vrow['dateadded'];?>">
      <input type="hidden" name="id" value="<?php echo $vrow['bid'];?>">
     <td><input type="submit" value="Remove" onclick="return confirm('Do you want to Remove?');"></td>
     </tr>
</form>
	<?php }
?>


</table>
</td>
</tr>
   </table>  
