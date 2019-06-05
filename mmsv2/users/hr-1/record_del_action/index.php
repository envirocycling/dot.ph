<?php
date_default_timezone_set("Asia/Singapore");
session_start();
include '../../../connect.php';

if (isset($_POST['submit'])) {
    @$target_dir = "../../../attachment/delinquency/hr/";
    @$target_file = $target_dir . $_GET['d_id'] . '-' . basename($_FILES["file"]["name"]);

    $sql_del = mysql_query("SELECT * from delinquency WHERE d_id='" . $_GET['d_id'] . "'");
    $row_del = mysql_fetch_array($sql_del);
    $sql_company = mysql_query("SELECT * from company WHERE company_id='" . $row_del['company_id'] . "' and type=1") or die(mysql_error());
    $company_id = $row_del['company_id'];

    $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_del['emp_num'] . "' ") or die(mysql_error());
    $row_emp = mysql_fetch_array($sql_emp);
    $str_count = strlen($row_emp['middlename']) - 1;
    $fullname = ucwords($row_emp['firstname'] . ' ' . substr($row_emp['middlename'], 0, -$str_count) . '. ' . $row_emp['lastname']);

    if ($_POST['status'] == 'with monetary deduction') {
        $type = 'monetary';

        $sql_del = mysql_query("SELECT * from delinquency WHERE d_id='" . $_GET['d_id'] . "'");
        $row_del = mysql_fetch_array($sql_del);

        $sql_company = mysql_query("SELECT * from company WHERE company_id='" . $row_del['company_id'] . "' and type = '1'");
        if (mysql_num_rows($sql_company) == 1) {
            $imp_status = 'pending to accounting';
            $context = 'This report has monetary deduction and pending to Accounting. Kindly advise the BH to upload the Authority to deduct / Charge Slip signed by the employee. Authority to deduct form is available the system.';
        } else {
            $imp_status = 'pending to agency';
            $context = 'This report has monetary deduction and pending to Agency. Kindly upload the Authority to deduct / Charge Slip signed by the employee. Authority to deduct form is available the system.';
        }

        if (mysql_num_rows($sql_company) == 0) {
            $to = '';
            $sql_emailTo = mysql_query("SELECT * from email WHERE emp_num = '$company_id' and status='' and department='agency'") or die(mysql_error());
            while ($row_emailTo = mysql_fetch_array($sql_emailTo)) {
                $to .= $row_emailTo['email'] . ',';
            }

            $cc = "CC: ";
            $sql_emailCC = mysql_query("SELECT * from email WHERE department = 'hr' and status=''") or die(mysql_error());
            while ($row_emailCC = mysql_fetch_array($sql_emailCC)) {
                $cc .= $row_emailCC['email'] . ',';
            }

            $sql_bh = mysql_query("SELECT * from users WHERE status='' and branch_id LIKE '%(" . $row_del['branch_id'] . ")%' and user_type='3'") or die(mysql_error());
            while ($row_bh = mysql_fetch_array($sql_bh)) {
                $sql_emailBH = mysql_query("SELECT * from email WHERE emp_num = '" . $row_bh['emp_num'] . "' and status=''") or die(mysql_error());
                $row_emailBH = mysql_fetch_array($sql_emailBH);
                $to .= $row_emailBH['email'] . ',';
            }
        } else {
            $to = '';
            $cc = "CC: ";
            $sql_bh = mysql_query("SELECT * from users WHERE status='' and branch_id LIKE '%(" . $row_del['branch_id'] . ")%' and user_type='3'") or die(mysql_error());
            while ($row_bh = mysql_fetch_array($sql_bh)) {
                $sql_emailBH = mysql_query("SELECT * from email WHERE emp_num = '" . $row_bh['emp_num'] . "' and status=''") or die(mysql_error());
                $row_emailBH = mysql_fetch_array($sql_emailBH);
                $to .= $row_emailBH['email'] . ',';
            }

            $sql_emailCC2 = mysql_query("SELECT * from email WHERE department = 'hr' and status=''") or die(mysql_error());
            $row_emailCC2 = mysql_fetch_array($sql_emailCC2);
            $cc .= $row_emailCC2['email'];

            $sql_emailTo = mysql_query("SELECT * from email WHERE department = 'accounting' and status=''") or die(mysql_error());
            $row_emailTo = mysql_fetch_array($sql_emailTo);
            $to .= $row_emailTo['email'];
        }

        $subject = "DELINQUENCY REPORT OF " . $fullname;
        $message = "Good day Ma'am/Sir \r\n" . $context . " \r\n\n Please Login here http://mmsv2.efi.net.ph/ to do more action.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
        $headers = "From: envirocyclingfiberincorporated@efi.net.ph" . "\r\n" . $cc;
        mail($to, $subject, $message, $headers);
    } else {

        $sql_company = mysql_query("SELECT * from company WHERE company_id='" . $row_del['company_id'] . "' and type = '1'");

        $imp_status = 'cleared';
        $type = '';
        $to = '';

        if (mysql_num_rows($sql_company) == 0) {
            $sql_emailTo = mysql_query("SELECT * from email WHERE emp_num = '$company_id' and status='' and department='agency'") or die(mysql_error());
            while ($row_emailTo = mysql_fetch_array($sql_emailTo)) {
                $to .= $row_emailTo['email'] . ',';
            }
        }

        $sql_emailCC = mysql_query("SELECT * from email WHERE department = 'manager' and status=''") or die(mysql_error());
        $row_emailCC = mysql_fetch_array($sql_emailCC);
        $cc = "CC: " . $row_emailCC['email'] . ',';

        $sql_bh = mysql_query("SELECT * from users WHERE status='' and branch_id LIKE '%(" . $row_del['branch_id'] . ")%' and user_type='3'") or die(mysql_error());
        while ($row_bh = mysql_fetch_array($sql_bh)) {
            $sql_emailBH = mysql_query("SELECT * from email WHERE emp_num = '" . $row_bh['emp_num'] . "' and status=''") or die(mysql_error());
            $row_emailBH = mysql_fetch_array($sql_emailBH);
            $cc .= $row_emailBH['email'] . ',';
        }

        $sql_emailCC2 = mysql_query("SELECT * from email WHERE department = 'hr' and status=''") or die(mysql_error());
        while ($row_emailCC2 = mysql_fetch_array($sql_emailCC2)) {
            $to .= $row_emailCC2['email'] . ',';
        }

        $subject = "DELINQUENCY REPORT OF " . $fullname;
        $message = "Good day Ma'am/Sir \r\n This deliquency report is now clear and close.\r\n\n Please Login here http://mmsv2.efi.net.ph/ to do more action.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
        $headers = "From: envirocyclingfiberincorporated@efi.net.ph" . "\r\n" . $cc;
        mail($to, $subject, $message, $headers);
    }

    mysql_query("UPDATE delinquency SET hr_action = '" . mysql_real_escape_string($_POST['action']) . "', status='" . $_POST['status'] . "', type='$type', hr_actionDate='" . date('Y-m-d') . "', cost='" . $_POST['cost'] . "', hr_attachment='" . $_GET['d_id'] . '-' . basename($_FILES["file"]["name"]) . "', implementation_status='$imp_status' WHERE d_id = '" . $_GET['d_id'] . "' ") or die(mysql_error());
    move_uploaded_file(@$_FILES["file"]["tmp_name"], $target_file);
    echo '<script>
                window.top.location.href="../view_delinquency.php?status=active&active=view&http=200";
    </script>';
}
?>
<html lang="en">
    <head>
        <link href="chat_box.css" rel="stylesheet">
        <style type="text/css">
            .chat
            {
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .chat li
            {
                margin-bottom: 10px;
                padding-bottom: 5px;
                border-bottom: 1px dotted #B3A9A9;
            }

            .chat li.left .chat-body
            {
                margin-left: 60px;
            }

            .chat li.right .chat-body
            {
                margin-right: 60px;
            }


            .chat li .chat-body p
            {
                margin: 0;
                color: #777777;
            }

            .panel .slidedown .glyphicon, .chat .glyphicon
            {
                margin-right: 5px;
            }


            ::-webkit-scrollbar-track
            {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                background-color: #F5F5F5;
            }

            ::-webkit-scrollbar
            {
                width: 12px;
                background-color: #F5F5F5;
            }

            ::-webkit-scrollbar-thumb
            {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
                background-color: #555;
            }
            textarea {
                resize: none;
                width: 80%;
                height: 80px;
            }

        </style>
        <script src="jquery.min.js"></script>
        <script src="bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#cost').hide();
                $('[name=status]').change(function () {
                    var _thisVal = this.value;
                    if (_thisVal == 'with monetary deduction') {
                        $('#cost').show();
                    } else {
                        $('#cost').hide();
                    }
                });
            });
        </script>
    </head>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <?php
                                $sql_pr = mysql_query("SELECT * from delinquency WHERE d_id='" . $_GET['d_id'] . "'") or die(mysql_error());
                                ?>
                                <div class="panel-footer">
                                    <div class="input-group"><br>
                                        Status: <select name="status" style="height: 30px; margin-top: 10px;" required>
                                            <option value="" selected disabled>Select</option>
                                            <option value="with monetary deduction">With Monetary Duduction</option>
                                            <option value="cleared">Clear</option>
                                        </select>
                                        <br/>
                                        <span id="cost">Cost: <input type="number" style="width:115px; height: 30px; margin-top: 10px;" name="cost" autocomplete="off" step="any" requried/></span><br/>
                                        Attach File (if any): <input type="file" style=" height: 30px; margin-top: 10px;" name="file"/><br/>
                                        <textarea name="action" required /></textarea>
                                        <br><input type="submit" class="btn btn-warning btn-sm" id="btn-chat" name="submit" value="Record"/><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </body>
</html>
<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css"/>
<script src="../js/jquery.datetimepicker.full.js"></script>
<script>
            $('#datetimepicker').keydown(false);
            $('#datetimepicker').datetimepicker({
                dayOfWeekStart: 1,
                lang: 'ch',
                timepicker: false,
                format: 'Y/m/d',
                formatDate: 'Y/m/d',
                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                startDate: '2016',
                scrollMonth: false,
                scrollInput: false
            });
            $('#datetimepicker').datetimepicker({value: '', step: 30});
</script>
