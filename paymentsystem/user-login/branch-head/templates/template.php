<!DOCTYPE html>
<?php
@session_start();
if (!isset ($_SESSION['bh_id'])) {
    echo "<script>location.replace('../../');</script>";
}
?>
<head>
    <meta charset="utf-8">
    <title>EFI Payment System</title>
    <link media="all" rel="stylesheet" type="text/css" href="css/all.css" />
    <script type="text/javascript">window.jQuery || document.write('<script type="text/javascript" src="js/jquery-1.7.2.min.js"><\/script>');</script>
    <script type="text/javascript" src="js/jquery.main.js"></script>
    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="css/ie.css" /><![endif]-->
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="src/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('a[rel*=facebox]').facebox({
                loadingImage: 'src/loading.gif',
                closeImage: 'src/closelabel.png'
            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();

            $('.datatable').dataTable({
                aLengthMenu: [
                    [10, 20, 40, 100, 1000, 2000, 10000, -1],
                    [10, 20, 40, 100, 1000, 2000, 10000, "All"]
                ],
                iDisplayLength: -1
            });
            setSidebarHeight();


        });
    </script>


    <style>
        h6{
            color:white;
        }
        .tabs{
            margin-left: 20px;
            margin-top: 20px;
        }
        #type{
            background-color: gray;
            font-weight:bold;
            color:white;
        }
    </style>


</head>
<body>
    <div id="wrapper">
        <div id="content">
            <div class="c1">
                <div class="controls">
                    <nav class="links">
                        <ul>
                            <li>
                                <a href="index.php" class="">Request for POs <span class="num">
                                        <?php
                                        include('configPhp.php');
                                        if ($_SESSION['position'] == 'Reliever') {
                                            $query = "SELECT count(payment_id) FROM payment WHERE status='' and branch_code like '%" . $_SESSION['branch'] . "%' and signatory like '%".$_SESSION['initial']."%'";
                                        } else {
                                            $query = "SELECT count(payment_id) FROM payment WHERE status='' and branch_code like '%" . $_SESSION['branch'] . "%'";
                                        }
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_array($result)) {
                                            echo $row['count(payment_id)'];
                                        }
                                        ?>
                                    </span></a></li>
                            <li>
                            <li>
                                <a href="request_pos.php" class="">Request for POs <span class="num">
                                        <?php
                                        include('configPhp.php');
                                        $query = "SELECT count(payment_id) FROM payment WHERE status='approved' and branch_code like '%" . $_SESSION['branch'] . "%'";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_array($result)) {
                                            echo $row['count(payment_id)'];
                                        }
                                        ?>
                                    </span></a></li>
                            <li>
                                <a href="for_verification_pos.php" class="">Approved Fund Transfer<span class="num">
                                        <?php
                                        include('configPhp.php');
                                        $query = "SELECT count(payment_id) FROM payment WHERE status='generated' and branch_code like '%" . $_SESSION['branch'] . "%' and bh_approved_noti='0'";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_array($result)) {
                                            echo $row['count(payment_id)'];
                                        }
                                        ?>
                                    </span></a></li>
                            <!-- <li>
                                <a href="for_fund_transfer_pos.php" class="">POs for Fund Transfer<span class="num">
                            <?php
//                                        include('configPhp.php');
//                                        $query = "SELECT count(payment_id) FROM payment WHERE status='verified' and branch_code like '%" . $_SESSION['branch'] . "%'";
//                                        $result = mysql_query($query);
//                                        while ($row = mysql_fetch_array($result)) {
//                                            echo $row['count(payment_id)'];
//                                        }
                            ?>
                                    </span></a></li>
                            <li>
                                <a href="approved_fund_transfer_pos.php" class="">Approved Fund Transfer<span class="num">
                            <?php
//                                        include('configPhp.php');
//                                        $query = "SELECT count(payment_id) FROM payment WHERE status='transfered' and branch_code like '%" . $_SESSION['branch'] . "%'";
//                                        $result = mysql_query($query);
//                                        while ($row = mysql_fetch_array($result)) {
//                                            echo $row['count(payment_id)'];
//                                        }
                            ?>
                                    </span></a></li> -->
                            <li>
                                <a href="disapproved_pos.php" class="">Disapproved POs<span class="num">
                                        <?php
                                        include('configPhp.php');
                                        $query = "SELECT count(payment_id) FROM payment WHERE status='disapproved' and branch_code like '%" . $_SESSION['branch'] . "%' and bh_disapproved_noti='0'";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_array($result)) {
                                            echo $row['count(payment_id)'];
                                        }
                                        ?>
                                    </span></a></li>
                                    <li>
                                <a href="processed_pos.php" class="">Processed POs</a></li>
                        </ul>
                    </nav>
                    <div class="profile-box">
                        <span class="profile">
                            <a href="#" class="section">
                                <img class="image" src="images/img1.png" alt="image description" width="26" height="26" />
                                <span class="text-box">
                                    Welcome
                                    <strong class="name"><?php echo $_SESSION['username']; ?></strong>
                                </span>
                            </a>
                            <a href="#" class="opener">opener</a>
                        </span>
                        <a href="logout.php" class="btn-on">On</a>
                    </div>
                </div>