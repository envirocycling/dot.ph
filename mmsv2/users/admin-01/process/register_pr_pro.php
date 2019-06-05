<?php
session_start();
date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');
include('process_loading.php');

$sql_hr = mysql_query("SELECT * from users WHERE user_type = '1'") or die(mysql_error());
$row_hr = mysql_fetch_array($sql_hr);
$hr_empnum = $row_hr['emp_num'];

$sql_gm = mysql_query("SELECT * from users WHERE user_type = '2'") or die(mysql_error());
$row_gm = mysql_fetch_array($sql_gm);
$gm_empnum = $row_gm['emp_num'];

$sql_user = mysql_query("SELECT * from users WHERE user_id = '".$_SESSION['user_id']."'") or die(mysql_error());
$row_user = mysql_fetch_array($sql_user);
$prepared_by = $row_user['emp_num'];

@$date_requested = date('Y/m/d', strtotime($_POST['date_requested']));
@$branch = $_POST['branch'];
@$date_needed = $_POST['date_needed'];
@$no_needed = $_POST['no_needed'];
@$job_title = $_POST['job_title'];
@$status = $_POST['status'];
@$agency = $_POST['agency'];
@$reason = $_POST['reason1'].'~'.mysql_real_escape_string($_POST['txt_reason1']).'~'.$_POST['reason2'].'~'.mysql_real_escape_string($_POST['txt_reason2']).'~'.$_POST['reason3'].'~'.mysql_real_escape_string($_POST['txt_reason3']).'~'.$_POST['reason4'].'~'.mysql_real_escape_string($_POST['txt_reason4']);
@$date_movement = $_POST['date_movement'];
@$ed_requirements = $_POST['ed_requirements'].$_POST['txt_college'];
@$special_skills = mysql_real_escape_string($_POST['special_skills']);
@$attitudinal_req = mysql_real_escape_string($_POST['attitudinal_req']);
@$other_skills = mysql_real_escape_string($_POST['other_skills']);
@$recommendation = mysql_real_escape_string($_POST['recommendation']);
@$salary = $_POST['salary'];
$upload_control = $_POST['upload_control'];

if($job_title == 'others'){
    $job_specify = mysql_real_escape_string($_POST['job_specify']);
    if(mysql_query("INSERT INTO positions (position) VALUES ('$job_specify')") or die(mysql_error())){
        $sql_lastposition = mysql_query("SELECT max(p_id) as p_id from positions") or die(mysql_error());
        $row_lastposition = mysql_fetch_array($sql_lastposition);  
        $job_title = $row_lastposition['p_id'];
    }

}

//p = pending , 00=cancel, 0=disapproved, 1=approved

if(mysql_query("INSERT INTO personnel_requisition (date_requested, branch_id, date_needed, no_needed, job_title, employment_status, company_id, reason, education_req, special_skills, attitudinal_req, other_skills, recommendation, salary, status, prepared_id, gm_id, hr_id, gm_status, hr_status, date_movement)
        VALUES ('$date_requested', '$branch', '$date_needed', '$no_needed', '$job_title', '$status', '$agency', '$reason', '$ed_requirements', '$special_skills', '$attitudinal_req', '$other_skills', '$recommendation', '$salary','pending', '$prepared_by', '$gm_empnum', '$hr_empnum', 'pending', 'pending', '$date_movement')") or die(mysql_error())){
    
    $sql_max = mysql_query("SELECT max(pr_id) as pr_id from personnel_requisition") or die(mysql_error());
    $row_max = mysql_fetch_array($sql_max);
        $pro_ctr = 1;
        $arr_ctr = 0;
        $date = date('Y-m-d');
        $target_dir = "../../../attachment/pr/";
        while($pro_ctr <= $upload_control){
                $target = $target_dir.basename($_FILES["upload"]["name"][$arr_ctr]);
                $upload_name = basename($_FILES["upload"]["name"][$arr_ctr]);
                if(!empty($upload_name)){
                    if(move_uploaded_file(@$_FILES["upload"]["tmp_name"][$arr_ctr],$target)){
                        mysql_query("INSERT INTO personnel_requisition_attachment (pr_id, file_name, user_id, date_uploaded) VALUES('".$row_max['pr_id']."', '$upload_name', '".$_SESSION['user_id']."','$date')") or die(mysql_error());
                    }
                }
            $pro_ctr++;
            $arr_ctr++;
        }
    
    echo '<script>
            location.replace("../view_pr.php?status=active&active=view&http=200");
    </script>';
}else{
    echo '<script>
            location.replace("../register_pr.php?active=register&http=400");
    </script>';
}
 

/*echo "INSERT INTO personnel_requisition (date_requested, branch, date_needed, no_needed, job_title, employment_status, company, reason, education_req, special_skills, attitudinal_req, other_skills, recommendation, salaray, status, prepared_by, gm, hr)
        VALUES ('$date_requested', '$branch', '$date_needed', '$no_needed', '$job_title', '$status', '$agency', '$reason', '$ed_requirements', '$special_skills', '$attitudinal_req', '$other_skills', '$recommendation', '$salary','p', '$prepared_by', '$gm_empnum', '$hr_empnum')";*/