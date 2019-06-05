<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>

<title>EFI Vehicles Report</title>
<head>
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

 <?php // headermenu==============?>
    <link rel="stylesheet" href="../css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
<?php //=====================================================?>
<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
        <link rel="stylesheet" href="../css/style.css"></head>
        
<img src="../image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Truck</a></li>
   <li class='active'><a href="existing_truck.php">Existing Trucks</a></li>
      <li><a href='maintenance.php'>Maintenance</a></li>
   <li><a href="registration_monitoring.php">Truck Registration</a></li>
     <li><a href="truck_reassign.php">Truck Reassignment</a></li>
      <li><a href='inventory.php'>Inventory</a></li>

        <li>|                |</li> 
        <li><a href='myaccount.php' rel='facebox'>MyAccount</a></li>
            <li><a href='otheraccount.php'>Other Account</a></li>
         <li><a href="logout.php">Logout</a></li>
</ul>
</div>
<center> <br />
<?php
include('connect.php');

		$query = "Select * from tbl_truck_report Where id='".$_GET['id']."' ";
		$result = mysql_query($query) or die(mysql_error());
	
?>
     <table  width="80%" align="center">
		<tr>
				<td align="center" colspan="2"><h3>Existing Vehicles</h3></td>
				<td></td>
			</tr>
				<td align="center" colspan="2"><h4>Details</h4></td>
				<td></td>
			</tr>
	</table>   
   
<?php //pictures=============================================================== ?>
<?php 	

		@$fname=$_FILES["fileToUpload"]["name"];
		$truck_pic = "Select * from tbl_truck_report Where id='".$_GET['id']."' ";
		$truck_result_pic = mysql_query($truck_pic) or die(mysql_error());
		
		 ?>
 <center>
 </center>         
<div id="slider">
  <a href="#" class="control_next">>></a>
  <a href="#" class="control_prev"><<</a>
  <ul>

  <?php while($tprow = mysql_fetch_array($truck_result_pic)){
	
	  if(!empty($tprow['finame']) && empty($tprow['siname'])){
	  ?> 
    <li> <a href="show_image.php?id=<?php echo $_GET['id'];?>" rel="facebox"><img src="../trucks/<?php echo $tprow['finame'] ?>" width="100%" height="100%"></a></li>
    <li> <a href="show_image.php?id=<?php echo $_GET['id'];?>" rel="facebox"><img src="../trucks/<?php echo $tprow['finame'] ?>" width="100%" height="100%"></a></li>
    <?php } if( !empty($tprow['siname']) && empty($tprow['tiname'])){
	  ?>
        
    <li> <a href="show_image.php?id=<?php echo $_GET['id'];?>" rel="facebox"><img src="../trucks/<?php echo $tprow['finame'] ?>" width="100%" height="100%"></a></li>
    <li> <a href="show_image.php?id=<?php echo $_GET['id'];?>" rel="facebox"><img src="../trucks/<?php echo $tprow['siname'] ?>" width="100%" height="100%"></a></li>
	<?php } else if(!empty($tprow['tiname']) ){
		
	  ?>

    <li> <a href="show_image.php?id=<?php echo $_GET['id'];?>" rel="facebox"><img src="../trucks/<?php echo $tprow['finame'] ?>" width="100%" height="100%"></a></li>
    <li> <a href="show_image.php?id=<?php echo $_GET['id'];?>" rel="facebox"><img src="../trucks/<?php echo $tprow['siname'] ?>" width="100%" height="100%"></a></li>
    <li> <a href="show_image.php?id=<?php echo $_GET['id'];?>" rel="facebox"><img src="../trucks/<?php echo $tprow['tiname'] ?>" width="100%" height="100%"></a></li>
	<?php } 
	
	?>
	
	<?php } 	?>
  </ul>  

</div>

	    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="../js/index.js"></script>
<center><br />


	 <?php
//upload==========================================================================
$refresh=$_GET['id'];
if(isset($_POST['submit'])){
	if($_POST['radio'] == "truck"){
@$target_dir = "../trucks/";
	}if($_POST['radio'] == "orcr"){
@$target_dir = "../orcr/";
	}if($_POST['radio'] == "deed"){
@$target_dir = "../tms/deedofsale/";
	}
@$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
@$uploadOk = 1;
@$imageFileType = pathinfo(@$target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    @$check = getimagesize(@$_FILES["fileToUpload"]["tmp_name"]);
    if(@$check !== false) {
		$id=$_POST['id'];
		$location = "t";
        
        @$uploadOk = 1;
		
    } else {
        echo "File is not an image.";
        @$uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists(@$target_file)) {
    echo "Sorry, file already exists.";
    @$uploadOk = 0;
}
// Check file size
if (@$_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    @$uploadOk = 0;
}
// Allow certain file formats
if(@$imageFileType != "jpg" && @$imageFileType != "png" && @$imageFileType != "jpeg"
&& @$imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    @$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if (@$uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file(@$_FILES["fileToUpload"]["tmp_name"], @$target_file)) {
		//truck
		$truck = "Select * from tbl_truck_report Where id='".$_GET['id']."' ";
		$truck_result = mysql_query($truck) or die(mysql_error());
		$trow = mysql_fetch_array($truck_result);
		 if($_POST['radio'] == 'truck' && empty($trow['finame'])){
		mysql_query("Update tbl_truck_report Set finame = '".@$_FILES["fileToUpload"]["name"]."' Where id='".$_POST['id']."' ");
		header("Location: truck_details.php?id=$refresh");
		}
		else if($_POST['radio'] == 'truck' && !empty($trow['finame']) && empty($trow['siname'])){
		mysql_query("Update tbl_truck_report Set siname = '".@$_FILES["fileToUpload"]["name"]."' Where id='".$_POST['id']."' ");
			header("Location: truck_details.php?id=$refresh");
		}else if($_POST['radio'] == 'truck' && !empty($trow['finame']) && !empty($trow['siname']) && empty($trow['tiname'])){
		mysql_query("Update tbl_truck_report Set tiname = '".@$_FILES["fileToUpload"]["name"]."' Where id='".$_POST['id']."' ");
			header("Location: truck_details.php?id=$refresh");
		}
			else if($_POST['radio'] == 'deed'){
		mysql_query("Update tbl_truckdeedofsale Set location = '".@$_FILES["fileToUpload"]["name"]."' Where truckid='".$_POST['id']."' ");
			header("Location: truck_details.php?id=$refresh");
		}
		else if($_POST['radio'] = 'orcr'){
		mysql_query("Update tbl_truckorcr Set location = '".@$_FILES["fileToUpload"]["name"]."' Where truckid='".$_POST['id']."' ");
			header("Location: truck_details.php?id=$refresh");
		}
	
        echo "The file ". basename( @$_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
//=================================================================================
?>
               
		
    <?php


include('connect.php');



$results = mysql_query ("SELECT * FROM tbl_truck_report WHERE id ='".$_GET['id']."' ");
$rows = mysql_fetch_array($results);

?>
<p />
<form action=" " target="_self" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $rows['id'];?>">
    <input type="file" accept="image/*" name="fileToUpload" id="fileToUpload" required />
    <input type="submit" value="Upload Image" name="submit"><p />
        <input type="radio" value="truck" name="radio" required>Truck
     <input type="radio" value="orcr" name="radio" required>OR/CR
      <input type="radio" value="deed" name="radio" required>DeedofSale
    
</form>


</center><br />

    <table width="40%" align="center">    
			
	 
 <?php
//table ==============================================================================================
//orcr====================================
		$orcr = "Select * from tbl_truck_report Where id='".$_GET['id']."' ";
		$result_orcr = mysql_query($orcr) or die(mysql_error());
		$orcrrow = mysql_fetch_array($result_orcr);
			
	while($row=mysql_fetch_array($result))
  
	{
	
  ?>
                                              
                                              
 
	
				<form method="post" >
					<input type="hidden" value="<?php echo $row['id']; ?>">
				</form>
			<tr><td align="right">BRANCH:<td><font size="+2"><?php echo strtoupper($row['branch']); ?></td></tr>
			<tr><td width="25%" align="right">OWNER's NAME:<td><font size="+2"><?php echo strtoupper($row['ownersname']); ?></td></tr>
			<tr><td align="right">TRUCK PLATE:<td><font size="+2"><?php echo strtoupper($row['truckplate']); ?></td></tr>
			<tr><td align="right">OR/CR:<td >
            <?php 
			$qorcr = mysql_query("Select * from tbl_truckorcr Where truckid = '".$_GET['id']."'") or die (mysql_error());
			$rrow = mysql_fetch_array($qorcr);
			if(!empty($rrow['location'])){
			?>
           <a rel="facebox" href="view_orcr.php?id=<?php echo $_GET['id'];?>"> <input type="button" value="View">
            <?php } else if(empty($rrow['location'])){
				echo "NONE";
				} ?>
            </td>
          </tr>
			<tr><td align="right">DEED OF SALE:<td>
             <?php 
			$qorcr = mysql_query("Select * from tbl_truckdeedofsale Where truckid = '".$_GET['id']."'") or die (mysql_error());
			$rrow = mysql_fetch_array($qorcr);
			if(!empty($rrow['location'])){
			?>
         <a rel="facebox" href="view_deed.php?id=<?php echo $_GET['id'];?>"> <input type="button" value="View">
            <?php } else if(empty($rrow['location'])){
				echo "NONE";
				} ?>
            </td></tr>
			</tr>
<?php

	}
  ?>

</table><br /><br />
<img src="../image/footer.png" height="8%" width="100%">
