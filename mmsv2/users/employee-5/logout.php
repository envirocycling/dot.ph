<?php
session_start();
include("../../connect.php");

$sql_chk = mysql_query("SELECT * from employees WHERE emp_num='".$_SESSION['emp_num']."' and password='".$_SESSION['emp_num']."'") or die(mysql_error());

if(mysql_num_rows($sql_chk) == 1){
    echo '<script>
            location.replace("myaccount_update.php?active=myaccount&http=401");
    </script>'; 
}else{
    session_destroy();
    header("Location: ../../index.php");
}
?>