<?php

session_start();
include('../../../connect.php');
include('process_loading.php');

$sql_gm = mysql_query("SELECT * from users WHERE user_type = '2'") or die(mysql_error());
$row_gm = mysql_fetch_array($sql_gm);

$date_updated = date('Y/m/d H:i');
$title = mysql_real_escape_string($_POST['title']);
$from = date('Y-m-d H:i', strtotime($_POST['from']));
$to = date('Y-m-d H:i', strtotime($_POST['to']));
$training_type = $_POST['training_type'];
$facilitator = mysql_real_escape_string($_POST['facilitator']);
$venue = mysql_real_escape_string($_POST['venue']);
$justification = mysql_real_escape_string($_POST['justification']);
$ban = $_POST['ban'];
$row_ctrl = $_POST['row_ctrl'];
$num = 1;
$all_emp = '';
$upload_control = $_POST['upload_control'];
while ($num <= $row_ctrl) {
    $emp_num = $_POST['emp_num' . $num];
    $all_emp .= $emp_num;
    $num++;
}
if (empty($all_emp)) {
    echo '<script>
            window.top.location.href="../register_trainingseminar.php?active=register&http=400";
    </script>';
} else if (mysql_query("INSERT INTO training_seminar (title, from_date, to_date, facilitator, venue, participants, prepared_num, date_updated, attachment, type, bond, status, gm_num, justification)
        VALUES('$title', '$from', '$to', '$facilitator', '$venue', '$all_emp', '" . $_SESSION['emp_num'] . "', '$date_updated', '', '$training_type', '$ban', 'pending to gm', '" . $row_gm['emp_num'] . "', '$justification') ") or die(mysql_error())) {

//    $target = '../../../attachment/tns/' . basename($_FILES["attachment"]["name"]);
//    $upload_name = basename($_FILES["attachment"]["name"]);
//    if (!empty($upload_name)) {
//        if (file_exists($target)) {
//            unlink($target);
//        }
//        move_uploaded_file(@$_FILES["attachment"]["tmp_name"], $target);
//    }

    $exEmp = str_replace('(','',explode(')',$all_emp));
    foreach ($exEmp as $exVal){
        $sVal = strtolower($title).'~';
        $sql_tns = mysql_query("SELECT * from employees WHERE emp_num='$exVal' and training_must_attended LIKE '%$sVal%'") or die(mysql_error());
        $row_tns = mysql_fetch_array($sql_tns);
        $nVal = mysql_real_escape_string(str_replace($sVal,'',strtolower($row_tns['training_must_attended'])));
        mysql_query("UPDATE employees SET training_must_attended='$nVal' WHERE emp_num='$exVal'") or die(mysql_error());
    }
    
    $sql_max = mysql_query("SELECT max(tns_id) as tns_id from training_seminar") or die(mysql_error());
    $row_max = mysql_fetch_array($sql_max);
    $pro_ctr = 1;
    $arr_ctr = 0;
    $date = date('Y-m-d');
    $target_dir = "../../../attachment/tns/";
    while ($pro_ctr <= $upload_control) {
        $target = $target_dir . $row_max['tns_id'] . $arr_ctr . basename($_FILES["upload"]["name"][$arr_ctr]);
        $upload_name = $row_max['tns_id'] . $arr_ctr . basename($_FILES["upload"]["name"][$arr_ctr]);
        $name2 = @$_FILES["cert"]["tmp_name"][$arr_ctr];
        $name1 = $_FILES["upload"]["tmp_name"][$arr_ctr];

        if (empty($name1)) {
            $upload_name = '';
        }
        if (empty($name2)) {
            $upload_name2 = '';
        }
        
        if (move_uploaded_file(@$_FILES["upload"]["tmp_name"][$arr_ctr], $target)) {
            if (!empty($upload_name2)) {
                $target2 = $target_dir . $row_max['tns_id'] . $arr_ctr . basename($_FILES["cert"]["name"][$arr_ctr]);
                $upload_name2 = $row_max['tns_id'] . $arr_ctr . basename($_FILES["cert"]["name"][$arr_ctr]);
                move_uploaded_file(@$_FILES["cert"]["tmp_name"][$arr_ctr], $target2);
            }
        }
        mysql_query("INSERT INTO training_seminar_attachment (tns_id, emp_num, file_name, cert_name, user_id, date_uploaded) VALUES('" . $row_max['tns_id'] . "', '" . $_POST['emp_num' . $pro_ctr] . "', '$upload_name', '$upload_name2', '" . $_SESSION['user_id'] . "','$date')") or die(mysql_error());
        $pro_ctr++;
        $arr_ctr++;
    }

    echo '<script>
            window.top.location.href="../view_trainingseminar.php?status=active&active=view&http=200";
    </script>';
} else {
    echo '<script>
            window.top.location.href="../register_trainingseminar.php?active=register&http=400";
    </script>';
}
