<style>
    body{
        font-size:50px;

    }
</style>
<?php
include('config.php');
$username=$_POST['username'];
$current_pass=$_POST['current_pass'];
$new_pass=$_POST['new_pass'];
$confirm_pass=$_POST['confirm_pass'];

$query="SELECT * FROM users where user_id='$username'";
$result=mysql_query($query);
$row = mysql_fetch_array($result);
$old_password=$row['password'];

if(strlen($new_pass) >= 8) {
    $numberOfNumbersFound = preg_match("/[0-9]+/", $new_pass);
   
    if($numberOfNumbersFound!=0 ) {
        if( $new_pass=='' || $current_pass =='' || $confirm_pass=='') {

            echo "<script>

alert('Please fill out all fields');
window.location = 'viewAccountDetails.php';
</script>";

        }else if($current_pass != $old_password) {

            echo "<script>

alert('The current password you enetered does not match with your username');
window.location = 'viewAccountDetails.php';
</script>";
        }else if($new_pass != $confirm_pass) {
            echo "<script>

alert('confirmation and new password did not match');
window.location = 'viewAccountDetails.php';
</script>";
        }else {
            mysql_query("UPDATE users set password='$new_pass' where user_id='$username'");
            echo "<script>

alert('Password changed successfully!!!');
window.location = 'viewAccountDetails.php';
</script>";
        }
    }else {
        echo "<script>
alert('Password must contain numbers.');
window.history.back();
</script>";

    }

}else {
    echo "<script>
alert('Password must be atleast 8 characters long.');
window.history.back();
</script>";

}
?>