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
$date_hired = $_POST['date_hired'];
$date_start = $_POST['date_start'];
$company = $_POST['company'];
$branch = $_POST['branch'];
$position = $_POST['position'];
$status = $_POST['emp_status'];
$stayin = $_POST['stayin'];
$tin = $_POST['tin'];
$sss_no = $_POST['sss'];
$phic_no = $_POST['phic'];
$hdmf_no = $_POST['hdmf'];
$user_id = $_SESSION['user_id'];
$date_created = date('Y/m/d');
$response = 'success';
$success = 'true';
@$emp_num = $_POST['emp_num'];
$civil_status = $_POST['civil_status'];
@$date_regularization = $_POST['date_regularization'];

@$action = $_GET['action'];

if(!empty($action)){
    $sql_chkRequest = mysql_query("SELECT * from employees_request WHERE emp_num='$emp_num' and type='edit'") or die(mysql_error());
    if(mysql_num_rows($sql_chkRequest) == 1){
        if(mysql_query("UPDATE employees_request SET firstname='$firstname', middlename='$middlename', lastname='$lastname', birthdate='$birthdate', st_brgy='$st_brgy', town_city='$town_city', province='$province', contact_no='$contact_no', date_hired='$date_hired', date_start='$date_start', company_id='$company', branch_id='$branch', position_id='$position', status_id='$status', stayin='$stayin', tin='$tin', sss_no='$sss_no', phic_no='$phic_no', hdmf_no='$hdmf_no', user_id='$user_id', date_created='$date_created', civil_status='$civil_status', type='edit' WHERE emp_num='$emp_num'") or die (mysql_error())){
        echo '<script>
                    location.replace("../view_employee.php?status=toedit&active=view&http=200");
            </script>';

        }else{
            echo '<script>
                    location.replace("../view_employee.php?status=active&active=view&http=400");
            </script>';
        }
    }else{
        if(mysql_query("INSERT INTO employees_request (emp_num,firstname, middlename, lastname, birthdate, st_brgy, town_city, province, contact_no, date_hired, date_start, company_id, branch_id, position_id, status_id, stayin, tin, sss_no, phic_no, hdmf_no, user_id, date_created, civil_status, type)
            VALUES ('$emp_num','$firstname', '$middlename', '$lastname', '$birthdate', '$st_brgy', '$town_city', '$province', '$contact_no', '$date_hired', '$date_start', '$company','$branch', '$position', '$status', '$stayin', '$tin', '$sss_no', '$phic_no', '$hdmf_no', '$user_id', '$date_created', '$civil_status','edit') ") or die (mysql_error())){
        echo '<script>
                    location.replace("../view_employee.php?status=toedit&active=view&http=200");
            </script>';

        }else{
            echo '<script>
                    location.replace("../view_employee.php?status=active&active=view&http=400");
            </script>';
        }
    }
}else{
    if(mysql_query("INSERT INTO employees_request (firstname, middlename, lastname, birthdate, st_brgy, town_city, province, contact_no, date_hired, date_start, company_id, branch_id, position_id, status_id, stayin, tin, sss_no, phic_no, hdmf_no, user_id, date_created, civil_status, type)
        VALUES ('$firstname', '$middlename', '$lastname', '$birthdate', '$st_brgy', '$town_city', '$province', '$contact_no', '$date_hired', '$date_start', '$company','$branch', '$position', '$status', '$stayin', '$tin', '$sss_no', '$phic_no', '$hdmf_no', '$user_id', '$date_created', '$civil_status','add') ") or die (mysql_error())){
    echo '<script>
                location.replace("../view_employee.php?status=toadd&active=view&http=200");
        </script>';
    
    }else{
        echo '<script>
                location.replace("../register_employee.php?active=register&http=400");
        </script>';
    }
}



        