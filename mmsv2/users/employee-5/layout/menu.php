<?php
include '../../connect.php';
@session_start(); 
    
    $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '".$_SESSION['emp_num']."' ") or die(mysql_error());
    $row_emp = mysql_fetch_array($sql_emp);
    $chk_str = strlen($row_emp['middlename']);
    if($chk_str > 1){
        $str_count = strlen($row_emp['middlename']) - 1;
    $middlename = substr($row_emp['middlename'],0,-$str_count);
    }else{
        $str_count = strlen($row_emp['middlename']);
    $middlename = $row_emp['middlename'];
    }
    if(empty($row_emp['middlename'])){
        $middlename = '';
    }else{
        $middlename = ', '.$middlename.'.';
    }
    $fullname = ucwords($row_emp['lastname'].', '.$row_emp['firstname'].$middlename);
    
    
    $sql_position = mysql_query("SELECT * from positions WHERE p_id = '".$row_emp['position_id']."' ") or die(mysql_error());
    $row_position = mysql_fetch_array($sql_position);
    
    $sql_empstat = mysql_query("SELECT * from employment_status WHERE e_id = '".$row_emp['status_id']."' ") or die(mysql_error());
    $row_empstat = mysql_fetch_array($sql_empstat);
    
    $sql_company = mysql_query("SELECT * from company WHERE company_id = '".$row_emp['company_id']."' ") or die(mysql_error());
    $row_company = mysql_fetch_array($sql_company);
   
    /*$branch_id = explode("-",$row_user['branch_id']);
    if(empty($branch_id[1])){
    $sql_branch = mysql_query("SELECT * from branches WHERE branch_id = '".$branch_id[0]."' ") or die(mysql_error());
    }else{
    $sql_branch = mysql_query("SELECT * from branches WHERE (branch_id = '".$branch_id[0]."' or branch_id = '".$$branch_id[1]."') ") or die(mysql_error());
    }*/
    $sql_branch = mysql_query("SELECT * from branches WHERE branch_id = '".$row_emp['branch_id']."' ") or die(mysql_error());
    $row_branch = mysql_fetch_array($sql_branch);
    
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
    
    $sql_userhead = mysql_query("SELECT * from users WHERE user_type='4.5'") or die(mysql_error());
    $row_userhead = mysql_fetch_array($sql_userhead);
    $sql_accthead = mysql_query("SELECT * from employees WHERE emp_num = '".$row_userhead['emp_num']."'") or die(mysql_error());
    $row_accthead = mysql_fetch_array($sql_accthead);
    $chk_straccthead = strlen($row_accthead['middlename']);
    if($chk_straccthead > 1){
        $str_countgm = strlen($row_accthead['middlename']) - 1;
        $accthead_middlename = substr($row_accthead['middlename'],0,-$str_countgm);
    }else{
        $accthead_middlename = $row_accthead['middlename'];
    }
    if(empty($row_accthead['middlename'])){
        $accthead_middlename = '';
    }else{
        $accthead_middlename = ', '.$accthead_middlename.'.';
    }
    $accthead_fullname = ucwords($row_accthead['lastname'].', '.$row_accthead['firstname'].$accthead_middlename);
    
    $sql_gmposition = mysql_query("SELECT * from positions WHERE p_id = '".$row_gmname['position_id']."' ") or die(mysql_error());
    $row_gmposition = mysql_fetch_array($sql_gmposition);
    
    $page = @$_GET['active'];
    if($page == 'index'){
        $index = 'active';
    }else if($page == 'view'){
        $view = 'active';
    }else if($page == 'myaccount'){
        $myaccount = 'active';
    }
    
    if(!isset($_SESSION['username-5']) || empty($fullname)){
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
    .prof{
        cursor: pointer;
    }
</style>
<?php
$image_path = "../../images/employee/".$row_emp['emp_num'].".png";
if(file_exists($image_path)){?>
<img src="../../images/employee/<?php echo $row_emp['emp_num'];?>.png" id="myImage">
<?php
}else{?>
<img src="../../images/employee/icon.png" id="myImage">
<?php }
?>
<span class="welcome">Welcome! </span><?php echo $fullname;?> - <span class="jd"><?php echo ucwords($row_position['position']).' (Emp# '.$_SESSION['emp_num'].')';?></span>
<div id='cssmenu'>
    <ul>
        <li class="<?php echo $index;?>"><a href="index.php?active=index"><span class="pages">Home</span></a></li>
        <li class="<?php echo $view;?>"><a><span>Action</span></a>
            <ul> 
                <li class="pages"><span class="prof"><a data-jAlert data-title="Employee Information" title="View" data-fullscreen="true" data-iframe="view_emp_data.php?status=active&active=view&emp_num=<?php echo $_SESSION['emp_num'];?>">My Profile</a></span></li>
                <li class="pages"><a>Leave</a>
                    <ul>
                        <li class="pages"><a href="register_leave.php?active=view">Submit</a></li>
                        <li class="pages"><a href="view_leave.php?active=view">View Submitted Request</a></li>
                        <li class="pages"><a href="view_leave.php?active=view&page=request">Reliever Request</a></li>
                    </ul>
                </li>
                <li class="pages"><a href="view_delinquency.php?status=active&active=view">View Delinquency</a></li>
                <li class="pages"><a href="view_trainingseminar.php?status=active&active=view">View Training & Seminars</a></li>
            </ul>  
        </li>
        <li class='<?php echo @$myaccount;?>'><a><span>My Account</span></a>
            <ul>
                <li><a class="externalAccess">Old MMS</a></li>
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
        -->
<script>
	$(function(){
            //for the data-jAlerts
            $.jAlert('attach');
        });
        
</script>

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