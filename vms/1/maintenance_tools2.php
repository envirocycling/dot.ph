
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
<?php //=====================================================?>
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
?>
<title>EFI Vehicles Report</title>
<table  width="80%" align="center">
            <tr>
              <td align="center" colspan="2"><h4>Tools</h4></td>
              <td></td>
			</tr>
</table> 
<form action="add_selecttool.php?id=<?php echo $_GET['id'];?>" method="post" >
 <table width="60%"  align="center">
<tr>
<td>
Select Tool:
</td>
<td width="50%">
<input type="text" name="tool" required="required"></td>


 <br />

 </td>
 
 <input type="hidden" name="plate" value="<?php echo $rplate['truckplate'];?>">
 <input type="hidden" name="tool" value="<?php echo $_POST['tool'];?>">
<?php
$qtools = mysql_query("Select * from tbl_addinventorytool Where name='".$_POST['tool']."'") or die (mysql_error());
$row = mysql_fetch_array($qtools);
 $qty = $row['qty'];
 $issued = $row['issued'];
$remaining = $qty - $issued;
  ?>
<td>Quantity: <input style="width:15%" min="1"  value="1" type="number" name="qty" id="extra7" onKeyPress="return isNumber(event)" required></td>
<!---
<td>Available:
<?php /*/
$qtools = mysql_query("Select * from tbl_addinventorytool Where name='".$_POST['tool']."'") or die (mysql_error());
$row = mysql_fetch_array($qtools);
 $qty = $row['qty'];
 $issued = $row['issued'];
$remaining = $qty - $issued;
echo $remaining; /*/ ?>
</td>
--->
</tr>
</table>
<table align="center" width="50%">
<tr>
<td colspan="3" align="center">
<br />
 <input type="hidden" name="remaining" value="<?php echo $remaining;?>">
<input type="submit" name="add" value="ADD"> </td>
</form>

</tr>
</table>

<br />
<table  width="60%" align="center" >
            <tr>
              <td align="center" colspan="2"><h4>List of Tools</h4></td>
           
			</tr>
            </table>
             <table width="65%" align="center"><tr><td>
<table  width="30%" border="1px" align="center" class="CSSTableGenerator">
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
      <td><form action="p_remarks.php?id=<?php echo $del;?>" method="post"><textarea cols="15" rows="4" name="remarks" onKeyUp="caps(this)"><?php echo $vrow['remarks'];?></textarea></td>
       <input type="hidden" name="id" value="<?php echo $vrow['truckid'];?>">
      <input type="hidden" name="qty" value="<?php echo $vrow['qty'];?>">
     <input type="hidden" name="qty" value="<?php echo $vrow['dateadded'];?>">
         <input type="hidden" name="ti" value="<?php echo $vrow['ti'];?>">
        <td><input type="submit"  value="Update" ></form></td>
        <form action="maintenance_remove.php?ti=<?php echo $vrow['ti'];?>" method="post">
        <td>
           <input type="hidden" name="toolname" value="<?php echo $vrow['toolname'];?>">
        <input type="hidden" name="id" value="<?php echo $del;?>">
        <input type="submit" value="Remove"></td></form>
     </tr>


	<?php }
?>

</table>
</td>
</tr>
 </table>
