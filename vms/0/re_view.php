	<!doctype html>
<html lang=''>
<head>
	<title>Vehicle Management System</title>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <script src="js/header.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
   <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
	<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
	<script src="js/setup.js" type="text/javascript"></script>
	<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
	</script>
	<link href="css/select2.min.css" rel="stylesheet">
	<link href="css/tables.css" rel="stylesheet">

</head>
<body>
<html>
<script type="text/javascript" src="js/jquery.min.js"></script>

 </script>
<?php include('layout/header.php');?>
<center>
			<div id="body">
			<table id="page1"><tr><td align="left">Reassignment : View<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<br />
<center>

<?php 
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
<style> #txta{text-transform:uppercase;}</style>
<td style="height:20%;">
<textarea class="chat" id="txta" placeholder="Enter Comment Here" name="comment"  required="required"></textarea>
<input  type="submit" name="submit" onClick="clears()"  value="Comment" id="button">
</td>
</table>
		
</form>




</center>

</table>
<br /><br />
</center>
</div>
</center>
<?php include('layout/footer.php');?>
</body>
</html>