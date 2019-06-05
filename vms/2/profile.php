 <?php
 include('connect.php');
 ?>
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
   <script>
   	function iframe(){
		document.getElementById('iframe').hidden = false;
	}
   </script>
</head>
<body>
<html>

<?php include('layout/header.php');?>

<center>
<div id="body">
<table id="page1"><tr><td align="left">Existing Vehicles : Profile<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<br />

<form action="maintenance_before.php" method="post" target="tire" onSubmit="iframe();"> 
<br /><br />

<?php
include('connect.php');
$profile_plate = mysql_query("Select * from tbl_truck_report Where id ='".$_GET['id']."'") or die(mysql_error());
$profile_plate_row = mysql_fetch_array($profile_plate);

$repair = mysql_query("Select * from tbl_forrepair Where truckid='".$_GET['id']."'") or die(mysql_error());
?>
<input type="hidden" name="plate" value="<?php echo $profile_plate_row['truckplate'];?>">
<font size="+1"><b>Plate:  &nbsp;<?php echo $profile_plate_row['truckplate'];?></b></font>
    <select name="maintain" id="text" required>
<?php	if(isset($_POST['filter'])){
		?><option value="<?php echo $_POST['maintain'];?>"><?php echo $_POST['maintain'];?></option>
		<?php
		 } ?>
          <option value="" disabled="disabled" selected="selected">SELECT</option>
    <option value="TOOLS">TOOLS</option>
	<option value="TIRE">TIRE</option>
    <option value="BATTERY">BATTERY</option>
   <?php if(mysql_num_rows($repair) > 0 ){?>
     <option value="FOR REPAIR">FOR REPAIR</option>
     <?php } ?>
    </select>
    <input type="submit" id="button" value="Filter" name="filter">
</form>

<center>
<br /><br /><br />
<iframe frameborder="0%" scrolling="auto" name="tire" height="560px" width="100%" align="middle" hidden id="iframe"></iframe>
</center>
</div>

<?php include('layout/footer.php');?>
</center>
</body>
</html>
  