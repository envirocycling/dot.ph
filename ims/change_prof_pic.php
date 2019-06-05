<?php
include 'config.php';
session_start();
$user_id = $_SESSION['username'];
if(isset($_POST['upload'])) {

    $image = $_FILES['image']['tmp_name'];

    if(empty($image)) {
        echo '<script type="text/javascript">
            alert("Please choose a file!");
            location.replace("viewAccountDetails.php");
            </script>';
    } else {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $image_size = getimagesize($_FILES['image']['tmp_name']);
        $fsize = $_FILES["image"]["size"];
        if($image_size==False) {
            echo '<script type="text/javascript">
                alert("Thats not an image!");
                location.replace("viewAccountDetails.php");
                </script>';
        }
        else if($fsize < 1000) {
            echo '<script type="text/javascript">
                alert("The image file size exceeded the maximum limit!");
                location.replace("viewAccountDetails.php");
                </script>';
        }
        else {
            mysql_query("UPDATE users SET image='$image' WHERE user_id='$user_id'");
            echo '<script type="text/javascript">
                alert("Succesfully Added!");
                location.replace("viewAccountDetails.php");
                </script>';
        }

    }
}
?>