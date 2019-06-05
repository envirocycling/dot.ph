<style>
    @media print
    {    
        .no-print
        {
            display: none !important;
        }
        .yes-print{
            display: block;
            text-transform: capitalize;
        }
    }
    table{
        font-family: Arial;
        font-size: 11px;
        width: 90%;
        border-collapse: collapse;
    }
    p{
        text-align: justify;
        text-justify: inter-word;
        font-size: 11px;
    }
    .center{
        text-align: center;
        font-weight: bold;
    }
    .center2{
        text-align: center;
        border-top: double black;
        border-bottom: double black;
        font-weight: bold;
    }
    .left{
        text-align: left;
        padding-left: 30px;
    }
    .left2{
        text-align: left;
        border-bottom: solid black;
        border-width: 1px;
        font-weight: bold;
    }
    .left3{
        text-align: left;
        font-weight: bold;
    }
    .center3{
        text-align: center;
        vertical-align: bottom;
        border-bottom: solid black;
        border-right: solid white;
        border-right-width: 20px;
        border-bottom-width: 1px;
        font-weight: bold;
        font-size: 11px;
    }
    .center3n5{
        text-align: center;
        vertical-align: bottom;
        border-bottom: solid black;
        border-right: solid white;
        border-right-width: 20px;
        border-bottom-width: 1px;
        font-weight: bold;
        font-size: 11px;
        width: 225px;
    }
    .center3n6{
        text-align: center;
        vertical-align: bottom;
        border-bottom: solid black;
        border-right: solid white;
        border-right-width: 20px;
        border-bottom-width: 1px;
        font-weight: bold;
        font-size: 11px;
        width: 120px;
    }
    .center3n7{
        text-align: center;
        vertical-align: bottom;
        border-bottom: solid black;
        border-right: solid white;
        border-right-width: 20px;
        border-bottom-width: 1px;
        font-size: 10px;
        height: 50px;
        width: 310px;
    }
    .center4{
        text-align: center;
        border-right: solid white;
        border-right-width: 20px;
        border-bottom-width: 1px;
        font-weight: 500;
        font-size: 10px;
    }
</style>
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $.each($('select'), function () {
            var _slctName = this.name;

            $.each($('[name=' + _slctName + '] option'), function () {
                var _val = this.text.toUpperCase();
                var _spnVal = $('#SPN' + _slctName).text();
                if (_val === _spnVal) {
                    $(this).prop('selected', true);
                }
            });
        });
        $('select').change(function () {
            var _remarks = encodeURIComponent(prompt("Kindly input a remarks or you can leave this empty."));
            var _name = this.name;
            var _value = this.value;
            var _emp = "<?php echo $_GET['emp_num']; ?>";
            var _nameSplit = _name.split('_');
            var _remarksActor = _nameSplit[0] + '_remarks';
            if (_remarks === 'null') {
                var _remarks = '';
            }

            $.ajax({
                url: 'clearance_pro.php?statusActor=' + _name + '&status=' + _value + '&remarks=' + _remarks + '&emp_num=' + _emp + '&remarksActor=' + _remarksActor,
                async: false
            }).done(function () {
                if (_value !== 'cleared') {
                    $('#spnActionAccounting').text(_value).css('color', 'red');
                } else {
                    $('#spnActionAccounting').text(_value);
                }
                location.reload();
            });
        });

        $('button').click(function () {
            var _val = this.value;
            var _emp = "<?php echo $_GET['emp_num']; ?>";
            var _name = this.name;
            $.ajax({
                url: 'clearance_pro.php?statusActor=' + _name + '&status=' + _val + '&emp_num=' + _emp,
                async: false
            }).done(function () {
                location.reload();
            });

        });
    });
</script>
<?php
@session_start();
$session_num = $_SESSION['emp_num'];
if ($session_num < 1) {
    echo '<script>
            location.replace("../index.php");
        </script>';
}
include('../connect.php');

$emp_num = $_GET['emp_num'];

$sql_separated = mysql_query("SELECT * from employees_deactivated WHERE emp_num='$emp_num'");
if (mysql_num_rows($sql_separated) == 1) {
    $row_separated = mysql_fetch_array($sql_separated);

    $sql_branch = mysql_query("SELECT * from branches WHERE branch_id='" . $row_separated['branch_id'] . "'");
    $row_branch = mysql_fetch_array($sql_branch);

    $sql_company = mysql_query("SELECT * from company WHERE company_id='" . $row_separated['company_id'] . "'");
    $row_company = mysql_fetch_array($sql_company);

    $sql_position = mysql_query("SELECT * from positions WHERE p_id='" . $row_separated['position_id'] . "'");
    $row_position = mysql_fetch_array($sql_position);

    $sql_status = mysql_query("SELECT * from employment_status WHERE e_id='" . $row_separated['status_id'] . "'");
    $row_status = mysql_fetch_array($sql_status);

    $chk_str = strlen($row_separated['middlename']);
    if ($chk_str > 1) {
        $str_count = strlen($row_separated['middlename']) - 1;
        $middlename = substr($row_separated['middlename'], 0, -$str_count);
    } else {
        $str_count = strlen($row_separated['middlename']);
        $middlename = $row_separated['middlename'];
    }
    if (empty($row_separated['middlename'])) {
        $middlename = ' ';
    } else {
        $middlename = ' ' . $middlename . '. ';
    }
    $fullname = strtoupper($row_separated['firstname'] . ' ' . $middlename . ' ' . $row_separated['lastname']);

    $sql_clearance = mysql_query("SELECT * from form_clearance WHERE emp_num='$emp_num'") or die(mysql_error());
    $row_clearance = mysql_fetch_array($sql_clearance);

    $sql_accounting = mysql_query("SELECT * from employees WHERE emp_num='" . $row_clearance['accounting_num'] . "'");
    if (mysql_num_rows($sql_accounting) == 0) {
        $sql_accounting = mysql_query("SELECT * from employees_deactivated WHERE emp_num='" . $row_clearance['accounting_num'] . "'");
    }
    $row_accounting = mysql_fetch_array($sql_accounting);
    $chk_str = strlen($row_accounting['middlename']);
    if ($chk_str > 1) {
        $str_count = strlen($row_accounting['middlename']) - 1;
        $middlename = substr($row_accounting['middlename'], 0, -$str_count);
    } else {
        $str_count = strlen($row_accounting['middlename']);
        $middlename = $row_accounting['middlename'];
    }
    if (empty($row_accounting['middlename'])) {
        $middlename = '';
    } else {
        $middlename = ' ' . $middlename . '. ';
    }
    $fullnameAccounting = strtoupper($row_accounting['firstname'] . $middlename . $row_accounting['lastname']);

    $sql_supervisor = mysql_query("SELECT * from employees WHERE emp_num='" . $row_clearance['supervisor_num'] . "'");
    if (mysql_num_rows($sql_supervisor) == 0) {
        $sql_supervisor = mysql_query("SELECT * from employees_deactivated WHERE emp_num='" . $row_clearance['supervisor_num'] . "'");
    }
    $row_supervisor = mysql_fetch_array($sql_supervisor);
    $chk_str = strlen($row_supervisor['middlename']);
    if ($chk_str > 1) {
        $str_count = strlen($row_supervisor['middlename']) - 1;
        $middlename = substr($row_supervisor['middlename'], 0, -$str_count);
    } else {
        $str_count = strlen($row_supervisor['middlename']);
        $middlename = $row_supervisor['middlename'];
    }
    if (empty($row_supervisor['middlename'])) {
        $middlename = '';
    } else {
        $middlename = ' ' . $middlename . '. ';
    }
    $fullnameSupervisor = strtoupper($row_supervisor['firstname'] . $middlename . $row_supervisor['lastname']);

    $sql_treasury = mysql_query("SELECT * from employees WHERE emp_num='" . $row_clearance['treasury_num'] . "'");
    if (mysql_num_rows($sql_treasury) == 0) {
        $sql_treasury = mysql_query("SELECT * from employees_deactivated WHERE emp_num='" . $row_clearance['treasury_num'] . "'");
    }
    $row_treasury = mysql_fetch_array($sql_treasury);
    $chk_str = strlen($row_treasury['middlename']);
    if ($chk_str > 1) {
        $str_count = strlen($row_treasury['middlename']) - 1;
        $middlename = substr($row_treasury['middlename'], 0, -$str_count);
    } else {
        $str_count = strlen($row_treasury['middlename']);
        $middlename = $row_treasury['middlename'];
    }
    if (empty($row_treasury['middlename'])) {
        $middlename = '';
    } else {
        $middlename = ' ' . $middlename . '. ';
    }
    $fullnameTreasury = strtoupper($row_treasury['firstname'] . $middlename . $row_treasury['lastname']);

    $sql_hr = mysql_query("SELECT * from employees WHERE emp_num='" . $row_clearance['hr_num'] . "'");
    if (mysql_num_rows($sql_hr) == 0) {
        $sql_hr = mysql_query("SELECT * from employees_deactivated WHERE emp_num='" . $row_clearance['hr_num'] . "'");
    }
    $row_hr = mysql_fetch_array($sql_hr);
    $chk_str = strlen($row_hr['middlename']);
    if ($chk_str > 1) {
        $str_count = strlen($row_hr['middlename']) - 1;
        $middlename = substr($row_hr['middlename'], 0, -$str_count);
    } else {
        $str_count = strlen($row_hr['middlename']);
        $middlename = $row_hr['middlename'];
    }
    if (empty($row_hr['middlename'])) {
        $middlename = '';
    } else {
        $middlename = ' ' . $middlename . '. ';
    }
    $fullnameHr = strtoupper($row_hr['firstname'] . $middlename . $row_hr['lastname']);

    $sql_it = mysql_query("SELECT * from employees WHERE emp_num='" . $row_clearance['it_num'] . "'");
    if (mysql_num_rows($sql_it) == 0) {
        $sql_it = mysql_query("SELECT * from employees_deactivated WHERE emp_num='" . $row_clearance['it_num'] . "'");
    }
    $row_it = mysql_fetch_array($sql_it);
    $chk_str = strlen($row_it['middlename']);
    if ($chk_str > 1) {
        $str_count = strlen($row_it['middlename']) - 1;
        $middlename = substr($row_it['middlename'], 0, -$str_count);
    } else {
        $str_count = strlen($row_it['middlename']);
        $middlename = $row_it['middlename'];
    }
    if (empty($row_it['middlename'])) {
        $middlename = '';
    } else {
        $middlename = ' ' . $middlename . '. ';
    }
    $fullnameIt = strtoupper($row_it['firstname'] . $middlename . $row_it['lastname']);

    $sql_gm = mysql_query("SELECT * from employees WHERE emp_num='" . $row_clearance['gm_num'] . "'");
    if (mysql_num_rows($sql_gm) == 0) {
        $sql_gm = mysql_query("SELECT * from employees_deactivated WHERE emp_num='" . $row_clearance['gm_num'] . "'");
    }
    $row_gm = mysql_fetch_array($sql_gm);
    $chk_str = strlen($row_gm['middlename']);
    if ($chk_str > 1) {
        $str_count = strlen($row_gm['middlename']) - 1;
        $middlename = substr($row_gm['middlename'], 0, -$str_count);
    } else {
        $str_count = strlen($row_gm['middlename']);
        $middlename = $row_gm['middlename'];
    }
    if (empty($row_gm['middlename'])) {
        $middlename = '';
    } else {
        $middlename = ' ' . $middlename . '. ';
    }
    $fullnameGm = strtoupper($row_gm['firstname'] . $middlename . $row_gm['lastname']);

    if ($row_clearance['accounting_status'] == 'cleared') {
        $signatureAccounting = '<img src="../images/signature/' . $row_clearance['accounting_num'] . '.png" style="height:35px"><br>';
        $dateAcounting = strtoupper(date('M d, Y', strtotime($row_clearance['accounting_date'])));
        $statusAccounting = strtoupper($row_clearance['accounting_status']);
    } else {
        $signatureAccounting = '<div style="height:35px"></div><br />';
        $dateAcounting = '';
        $statusAccounting = '<font color="red">' . strtoupper($row_clearance['accounting_status']) . '</font>';
    }
    if ($row_clearance['supervisor_status'] == 'cleared') {
        $signatureSupervisor = '<img src="../images/signature/' . $row_clearance['supervisor_num'] . '.png" style="height:35px"><br>';
        $dateSupervisor = strtoupper(date('M d, Y', strtotime($row_clearance['supervisor_date'])));
        $statusSupervisor = strtoupper($row_clearance['supervisor_status']);
    } else {
        $signatureSupervisor = '<div style="height:35px"></div><br />';
        $dateSupervisor = '';
        $statusSupervisor = '<font color="red">' . strtoupper($row_clearance['supervisor_status']) . '</font>';
    }
    if ($row_clearance['treasury_status'] == 'cleared') {
        $signatureTreasury = '<img src="../images/signature/' . $row_clearance['treasury_num'] . '.png" style="height:35px"><br>';
        $dateTreasury = strtoupper(date('M d, Y', strtotime($row_clearance['treasury_date'])));
        $statusTreasury = strtoupper($row_clearance['treasury_status']);
    } else {
        $signatureTreasury = '<div style="height:35px"></div><br />';
        $dateTreasury = '';
        $statusTreasury = '<font color="red">' . strtoupper($row_clearance['treasury_status']) . '</font>';
    }
    if ($row_clearance['hr_status'] == 'cleared') {
        $signatureHr = '<img src="../images/signature/' . $row_clearance['hr_num'] . '.png" style="height:35px"><br>';
        $dateHr = strtoupper(date('M d, Y', strtotime($row_clearance['hr_date'])));
        $statusHr = strtoupper($row_clearance['hr_status']);
    } else {
        $signatureHr = '<div style="height:35px"></div><br />';
        $dateHr = '';
        $statusHr = '<font color="red">' . strtoupper($row_clearance['hr_status']) . '</font>';
    }
    if ($row_clearance['it_status'] == 'cleared') {
        $signatureIt = '<img src="../images/signature/' . $row_clearance['it_num'] . '.png" style="height:35px"><br>';
        $dateIt = strtoupper(date('M d, Y', strtotime($row_clearance['it_date'])));
        $statusIt = strtoupper($row_clearance['it_status']);
    } else {
        $signatureIt = '<div style="height:35px"></div><br />';
        $dateIt = '';
        $statusIt = '<font color="red">' . strtoupper($row_clearance['it_status']) . '</font>';
    }

    if ($row_clearance['emp_status'] == '1') {
        $dateEmp = strtoupper(date('M d, Y', strtotime($row_clearance['emp_date'])));
        $signatureEmp = '<img src="../images/signature/' . $row_clearance['emp_num'] . '.png" style="height:35px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;' . $dateEmp . '<br>';
    } else {
        $signatureEmp = '<div style="height:30px"></div><br />';
    }

    if ($row_clearance['gm_status'] == '1') {
        $signatureGm = '<img src="../images/signature/' . $row_clearance['gm_num'] . '.png" style="height:35px"><br>';
    } else if ($row_clearance['gm_status'] == '3') {
        $signatureGm = '<div style="height:35px"><font color="red">DISAPPROVED</font></div><br>';
    } else {
        if($row_clearance['gm_num'] == $session_num && $row_clearance['accounting_status'] == 'cleared' && $row_clearance['supervisor_status'] == 'cleared' && $row_clearance['treasury_status'] == 'cleared'
                 && $row_clearance['hr_status'] == 'cleared' && $row_clearance['it_status'] == 'cleared') {
            $signatureGm = '<div style="height:35px"><button class="btn btn-success" name="gm_status" value="1">Approve</button> | <button class="btn btn-danger" name="gm_status" value="3">Disapprove</button></div><br />';
        }else{
            $signatureGm = '<div style="height:35px"></div><br>';
        }
        if ($row_clearance['accounting_num'] != $session_num) {
            $statusAccounting = $statusAccounting;
        } else {
            $statusAccounting = '<select name="accounting_status" class="no-print" required>
                                <option value="" selected>Please select</option>
                                <option value="cleared">Cleared</option>
                                <option value="with outstanding">With Outstanding</option>
                            </select><span class="yes-print" id="SPNaccounting_status" hidden>' . $statusAccounting . '</span>';
        }

        if ($row_clearance['supervisor_num'] != $session_num) {
            $statusSupervisor = $statusSupervisor;
        } else {
            $statusSupervisor = '<select name="supervisor_status" class="no-print" required>
                                <option value="" selected>Please select</option>
                                <option value="cleared">Cleared</option>
                                <option value="with outstanding">With Outstanding</option>
                            </select><span class="yes-print" id="SPNsupervisor_status" hidden>' . $statusSupervisor . '</span>';
        }

        if ($row_clearance['treasury_num'] != $session_num) {
            $statusTreasury = $statusTreasury;
        } else {
            $statusTreasury = '<select name="treasury_status" class="no-print" required>
                                <option value="" selected>Please select</option>
                                <option value="cleared">Cleared</option>
                                <option value="with outstanding">With Outstanding</option>
                            </select><span class="yes-print" id="SPNtreasury_status" hidden>' . $statusTreasury . '</span>';
        }

        if ($row_clearance['hr_num'] != $session_num) {
            $statusHr = $statusHr;
        } else {
            $statusHr = '<select name="hr_status" class="no-print" required>
                                <option value="" selected>Please select</option>
                                <option value="cleared">Cleared</option>
                                <option value="with outstanding">With Outstanding</option>
                            </select><span class="yes-print" id="SPNhr_status" hidden>' . $statusHr . '</span>';
        }

        if ($row_clearance['it_num'] != $session_num) {
            $statusIt = $statusIt;
        } else {
            $statusIt = '<select name="it_status" class="no-print" required>
                                <option value="" selected>Please select</option>
                                <option value="cleared">Cleared</option>
                                <option value="with outstanding">With Outstanding</option>
                            </select><span class="yes-print" id="SPNit_status" hidden>' . $statusIt . '</span>';
        }
    }

    echo '<center>';
    echo '<table>';
    echo '<tr>';
    echo '<td colspan="4" class="center"><br/><img src="../images/company_logo/' . $row_company['company_id'] . '.png" width="70px"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="4" class="center"><h5>' . strtoupper($row_company['description']) . '</h4></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="4" class="center"><h7>' . strtoupper($row_company['address']) . '</h6></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="4" class="center"><br><h4>CLEARANCE FORM</h4></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="left">NAME: </td>';
    echo '<td class="left2">' . $fullname . '</td>';
    echo '<td class="left">DATE HIRED</td>';
    echo '<td class="left2">' . date('F d, Y', strtotime($row_separated['date_hired'])) . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="left">POSITION: </td>';
    echo '<td class="left2">' . strtoupper($row_position['position']) . '</td>';
    echo '<td class="left">DATE OF RESIGNATION: </td>';
    echo '<td class="left2">' . date('F d, Y', strtotime($row_separated['date_separated'])) . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="left">STATUS: </td>';
    echo '<td class="left2">' . strtoupper($row_status['code']) . '</td>';
    echo '<td class="left"></td>';
    echo '<td class="left"></td>';
    echo '</tr>';
    echo '</table>';
    echo '<table>';
    echo '<tr>';
    echo '<td colspan="4"><br/><p>This will certify that the subject employee has no financial and property accountablity and has been released from any further responsibility except as may be indicated below.</p><br/></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="center">SIGNATORIES/DEPTS.</td>';
    echo '<td class="center">DATE</td>';
    echo '<td class="center">STATUS</td>';
    echo '<td class="center">REMARKS</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="center3n5">' . $signatureAccounting . $fullnameAccounting . '</td>';
    echo '<td class="center3n6">' . $dateAcounting . '</td>';
    echo '<td class="center3">' . $statusAccounting . '</td>';
    echo '<td class="center3n7">' . strtoupper($row_clearance['accounting_remarks']) . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="center4">ACCOUNTING</td>';
    echo '<td colspan="3"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="center3n5">' . $signatureSupervisor . $fullnameSupervisor . '</td>';
    echo '<td class="center3n6">' . $dateSupervisor . '</td>';
    echo '<td class="center3">' . $statusSupervisor . '</td>';
    echo '<td class="center3n7">' . strtoupper($row_clearance['supervisor_remarks']) . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="center4">BRANCH HEAD</td>';
    echo '<td colspan="3"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="center3n5">' . $signatureTreasury . $fullnameTreasury . '</td>';
    echo '<td class="center3n6">' . $dateTreasury . '</td>';
    echo '<td class="center3">' . $statusTreasury . '</td>';
    echo '<td class="center3n7">' . strtoupper($row_clearance['treasury_remarks']) . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="center4">TREASURY</td>';
    echo '<td colspan="3"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="center3n5">' . $signatureHr . $fullnameHr . '</td>';
    echo '<td class="center3n6">' . $dateHr . '</td>';
    echo '<td class="center3">' . $statusHr . '</td>';
    echo '<td class="center3n7">' . strtoupper($row_clearance['hr_remarks']) . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="center4">HUMAN RESOURCES</td>';
    echo '<td colspan="3"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="center3n5">' . $signatureIt . $fullnameIt . '</td>';
    echo '<td class="center3n6">' . $dateIt . '</td>';
    echo '<td class="center3">' . $statusIt . '</td>';
    echo '<td class="center3n7">' . strtoupper($row_clearance['it_remarks']) . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="center4">IT ADMIN</td>';
    echo '<td colspan="3"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="left3" colspan="4"><br /><br />APPROVED:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RELEASE OF FINAL PAYMENT</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td></td>';
    echo '<td class="center3" colspan="2">' . $signatureGm . $fullnameGm . '</td>';
    echo '<td colspan=""></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan=""></td>';
    echo '<td class="center" colspan="2">GENERAL MANAGER</td>';
    echo '<td colspan=""></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="4"><br/><br/></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="4" class="center2">RELEASEWAIVER and QUITCLAIM</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="4"><br><p>In connection with the cessation of my employment effective ' . date('F d, Y', strtotime($row_separated['date_separated'])) . ', I hereby certify that I received in full all remuneration and benefits due to me under the Labor Code, Social Security Act and all existing labor laws. I hereby declare also that I have no claim of whatsoever nature against my employer. For all legal intents and purpose, I hereby forever and discharge ' . strtoupper($row_company['description']) . '. From any liability / responsibility arising out of and in connection with my employment the same having been fully compensated, settled and paid to me fully and to my satisfaction.</p></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="4"><br><p>I manifest that the terms of this quit claim and release have been read by me and / or read translated for me in dialect that I speak and therfore I thoroughly and fully understood the same.</p></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="2"></td>';
    echo '<td colspan="2" class="center3"><br/>' . $fullname . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="2"></td>';
    echo '<td colspan="2" class="center4">EMPLOYEE SIGNATURE OVER PRINTED NAME / DATE</td>';
    echo '</tr>';
    echo '</table>';
    echo '</center>';
}