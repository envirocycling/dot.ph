<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}

?>
<title>EFI Vehicles Report</title>
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
