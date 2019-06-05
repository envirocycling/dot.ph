<?php session_start(); ?>

<style>
    h1{
        color:white;
    }
    a{
        color:blue;
    }
    body{
        background-color: #2e5e79;
    }
</style>

<?php

if (!isset($_SESSION["username"])) {
    echo "<script>
    location.replace('index.php');
    </script>";
}

$usertype = $_SESSION['usertype'];
$branch = $_SESSION['user_branch'];
$_SESSION['current_month'] = date('m');
include('config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <title>EFI INVENTORY MANAGEMENT SYSTEM</title>

        <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
        <link rel="shortcut icon" href="images/efi_ico.png" />

        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

        <script>
            $(function() {
                $('input[name="dates"]').daterangepicker({
                    locale: {
                        format: 'Y/MM/DD'
                    }
                });

                $('#tbl').DataTable();
            });
        </script>

    </head>

    <body>
 
        <div class="container_12">

            <div class="grid_12 header-repeat">

                <div id="branding">

                    <div class="floatleft">

                        <img style="position: absolute; margin-top: -15px;" src="images/efi_ico.png" height="90" width="90"/><h1 style="font-size: 35px; position: absolute; margin-left: 90px;">&nbsp;EFI INVENTORY MANAGEMENT SYSTEM</h1>

                    </div>

                    <div style="margin-top: 10px;">

                        <div class="floatright">

                            <div class="floatleft">

                                <div style="margin-top: -10px;">

                                    <?php
                                    include 'config.php';

                                    $user_id = $_SESSION['username'];

                                    $profpic = mysql_query("SELECT image FROM users WHERE user_id='$user_id'");

                                    $rs_profpic = mysql_fetch_array($profpic);

                                    $profpic = $rs_profpic["image"];

                                    if (empty($profpic)) {

                                        echo'<img src="images/no_avatar.png" height="50" width="50" alt="view profile" />';
                                    } else {

                                        echo '<img src="prof_pic.php?user_id=' . $user_id . '" height="50" width="50" alt=""/>';
                                    }
                                    ?>

                                </div>

                            </div>

                            <table>
                                <tr>
                                    <td style="background-color: transparent;">&nbsp;&nbsp;&nbsp;<font style="font-size: 14px; font-weight: bold; margin-top: -10px; color: white;">Welcome <i><u><b><?php echo $_SESSION['username']; ?></b></u></i></font>

                                        <br />

                                        &nbsp;&nbsp;&nbsp;<span class="small grey"><?php echo date('D M d, Y'); ?></span>
                                    </td>

                                    <td style="background-color: transparent;">
                                        <a rel="facebox" href="notifications.php" title="Click to view all Notifications"><img src="images/noti.png" width="30" height="30" /></a>

                                        <div id = "latestData"></div>
                                    </td>


                                    <td style="background-color: transparent;">

                                        <a href="viewAccountDetails.php" title="Click to edit Account Settings"><img src="images/settings.png" width="30" height="30" /></a>
                                    </td>

                                    <td style="background-color: transparent;">

                                        <a href="logout.php" title="Log-out"><img src="images/logout.png" width="30" height="30" /></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="clear"></div>

                </div>
            </div>


            <div class="grid_12">

                <ul class="nav main">
                    <li class="ic-grid-tables">
                        <a href="outgoing_pss_report.php" style="height: 40px;"><span>Outgoing w/ ETA</span></a>
                    </li>
                </ul>

            </div>

            <div class="clear"></div>





