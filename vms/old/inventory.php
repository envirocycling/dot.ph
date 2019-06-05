 <title>EFI Vehicles Report</title>
  <link href="css/table.css" media="screen" rel="stylesheet" type="text/css" />
 <?php
 include('connect.php');
 ?>
 <?php //======================================================================================?>
	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
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

<script src="js/jquery.min.js" type="text/javascript"></script>
<link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="js/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage: 'src/loading.gif',
            closeImage: 'src/closelabel.png'
        })
    })
</script>
<?php //=====================================================?>
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
    <link rel="stylesheet" href="css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="js/header.js"></script>
   <img src="image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Truck</a></li>
   <li  ><a href="existing_truck.php">Existing Trucks</a></li>
      <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Truck Registration</a></li>
     <li><a href="truck_reassign.php">Truck Reassignment</a></li>
      <li  class='active'><a href='inventory.php'>Inventory</a></li>

        <li>|                |</li> 
         <li><a href="registration_monitoring.php">Logout</a></li>
</ul>
</div><br /> 
<?php //startofcode===========================================================================?>
<br />

		<table align="center">
			<tr>
				<td colspan="2"><h3>Truck Inventory</h3></td>
                <td></td>
            </tr>
  </table>
  <br />

  <table align="center"  >
  <form action="in_add_tool.php"  method="post">
  <tr>
  <td valign="middle">Tool Name:<input type="text" name="name" id="text" onKeyUp="caps(this)" required></td>
  
  <td>Description:</td>
  <td valign="middle"><textarea name="des" cols="20" rows="2" id="text" onKeyUp="caps(this)"></textarea>
  </td>
    <td><input type="submit" value="Add New Tool"></td>
  </tr>
  </form>
  </table>
  <br />
    <table align="center"  >
  <form action="inventory_addtool.php"  method="post">

  <tr>
  <td valign="middle">Select Tool:<select name="tools" >
  <option value="">NONE</option>
		<?php 
		$tool = mysql_query("Select * from tbl_tool") or die (mysql_error());
		while($t_row = mysql_fetch_array($tool)){
			?>
             
       	<option value="<?php echo $t_row['name'];?>"><?php echo $t_row['name'];?></option>
		<?php
		}
		?></select></td>
  
  <td>Quantity:</td>
  <td valign="middle"><input type="text" name="qty" id="extra7" onKeyPress="return isNumber(event)" required="required">
  </td>
    <td><input type="submit" value="Add to Tool"></td>
  </tr>
  </form>
  </table>
  <br />
    <table width="40%" align="center"><tr><td>
<table align="center" width="60%" border="1px" class="CSSTableGenerator">
<tr>
<td  colspan="2"align="center">Tool Name</td>
<td align="center">Quantity</td>
<td align="center">Issued</td>
<td align="center">Available</td>
<td align="center" >Action</td>
</tr>
<form method="post">
<?php
$num=0;
$tool = mysql_query("Select * from tbl_addinventorytool") or die (mysql_error());
 while($row = mysql_fetch_array($tool)){

$num++;
?>
<tr>
<td width="3%"><?php echo $num?></td>
<td><?php echo $row['name'];?></td>
<td><?php echo $row['qty']; ?></td>
<td><?php echo $row['issued']; ?></td>
<td><?php $qty = $row['qty'];
$issued = $row['issued'];
$remaining = $qty - $issued;
echo $remaining; ?>
</td>
<td width="5%" align="center"><a rel="facebox" href="in_edittool.php?id=<?php echo $row['id'];?>"><input type="button" value="Edit"></a></td>
</tr>
<?php } ?>
</table>
</td></tr></table>

<?php //endtofcode===========================================================================?>
<br /><br />
<img src="image/footer.png" height="8%" width="100%">     