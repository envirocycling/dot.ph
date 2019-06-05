  	<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}

?>
 <title>EFI Vehicles Report</title>
  <link href="../css/table.css" media="screen" rel="stylesheet" type="text/css" />
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
 <?php
 include('connect.php');
 $plate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
 $plate_row = mysql_fetch_array($plate); 
 ?><center>
    <table width="98%">  
    <tr>
    <td>
    <table class="CSSTableGenerator">
    <tr>
    <td>Date</td>
    <td>Supllier</td>
    <td>Location</td>
    <td colspan="3" width="25%">Diesel</td>
    <td>Driver</td>
    <td>Helper</td>
    <td>Remarks</td>
 	<td colspan="2" width="8%">Action</td>
    </tr>
    <?php
    $select  = mysql_query("Select * from tbl_trip Where truckid ='".$plate_row['id']."' order by date Asc") or die(mysql_error());
	while($row = mysql_fetch_array($select)){
		?>
		<tr>
        <td><?php echo $row['date'];?></td>
        <td><?php echo $row['supplier'];?></td>
        <td><?php echo $row['location'];?></td>
        <td>Cm:
      <?php
		$num1 = $row['beg'];
		$num2 = $row['end'];
		?> <input type="text" style="width:100%" value="<?php echo ' '.$num = $num1 - $num2;?>" /></td>
        <td>Lit:<?php
	 $c = $row['out1'].'.'.$row['out2'];
		$d = $c;
		$nums = $num * $d;
		
		?><input type="text" style="width:100%" value="<?php echo ' '.$nums;?>" /></td>
         <td>Peso/s:<?php
		 $cost = $row['diesel'];
  	 	?><input type="text" style="width:100%" value="<?php echo ' '.$diesel = $nums * $cost;?>" readonly="readonly" /></td>
          <td><?php echo $row['driver'];?></td>
            <td><?php echo $row['helper'];?></td>
              <td><?php echo $row['remarks'];?></td>
                <td><a href="trip_edit.php?id=<?php echo $row['id'];?>" rel="facebox"><input type="button" value="Edit"></a></td>
                <td><a href="trip_delete.php?id=<?php echo  $row['id'];?>"><input type="button" onclick="return confirm('Do you want to delete?');" value="Delete"></a></td>
        </tr>
		<?php
        }
	?>
    </table>
    </td>
    </tr>
    </table>
   </center>