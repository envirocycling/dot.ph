<?php
include '../../connect.php';
@session_start();

$sql_user = mysql_query("SELECT * from users WHERE user_id = '" . $_SESSION['user_id'] . "'") or die(mysql_error());
$row_user = mysql_fetch_array($sql_user);

$sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_user['emp_num'] . "' ") or die(mysql_error());
$row_emp = mysql_fetch_array($sql_emp);
$chk_str = strlen($row_emp['middlename']);
if ($chk_str > 1) {
    $str_count = strlen($row_emp['middlename']) - 1;
    $middlename = substr($row_emp['middlename'], 0, -$str_count);
} else {
    $str_count = strlen($row_emp['middlename']);
    $middlename = $row_emp['middlename'];
}
if (empty($row_emp['middlename'])) {
    $middlename = '';
} else {
    $middlename = ', ' . $middlename . '.';
}
$fullname = ucwords($row_emp['lastname'] . ', ' . $row_emp['firstname'] . $middlename);

$sql_position = mysql_query("SELECT * from positions WHERE p_id = '" . $row_emp['position_id'] . "' ") or die(mysql_error());
$row_position = mysql_fetch_array($sql_position);

$sql_empstat = mysql_query("SELECT * from employment_status WHERE e_id = '" . $row_emp['status_id'] . "' ") or die(mysql_error());
$row_empstat = mysql_fetch_array($sql_empstat);

$sql_company = mysql_query("SELECT * from company WHERE company_id = '" . $row_emp['company_id'] . "' ") or die(mysql_error());
$row_company = mysql_fetch_array($sql_company);

$sql_department = mysql_query("SELECT * from departments WHERE dep_id = '".$row_user['dep_id']."' ") or die(mysql_error());
$row_department = mysql_fetch_array($sql_department);

/* $branch_id = explode("-",$row_user['branch_id']);
  if(empty($branch_id[1])){
  $sql_branch = mysql_query("SELECT * from branches WHERE branch_id = '".$branch_id[0]."' ") or die(mysql_error());
  }else{
  $sql_branch = mysql_query("SELECT * from branches WHERE (branch_id = '".$branch_id[0]."' or branch_id = '".$$branch_id[1]."') ") or die(mysql_error());
  } */
$sql_branch = mysql_query("SELECT * from branches WHERE branch_id = '" . $row_emp['branch_id'] . "' ") or die(mysql_error());
$row_branch = mysql_fetch_array($sql_branch);


    // ========= General Manager ======================
    $sql_gm = mysql_query("SELECT * from users WHERE user_type = '2'") or die(mysql_error());
    $row_gm = mysql_fetch_array($sql_gm);
    $sql_gmname = mysql_query("SELECT * from employees WHERE emp_num='".$row_gm['emp_num']."'") or die(mysql_error());
    $row_gmname = mysql_fetch_array($sql_gmname);
    $chk_strgm = strlen($row_gmname['middlename']);

    if($chk_strgm > 1){
        $str_countgm = strlen($row_gmname['middlename']) - 1;
        $gm_middlename = substr($row_gmname['middlename'],0,-$str_countgm);
    }else{
        $gm_middlename = $row_gmname['middlename'];
    }

    if(empty($row_gmname['middlename'])){
        $gm_middlename = '';
    }else{
        $gm_middlename = ', '.$gm_middlename.'.';
    }

    $gm_fullname = ucwords($row_gmname['lastname'].', '.$row_gmname['firstname'].$gm_middlename);
    
    $sql_gmposition = mysql_query("SELECT * from positions WHERE p_id = '".$row_gmname['position_id']."' ") or die(mysql_error());
    $row_gmposition = mysql_fetch_array($sql_gmposition);
    // ============ End general manager =====================

    // ============ HR Supervisor ========================
    $sql_hr = mysql_query("SELECT * from users WHERE emp_num = '50'") or die(mysql_error());
    $row_hr = mysql_fetch_array($sql_hr);
    $sql_hrname = mysql_query("SELECT * from employees WHERE emp_num='".$row_hr['emp_num']."'") or die(mysql_error()); //hard coded for now
    $row_hrname = mysql_fetch_array($sql_hrname);
    $chk_strhr = strlen($row_hrname['middlename']);

    if($chk_strhr > 1){
        $str_counthr = strlen($row_hrname['middlename']) - 1;
        $hr_middlename = substr($row_hrname['middlename'],0,-$str_counthr);
    }else{
        $hr_middlename = $row_hrname['middlename'];
    }

    if(empty($row_hrname['middlename'])){
        $hr_middlename = '';
    }else{
        $hr_middlename = ', '.$hr_middlename.'.';
    }

    $hr_fullname = ucwords($row_hrname['lastname'].', '.$row_hrname['firstname'].$hr_middlename);
    
    $sql_hrposition = mysql_query("SELECT * from positions WHERE p_id = '".$row_hrname['position_id']."' ") or die(mysql_error());
    $row_hrposition = mysql_fetch_array($sql_hrposition);    
    // ============ End HR Supervisor ====================


$page = @$_GET['active'];
if ($page == 'register') {
    $register = 'active';
} else if ($page == 'maintenance') {
    $maintenance = 'active';
} else if ($page == 'index') {
    $index = 'active';
} else if ($page == 'view') {
    $view = 'active';
} else if ($page == 'myaccount') {
    $myaccount = 'active';
} else if ($page == 'report') {
    $report = 'active';
}

if (!isset($_SESSION['username-1']) || empty($fullname)) {
    echo '<script>
            location.replace("../../index.php");
            </script>';
}
?>
<link rel="stylesheet" href="css/menu.css">
<style>
    #myImage{
        height: 100px;
        margin-top: 10px;
        margin-right: 10px;
        border: solid;
        border-width: 5px;
        border-top-left-radius:4px; 
        border-top-right-radius:4px; 
        background-color: #333333;
    }
</style>
<?php
$image_path = "../../images/employee/" . $row_emp['emp_num'] . ".png";
if (file_exists($image_path)) {
    ?>
    <img src="../../images/employee/<?php echo $row_emp['emp_num']; ?>.png" id="myImage">
    <?php } else {
    ?>
    <img src="../../images/employee/icon.png" id="myImage">
<?php }
?>
<span class="welcome">Welcome! </span><?php echo $fullname; ?> - <span class="jd"><?php echo ucwords($row_position['position']); ?></span>
<div id='cssmenu'>
    <ul>
        <li class="<?php echo $index; ?>"><a href="index.php?active=index"><span class="pages">Home</span></a></li>
        <li class='<?php echo @$register; ?>'><a><span>Register</span></a>
            <ul>
                <li class="pages"><a href="register_employee.php?active=register">New Employee</a></li>
                <li class="pages"><a href="register_leave.php?active=register">Leave</a></li>
                <li class="pages"><a href="register_pr.php?active=register">Personnel Requisition</a></li>
                <li class="pages"><a href="register_ia.php?active=register">Incident / Accident</a></li>
                <li class="pages"><a href="register_delinquency.php?active=register">Delinquency</a></li>
                <li class="pages"><a href="register_nte.php?active=register">NTE</a></li>
                <li class="pages"><a href="register_trainingseminar.php?active=register">Training & Seminars</a></li>
                <li class="pages"><a href="register_empmovement.php?active=register">Employee Movement</a></li>
            </ul>  
        </li>
        <li class="<?php echo $view; ?>"><a><span>View</span></a>
            <ul>
                <li><a>Employee</a>
                    <ul>
                        <li class="pages"><a href="view_employee.php?status=active&active=view">Active</a></li>
                        <li class="pages"><a href="view_employee.php?status=deactived&active=view">Separated</a></li>
                    </ul>
                </li>
                <li class="pages"><a>Leave</a>
                    <ul>
                        <li><a href="view_leave.php?status=sent&active=view">Sent</a></li>
                        <li><a href="view_leave.php?status=request&active=view">Employee Request</a></li>
                        <li><a href="view_leave.php?status=for validation&active=view">For Validation</a></li>
                        <li class="pages"><a href="view_leave_reliever.php?active=view&page=request">Reliever Request</a></li>
                    </ul>
                </li>
                <li class="pages"><a href="view_pr.php?status=active&active=view">Personnel Requisition</a></li>
                <li class="pages"><a href="view_ia.php?status=active&active=view">Incident / Accident</a></li>
                <li class="pages"><a href="view_delinquency.php?status=active&active=view">Delinquency</a></li>
                <li class="pages"><a href="view_nte.php?active=view">NTE</a></li>
                <li class="pages"><a href="view_trainingseminar.php?status=active&active=view">Training & Seminars</a></li>
                <li class="pages"><a href="view_empmovement.php?status=active&active=view">Employee Movement</a></li>
            </ul>  
        </li>
        <li class='<?php echo @$report; ?>'><a><span>Report</span></a>
            <ul>
                <li><a href="report_employee.php?active=report">Employee</a></li>
                <li><a href="report_leave.php?active=report">Leave Summary</a></li>
                <li><a href="report_pr.php?active=report">Personnel Requisition</a></li>
                <li><a href="report_ia.php?active=report">Incident / Accident</a></li>
                <li><a href="report_delinquency.php?active=report">Delinquency</a></li>
                <li><a href="report_tns.php?active=report">Training & Seminars</a></li>
                <li><a href="report_mm.php?active=report">Employee Movement</a></li>
            </ul>  
        </li>
        <li class="<?php echo @$maintenance; ?>"><a><span>Maintenance</span></a>
            <ul>
                <li><a href="maintenance_announcement.php?active=maintenance">Announcements</a></li>
                <li><a href="maintenance_events.php?active=maintenance">Company Events</a></li>
                <li><a href="maintenance_branch.php?active=maintenance">Branch</a></li>
                <li><a href="maintenance_company.php?active=maintenance">Company</a></li>
                <li><a href="maintenance_leaves.php?active=maintenance">Entitled Leaves</a></li>
                <li><a href="maintenance_position.php?active=maintenance">Position</a></li>
                <li><a href="maintenance_rank.php?active=maintenance">Rank</a></li>
            </ul>  
        </li>
        <li class='<?php echo @$myaccount; ?>'><a><span>My Account</span></a>
            <ul>
                <li><a class="externalAccess">Old MMS</a></li>
                <li><a href="myaccount_update.php?active=myaccount">Settings</a></li>
                <li><a href="logout.php?active=other">Logout</a></li>
        </li>
    </ul>

</div>

<?php include 'loading.php'; ?>
<style>
    .externalAccess:hover{
        cursor: pointer;
    }
</style>
<script>
    $(function(){
        $('.externalAccess').click(function(){
            $('[name=fromExternalAccess]').submit();
        });
    });
</script>
<form action="http://mms.efi.net.ph/" method="post" name="fromExternalAccess" hidden>
    <input type="hidden" name="access" value="true">
</form>

