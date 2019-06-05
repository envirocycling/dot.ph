<?php
include('../../../connect.php');
include('process_loading.php');
session_start();
date_default_timezone_set("Asia/Singapore");

$firstname = ucwords($_POST['firstname']);
$middlename = ucwords($_POST['middlename']);
$lastname = ucwords($_POST['lastname']);
$birthdate = $_POST['birthdate'];
$st_brgy = ucwords($_POST['address_brgy']);
$town_city = ucwords($_POST['address_towncity']);
$province = ucwords($_POST['address_province']);
$contact_no = $_POST['contact'];
$civil_status = $_POST['civil_status'];
$gender = $_POST['gender'];
$date_hired = $_POST['date_hired'];
$date_start = $_POST['date_start'];
$company = $_POST['company'];
$branch = $_POST['branch'];
$position = $_POST['position'];
$rank = $_POST['rank'];
$status = $_POST['emp_status'];
$stayin = $_POST['stayin'];
$tin = $_POST['tin'];
$sss_no = $_POST['sss'];
$phic_no = $_POST['phic'];
$hdmf_no = $_POST['hdmf'];
$tax_code = $_POST['tax_code'];
$user_id = $_SESSION['user_id'];
$date_created = date('Y/m/d');
$response = 'success';
$success = 'true';
@$emp_num = $_POST['emp_num'];
@$date_regularization = $_POST['date_regularization'];

//educational attainment start
    $tertiary = $_POST['tertiary'].'~'.$_POST['year_tertiary'];
    $secondary = $_POST['secondary'].'~'.$_POST['year_secondary'];
    $primary = $_POST['primary'].'~'.$_POST['year_primary'];
//educational attainment end

//dependents start
    $dependents_count = $_POST['r_dependentCount'];
    $dependents = '';
    if($dependents_count > 0){
        $ctrl = 1;
        while($ctrl <= $dependents_count){
            @$dependents .= '['.$_POST['nameDependent'.$ctrl].'~'.$_POST['birthdateDependent'.$ctrl].'~'.$_POST['relationship'.$ctrl].']';
        $ctrl++;   
        }
    }
//dependents end
    
//emergency start
    $emergency_count = $_POST['r_emergency'];
    $emergency = '';
        $ctrl_emer = 1;
        while($ctrl_emer <= $emergency_count){
            @$emergency .= '['.$_POST['nameEmergency'.$ctrl_emer].'~'.$_POST['birthdateEmergency'.$ctrl_emer].'~'.$_POST['relationshipEmergency'.$ctrl_emer].'~'.$_POST['contactEmergency'.$ctrl_emer].'~'.$_POST['addressEmergency'.$ctrl_emer].']';
        $ctrl_emer++;   
        }
//emergency end



$chk_emp = mysql_query("SELECT * from employees WHERE emp_num = '$emp_num'") or die(mysql_error());

if(mysql_num_rows($chk_emp) > 0 && $emp_num > 0){
    if(mysql_query("UPDATE employees SET firstname='$firstname', middlename='$middlename', lastname='$lastname', birthdate='$birthdate', st_brgy='$st_brgy', town_city='$town_city', province='$province', contact_no='$contact_no', date_hired='$date_hired', date_start='$date_start', company_id='$company', branch_id='$branch', position_id='$position', status_id='$status', stayin='$stayin', tin='$tin', sss_no='$sss_no', phic_no='$phic_no', hdmf_no='$hdmf_no', updated_id='$user_id', date_updated='$date_created', civil_status='$civil_status', date_regularization='$date_regularization', gender='$gender', tertiary='$tertiary', secondary='$secondary', elementary='$primary', rank_id='$rank', tax_code='$tax_code', dependents='$dependents', emergency='$emergency' WHERE emp_num='$emp_num'")){
        if(!empty(basename($_FILES["sketch"]["name"]))){
            mysql_query("UPDATE employees SET sketch='".basename($_FILES["sketch"]["name"])."' WHERE emp_num='$emp_num'");
        //uploading sketch start
            @$target_dir = "../../../images/sketch/";
            @$target_file = $target_dir . basename($_FILES["sketch"]["name"]);
            @$uploadOk = 1;
            $_SESSION['err'] = '';
            @$imageFileType = pathinfo(@$target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image                                
                                // Check if file already exists
            if (file_exists(basename($_FILES["sketch"]["name"]))) {
                    unlink(basename($_FILES["sketch"]["name"]));
            }
             move_uploaded_file(@$_FILES["sketch"]["tmp_name"], $target_file);
        //uploading sketch end
        }
        echo '<script>
                location.replace("../view_employee.php?status=active&active=view&http=200");
        </script>';
    
    }
}else {
    if(mysql_query("INSERT INTO employees (firstname, middlename, lastname, birthdate, st_brgy, town_city, province, contact_no, date_hired, date_start, company_id, branch_id, position_id, status_id, stayin, tin, sss_no, phic_no, hdmf_no, user_id, date_created, civil_status, date_regularization, gender, tertiary, secondary, elementary, rank_id, tax_code, dependents, emergency, sketch)
        VALUES ('$firstname', '$middlename', '$lastname', '$birthdate', '$st_brgy', '$town_city', '$province', '$contact_no', '$date_hired', '$date_start', '$company','$branch', '$position', '$status', '$stayin', '$tin', '$sss_no', '$phic_no', '$hdmf_no', '$user_id', '$date_created', '$civil_status', '$date_regularization', '$gender', '$tertiary', '$secondary', '$primary', '$rank', '$tax_code', '$dependents', '$emergency', '".basename($_FILES["sketch"]["name"])."') ") or die (mysql_error())){
    
            $sql_empnum = mysql_query("SELECT max(emp_num) as emp_num from employees") or die(mysql_error());
            $row_empnum = mysql_fetch_array($sql_empnum);
            
             //uploading sketch start
            @$target_dir = "../../../images/sketch/";
            @$target_file = $target_dir . basename($_FILES["sketch"]["name"]);
            @$uploadOk = 1;
            $_SESSION['err'] = '';
            @$imageFileType = pathinfo(@$target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image                                
                                // Check if file already exists
            if (file_exists(basename($_FILES["sketch"]["name"]))) {
                    unlink(basename($_FILES["sketch"]["name"]));
            }
             move_uploaded_file(@$_FILES["sketch"]["tmp_name"], $target_file);
        //uploading sketch end
            
            if(mysql_query("UPDATE employees SET password='".$row_empnum['emp_num']."' WHERE emp_num='".$row_empnum['emp_num']."'") or die(mysql_error())){
                echo '<script>
                    location.replace("../register_employee.php?active=register&http=200");
                </script>';
            }else{
               echo '<script>
                    location.replace("../register_employee.php?active=register&http=400");
                </script>'; 
            }
        
            
    }
}



        