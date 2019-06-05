<?php
    date_default_timezone_set("Asia/Singapore");
    session_start();
    include '../../../connect.php';
    
if(isset($_POST['submit'])){
    mysql_query("UPDATE delinquency SET action = '".mysql_real_escape_string($_POST['action'])."', status='action taken',action_date='".$_POST['date']."' WHERE d_id = '".$_GET['d_id']."' ") or die(mysql_error());
    echo '<script>
                alert("Successful");
                window.top.location.href="../view_delinquency.php?status=active&active=view";
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
    <form action="" method="post">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                 <?php
                 $sql_pr = mysql_query("SELECT * from delinquency WHERE d_id='".$_GET['d_id']."'") or die(mysql_error());
                 ?>
                <div class="panel-footer">
                    <div class="input-group"><br>
                        Action Date: <input type="text" style="width:115px; height: 30px; margin-top: 10px;" id="datetimepicker" name="date" autocomplete="off" placeholder="Required" required/><br/>
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
    $('#datetimepicker').datetimepicker({
                                dayOfWeekStart: 1,
                                lang:'ch',
                                timepicker:false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '2016'
                            });
                            $('#datetimepicker').datetimepicker({value: '', step: 30});
</script>
