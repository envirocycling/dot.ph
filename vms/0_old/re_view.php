<center>

<?php 
include('../title.php');
session_start();
if(!isset($_SESSION['username'])){
	header("Location:  ../index.php");
	}
include ('connect.php');
$assign = mysql_query("Select * from tbl_reassign Where id ='".$_GET['id']."'") or die(mysql_error()); 
$ass_row = mysql_fetch_array($assign);

$plate = mysql_query("Select * from tbl_truck_report Where id='".$ass_row['truckid']."'") or die (mysql_error());
$rows = mysql_fetch_array($plate);
?>
	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
		
	
		</script>


<?php //startofcode===========================================================================?>
<br />
<style>

.chat{
	width:80%;
	height:100%;	
	}

</style>
<form action="re_commentpro.php?id=<?php echo $_GET['id'];?>" method="post" >
<table  width="1000px">
<tr>
<td width="60%">
<table align="center">
			<tr>
				<td colspan="2"><h3>Truck Reassignment</h3></td>        
             
            </tr>
  </table>
  <td width="60%">
<table align="center" >
			<tr>
				<td colspan="2"><h3>Comment</h3></td>        
             
            </tr>
  </table>
  <tr>
  <td rowspan="2">
 <center>
 <iframe name="review" height="500px" width="100%" src="re_viewtarget.php?id=<?php echo $_GET['id'];?>"></iframe>
</td>
<td>
<iframe  name="chat" height="100%" width="100%" src="reassign_chat.php?id=<?php echo $_GET['id'];?>"></iframe>
</td>
</tr>
<?php

if(isset($_POST['submit'])){
	?>
    <script>
		function clears(){
			document.getElementById('txta').value=''
			}
			</script>
	<?php
	}
?>
<td style="height:20%;">
<textarea class="chat" id="txta" placeholder="Enter Comment Here" name="comment" onkeyup="caps(this)" required="required"></textarea>
<input  type="submit" name="submit" onclick="clears()"  value="Comment">
</td>
</table>
		
</form>




</center>

</table>
<center>
<a href="truck_reassign.php"><input type="button" value="BACK"></a>
<?php //endtofcode===========================================================================?>
</center>