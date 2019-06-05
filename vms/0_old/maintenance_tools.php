<?php
session_start();
if(!isset($_SESSION['username'])){
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
?>
<title>EFI Vehicles Report</title>
<table  width="80%" align="center">
		
            <tr>
              <td align="center" colspan="2"><h4>Tools</h4></td>
              <td></td>
			</tr>
</table> 
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
 