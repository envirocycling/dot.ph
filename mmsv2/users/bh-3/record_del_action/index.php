<?php
date_default_timezone_set("Asia/Singapore");
session_start();
include '../../../connect.php';

if (isset($_POST['submit'])) {
    @$target_dir = "../../../attachment/delinquency/";
    @$target_file = $target_dir . $_GET['d_id'] . '-' . basename($_FILES["file"]["name"]);
    if ($_POST['cost'] > 0) {
        $imp_status = 'pending to agency';

        $sql_del = mysql_query("SELECT * from delinquency WHERE d_id='" . $_GET['d_id'] . "'");
        $row_del = mysql_fetch_array($sql_del);
        $sql_company = mysql_query("SELECT * from company WHERE company_id='" . $row_del['company_id'] . "' and type=1") or die(mysql_error());

        $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_del['emp_num'] . "' ") or die(mysql_error());
        $row_emp = mysql_fetch_array($sql_emp);
        $str_count = strlen($row_emp['middlename']) - 1;
        $fullname = ucwords($row_emp['firstname'] . ' ' . substr($row_emp['middlename'], 0, -$str_count) . '. ' . $row_emp['lastname']);

        if (mysql_num_rows($sql_company) == 0) {
            $to = '';
            $sql_emailTo = mysql_query("SELECT * from email WHERE emp_num = '$company_id' and status='' and department='agency'") or die(mysql_error());
            while ($row_emailTo = mysql_fetch_array($sql_emailTo)) {
                $to .= $row_emailTo['email'];
            }

            $sql_emailCC = mysql_query("SELECT * from email WHERE department = 'hr' and status=''") or die(mysql_error());
            $row_emailCC = mysql_fetch_array($sql_emailCC);
            $cc = "CC: " . $row_emailCC['email'] . ',';

            $sql_bh = mysql_query("SELECT * from users WHERE status='' and branch_id LIKE '%(" . $row_del['branch_id'] . ")%' and user_type='3'") or die(mysql_error());
            while ($row_bh = mysql_fetch_array($sql_bh)) {
                $sql_emailBH = mysql_query("SELECT * from email WHERE emp_num = '" . $row_bh['emp_num'] . "' and status=''") or die(mysql_error());
                $row_emailBH = mysql_fetch_array($sql_emailBH);
                $cc .= $row_emailBH['email'] . ',';
            }

            $sql_emailManager = mysql_query("SELECT * from email WHERE department = 'manager' and status=''") or die(mysql_error());
            $row_emailManager = mysql_fetch_array($sql_emailManager);
            $cc .= $row_emailManager['email'];
        } else {
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
            $row_emailCC2 = mysql_fetch_array($sql_emailCC2);
            $cc .= $row_emailCC2['email'];

            $sql_emailTo = mysql_query("SELECT * from email WHERE department = 'accounting' and status=''") or die(mysql_error());
            $row_emailTo = mysql_fetch_array($sql_emailTo);
            $to = $row_emailTo['email'];
        }

        $subject = "DELINQUENCY REPORT OF " . $fullname;
        $message = "Good day Ma'am/Sir \r\n This report is pending to agency. Click this link to view " . "http://mmsv2.efi.net.ph/users/viewing-page/view_emp_delinquency.php?d_id=" . $_GET['d_id'] . ".\r\n\n Please Login here http://mmsv2.efi.net.ph/ to do more action.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
        $headers = "From: envirocyclingfiberincorporated@efi.net.ph" . "\r\n" . $cc;
        mail($to, $subject, $message, $headers);
    } else {
        $imp_status = 'N/A';
    }
    mysql_query("UPDATE delinquency SET action = '" . mysql_real_escape_string($_POST['action']) . "', status='pending to hr',action_date='" . date('Y-m-d') . "', action_cost='" . $_POST['cost'] . "', attachment='" . $_GET['d_id'] . '-' . basename($_FILES["file"]["name"]) . "' WHERE d_id = '" . $_GET['d_id'] . "' ") or die(mysql_error());
    move_uploaded_file(@$_FILES["file"]["tmp_name"], $target_file);
    echo '<script>
                window.top.location.href="../view_delinquency.php?status=active&active=view&http=201";
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
                                        <!--Action Date: <input type="text" style="width:115px; height: 30px; margin-top: 10px;" id="datetimepicker" name="date" autocomplete="off" placeholder="Required" required/><br/>-->
                <!--                        Status: <select name="status" style="width:115px; height: 30px; margin-top: 10px;" required>
                                                    <option value="" selected disabled>Select</option>
                                                    <option value="cleared">Clear</option>
                                                    <option value="not clear">Not Clear</option>
                                                </select>-->
                                        <br/>
                                        Cost: <input type="number" style="width:115px; height: 30px; margin-top: 10px;" name="cost" autocomplete="off" step="any" placeholder="if any"/><br/>
                                        Attach File (if any): <input type="file" style=" height: 30px; margin-top: 10px;" name="file"/><br/>
                                        <textarea placeholder="Input agency action taken here..." name="action" required/></textarea>
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
