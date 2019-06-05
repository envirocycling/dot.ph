<?php
date_default_timezone_set("Asia/Singapore");
session_start();
include '../../connect.php';

if (isset($_POST['submit'])) {
    $to = '';

    $sql_pr = mysql_query("SELECT * from personnel_requisition WHERE pr_id='" . $_GET['pr_id'] . "'") or die(mysql_error());
    $row_pr = mysql_fetch_array($sql_pr);

    if ($row_pr['prepared_id'] == $row_pr['hr_id']) {
        $query = 'and emp_num !=' . $row_pr['prepared_id'] . ' and emp_num!=' . $row_pr['gm_id'];
    } else {
        $query = 'and emp_num !=' . $row_pr['prepared_id'] . ' and emp_num!=' . $row_pr['gm_id'] . ' and emp_num!=' . $row_pr['hr_id'] . '';
        
        $sql_emailsTO3 = mysql_query("SELECT * from email WHERE emp_num='" . $row_pr['prepared_id'] . "' and department!='agency' and status=''") or die(mysql_error());
        if (mysql_num_rows($sql_emailsTO3) > 0) {
            $row_emailTO3 = mysql_fetch_array($sql_emailsTO3);
            $to .= $row_emailTO3['email'] . ',';
        }
    }

    mysql_query("INSERT INTO comment_pr (pr_id, comment, date, user_id) VALUES('" . $_GET['pr_id'] . "', '" . mysql_real_escape_string($_POST['comment']) . "', '" . date('Y/m/d H:i') . "', '" . $_SESSION['emp_num'] . "')") or die(mysql_error());

    $sql_group = mysql_query("SELECT DISTINCT(user_id) from comment_pr WHERE pr_id='" . $_GET['pr_id'] . "'");
    while ($row_group = mysql_fetch_array($sql_group)) {
        $sql_emails = mysql_query("SELECT * from email WHERE emp_num='" . $row_group['user_id'] . "' $query and department!='agency' and status=''") or die(mysql_error());
        while ($row_email = mysql_fetch_array($sql_emails)) {
            $to .= $row_email['email'] . ',';
        }
    }

    $sql_emailsTO1 = mysql_query("SELECT * from email WHERE emp_num='" . $row_pr['hr_id'] . "' and department!='agency' and status=''") or die(mysql_error());
    if (mysql_num_rows($sql_emailsTO1) > 0) {
        $row_emailTO1 = mysql_fetch_array($sql_emailsTO1);
        $to .= $row_emailTO1['email'] . ',';
    }

    $sql_emailsTO2 = mysql_query("SELECT * from email WHERE emp_num='" . $row_pr['gm_id'] . "' and department!='agency' and status=''") or die(mysql_error());
    if (mysql_num_rows($sql_emailsTO2) > 0) {
        $row_emailTO2 = mysql_fetch_array($sql_emailsTO2);
        $to .= $row_emailTO2['email'];
    }

    $sql_job= mysql_query("SELECT * from positions WHERE p_id='" . $row_pr['job_title'] . "'") or die(mysql_error());
    $row_job = mysql_fetch_array($sql_job);
    
    $sql_branch= mysql_query("SELECT * from branches WHERE branch_id='" . $row_pr['branch_id'] . "'") or die(mysql_error());
    $row_branch= mysql_fetch_array($sql_branch);

    $subject = "COMMENT: PERSONAL REQUISITION FOR " .strtoupper($row_branch['branch_name']).' '. strtoupper($row_job['position']);
    $message = "Good day Ma'am/Sir \r\n Click this link to view " . "http://mmsv2.efi.net.ph/users/viewing-page/view_emp_pr.php?pr_id=" . $_GET['pr_id'] . ".\r\n\n Please Login here http://mmsv2.efi.net.ph/ to do more action.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
    $headers = "From: envirocyclingfiberincorporated@efi.net.ph" . "\r\n";
    mail($to, $subject, $message, $headers);
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
                width: 500px;
                height: 80px;
            }

        </style>
        <script src="jquery.min.js"></script>
        <script src="bootstrap.js"></script>
    </head>
    <body>
        <form action="" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <span class="glyphicon glyphicon-comment"><h4>Comment</h4></span> 
                                <?php
                                $sql_comment = mysql_query("SELECT * from comment_pr WHERE pr_id='" . $_GET['pr_id'] . "' ORDER BY date Asc") or die(mysql_error());
                                ?>
                                <div class="panel-body">

                                    <ul class="chat">
                                        <?php
                                        while ($row_pr = mysql_fetch_array($sql_comment)) {

                                            $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_pr['user_id'] . "' ") or die(mysql_error());
                                            if (mysql_num_rows($sql_emp) == 0) {
                                                $sql_emp = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '" . $row_pr['user_id'] . "' ") or die(mysql_error());
                                            }
                                            $row_emp = mysql_fetch_array($sql_emp);
                                            $chk_str = strlen($row_emp['middlename']);
                                            if ($chk_str > 1) {
                                                $str_count = strlen($row_emp['middlename']) - 1;
                                                $middlename = substr($row_emp['middlename'], 0, -$str_count);
                                            } else {
                                                $middlename = $row_emp['middlename'];
                                            }
                                            if (empty($row_emp['middlename'])) {
                                                $middlename = '';
                                            } else {
                                                $middlename = ', ' . $middlename . '.';
                                            }
                                            $fullname = ucwords($row_emp['lastname'] . ', ' . $row_emp['firstname'] . $middlename);
                                            if ($row_pr['user_id'] == $_SESSION['emp_num']) {
                                                echo ' <li class="left clearfix"><span class="chat-img pull-left">';
                                                $image_path = '../../images/employee/' . $row_pr['user_id'] . '.png';
                                                if (file_exists($image_path)) {
                                                    echo '<img src="../../images/employee/' . $row_pr['user_id'] . '.png" height="60" width="80"  alt="User Picture" class="img-circle" />';
                                                } else {
                                                    echo '<img src="../../images/icon.png" height="60" width="80" alt="User Picture" class="img-circle" />';
                                                }
                                                echo '</span>';

                                                echo '<div class="chat-body clearfix">
                                                    <div class="header">
                                                        <strong class="primary-font">' . $fullname . '</strong> <small class="pull-right text-muted">
                                                            <span class="glyphicon glyphicon-time"></span>' . date('M d, Y - h:i a', strtotime($row_pr['date'])) . '</small>
                                                    </div>
                                                        <p> - ' . $row_pr['comment'] . '</p>
                                                </div>
                                    </li>';
                                            } else {
                                                echo ' <li class="right clearfix"><span class="chat-img pull-right">';
                                                $image_path = '../../images/employee/' . $row_pr['user_id'] . '.png';
                                                if (file_exists($image_path)) {
                                                    echo '<img src="../../images/employee/' . $row_pr['user_id'] . '.png" height="60" width="80"  alt="User Picture" class="img-circle" />';
                                                } else {
                                                    echo '<img src="../../images/icon.png" height="60" width="80" alt="User Picture" class="img-circle" />';
                                                }
                                                echo '</span>';

                                                echo '<div class="chat-body clearfix">
                                                    <div class="header">
                                                        <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>' . date('M d, Y h:i a', strtotime($row_pr['date'])) . '</small>
                                                        <strong class="pull-right primary-font">' . $fullname . '</strong>
                                                    </div>
                                                    <p> - ' . $row_pr['comment'] . '</p>
                                                </div>
                                    </li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="panel-footer">
                                    <div class="input-group">
                                        <textarea placeholder="Type your comment here..." name="comment" required/></textarea>
                                        <br><input type="submit" class="btn btn-warning btn-sm" id="btn-chat" name="submit" value="Add Comment"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </body>
</html>
