<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/del_form.css">
<script type="text/javascript" src="validation/jquery.min.js"></script>
<style>
    @media screen, print{
        .sig{
            font-style: italic;
            color: blue;
        }
    }
</style>
<?php
include("../../connect.php");
date_default_timezone_set("Asia/Singapore");

$sql_nte = mysql_query("SELECT * from nte WHERE nte_id = '" . $_GET['nte_id'] . "'") or die(mysql_error());
$row_nte = mysql_fetch_array($sql_nte);

$sql_del = mysql_query("SELECT * from delinquency WHERE nte='" . $row_nte['nte_id'] . "'");
$row_del = mysql_fetch_array($sql_del);
$actions = mysql_real_escape_string($row_del['action']) . ". issued <a href=\"view_emp_nte.php?nte_id=" . $row_nte['nte_id'] . "\" target=\"_blank\">Notice ot Explain</a>";
if ($row_del['action_date'] == '0000-00-00') {
    $aDate = date('Y-m-d');
} else {
    $aDate = $row_del['action_date'];
}
if ($row_nte['supervisor_num'] > 0) {
    mysql_query("UPDATE delinquency SET action='issued <a href=\"view_emp_nte.php?nte_id=" . $row_nte['nte_id'] . "\" target=\"_blank\">Notice ot Explain</a>', action_date='$aDate', implementation_status='pending to supervisor', print='1' WHERE nte='" . $row_nte['nte_id'] . "' and print='0'");
} else {
    mysql_query("UPDATE delinquency SET action='issued <a href=\"view_emp_nte.php?nte_id=" . $row_nte['nte_id'] . "\" target=\"_blank\">Notice ot Explain</a>', action_date='$aDate', print='1' WHERE nte='" . $row_nte['nte_id'] . "' and print='0'");
}
$sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_nte['emp_num'] . "'") or die(mysql_error());
if (mysql_num_rows($sql_emp) == 0) {
    $sql_emp = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '" . $row_nte['emp_num'] . "'") or die(mysql_error());
}
$row_emp = mysql_fetch_array($sql_emp);
$chk_count = strlen($row_emp['middlename']);
if ($chk_count > 1) {
    $str_counted = strlen($row_emp['middlename']) - 1;
    $middle = ', ' . substr($row_emp['middlename'], 0, -$str_counted) . '.';
} else {
    $middle = ', ' . $row_emp['middlename'] . '.';
}
$employee_fullname = ucwords($row_emp['lastname'] . ', ' . $row_emp['firstname'] . $middle);


if ($row_nte['supervisor_num'] > 0) {
    $sql_sup = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_nte['supervisor_num'] . "'") or die(mysql_error());
    if (mysql_num_rows($sql_sup) == 0) {
        $sql_sup = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '" . $row_nte['supervisor_num'] . "'") or die(mysql_error());
    }
    $row_sub = mysql_fetch_array($sql_sup);
    $chk_count = strlen($row_sub['middlename']);
    if ($chk_count > 1) {
        $str_counted = strlen($row_sub['middlename']) - 1;
        $middle_sub = ', ' . substr($row_sub['middlename'], 0, -$str_counted) . '.';
    } else {
        $middle_sub = ', ' . $row_sub['middlename'] . '.';
    }
    $employee_fullname_sub = ucwords($row_sub['lastname'] . ', ' . $row_sub['firstname'] . $middle_sub);

    $sub_pos = mysql_query("SELECT * from positions WHERE p_id = '" . $row_sub['position_id'] . "'") or die(mysql_error());
    $row_pos = mysql_fetch_array($sub_pos);
    $rowPos = $row_pos['position'];

    $supSig = '<img src="../../images/signature/' . $row_nte['supervisor_num'] . '.png" width="50"><br/>';
} else {
    $emp_company1 = mysql_query("SELECT * from company WHERE company_id = '" . $row_nte['company_id'] . "' ") or die(mysql_error());
    $row_emp_company1 = mysql_fetch_array($emp_company1);
    $employee_fullname_sub = $row_emp_company1['name'];
    $rowPos = $row_emp_company1['description'];
    $supSig = '<span class="sig">Signed</span>';
}

$sql_dep = mysql_query("SELECT * from departments WHERE dep_id = '" . $row_nte['dep_id'] . "'") or die(mysql_error());
$row_dep = mysql_fetch_array($sql_dep);

$emp_position = mysql_query("SELECT * from positions WHERE p_id = '" . $row_nte['position_id'] . "' ") or die(mysql_error());
$row_emp_position = mysql_fetch_array($emp_position);

$emp_branch = mysql_query("SELECT * from branches WHERE branch_id = '" . $row_nte['branch_id'] . "' ") or die(mysql_error());
$row_emp_branch = mysql_fetch_array($emp_branch);

$emp_company = mysql_query("SELECT * from company WHERE company_id = '" . $row_nte['company_id'] . "' ") or die(mysql_error());
$row_emp_company = mysql_fetch_array($emp_company);
?>
<style>
    .txt2{
        text-indent: 70px;
        font-weight: bold;
        font-size: 14px;
    }
    .txt{
        font-weight: bold;
        padding-top: 14px;
        width: 250px;
    }
    .txt3{
        font-weight: bold;
        padding-top: 20px;
        font-size: 11px;
    }
    .txt4{
        font-size: 11px;
        padding-top: 10px;
    }
    .txt5{
        font-size: 14px;
        font-weight: lighter;
        padding-top: 0px;
        text-transform: uppercase;
    }
    .txt6{
        font-size: 13px;
    }
    select{
        width: 350px;
    }
    table{
        width: 95%;
        text-align: justify;
        text-justify: inter-word;
    }
</style>
<script>
    $(document).ready(function () {
        print();
    });
</script>
<?php
$logo = "../../images/company_logo/" . $row_nte['company_id'] . ".png";
if (file_exists($logo)) {
    $img = '<img src="../../images/company_logo/' . $row_nte['company_id'] . '.png" height="60px" width="60px">';
} else {
    $img = '';
}
?>
<center>
    <table>
        <tr>
            <td style="color: gray; font-size: 16px;" colspan="2"><?php echo $img . '<b>' . $row_emp_company['description'] . '</b>'; ?></td>
            <td style="text-align: right; color: gray; width: 250px; font-size: 20px;"><b>NOTICE TO EXPLAIN</b></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td style="text-align: right; color: gray; font-size: 16px;"><?php echo date('F d, Y', strtotime($row_nte['date_submitted'])) ?></td>
        </tr>
        <tr>
            <td class="txt">TO:</td>
        </tr>
        <tr>
            <td class="txt2">EMPLOYEE NAME :</td>
            <td colspan="2" class="txt5"><?php echo $employee_fullname; ?></td>
        </tr>
        <tr>
            <td class="txt2">POSITION :</td>
            <td class="txt5" id="emp_position" colspan="2"><?php echo $row_emp_position['position']; ?></td>
        </tr>
        <tr>
            <td class="txt2">BRANCH :</td>
            <td class="txt5" colspan="2"><?php echo $row_emp_branch['branch_name']; ?></td>
        </tr>
        <tr>
            <td class="txt">RE :</td>
            <td colspan="2" class="txt5"><?php echo $row_del['violation']; ?></td>
        </tr>
        <tr>
            <td class="txt">FR :</td>
            <td colspan="2" class="txt5"><?php echo $row_dep['description']; ?></td>
        </tr>
        <tr>
            <td colspan="3"><hr></td>
        </tr>
        <tr>
            <td colspan="3" class="txt6">This office has received information/complaint of your alleged violation of company policy detailed hereunder: </td>
        </tr>
        <tr>
            <td colspan="3" class="txt6"><?php echo '<br/><b><i>' . nl2br(utf8_encode($row_nte['description'])) . '</i></b>'; ?></textarea></td>
        </tr>
        <tr>
            <td colspan="3" class="txt6"><br />In which it is a clear violation of our Company rules on <b>(Violated Company Policies)</b><br /><br />
                Please explain in writing and submit to the undersigned a letter explaining your side <b>within 120 hours</b> upon receipt of this notice. Failure to submit your explanation within the period above means that you waive your right to be heard and the management will decide on your case on the basis of the evidence at hand, and if warranted, impose the appropriate sanction.
                <br /><br /><br /><br />Please be guided accordingly.<br />
            </td>
        </tr>
        <tr>
            <td colspan="2"><?php echo $supSig.'<br/><span class="txt3">' . $employee_fullname_sub . '</span><br><span class="txt4">' . $rowPos . '</span><br /><br /><br />'; ?></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" class="txt4">Received By:</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"><?php echo '<br /><br /><span class="txt3" id="emp_name">' . $employee_fullname . '</span><br><span class="txt4" id="emp_position2">' . $row_emp_position['position'] . '</span><br/><br/><span class="txt4">Date Received: _______________________</span>'; ?></td>
            <td></td>
        </tr>
    </table>
</center>
