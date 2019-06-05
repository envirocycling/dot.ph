<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/del_form.css">
<script type="text/javascript" src="validation/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#iframe').hide();
        var company_id = $('#company_id').val();
        $.ajax({
            url: 'process/register_del_empdata2.php',
            type: 'Post',
            data: 'company_id=' + company_id
        }).done(function (e) {
            var val = e.split('~');
            var company_logo = company_id + '.png';
            $('#header1').html(val[0]);
            $('#header2').html(val[1]);
            $("#emp_num").html(val[2]);
            $('#comp_logo').attr('src', '../../images/company_logo/' + company_logo);
        });
        $('#record').click(function () {
            var act = $('#record').html();
            if (act == 'Cancel') {
                $('#iframe').hide(100);
                $('#record').html('Record Action Taken');
            } else {
                $('#iframe').show(500);
                $('#record').html('Cancel');
            }
        });

    });
</script>
<style>
    #val{
        border-bottom: groove;
    }#val2{
        border-bottom: groove;
    }#val3{
        border-bottom: groove;
    }
    .action{
        text-indent: 60px;
        line-height: 25px;
    }
</style>
<?php
include("../../connect.php");
if (isset($_POST['submitUp'])) {
    if (mysql_query("UPDATE delinquency SET acknowledgment='" . $_GET['d_id'] . '-' . basename($_FILES["form"]["name"]) . "', implementation_status='pending to accounting' WHERE d_id = '" . $_GET['d_id'] . "'") or die(mysql_error())) {
        //uploading sketch start
        @$target_dir = "../../attachment/acknowledgment/";
        @$target_file = $target_dir . $_GET['d_id'] . '-' . basename($_FILES["form"]["name"]);
        if (file_exists($_GET['d_id'] . '-' . basename($_FILES["form"]["name"]))) {
            
        } else {
            move_uploaded_file(@$_FILES["form"]["tmp_name"], $target_file);
        }
        //uploading sketch end   

        $sql_del = mysql_query("SELECT * from delinquency WHERE d_id='" . $_GET['d_id'] . "'");
        $row_del = mysql_fetch_array($sql_del);

        $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_del['emp_num'] . "' ") or die(mysql_error());
        $row_emp = mysql_fetch_array($sql_emp);
        $str_count = strlen($row_emp['middlename']) - 1;
        $fullname = ucwords($row_emp['firstname'] . ' ' . substr($row_emp['middlename'], 0, -$str_count) . '. ' . $row_emp['lastname']);

        $cc = 'CC: ';
        $sql_emailCC = mysql_query("SELECT * from email WHERE emp_num = '" . $row_emp['company_id'] . "' and status='' and department='agency'") or die(mysql_error());
        while ($row_emailCC = mysql_fetch_array($sql_emailCC)) {
            $cc .= $row_emailCC['email'] . ',';
        }

        $sql_emailTo = mysql_query("SELECT * from email WHERE department = 'hr' and status=''") or die(mysql_error());
        while ($row_emailTo = mysql_fetch_array($sql_emailTo)) {
            $cc .= $row_emailTo['email'] . ',';
        }

        $sql_bh = mysql_query("SELECT * from users WHERE status='' and branch_id LIKE '%(" . $row_del['branch_id'] . ")%' and user_type='3'") or die(mysql_error());
        while ($row_bh = mysql_fetch_array($sql_bh)) {
            $sql_emailBH = mysql_query("SELECT * from email WHERE emp_num = '" . $row_bh['emp_num'] . "' and status=''") or die(mysql_error());
            $row_emailBH = mysql_fetch_array($sql_emailBH);
            $cc .= $row_emailBH['email'] . ',';
        }

        $to = '';
        $sql_emailTo2 = mysql_query("SELECT * from email WHERE  status='' and department='accounting'") or die(mysql_error());
        while ($row_emailTo2 = mysql_fetch_array($sql_emailTo2)) {
            $to .= $row_emailTo2['email'] . ',';
        }

        $subject = "DELINQUENCY REPORT OF " . $fullname;
        $message = "Good day Ma'am/Sir \r\n Authority to deduct / Charge slip was already uploaded. This request is now pending to accounting.\r\n\n Please Login here http://mmsv2.efi.net.ph/ to do more action.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
        $headers = "From: envirocyclingfiberincorporated@efi.net.ph" . "\r\n" . $cc;
        mail($to, $subject, $message, $headers);

        echo '<script>
                 window.top.location.href="view_delinquency.php?status=active&active=view&http=201";
             </script>';
    } else {
        echo '<script>
                 window.top.location.href="view_delinquency.php?status=active&active=view&http=400";
             </script>';
    }
}
//if (isset($_POST['submit'])) {
//    if (mysql_query("UPDATE delinquency SET implementation_status='cleared' WHERE d_id = '" . $_GET['d_id'] . "'") or die(mysql_error())) {
//        echo '<script>
//                window.top.location.href="view_delinquency.php?status=active&active=view&http=201";
//            </script>';
//    } else {
//        echo '<script>
//                window.top.location.href="view_delinquency.php?status=active&active=view&http=400";
//            </script>';
//    }
//}

$sql_del = mysql_query("SELECT * from delinquency WHERE d_id = '" . $_GET['d_id'] . "'") or die(mysql_error());
$row_del = mysql_fetch_array($sql_del);

$sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_del['emp_num'] . "'") or die(mysql_error());
if (mysql_num_rows($sql_emp) == 0) {
    $sql_emp = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '" . $row_del['emp_num'] . "'") or die(mysql_error());
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

$sql_user_sub = mysql_query("SELECT * from users WHERE user_id='" . $row_del['submitted_by'] . "'") or die(mysql_error());
$row_user_sub = mysql_fetch_array($sql_user_sub);
$sql_sub = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_user_sub['emp_num'] . "'") or die(mysql_error());
if (mysql_num_rows($sql_sub) == 0) {
    $sql_sub = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '" . $row_user_sub['emp_num'] . "'") or die(mysql_error());
}
$row_sub = mysql_fetch_array($sql_sub);
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

$emp_branch = mysql_query("SELECT * from branches WHERE branch_id = '" . $row_del['branch_id'] . "' ") or die(mysql_error());
$row_emp_branch = mysql_fetch_array($emp_branch);

$emp_company = mysql_query("SELECT * from company WHERE company_id = '" . $row_del['company_id'] . "' ") or die(mysql_error());
$row_emp_company = mysql_fetch_array($emp_company);

$type = explode('~', $row_del['type']);
if ($type[0] == 'accident') {
    $ac_attr = 'checked';
}
if ($type[0] == 'incident') {
    $in_attr = 'checked';
}
echo '<input type="hidden" value="' . $row_emp_company['company_id'] . '" id="company_id">';
?>
<center>
    <table width="85%">
        <tr>
            <td colspan="4" class="header1"><span id="logo"><img id="comp_logo" height="100px" width="100px;"></span><span id="header1"></span><br><span id="header2"><br></span></td>
        </tr>
        <tr>
            <td class="txt">To:</td>
            <td>Whom it may concern</td>
        </tr>
        <tr>
            <td class="txt">Company:</td>
            <td><?php echo $row_emp_company['name'] ?></td>
        </tr>
        <tr>
            <td class="txt">RE:</td>
            <td>Delinquency Report</td>
        </tr>
        <tr>
            <td class="txt">Date:</td>
            <td><?php echo date('Y/m/d', strtotime($row_del['date_submitted'])); ?></td>
        </tr>
        <tr>
            <td colspan="4"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forwarding to you the Delinquency Report of your employee assigned in our company. Kindly arrange to return the duplicate and indicate the action taken for the infraction of erring employee/s.</td>
        </tr>
        <tr>
            <td class="txt"><br><br>Name of Employee:</td>
            <td><br><br><?php echo $employee_fullname; ?>
            </td>
            <td class="txt"><br><br>Branch Assignment:</td>
            <td width="20%" style="padding-top: 10px;"><br><?php echo $row_emp_branch['branch_name']; ?></td>
        </tr>
        <tr>
            <td class="txt"><br><br>Violation Committed:</td>
            <td><br><br><?php echo $row_del['violation']; ?></td>
            <td class="txt"><br><br>Date of Commission:</td>
            <td width="20%" style="padding-top: 15px;"><br><?php echo date('Y/d/m', strtotime($row_del['date_committed'])); ?></td>
        </tr>
        <?php
        if (!empty($type[1])) {
            $report_idVal = explode('-', $type[1]);
            ?>
            <tr>
                <td class="txt"><br><br>Type (if any):</td>
                <td colspan="2"><br><br>
                    <input type="checkbox" name="del_type" class="radio" value="Incident" disabled <?php echo @$in_attr; ?>>Incident &nbsp;&nbsp;<input type="checkbox" class="radio" name="del_type" value="Accident" disabled  <?php echo @$ac_attr; ?>>Accident &nbsp;&nbsp;
                    <span id="report_num"><i><font color="blue"><a href="view_emp_ia.php?report_id=<?php echo $report_idVal[0] . '&head=1'; ?>" target="_blank"><?php echo $type[1]; ?></a></font></i></span>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td class="txt" colspan="2"><br><br>Brief description of the incident:</td>
        </tr>
        <tr>
            <td colspan="4" id='val' class="action"><?php echo $row_del['description'] ?></td>
        </tr>
        <tr>
            <td colspan="2"><br><br><b>Disciplinary action :</b> 
                <?php
                $sql_company = mysql_query("SELECT * from company WHERE company_id='" . $row_del['company_id'] . "'") or die(mysql_error());
                if ($row_del['status'] == 'pending' && mysql_num_rows($sql_company) > 0) {
                    echo '<button class="btn btn-primary" id="record">Record Action Taken</button>';
                }
                ?>
            </td>
        </tr>
        <?php
        if ($row_del['status'] == 'pending') {
            ?>
            <tr id="iframe">
                <td colspan="4"><iframe width="100%" height="400px;" frameborder="none" src="record_del_action/index.php?d_id=<?php echo $row_del['d_id']; ?>"></iframe></td>
            </tr>
        <?php } else { ?>
            <tr>
                <td colspan="4" id='val3'>
                    <?php
                    $exAtt = explode('-', $row_del['attachment']);
                    if (!empty($exAtt[1])) {
                        echo '<br/><div class="action">Attachment: <a href="../../attachment/delinquency/' . $row_del['attachment'] . '" target="_blank"><i>' . $row_del['attachment'] . '</i></a></div>';
                    }
                    if ($row_del['action_cost'] > 0) {
                        $cost = ' with a total cost of <b>' . number_format($row_del['action_cost'], 2) . '</b>';
                    } else {
                        $cost = '';
                    }
                    echo '<div class="action">Action Date: ' . date('Y/m/d', strtotime($row_del['action_date'])) . $cost;
                    echo ' - ' . $row_del['action'] . '</div>';
                    ?>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="4" id='val3'><br><br><b>HR action :</b>
                <?php
                if (!empty($row_del['hr_action']) && $row_del['type'] == 'monetary') {
                    echo '<br /><br /><div class="action">Action Date: ' . date('Y/m/d', strtotime($row_del['hr_actionDate'])) . ' with monetary deducton of <b>' . number_format($row_del['cost'], 2) . '</b> - ' . $row_del['hr_action'] . '</div>';
                } else if (!empty($row_del['hr_action'])) {
                    echo '<br /><br /><div class="action">Action Date: ' . date('Y/m/d', strtotime($row_del['hr_actionDate'])) . ' - ' . $row_del['hr_action'] . '</div>';
                }
                $expAttach2 = explode('-', $row_del['hr_attachment']);
                if (!empty($expAttach2[1])) {
                    echo '<div class="action">Attachment: <a href="../../attachment/delinquency/hr/' . $row_del['hr_attachment'] . '" target="_blank"><i>' . $row_del['hr_attachment'] . '</i></a></div>';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="4" ><br>
                <?php
                if (empty($row_del['acknowledgment']) && $row_del['type'] == 'monetary') {
                    echo '<br/><br/>Acknowledgment Form:
                                                    <form method="post" enctype="multipart/form-data">
                                                        <input type="file" name="form" accept="application/pdf,image/*" required>&nbsp;<input type="submit" class="btn btn-primary" value="Upload Form" name="submitUp">';
                    if ($row_del['cost'] > 0) {
                        $sql_deduct = mysql_query("SELECT * from forms WHERE status='' and type='deduct'");
                        $row_deduct = mysql_fetch_array($sql_deduct);
                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><a href="../../forms/' . $row_deduct['name'] . '" target="_blank">Download authority to deduct form here</a></i>';
                    }
                    echo '</form>';
                }
                if (!empty($row_del['acknowledgment'])) {
                    echo '<br/><br/>Authority to deduct form: <a href="../../attachment/acknowledgment/' . $row_del['acknowledgment'] . '" target="_blank"><i>' . $row_del['acknowledgment'] . '</i></a>';
                    if ($row_del['implementation_status'] == 'pending to agency') {
                        echo'&nbsp;&nbsp;&nbsp;&nbsp;<form method="post" onsubmit="return confirm(\'Do you want to proceed?\');"><input class="btn btn-primary" type="submit" name="submit" value="Mark as Cleared"></form>';
                    }
                } else if ($row_del['type'] == 'monetary') {
                    $sql_deduct = mysql_query("SELECT * from forms WHERE status='' and type='deduct'");
                    $row_deduct = mysql_fetch_array($sql_deduct);
                    echo '<br><font color="red"><i>No authority to deduct form uploaded.</i></font>';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"><br><br><br>For your immediate action.</td>
        </tr>
        <tr>
            <td colspan="2"><br><img src="../../images/signature/<?php echo $row_user_sub['emp_num'] . '.png'; ?>"  width="100px;"><!--Signature--></td>
        </tr>
        <tr>
            <td colspan="2"><br><?php echo $employee_fullname_sub . ' - <i>' . $row_pos['position'] . '</i>'; ?></td>
        </tr>
    </table>
</center>
