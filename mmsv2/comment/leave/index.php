<?php
date_default_timezone_set("Asia/Singapore");
session_start();
include '../../connect.php';

if (isset($_POST['submit'])) {
    $sql_leave = mysql_query("SELECT * from leaves WHERE leave_id='" . $_GET['leave_id'] . "'") or die(mysql_error());
    $row_leave = mysql_fetch_array($sql_leave);

    mysql_query("INSERT INTO comment_leave (leave_id, comment, date, user_id, user_type) VALUES('" . $_GET['leave_id'] . "', '" . mysql_real_escape_string($_POST['comment']) . "', '" . date('Y/m/d H:i') . "', '" . $_SESSION['emp_num'] . "', '" . $_SESSION['user_type'] . "')") or die(mysql_error());

    $to = '';
    $sql_group = mysql_query("SELECT DISTINCT(user_id) from comment_leave WHERE leave_id='" . $_GET['leave_id'] . "'");
    while ($row_group = mysql_fetch_array($sql_group)) {
        $sql_emails = mysql_query("SELECT * from email WHERE emp_num='" . $row_group['user_id'] . "' and emp_num!='" . $row_leave['emp_num'] . "' and department!='agency' and status=''") or die(mysql_error());
        while ($row_email = mysql_fetch_array($sql_emails)) {
            $to .= $row_email['email'] . ',';
        }
    }

    $sql_emailsTO = mysql_query("SELECT * from email WHERE emp_num='" . $row_leave['emp_num'] . "' and department!='agency' and status=''") or die(mysql_error());
    if (mysql_num_rows($sql_emailsTO) > 0) {
        $row_emailTO = mysql_fetch_array($sql_emailsTO);
        $to .= $row_emailTO['email'];
    }

    $sql_emp = mysql_query("SELECT * from employees WHERE emp_num='" . $row_leave['emp_num'] . "'") or die(mysql_error());
    $row_emp = mysql_fetch_array($sql_emp);
    $str_count = strlen($row_emp['middlename']) - 1;
    $fullname = ucwords($row_emp['firstname'] . ' ' . substr($row_emp['middlename'], 0, -$str_count) . '. ' . $row_emp['lastname']);

    $subject = "COMMENT: LEAVE REQUEST OF " . $fullname;
    $message = "Good day Ma'am/Sir \r\n Click this link to view" . "http://mmsv2.efi.net.ph/users/viewing-page/view_emp_leave.php?leave_id=" . $_GET['leave_id'] . ".\r\n\n Please Login here http://mmsv2.efi.net.ph/ to do more action.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
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
                                $sql_comment = mysql_query("SELECT * from comment_leave WHERE leave_id='" . $_GET['leave_id'] . "' ORDER BY date Asc") or die(mysql_error());
                                ?>
                                <div class="panel-body">

                                    <ul class="chat">
                                        <?php
                                        while ($row_pr = mysql_fetch_array($sql_comment)) {
                                            $sql_user = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_pr['user_id'] . "'") or die(mysql_error());
                                            $row_user = mysql_fetch_array($sql_user);
                                            $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_user['emp_num'] . "' ") or die(mysql_error());
                                            if (mysql_num_rows($sql_emp) == 0) {
                                                $sql_emp = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '" . $row_user['emp_num'] . "' ") or die(mysql_error());
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
                                            if ($row_pr['user_id'] == @$_SESSION['user_id'] || $row_pr['user_id'] == @$_SESSION['emp_num']) {
                                                echo ' <li class="left clearfix"><span class="chat-img pull-left">';
                                                $image_path = '../../images/employee/' . $row_user['emp_num'] . '.png';
                                                if (file_exists($image_path)) {
                                                    echo '<img src="../../images/employee/' . $row_user['emp_num'] . '.png" height="60" width="80" alt="User Picture" class="img-circle" />';
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
                                                $image_path = '../../images/employee/' . $row_user['emp_num'] . '.png';
                                                if (file_exists($image_path)) {
                                                    echo '<img src="../../images/employee/' . $row_user['emp_num'] . '.png" height="60" width="80"  alt="User Picture" class="img-circle" />';
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
                                <?php
                                if (!empty($_SESSION['emp_num']) && isset($_SESSION['emp_num'])) {
                                    ?>
                                    <div class="panel-footer">
                                        <div class="input-group">
                                            <textarea placeholder="Type your comment here..." name="comment" required/></textarea>
                                            <br><input type="submit" class="btn btn-warning btn-sm" id="btn-chat" name="submit" value="Add Comment"/>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                    echo '<font color="red"><i><h4>Please login to add comment.</h4></i></font>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </body>
</html>
