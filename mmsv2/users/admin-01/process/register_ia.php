<?php
session_start();
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');

$num = 1;
$ctr_num = $_POST['row_ctrl'];
$emp_num = '';
    while($num <= $ctr_num){
        $emp_num .= $_POST['emp_num'.$num];
        $num++;
    }
$date_submitted = $_POST['date_submitted'];
$branch_id = $_POST['branch'];
$description = mysql_real_escape_string($_POST['description']);
$what_happened = mysql_real_escape_string($_POST['what_happened']);
$date_happened = date('Y-m-d H:i', strtotime($_POST['date_happened']));
$where_happened = mysql_real_escape_string($_POST['where']);
$corrective_action = mysql_real_escape_string($_POST['corrective_action']);
$preventive_action = mysql_real_escape_string($_POST['preventive_action']);
$prepared_id = $_SESSION['emp_num'];
@$report_id = $_POST['report_id'];

if(empty($emp_num)){
    echo '<script>
                window.top.location.href="../register_ia.php?active=register&http=400";
        </script>'; 
}else if(@$report_id > 0){
    if(mysql_query("UPDATE incident_accident SET date_submitted='$date_submitted', branch_id='$branch_id', description='$description', what_happened='$what_happened', date_happened='$date_happened', where_happened='$where_happened', person='$emp_num', corrective_action='$corrective_action', preventive_action='$preventive_action', prepared_num='$prepared_id'
            WHERE report_id ='$report_id'") or die(mysql_error())){
        echo '<script>
                window.top.location.href="../view_ia.php?status=active&active=view&http=200";
        </script>';  
    }else{
       echo '<script>
                window.top.location.href="../register_ia.php?active=register&http=400";
        </script>';  
    }
}else{
    if(mysql_query("INSERT INTO incident_accident (date_submitted, branch_id, description, what_happened, date_happened, where_happened, person, corrective_action, preventive_action, prepared_num)
            VALUES ('$date_submitted', '$branch_id', '$description', '$what_happened', '$date_happened', '$where_happened', '$emp_num', '$corrective_action', '$preventive_action', '$prepared_id')") or die(mysql_error())){
        echo '<script>
                window.top.location.href="../view_ia.php?status=active&active=view&http=200";
        </script>';  
    }else{
       echo '<script>
                window.top.location.href="../register_ia.php?active=register&http=400";
        </script>';  
    }
}
