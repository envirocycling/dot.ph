<style>
    h1{
        color:white;

    }
</style>


<?php

session_start();


include('config.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <script type='text/javascript' src='jquery-1.3.2.min.js'></script>
        <link href='notifCss/sNotify.css' rel='stylesheet' type='text/css' />
        <script src="notifJS/sNotify.js" type="text/javascript"></script>
        <title>EFI PURCHASING SYSTEM</title>
        <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
        <link rel="shortcut icon" href="images/efi_ico.png" />
        <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
        <script src="js/setup.js" type="text/javascript"></script>

        <script type="text/javascript">

            $(document).ready(function () {
                setupLeftMenu();

                $('.datatable').dataTable();
                setSidebarHeight();


            });
        </script>
        <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
        <script src="src/facebox.js" type="text/javascript"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('a[rel*=facebox]').facebox({
                    loadingImage : 'src/loading.gif',
                    closeImage   : 'src/closelabel.png'
                })
            })
        </script>


    </head>
    <body>
        <div class="container_12">
            <div class="grid_12 header-repeat">
                <div id="branding">
                    <div class="floatleft">
                        <img style="position: absolute; margin-top: -15px;" src="images/efi_ico.png" height="50" width="50"/><h1 style="position: absolute; margin-left: 50px;">&nbsp;EFI INVENTORY MANAGEMENT SYSTEM</h1></div>
                    <div class="floatright">
                        <div class="floatleft">
                            <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                        <div class="floatleft marginleft10">
                            <ul class="inline-ul floatleft">
                                <li>Welcome <i><u><b><?php echo $_SESSION['username'];?></b></u></i></li>
                                <li><a href="formChangePass.php">Config</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                            <br />
                            <span class="small grey"><?php echo date('D M d, Y'); ?></span>
                        </div>
                    </div>
                    <div class="clear">
                    </div>
                </div>
            </div>
            <div class="clear">
            </div>

            <div class="grid_12">
                <ul class="nav main">
                    <ul class="select"><li><a href="admin.php"><b>Home</b></a></li></ul>
                    <ul class="select"><li><a href="viewRequests.php"><b>Unclassified</b></a></li></ul>
                    <ul class="select"><li><a href="adminApprovedPR.php"><b>Approved</b></a></li></ul>
                    <ul class="select"><li><a href="adminDisapproved.php"><b>Disapproved</b></a></li></ul>

                    <ul class="select"><li><a href="adminOfficeSupplies.php"><b>Office Supplly PRs</b></a></li></ul>
                    <ul class="select"><li><a href="queuedtollr.php"><b>Queued To LLR</b></a></li></ul>
                    <ul class="select"><li><a href="queuedtohr.php"><b>Queued To HR</b></a></li></ul>


                </ul>
            </div>
            <div class="clear">
            </div>
            <div class="grid_1">
                <div class="box sidemenu">
                    <div class="block" id="section-menu">
                        <ul class="section menu">




                        </ul>
                    </div>
                </div>
            </div>