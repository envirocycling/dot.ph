<!doctype html>
<html lang=''>
<head>
	<title>Vehicle Management System</title>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/slider.css">
   <script src="js/header.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
   <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
	<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
	<script src="js/setup.js" type="text/javascript"></script>
	 <script src="js/slider.js"></script>
	<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
	</script>
</head>
<body>
<html>

<?php include('layout/header.php');?>
<center>
			<div id="body">
<?php
include('connect.php');

		$query = "Select * from tbl_truck_report Where id='".$_GET['id']."' ";
		$result = mysql_query($query) or die(mysql_error());
	
?>
<table id="page1"><tr><td align="left">Existing Vehicles : Images<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<br /> 
   
<?php //pictures=============================================================== ?>
<?php 	

		@$fname=$_FILES["fileToUpload"]["name"];
		$truck_pic = mysql_query("Select * from tbl_truckimage Where truckid='".$_GET['id']."' ") or die (mysql_error());
		
		 ?>
 <center>
 </center>         
<div id="slider">
  <a href="#" class="control_next">>></a>
  <a href="#" class="control_prev"><<</a>
      <ul>

<?php  

 while($tprow = mysql_fetch_array($truck_pic)){
	 if(mysql_num_rows($truck_pic) == 1){?>
<li><img src="../trucks/<?php echo $tprow['name'] ?>" width="100%"  height="100%"></li>
<li><img src="../trucks/<?php echo $tprow['name'] ?>" width="100%"  height="100%"></li>
<?php	}
	 ?>

<li><img src="../trucks/<?php echo $tprow['name'] ?>" width="100%"  height="100%"></li>

	<?php } ?>

	  </ul>  
</div>

	    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="../js/index.js"></script>
<center><br />


	 <?php /*/
//upload==========================================================================
$refresh=$_GET['id'];
if(isset($_POST['submit'])){
	if($_POST['radio'] == "truck"){
@$target_dir = "../trucks/";
	}else if($_POST['radio'] == "orcr"){
@$target_dir = "../orcr/";
	}else if($_POST['radio'] == "deed"){
@$target_dir = "../deedofsale/";
	}
echo @$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
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
	
    if ( move_uploaded_file(@$_FILES["fileToUpload"]["tmp_name"],$target_file)) {
		//truck
		$truck = "Select * from tbl_truck_report Where id='".$_GET['id']."' ";
		$truck_result = mysql_query($truck) or die(mysql_error());
		$trow = mysql_fetch_array($truck_result);
		 if($_POST['radio'] == 'truck'){
		mysql_query("Insert into tbl_truckimage (truckid,name) Values('".$_GET['id']."','".@$_FILES["fileToUpload"]["name"]."')")or die(mysql_error());
			?>
            <script>
				alert("Upload Successful.");
            location.replace("truck_details.php?id=<?php echo $refresh; ?>");
			</script>		
		<?php }
			else if($_POST['radio'] == 'deed'){
		mysql_query("Update tbl_truckdeedofsale Set location = '".@$_FILES["fileToUpload"]["name"]."' Where truckid='".$_POST['id']."' ");
			?><script>
			alert("Upload Successful.");
			location.replace("truck_details.php?id=<?php echo $refresh; ?>");
            </script><?php
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
/*/
?>
               
		
    <?php


include('connect.php');


?>

</center><br />

    <table width="60%" align="center">    
			
	 
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
            <input type="button" onClick="window.open('view_orcr.php?id=<?php echo $_GET['id'];?>','view_orcr','width=900px,height=500px,top=70px, left=220px');" value="View">
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
         <input onClick="window.open('view_deed.php?id=<?php echo $_GET['id'];?>','view_deed','width=900px,height=500px,top=70px, left=220px');" type="button" value="View">
            <?php } else if(empty($rrow['location'])){
				echo "NONE";
				} ?>
            </td></tr>
			</tr>
<?php

	}
  ?>

</table></div>
</center>
<?php include('layout/footer.php');?>
</body>
</html>

