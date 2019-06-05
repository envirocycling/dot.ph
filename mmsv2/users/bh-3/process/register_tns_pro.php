<?php
session_start();
include('../../../connect.php');
include('process_loading.php');

$date_updated = date('Y/m/d H:i');
$title = mysql_real_escape_string($_POST['title']);
$date = $_POST['date'];
$facilitator = mysql_real_escape_string($_POST['facilitator']);
$venue = mysql_real_escape_string($_POST['venue']);
$row_ctrl = $_POST['row_ctrl'];
$num = 1;
$all_emp = '';
while($num <= $row_ctrl){
    $emp_num = $_POST['emp_num'.$num];
    $all_emp .= $emp_num;
   $num++;
}
if(mysql_query("INSERT INTO training_seminar (title, date, facilitator, venue, participants, user_id, date_updated)
        VALUES('$title', '$date', '$facilitator', '$venue', '$all_emp', '".$_SESSION['user_id']."', '$date_updated') ") or die(mysql_error())){
    echo '<script>
            window.top.location.href="../register_trainingseminar.php?active=register&http=200";
    </script>';
}else{
    echo '<script>
            window.top.location.href="../register_trainingseminar.php?active=register&http=400";
    </script>';
}
