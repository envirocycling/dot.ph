	 <?php
//upload==========================================================================
include('connect.php');
$refresh=$_GET['id'];
if(isset($_POST['submit'])){
	if($_POST['radio'] == "truck"){
@$target_dir = "../trucks/";
	}else if($_POST['radio'] == "orcr"){
@$target_dir = "../orcr/";
	}else if($_POST['radio'] == "deed"){
@$target_dir = "../deedofsale/";
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
	
    if ( move_uploaded_file(@$_FILES["fileToUpload"]["tmp_name"],$target_file)) {
		//truck
		$truck = "Select * from tbl_truck_report Where id='".$_GET['id']."' ";
		$truck_result = mysql_query($truck) or die(mysql_error());
		$trow = mysql_fetch_array($truck_result);
		 if($_POST['radio'] == 'truck'){
		mysql_query("Insert into tbl_truckimage (truckid,name) Values('".$_GET['id']."','".@$_FILES["fileToUpload"]["name"]."')")or die(mysql_error());
			
		}
			else if($_POST['radio'] == 'deed'){
		mysql_query("Update tbl_truckdeedofsale Set location = '".@$_FILES["fileToUpload"]["name"]."' Where truckid='".$_POST['id']."' ");
			
		}
		else if($_POST['radio'] = 'orcr'){
		mysql_query("Update tbl_truckorcr Set location = '".@$_FILES["fileToUpload"]["name"]."' Where truckid='".$_POST['id']."' ");
		
		}
				?>
            <script>
				alert("Upload Successfull.");
            location.replace("truck_details.php?id=<?php echo $refresh; ?>");
			</script>		
		<?php
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
//=================================================================================
?>
     