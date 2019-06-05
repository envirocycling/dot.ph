<?php
include('config.php');
$passcode=$_POST['passcode'];
$str=$_POST['str'];
$new_grade=$_POST['new_grade'];
$old_grade=$_POST['old_grade'];
$remarks='Upgraded/Downgraded from '.$old_grade.' to '.$new_grade." last " . date("Y/m/d h:i:s a");
//if($passcode=='supervisory123') {
    if(mysql_query("UPDATE outgoing set wp_grade='$new_grade',remarks='$remarks' where  str='$str' and wp_grade='$old_grade';")) {

        echo "<script>
            alert('WP Grade has been updated successfully...');
            window.history.back();

          </script>";


    }else {
        echo "<script>
            alert('Failed to update wp_grade...');
            window.history.back();

          </script>";
    }
//}else {
//    echo "<script>
//            alert('Invalid Code...');
//            window.history.back();
//
//          </script>";
//}
?>