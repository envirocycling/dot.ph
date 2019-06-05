<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}
include('../title.php');
?>

    <link rel="stylesheet" href="../css/tables.css">
 <?php
 include('connect.php');
 
$upda = mysql_query("UPDATE tbl_reassign SET noti_llr='1' Where approved='0' Order by id Asc")or die (mysql_error());
 ?>
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
function openwin(){
	 window.open("re_view.php?id=<?php echo $id?>","TH","width=500, height=500");
	}
</script>
<?php //=====================================================?>
<?php // auto submit if change==================================================================?>
<script>
function onSelectChange(){
 document.getElementById('frm').submit();
}</script>
<?php //disabledfileds=====-=-=--=-==-===---------------------------[?>
<script>
function active(){
  if(document.getElementById('checkbox').checked){
   ;
	      document.getElementById('pdate').disabled=false;
	 document.getElementById('adate').disabled=false;
	  document.getElementById('quantity').disabled=false;
	   document.getElementById('reassign').disabled=false;
	    document.getElementById('sold').disabled=false;

}else{
   
	   document.getElementById('pdate').disabled=true;
	   	   document.getElementById('adate').disabled=true;
	   	  document.getElementById('quantity').disabled=true;
	   document.getElementById('reassign').disabled=true;
	    document.getElementById('sold').disabled=true;
	   }
}</script>
<?php //======================================================================================?>

	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
 <?php // headermenu==============?>
    <link rel="stylesheet" href="../css/header2.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
   <img src="../image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   
   <li ><a href="existing_truck.php">Existing Vehicles</a></li>
      <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li  class='active'><a href="truck_reassign.php">Vehicle Reassignment</a></li>
      <li><a href='summary.php'>Summary</a></li>
       <li><a href='trip.php'>Trip Schedule</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
            
         <li><a href="logout.php">Logout</a></li>
</ul>
</div><br /> 
<?php //startofcode===========================================================================?>
<br />

		<table align="center">
			<tr>
				<td colspan="2"><h3>Truck Reassignment</h3></td>
                <td></td>
            </tr>
  </table>
 <center>

<br /><br />
<?php 

$select = mysql_query("Select * from tbl_reassign Where approved='0' Order by id Asc")or die (mysql_error());?>
<table width="60%"  align="center">
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
	$plate =mysql_query("Select * from tbl_truck_report Where id='".$rows['truckid']."' ") or die(mysql_error());
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
            
      <input type="submit" name="view" value="View" ></form></td>

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
        <input type="submit" value="Approve" onclick="return confirm('Do you want to Approve?');">

   <td >      <a href="cancel.php?id=<?php echo $rows['id'];?>"> <input type="button" value="Cancel" onclick="return confirm('Do you want to Cancel?');"></a></td></form>
   
    </tr>
	<?php }
?>
</table>
</td>
</tr>
</table>

<?php //endtofcode===========================================================================?>

<br /><br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<img src="../image/footer.png" height="8%" width="100%">     