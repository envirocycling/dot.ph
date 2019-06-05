<?php
include('config.php');
session_start();
if (isset($_SESSION['username'])) {
    echo "<script>
window.location = 'dashboard_receiving.php';
</script>";
} else {
mysql_query("UPDATE sup_deliveries set wp_grade ='chipboard' where wp_grade='cb'  ");
mysql_query("UPDATE outgoing set wp_grade ='chipboard'  where wp_grade='cb'  ");
mysql_query("UPDATE bales set wp_grade ='chipboard'  where wp_grade='cb'  ");
mysql_query("UPDATE paper_buying set wp_grade ='mw'  where wp_grade like '%WASTE%'  ");
mysql_query("UPDATE paper_buying set wp_grade ='MW'  where wp_grade like '%mw%'  ");
mysql_query("UPDATE actual set wp_grade ='LCMW'  where wp_grade like '%ap%'  ");

//session_destroy();
//session_start();

$_SESSION['tat_date']=date('Y/m/t');
$_SESSION['planning_month']=date('Y/m');
$_SESSION['planning_date']=date('Y/m/d');
$_SESSION['planning_as_of']=date('Y/m/d');

$_SESSION['receiving_del_ids']=array();
$_SESSION['delivered_to']='';
$_SESSION['outgoing_grade']='';
$_SESSION['receiving_grade']='';

$_SESSION['inter-branch_from']=date('Y/m/01');
$_SESSION['inter-branch_to']=date('Y/m/t');

$_SESSION['paper_buying_branch']='';
$_SESSION['paper_buying_date']=date('Y/m');

$_SESSION['pick_up_branch']='';
$_SESSION['pick_up_date']=date('Y/m');

$_SESSION['sorting_branch']='';
$_SESSION['sorting_date']=date('Y/m');

$_SESSION['receiving_branch']='';
$_SESSION['receiving_date']=date('Y/m/d');

$_SESSION['outgoing_date']=date('Y/m/d');

$_SESSION['bm_from']='';
$_SESSION['bm_to']='';
$_SESSION['current_month']=date('F');
$_SESSION['analysis_from']='';
$_SESSION['analysis_to']='';
$_SESSION['supplier_branch']="";
$_SESSION['bh_criteria']="";
$_SESSION['supplier_name']="";
$_SESSION['supplier_type']="";
$_SESSION['supplier_id']="";
$_SESSION['yearcriteria']=date('Y');
$_SESSION['encoding_supplier_name']='<i>Name will be displayed here</i>';
$_SESSION['encoding_supplier_id']='';
$_SESSION['insert_status']='';
$_SESSION['criteria_wp_grade']='';
$_SESSION['inc_criteria_status']='';
$_SESSION['inc_criteria_grade']='';
$_SESSION['supplier_names_array']=array();
$_SESSION['user_branch']="";
$query = "SELECT * FROM wp_grades  ";
$_SESSION['wp_grades']=array();
$_SESSION['usertype']='';
$_SESSION['weekly_wp_grade']='';
$_SESSION['weekly_branch']='';
$_SESSION['weekly_month']=date('F');
$_SESSION['weekly_year']=date('Y');
$_SESSION['text_report_date']=date('Y/m/d');
$_SESSION['branches']=array();
$result = mysql_query($query) ;
while($row = mysql_fetch_array($result)) {
    array_push($_SESSION['wp_grades'],$row['wp_grade']);
}
$result = mysql_query("SELECT * FROM branches");
while($row = mysql_fetch_array($result)) {
    array_push($_SESSION['branches'],$row['branch_name']);
}
$query = "SELECT supplier_id,supplier_name FROM supplier_details group by supplier_id  ";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)) {
    array_push($_SESSION['supplier_names_array'],$row['supplier_id']."+".$row['supplier_name']);
}
$_SESSION['encoding_branch_delivered']='';
?>
<html>
    <head>
        <title>EFI Inventory Management System</title>
        <link rel="stylesheet" type="text/css" href="mos-css/mos-style.css">
        <!--pemanggilan file css-->    </head>    <body>        <div id="header">
            <div class="inHeaderLogin"></div>        </div>        <div id="loginForm">            <div class="headLoginForm">	Login User            </div>            <div class="fieldLogin">                <form method="POST" action="validation.php">                    <label>Username</label><br>                    <input type="text" class="login" name="username"><br>                    <label>Password</label><br>                    <input type="password" class="login" name="password"><br>                    <input type="submit" class="button" value="Login">                </form>            </div>        </div>    </body></html>


<?php } ?>