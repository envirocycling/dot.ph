<?php


session_start();

include('connect.php');

// Check to see if the type of file uploaded is a valid image type

function is_valid_type($file)

{

    // This is an array that holds all the valid image MIME types

    $valid_types = array("image/jpg", "image/jpeg", "image/bmp", "image/gif");

 

    if (in_array($file['type'], $valid_types))

        return 1;

    return 0;

}

function showContents($array)

{

    echo "<pre>";

    print_r($array);

    echo "</pre>";

}


// This variable is the path to the image folder where all the images are going to be stored

// Note that there is a trailing forward slash

$TARGET_PATH = "../trucks/";

 

// Get our POSTed variables

@$name = $_POST['name'];

@$type = $_POST['type'];

@$image = $_FILES['image'];

 

// Sanitize our inputs

@$name = mysql_real_escape_string($name);


@$image['name'] = mysql_real_escape_string($image['name']);





$TARGET_PATH .= $image['name'];



if (!is_valid_type($image))

{

    $_SESSION['error'] = "You must upload a jpeg, gif, or bmp.";

    exit;

}
 

// Here we check to see if a file with that name already exists

// You could get past filename problems by appending a timestamp to the filename and then continuing

if (file_exists($TARGET_PATH))

{

    $_SESSION['error'] = "A image with that name already exists.";



    exit;

}
$price=$_POST['price'];
if(!is_numeric  ($price))
 		{	  

	$_SESSION['error'] = "Price must be a Number.  ";


    exit;}
	
   


@$id = $_GET['id'];	
$exist = mysql_query("SELECT `name` FROM  `tbl_menulist` WHERE  `name`='$name' ");
if (mysql_num_rows($exist)>0) 
{
 $_SESSION['error'] = "A menu with that name already exists.";



    exit;			   
}
 

// Lets attempt to move the file from its temporary directory to its new home

if (move_uploaded_file($image['tmp_name'], $TARGET_PATH))

{

    // NOTE: This is where a lot of people make mistakes.

    // We are *not* putting the image into the database; we are putting a reference to the file's location on the server
		mysql_query("Update tbl_truck_report Set finame = '".@$_FILES["fileToUpload"]["name"]."' Where id='".$_GET['id']."' ");
    $result = mysql_query($sql) or die ("Could not insert data into DB: " . mysql_error());
?>
<script>
alert('Product Added Successful.');

</script>
	<?php
    exit;

}

else

{

    // A common cause of file moving failures is because of bad permissions on the directory attempting to be written to

    // Make sure you chmod the directory to be writeable

    $_SESSION['error'] = "Could not upload file.      Note: You must upload a jpeg, gif, or bmp.";


    exit;
	}

?>
 