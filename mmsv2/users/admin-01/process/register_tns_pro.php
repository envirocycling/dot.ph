<?php
session_start();
include('../../../connect.php');
include('process_loading.php');

$date_updated = date('Y/m/d H:i');
$title = mysql_real_escape_string($_POST['title']);
$from = date('Y-m-d H:i', strtotime($_POST['from']));
$to = date('Y-m-d H:i', strtotime($_POST['to']));
$training_type = $_POST['training_type'];
$facilitator = mysql_real_escape_string($_POST['facilitator']);
$venue = mysql_real_escape_string($_POST['venue']);
$ban = $_POST['ban'];
$row_ctrl = $_POST['row_ctrl'];
$num = 1;
$all_emp = '';
while($num <= $row_ctrl){
    $emp_num = $_POST['emp_num'.$num];
    $all_emp .= $emp_num;
   $num++;
}
if(empty($all_emp)){
    echo '<script>
            window.top.location.href="../register_trainingseminar.php?active=register&http=400";
    </script>';
}else if(mysql_query("INSERT INTO training_seminar (title, from_date, to_date, facilitator, venue, participants, user_id, date_updated, attachment, type, ban)
        VALUES('$title', '$from', '$to', '$facilitator', '$venue', '$all_emp', '".$_SESSION['user_id']."', '$date_updated', '".basename($_FILES["attachment"]["name"])."', '$training_type', '$ban') ") or die(mysql_error())){
    
    $target = '../../../attachment/tns/' . basename($_FILES["attachment"]["name"]);
    $upload_name = basename($_FILES["attachment"]["name"]);
    if (!empty($upload_name)) {
            if (file_exists($target)){
                unlink($target);
            }
        move_uploaded_file(@$_FILES["attachment"]["tmp_name"], $target);
    }

    echo '<script>
            window.top.location.href="../view_trainingseminar.php?status=active&active=view&http=200";
    </script>';
}else{
    echo '<script>
            window.top.location.href="../register_trainingseminar.php?active=register&http=400";
    </script>';
}
