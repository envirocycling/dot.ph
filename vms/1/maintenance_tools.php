 <?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
?>
<title>EFI Vehicles Report</title>
  <link href="../css/tables.css" media="screen" rel="stylesheet" type="text/css" />
  <?php //facebox==========================================================================?>

<script src="../js/jquery.min.js" type="text/javascript"></script>
<link href="../css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../js/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage: '../src/loading.gif',
            closeImage: '../src/closelabel.png'
        })
    })
</script>
	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
<?php //=====================================================?>
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
}
</script>
<br />

  <?php 
include('connect.php');
if(is_numeric($_GET['id'])){
$qplate = mysql_query("Select * from tbl_truck_report Where id='".$_GET['id']."'") or die (mysql_error());
$d_row = mysql_fetch_array($qplate);
$del = $d_row['truckplate'];
}else{
	$qplate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
	$del = $_GET['id'];
	}
$rplate = mysql_fetch_array($qplate);
echo $del;
?>
<title>EFI Vehicles Report</title>
<table  width="80%" align="center">
		
            <tr>
              <td align="center" colspan="2"><h4>Tools</h4></td>
              <td></td>
			</tr>
</table> 

<form id="frm" action="add_selecttool.php?id=<?php echo $_GET['id'];?>" method="post">
<table align="center" width="50%" >

<tr><td>
</td>
</tr>
</table>
<table width="30%"  align="center">
<tr>
<td>Item Name:</td>
<td width="70%"><input style="width:100%" type="text" name="tool" onkeyup="caps(this)" required="required"></td>
</tr>
<td>Condition	:</td>
<td width="70%"><input style="width:100%" type="text" name="remarks" onkeyup="caps(this)" required="required"></td>
</tr>
<tr>
<td>Quantity:</td>
<td><input type="number" name="qty" style="width:30%" onKeyPress="return isNumber(event)" min="1" required></td>
</tr>
<tr>
<td colspan="2" align="right"><input type="submit" value="Submit" /></td>
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
<td width="25%" align="center">Remarks</td>
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
       <td><form action="p_remarks.php?id=<?php echo $del;?>" method="post"><textarea cols="15" rows="4" name="remarks" onKeyUp="caps(this)" required="required"><?php echo $vrow['remarks'];?></textarea></td>
       <input type="hidden" name="id" value="<?php echo $vrow['truckid'];?>">
      <input type="hidden" name="qty" value="<?php echo $vrow['qty'];?>">
     <input type="hidden" name="qty" value="<?php echo $vrow['dateadded'];?>">
         <input type="hidden" name="ti" value="<?php echo $vrow['ti'];?>">
        <td><input type="submit"  value="Update" ></form></td>
        <form action="maintenance_remove.php?ti=<?php echo $vrow['ti'];?>" method="post">
        <td>
        <input type="hidden" name="toolname" value="<?php echo $vrow['toolname'];?>">
        <input type="hidden" name="id" value="<?php echo $del;?>">
        <input type="submit" value="Remove" onclick="return confirm('Do you wabt to Remove?');"></td></form>
     </tr>


	<?php }
?>


</table>
</td>
</tr>
   </table>  
 