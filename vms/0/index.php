<!doctype html>
<html lang=''>
    <head>
        <title>Vehicle Management System</title>
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/header.js" type="text/javascript"></script>
        <script src="js/script.js"></script>
    </head>
    <body>


        <?php
        include('layout/header.php');
        include('connect.php');
        $selected = mysql_query("Select * from tbl_reassign Where approved='0' and noti_llr='0' Order by id Asc")or die(mysql_error());
        $sql_contract = mysql_query("Select * from tbl_contract Where status LIKE '%pending%' and gm_noti='0' Order by id Asc")or die(mysql_error());

       if (mysql_num_rows($selected) > 0) {
            include('notification.php');
        }
        if (mysql_num_rows($sql_contract) > 0) {
            include('notification_contract.php');
        }

        ?>

    <center>
        <div id="body">
            <br/>
            <table id="page2"><tr><td align="left"><td></td></table>
            <br/><br/>
            <img src="../EFI BANNER.jpg" width="100%" height="100%">
            <br><br/><br/>
            <table id="page"><tr><td align="left"><td></td></table><br/>
        </div>

<?php include('layout/footer.php'); ?>
    </center>
</body>
</html>

