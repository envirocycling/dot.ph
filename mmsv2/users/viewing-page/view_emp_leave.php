<?php
date_default_timezone_set("Asia/Singapore");
include("../../connect.php");
session_start();
?>    
<!-- Load css styles -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/pluton.css" />
<link rel="stylesheet" type="text/css" href="css/jquery.cslider.css" />
<link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
<link rel="stylesheet" type="text/css" href="css/animate.css" />
<!-- Fav and touch icons -->
<link rel="stylesheet" href="css/forms_new.css" type="text/css">
<script language="javascript" type="text/javascript" src="js/datetimepicker.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.js"></script>

<script>
    //leave balance computation                             

    $(document).ready(function () {
        var sql_chk_leave = $('#sql_chk_leave').val();
        var if_pending = $('#if_pending').val();
        var if_NotVal = $('#if_NotVal').val();
        var if_cancelled = $('#if_cancelled').val();

        if (if_cancelled != '1') {
            if (if_pending == '1' || if_NotVal == '1') {
                if (sql_chk_leave == '1') {
                    var no_days = Number($('#no_days').val());
                    var bal_sl = Number($('#bal_sl').val());
                    var bal_vl = Number($('#bal_vl').val());

                    if ($('#vl').attr('checked')) {
                        var new_vl = (bal_vl - no_days).toFixed(2);
                        $('#balance_vl').val(new_vl);
                    } else {
                        $('#balance_vl').val(bal_vl);
                    }
                    if ($('#sl').attr('checked')) {
                        var new_sl = (bal_sl - no_days).toFixed(2);
                        $('#balance_sl').val(new_sl);
                    } else {
                        $('#balance_sl').val(bal_sl);
                    }
                }
            }
        }
    });

    //leave balance computation                             
    function f_leave_comp() {

        var chk_leave = $('#sql_chk_leave').val();
        var no_days = $('#no_days').val();
        var bal_vl = Number($('#bal_vl').val());
        var bal_sl = Number($('#bal_sl').val());

        if ($('#vl').attr('checked')) {
            var new_vl = (bal_vl - no_days).toFixed(2);
            $('#balance_vl').val(new_vl);
        } else {
            $('#balance_vl').val(bal_vl);
        }
        if ($('#sl').attr('checked')) {
            var new_sl = (bal_sl - no_days).toFixed(2);
            $('#balance_sl').val(new_sl);
        } else {
            $('#balance_sl').val(bal_sl);
        }

    }
    //end leave balance computation
    //end leave balance computation

</script>
<!----rj end-->
<style>
    body{
        background-color: white;
    }
</style>
<?php
$sql_user = mysql_query("SELECT * from users WHERE user_id = '" . $_SESSION['user_id'] . "'") or die(mysql_error());
$row_user = mysql_fetch_array($sql_user);

$sql_leave_form = mysql_query("SELECT * from leaves WHERE leave_id = '" . $_GET['leave_id'] . "'") or die(mysql_error());
$row_leave_form = mysql_fetch_array($sql_leave_form);

if ($row_leave_form['status'] == 'pending') {
    echo '<input type="hidden" id="if_pending" value="1">';
}if ($row_leave_form['validated'] == 0) {
    echo '<input type="hidden" id="if_NotVal" value="1">';
}

$sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_leave_form['emp_num'] . "'") or die();
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

$sql_branch = mysql_query("SELECT * from branches WHERE branch_id = '" . $row_leave_form['branch_id'] . "'") or die(mysql_error());
$row_branch = mysql_fetch_array($sql_branch);

$sql_position = mysql_query("SELECT * from positions WHERE p_id = '" . $row_leave_form['position_id'] . "' ") or die(mysql_error());
$row_position = mysql_fetch_array($sql_position);


$arr_slvl = array();
$arr_leaves = array();
//leave notation start
$sql_leaves = mysql_query("SELECT * from leaves WHERE emp_num='" . $row_emp['emp_num'] . "' and status LIKE 'approved%'") or die(mysql_error());
$no_leaves = mysql_num_rows($sql_leaves);
while ($row_leaves = mysql_fetch_array($sql_leaves)) {
    if ($row_leaves['validated'] == 1) {
        @$arr_slvl[$row_leaves['leave_type']] += $row_leaves['no_days'];
        @$arr_leaves[$row_leaves['leave_type']] += $row_leaves['no_days'];
    }

    if ($row_leaves['leave_type'] == 'Sick Leave' || $row_leaves['leave_type'] == 'Vacation Leave') {
        @$arr_usedleave += $row_leaves['no_days'];
    }
}
$sql_chk_leave = mysql_query("SELECT * from entitled_leaves WHERE emp_num = '" . $row_emp['emp_num'] . "'") or die();
$row_chk_leave = mysql_fetch_array($sql_chk_leave);
$num_reserved_leave = $row_chk_leave['vl'] + $row_chk_leave['sl'];
@$num_sl = $row_chk_leave['sl'] - $arr_slvl['Sick Leave'];
@$num_vl = $row_chk_leave['vl'] - $arr_slvl['Vacation Leave'];
//leave notation end

echo '<input type="hidden" value="' . $num_sl . '" id="bal_sl">';
echo '<input type="hidden" value="' . $num_vl . '" id="bal_vl">';

if (mysql_num_rows($sql_chk_leave) == 1) {
    echo '<input type="hidden" value="1" id="sql_chk_leave">';
}

//if selected reliever start
$sql_reliever1 = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_leave_form['reliever1_id'] . "'") or die(mysql_error());
if (mysql_num_rows($sql_reliever1) == 0) {
    $sql_reliever1 = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '" . $row_leave_form['reliever1_id'] . "'") or die(mysql_error());
}
$row_reliever1 = mysql_fetch_array($sql_reliever1);
$str_r1 = strlen($row_reliever1['middlename']) - 1;
$middlename1 = substr($row_reliever1['middlename'], 0, -$str_r1);
if (empty($row_reliever1['middlename'])) {
    $middlename1 = '';
} else {
    $middlename1 = ', ' . $middlename1 . '.';
}
$reliever1_name = ucwords($row_reliever1['lastname'] . ', ' . $row_reliever1['firstname'] . $middlename1);
if (mysql_num_rows($sql_reliever1) == 0) {
    $reliever1_name = 'None';
}

$sql_reliever2 = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_leave_form['reliever2_id'] . "'") or die(mysql_error());
if (mysql_num_rows($sql_reliever2) == 0) {
    $sql_reliever2 = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '" . $row_leave_form['reliever2_id'] . "'") or die(mysql_error());
}
$row_reliever2 = mysql_fetch_array($sql_reliever2);
$str_r2 = strlen($row_reliever2['middlename']) - 1;
$middlename2 = substr($row_reliever2['middlename'], 0, -$str_r1);
if (empty($row_reliever2['middlename'])) {
    $middlename2 = '';
} else {
    $middlename2 = ', ' . $middlename2 . '.';
}
$reliever2_name = ucwords($row_reliever2['lastname'] . ', ' . $row_reliever2['firstname'] . $middlename2);
if (mysql_num_rows($sql_reliever2) == 0) {
    $reliever2_name = 'None';
}
//if selected reliever end
//if leave type selected start
if ($row_leave_form['leave_type'] == 'Sick Leave') {
    $leave_sl = 'checked';
} else {
    $leave_sl_attr = 'disabled';
}
if ($row_leave_form['leave_type'] == 'Vacation Leave') {
    $leave_vl = 'checked';
} else {
    $leave_vl_attr = 'disabled';
}
if ($row_leave_form['leave_type'] == 'Leave Without Pay') {
    $leave_lwop = 'checked';
} else {
    $leave_lwop_attr = 'disabled';
}
if ($row_leave_form['leave_type'] == 'Change Schedule') {
    $leave_cs = 'checked';
    $cs = '<u>' . $sql_leave_form['cs_date1'] . '</u> to <u>' . $sql_leave_form['cs_date1'] . '</u>';
} else {
    $leave_cs_attr = 'disabled';
}
if ($row_leave_form['leave_type'] == 'Offset') {
    $leave_os = 'checked';
    $os = '<u>' . $row_leave_form['os_date'] . '</u>';
} else {
    $leave_os_attr = 'disabled';
}
if ($row_leave_form['leave_type'] == 'Holiday Offset') {
    $leave_hos = 'checked';
    $hos = '<u>' . $row_leave_form['hos_date'] . '</u>';
} else {
    $leave_hos_attr = 'disabled';
}
if ($row_leave_form['leave_type'] == 'Others') {
    $leave_o = 'checked';
    $leave_o_specify = '<u>' . $row_leave_form['specify'] . '</u>';
} else {
    $leave_o_attr = 'disabled';
}
//if leave type selected end
//if action is start
if ($row_leave_form['supervisor_status'] == 'approved') {
    $act_sup_app = 'checked';
} else {
    $act_sup_disapp = 'checked';
}
if ($row_leave_form['manager_status'] == 'approved') {
    $act_man_app = 'checked';
} else {
    $act_man_disapp = 'checked';
}
//if action is end
//select gm start
$sql_gmname = mysql_query("SELECT * from employees WHERE emp_num='" . $row_leave_form['manager_id'] . "'") or die(mysql_error());
if (mysql_num_rows($sql_gmname) == 0) {
    $sql_gmname = mysql_query("SELECT * from employees_deactivated WHERE emp_num='" . $sql_leave_form['manager_id'] . "'") or die(mysql_error());
}
$row_gmname = mysql_fetch_array($sql_gmname);
$str_countgm = strlen($row_gmname['middlename']) - 1;
$gm_middlename = substr($row_gmname['middlename'], 0, -$str_countgm);
if (empty($row_gmname['middlename'])) {
    $gm_middlename = '';
} else {
    $gm_middlename = ', ' . $gm_middlename . '.';
}
$gm_fullname = ucwords($row_gmname['lastname'] . ', ' . $row_gmname['firstname'] . $gm_middlename);
//select gm end

/* signatory */
$sql_supervisor = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_leave_form['supervisor_id'] . "'") or die(mysql_error());
$row_supervisor = mysql_fetch_array($sql_supervisor);
$str_count_head = strlen($row_supervisor['middlename']);
if ($str_count_head > 1) {
    $str_count = strlen($row_supervisor['middlename']) - 1;
    $middlename = substr($row_supervisor['middlename'], 0, -$str_count);
} else {
    $middlename = $row_supervisor['middlename'];
}
if (empty($row_supervisor['middlename'])) {
    $middlename = '';
} else {
    $middlename = ', ' . $middlename . '.';
}
$fullname_sup = ucwords($row_supervisor['lastname'] . ', ' . $row_supervisor['firstname'] . $middlename);

//start date
$current_date = strtotime(date('Y/m/d')) . '<br>';
$date = date('Y/m/d', strtotime($row_leave_form['date_submitted']));
//end date
//chk who's cancelled start
$can_mes = 'This request has been cancelled by ';
if ($row_leave_form['cancelled_user_type'] == 1) {
    $can_mes .= 'HR.';
} else if ($row_leave_form['cancelled_user_type'] == 5) {
    $can_mes .= 'Employee.';
}
//chk who's cancelled end
//chk who's cancelled start
$can_mes1 = 'This request has been disapproved by ';
if ($row_leave_form['manager_status'] == 'disapproved') {
    $can_mes1 .= 'GM.';
    $date = date('F d, Y h:i A', strtotime($row_leave_form['manager_date']));
} else if ($row_leave_form['supervisor_status'] == 'disapproved') {
    $can_mes1 .= 'BH.';
    $date = date('F d, Y h:i A', strtotime($row_leave_form['supervisor_date']));
}
//chk who's cancelled end

echo '<center>';
if ($row_leave_form['status'] == 'cancelled') {
    echo '<input type="hidden" value="1" id="if_cancelled">';
    echo '<font color="red"><b><i>' . $can_mes . '</b></i></font><b><i><font size="-1" color="red"><br> at ' . date('F d, Y h:i A', strtotime($row_leave_form['cancelled_date'])) . '</b></i></font><br>';
} else if ($row_leave_form['status'] == 'disapproved') {
    echo '<font color="red"><b><i>' . $can_mes1 . '</b></i></font><b><i><font size="-1" color="red"><br> at ' . $date . '</b></i></font><br>';
}
echo '<div id="form_container">';
echo '<table class="mytable">
                        <tr>
                             <td id="comp_name"><label class="header_medium"><img src="../../images/logo.png" height="50px" width="60px" id="logo">Envirocycling Fiber Inc.</label><br/><label class="header_sub">Ninoy Aquino Highway, Mabalacat City Pampanga</label></td>
                             <td style="text-align: center;"><label class="header_large">Application For Leave And<br><br> Absence Form</label></td>
                        </tr>
                        <tr>
                            <td><div class="small_rectangel"><label class="form_label">Name of Employee: <u>' . $fullname . '</u></label></div></td>
                            <td><div class="small_rectangel"><label class="form_label">Date Filed: <u>' . $date . '</label></div></td>
                        </tr>
                        <tr>
                            <td><div class="small_rectangel"><label class="form_label">Branch / Position: <u>' . $row_branch['branch_name'] . ' / ' . $row_position['position'] . '</u><input type="hidden" value="' . $row_position['p_id'] . '" id="position" name="position" readonly><input type="hidden" value="' . $row_branch['branch_id'] . ' " id="position" name="branch"></label></div></td>';
if ($row_leave_form['validated'] == 1) {
    echo '<td><div class="small_rectangel"><label class="form_label">Date Affected: <u>' . date('Y/m/d H:i', strtotime($row_leave_form['date_affected1'])) . '</u> to <u>' . date('Y/m/d H:i', strtotime($row_leave_form['date_affected1'])) . '</u> &nbsp;&nbsp;&nbsp;No.Days <u>' . $row_leave_form['no_days'] . '</u><input type="hidden" style="width:30px;" id="no_days" value="' . $row_leave_form['no_days'] . '" required></label></div></td>';
} else {
    echo '<td><div class="small_rectangel"><label class="form_label">Date Affected: <input class="dates" type="text" style="width:150px;height:30px;" id="datetimepicker" name="date_affected1" value="' . date('Y/m/d h:i A', strtotime($row_leave_form['date_affected1'])) . '" autocomplete="off" required/> to <input type="text" class="dates" style="width:150px;height:30px;" value="' . date('Y/m/d h:i A', strtotime($row_leave_form['date_affected2'])) . '" id="datetimepicker2" name="date_affected2" autocomplete="off" required/> No.Days <input type="text" style="width:45px; height:30px;" onKeypress="return isNumber(event);" onKeyup="f_leave_comp()" id="no_days" value="' . $row_leave_form['no_days'] . '" name="no_days" required></label></div></td>';
}
echo '</tr>
                </table>';

echo '<table class="mytable2">
                        <tr>
                            <td class="td" id="second_table_td1"><label style="font-weight: bold;">LEAVE TYPE: (Please tick your corresponding leave type)</label><br>
                                <div class="leave_type"><input type="checkbox" name="leave_type" class="leave" id="sl" value="Sick Leave" onclick="f_leave(this.id), f_leave_comp()" ' . @$leave_sl . ' ' . @$leave_sl_attr . '>Sick Leave</div>
                                <div class="leave_type"><input type=\'checkbox\' name=\'leave_type\' class=\'leave\' id=\'vl\' value=\'Vacation Leave\'  onclick=\'f_leave(this.id), f_leave_comp()\' ' . @$leave_vl . ' ' . @$leave_vl_attr . '>Vacation Leave</div>
                                <div class="leave_type"><input type=\'checkbox\' name=\'leave_type\' class=\'leave\'  id=\'lwop\' value=\'Leave Without Pay\' onclick=\'f_leave(this.id), f_leave_comp()\' ' . @$leave_lwop . ' ' . @$leave_lwop_attr . '>Leave w/o Pay(LWOP)</div><div class="leave_type"><input type=\'checkbox\' name=\'leave_type\' class=\'leave\' id=\'cs\' value=\'Change Schedule\' onclick=\'f_leave(this.id), f_leave_comp()\' ' . @$leave_cs . ' ' . @$leave_cs_attr . '>Change Schedule</div><div class="leave_type2">' . @$cs . '</div><div class="leave_type2"><input type=\'checkbox\' name=\'leave_type\' class=\'leave\'  id=\'os\' value=\'Offset\' onclick=\'f_leave(this.id)\' ' . @$leave_os . ' ' . @$leave_os_attr . '>Offset ' . @$os . '</div>
                                <div class="leave_type2"><input type=\'checkbox\' name=\'leave_type\' class=\'leave\'  id=\'hos\' value=\'Holiday Offset\' onclick=\'f_leave(this.id), f_leave_comp()\' ' . @$leave_hos . ' ' . @$leave_hos_attr . '>Holiday Offset(HO) ' . @$hos . '</div>
                                <div class="leave_type2"><input type=\'checkbox\' name=\'leave_type\' class=\'leave\'  id=\'others\' value=\'Others\' onClick=\'f_leave(this.id), f_leave_comp()\' ' . @$leave_o . ' ' . @$leave_o_attr . '>Others (pls.specify): ' . @$leave_o_specify . '</div><br><br><br><br><br><br><br><br>
                                <div id="reason">Reason:(give specific reason)</div><div id="textarea"><textarea name=\'reason\' rows="5" id=\'reason\' disabled>' . $row_leave_form['reason'] . '</textarea>'; //echo '<span class="remarks" hidden>Remarks: <br/><textarea type="text" cols="20" rows="3" style=" font-size:16px; font-weight:bold;" id="txt_remarks" readonly></textarea></span></div>
echo'</td>
                            <td align="center"><div id="reliever">DUTIES WILL BE PERFORMED BY: </div>';
//reliever 1 signature start 
if ($row_leave_form['reliever1_id'] > 0) {

    echo '<div class="signature_reliever">';
    if ($row_leave_form['reliever1_status'] == 'approved') {
        $image_path = "../../images/signature/" . $row_leave_form['reliever1_id'] . ".png";
        if (file_exists($image_path)) {
            echo '<img src="../../images/signature/' . $row_leave_form['reliever1_id'] . '.png" height="40" width="90">';
        } else {
            echo '<br><br><font color="red"><b>Approved</b></font>';
        }
    }
    echo '</div>';
    //reliever 1 signature end  
    echo '<u>' . $reliever1_name . '</u>';
    echo '<div id="reliever_name">(Signature over printed name)</div>';
}
//reliever 2 signature start 
if ($row_leave_form['reliever2_id'] > 0) {

    echo '<div class="signature_reliever">';
    if ($row_leave_form['reliever2_status'] == 'approved') {
        $image_path = "../../images/signature/" . $row_leave_form['reliever2_id'] . ".png";
        if (file_exists($image_path)) {
            echo '<img src="../../images/signature/' . $row_leave_form['reliever2_id'] . '.png" height="40" width="90">';
        } else {
            echo '<br><br><font color="red"><b>Approved</b></font>';
        }
    }
    echo '</div>';
    //reliever 2 signature end  
    echo '<u>' . $reliever2_name . '</u>';
    echo '<div id="reliever_name">(Signature over printed name)</div>';
}
echo '</td>
                        </tr>
                </table>';

echo '<table class="mytable3">
                        <tr>
                            <td class="tbl3_td1"><div id="action_taken">ACTION TAKEN:</div>';
if ($row_leave_form['supervisor_status'] == 'approved') {
    $attr_supAp = 'checked';
} else if ($row_leave_form['supervisor_status'] == 'disapproved') {
    $attr_supDis = 'checked';
}if ($row_leave_form['manager_status'] == 'approved') {
    $attr_gmAp = 'checked';
} else if ($row_leave_form['manager_status'] == 'disapproved') {
    $attr_gmDis = 'checked';
}
echo '<div class="supervisor">Immediate Supervisor :&nbsp; </div><div class="action"><input type="checkbox" name="supervisor_action" id="supervisor_approved" value="approved" ' . @$attr_supAp . '>approved</div><div class="action"><input type="checkbox" name="supervisor_action" id="supervisor_disapproved" value="not approved" ' . @$attr_supDis . '>not approved</div>
<div class="action_name">';
if ($row_leave_form['supervisor_status'] == 'approved') {
    echo '<img src="../../images/signature/' . $row_leave_form['supervisor_id'] . '.png" height="40" width="90">';
}
echo '<label class="approver">' . $fullname_sup . '</label></div>';
echo '<br/><br/><div id="app_from"><span style="width:32%;" >&nbsp;</span></div><div class="action_name2">Signature over printed name</div><br><br><br><br>';

echo '<br><br><br><div class="supervisor">Operations Manager : &nbsp;</div><div class="action"><input type=\'checkbox\' name=\'manager_action\' id=\'manager_approved\' value=\'approved\' ' . @$attr_gmAp . '>approved</div><div class="action"><input type=\'checkbox\' name=\'manager_action\' id=\'manager_disapproved\' value=\'not approved\' ' . @$attr_gmDis . '>not approved</div><div class="action_name">';

//supervisor if approved start
if ($row_leave_form['manager_status'] == 'approved') {
    echo '<img src="../../images/signature/' . $row_gmname['emp_num'] . '.png" height="40" width="90">';
}
//supervisor if approved end
echo '<label class="approver">' . $gm_fullname . '</label><input type=\'hidden\' value="' . $row_gmname['emp_num'] . '" id=\'manager_name\' name=\'manager\' size=25 readonly class="approver"></div><br/><br/>';
// <div id="app_from"><input type=\'checkbox\' name=\'manager_action\' id=\'manager_approved_from\' value=\'approved from\'>approved from <input type=\'text\' value=\'\' id=\'manager_from\' name=\'manager_from\'  style="width:16%;" > - <input type=\'text\' value=\'\' id=\'manager_to\' name=\'manager_to\' style="width:16%;" ></div><div class="action_name2">Signature over printed name</div><br><br><br><br>
echo '<div id="app_from"><span style="width:32%;" >&nbsp;</span></div><div class="action_name2">Signature over printed name</div><br><br>';
echo '</td>
                            <td class="tbl3_td2"><div id="hr_not">HR Notation (Days): <br><center><h4><i>No. of Leave Submitted</i></h4></center></div>
                                <div class="hr_label">SL: <span class="leave_summary">' . round(@$arr_leaves['Sick Leave'], 2) . '</span></div>
                                <div class="hr_label">VL: <span class="leave_summary">' . round(@$arr_leaves['Vacation Leave'], 2) . '</span></div>
                                <div class="hr_label">LWOP: <span class="leave_summary">' . round(@$arr_leaves['Leave Without Pay'], 2) . '</span></div>
                                <div class="hr_label">CS: <span class="leave_summary">' . round(@$arr_leaves['Change Schedule'], 2) . '</span></div>
                                <div class="hr_label">Offset: <span class="leave_summary">' . round(@$arr_leaves['Offset'], 2) . '</span></div>
                                <div class="hr_label">HO: <span class="leave_summary">' . round(@$arr_leaves['Holiday Offset'], 2) . '</span></div>
                                <div class="hr_label_val">Leave Balance After This: <br><div style="width: 50%; float: left">VL: <input type="text" value="' . $num_vl . '" id="balance_vl"  name="balance_vl" style="width:50%;" readonly></div><div style="width: 50%; float: left">SL: <input type="text" value="' . $num_sl . '" id="balance_sl"  style="width:50%;" name="balance_sl" readonly></div></div>
                            </td>
                        </tr>
                   </table>';
?>
</center>
<br><br><br>
</div>
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<script src="js/jquery.js"></script>
<script src="js/jquery.datetimepicker.full.js"></script>
<script>

    $('.dates').keydown(false);
//date picker1 start
    $('#datetimepicker').datetimepicker({
        dayOfWeekStart: 1,
        lang: 'en',
        format: 'Y/m/d h:i A',
        disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
        startDate: '2016'
    });
    $('#datetimepicker').datetimepicker({value: '', step: 30});
//date picker1 end

//date picker2 start
    $('#datetimepicker2').datetimepicker({
        dayOfWeekStart: 1,
        lang: 'en',
        format: 'Y/m/d h:i A',
        disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
        startDate: '2016'
    });
    $('#datetimepicker2').datetimepicker({value: '', step: 30});
//date picker2 end
</script>
<iframe width="80%" frameborder="none" height="600" src="../../comment/leave/index.php?leave_id=<?php echo $_GET['leave_id']; ?>" id="iframe"></iframe> 
