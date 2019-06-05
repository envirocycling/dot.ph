<?php
session_start();
include '../../connect.php';
$sql_user = mysql_query("SELECT * from users WHERE user_id = '" . $_SESSION['user_id'] . "'") or die(mysql_error());
$row_user = mysql_fetch_array($sql_user);

$sql_emp = mysql_query("SELECT * from company WHERE company_id = '" . $row_user['agency_id'] . "' ") or die(mysql_error());
$row_emp = mysql_fetch_array($sql_emp);

$sql_department = mysql_query("SELECT * from departments WHERE dep_id = '" . $row_user['dep_id'] . "' ") or die(mysql_error());
$row_department = mysql_fetch_array($sql_department);

$fullname = ucwords($row_emp['name']);

/* $branch_id = explode("-",$row_user['branch_id']);
  if(empty($branch_id[1])){
  $sql_branch = mysql_query("SELECT * from branches WHERE branch_id = '".$branch_id[0]."' ") or die(mysql_error());
  }else{
  $sql_branch = mysql_query("SELECT * from branches WHERE (branch_id = '".$branch_id[0]."' or branch_id = '".$$branch_id[1]."') ") or die(mysql_error());
  } */
$sql_gm = mysql_query("SELECT * from users WHERE user_type = '2'") or die(mysql_error());
$row_gm = mysql_fetch_array($sql_gm);
$sql_gmname = mysql_query("SELECT * from employees WHERE emp_num='" . $row_gm['emp_num'] . "'") or die(mysql_error());
$row_gmname = mysql_fetch_array($sql_gmname);
$chk_strgm = strlen($row_gmname['middlename']);
if ($chk_strgm > 1) {
    $str_countgm = strlen($row_gmname['middlename']) - 1;
    $gm_middlename = substr($row_gmname['middlename'], 0, -$str_countgm);
} else {
    $gm_middlename = $row_gmname['middlename'];
}
if (empty($row_gmname['middlename'])) {
    $gm_middlename = '';
} else {
    $gm_middlename = ', ' . $gm_middlename . '.';
}
$gm_fullname = ucwords($row_gmname['lastname'] . ', ' . $row_gmname['firstname'] . $gm_middlename);

$sql_gmposition = mysql_query("SELECT * from positions WHERE p_id = '" . $row_gmname['position_id'] . "' ") or die(mysql_error());
$row_gmposition = mysql_fetch_array($sql_gmposition);

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
} else if ($page == 'employee') {
    $employee = 'active';
}

if (!isset($_SESSION['username-6']) || empty($fullname)) {
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
$image_path = "../../images/agency/" . $row_user['agency_id'] . ".png";
if (file_exists($image_path)) {
    ?>
    <img src="../../images/agency/<?php echo $row_user['agency_id']; ?>.png" id="myImage">
<?php } else {
    ?>
    <img src="../../images/employee/icon.png" id="myImage">
<?php }
?>
<span class="welcome">Welcome! </span><?php echo $fullname; ?> - <span class="jd"><?php echo ucwords($row_emp['description']);
;
?></span>
<div id='cssmenu'>
    <ul>
        <li class="<?php echo $index; ?>"><a href="index.php?active=index"><span class="pages">Home</span></a></li>
        <li class="<?php echo $employee; ?>"><a href="view_employee.php?status=active&active=employee">Employee</a></li>
        <li class="<?php echo $view; ?>"><a><span><a href="view_delinquency.php?status=active&active=view">View Delinquency</a></span></li>
        <li class='<?php echo @$register; ?>'><a href="#"><span>Notice to Explain</span></a>
            <ul>
                <li class="pages"><a href="register_nte.php?active=register">Create</a></li>
                <li class="pages"><a href="view_nte.php?active=register">View</a></li>
            </ul>  
        </li>
        <li class='<?php echo @$myaccount; ?>'><a><span>My Account</span></a>
            <ul>
                <li><a href="myaccount_update.php?active=myaccount">Settings</a></li>
                <li><a href="logout.php?active=other">Logout</a></li>
        </li>
    </ul>

</div>

<?php include 'loading.php'; ?>
<link rel='stylesheet' href='pop-up/jAlert.css'>
<script src='pop-up/jAlert.js'></script>
<script src='pop-up/jAlert-functions.js'></script>
<script src="pop-up/jAlert.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
--><script src="pop-up/confirmation.js"></script>
<script>
    $(function () {
        //for the data-jAlerts
        $.jAlert('attach');
    });

</script>

