<?php session_start();?>
<style>
    h1{
        color:white;

    }
</style>


<?php

if (!isset($_SESSION["username"])) {
    header('Location: index.php');
}
$usertype=$_SESSION['usertype'];
$branch=$_SESSION['user_branch'];
$_SESSION['current_month']=date('m');
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
                        <h1>EFI INVENTORY MANAGEMENT SYSTEM</h1></div>
                    <div class="floatright">
                        <div class="floatleft">
                            <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                        <div class="floatleft marginleft10">
                            <ul class="inline-ul floatleft">
                                <li>Welcome <i><u><b><?php echo $_SESSION['username'];?></b></u></i></li>
                                <li><a href="viewAccountDetails.php">Config</a></li>
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
                    <li class="ic-dashboard"><a href=""><span>Dashboard</span></a>
                        <ul>
                            <li><a href="dashboard_outgoing.php">Outgoing</a></li>
                            <li><a href="dashboard_receiving.php">Receiving</a></li>


                        </ul>
                    </li>
                    <li class="ic-form-style"><a href=""><span>Template Uploading</span></a>
                        <ul>
                            <?php
                            if($branch=='Pampanga' || $branch=='Pasay' || $branch=='Urdaneta') {
                                echo '<li><a href="encodeDelivery.php">Receiving</a></li>';
                            }
                            ?><!-- <li><a href="frmUploadOutgoing.php">Outgoing</a></li> -->
                            <li><a href="frmUploadBales.php">Bales</a></li>
                            <li><a href="frmUploadBMProd.php">BM Production</a></li>
                        </ul>
                    </li>
                    <?php
                    if($usertype=='Super User') {
                        echo '<li class="ic-dashboard"><a href="inc_deliveries.php"><span>Incentive Monitoring</span></a> </li>';
                    }
                    ?>
                    <li class="ic-grid-tables"><a href="javascript:"><span>WP Receiving Reports</span></a>
                        <ul>
                            <?php
                            echo ' <li><a href="changeWpGrade.php?grade=all">All Grades</a></li>';
                            echo '<li><a href="current_month_weekly_brkdwn.php">Weekly Breakdown</a></li>';
                            echo '<li><a href="daily_brkdwn.php">Daily Breakdown</a></li>';
                            if($_SESSION['usertype']=='Super User') {
                                echo '<li><a href="branch_performance.php">Deliveries Per Branch</a></li>';

                            }
                            echo ' <li><a href="#">_________________</a></li>';

                            foreach($_SESSION['wp_grades'] as $value) {

                                echo ' <li><a href="changeWpGrade.php?grade='.$value.'">'.$value.'</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                    if($usertype=='Super User') {
                        echo '<li class="ic-grid-tables"><a href="javascript:"><span>WP Outgoing Reports</span></a>';
                    }else {
                        echo '<li class="ic-grid-tables"><a href="changeBranch.php?branch='.$branch.'"><span>WP Outgoing Reports</span></a>';


                    }

                    ?>
                    <ul>
                        <?php

                        if($usertype=='Super User') {
                            echo ' <li><a href="all_outgoing_report.php">All Branches</a></li>';
                            echo ' <li><a href="#">_________________</a></li>';

                            foreach($_SESSION['branches'] as $value) {

                                echo ' <li><a href="changeBranch.php?branch='.$value.'">'.$value.'</a></li>';
                            }

                        }

                        ?>
                    </ul>
                    </li>
                    <?php
                    if($usertype=='Super User') {
                        echo'  <li class="ic-grid-tables"><a href="javascript:"><span>Inventory Analysis</span></a>';

                    }else {
                        echo'  <li class="ic-grid-tables"><a href="changeInventoryBranch.php?branch='.$branch.'"><span>Inventory Analysis</span></a>';


                    }
                    ?>
                    <ul>
                        <?php
                        if($usertype=='Super User') {
                            echo ' <li><a href="changeInventoryBranch.php?branch=all">All Branches</a></li>';
                            echo ' <li><a href="#">_________________</a></li>';

                            foreach($_SESSION['branches'] as $value) {

                                echo ' <li><a href="changeInventoryBranch.php?branch='.$value.'">'.$value.'</a></li>';
                            }
                        }
                        ?>
                    </ul>
                    </li>


                    <?php
                    if($usertype=='Super User') {
                        echo '<li class="ic-grid-tables"><a href="javascript:"><span>BM Production</span></a>';
                    }else {
                        echo '<li class="ic-grid-tables"><a href="changeBMProdBranch.php?branch='.$branch.'"><span>BM Production</span></a>';

                    }
                    ?>
                    <ul>
                        <?php
                        if($usertype=='Super User') {
                            echo ' <li><a href="all_bmprod.php">All Branches</a></li>';
                            echo ' <li><a href="#">_________________</a></li>';

                            foreach($_SESSION['branches'] as $value) {

                                echo ' <li><a href="changeBMProdBranch.php?branch='.$value.'">'.$value.'</a></li>';
                            }
                        }
                        ?>
                    </ul>
                    </li>

                    <?php
                    if($usertype=='Super User') {
                        echo '<li class="ic-grid-tables"><a href="javascript:"><span>Daily TEXT Report</span></a>';
                    }else {
                        echo '<li class="ic-grid-tables"><a href="changeTextBranch.php?branch='.$branch.'"><span>Daily Text Report</span></a>';

                    }
                    ?>
                    <ul>
                        <?php
                        if($usertype=='Super User') {
                            echo ' <li><a href="changeTextBranch.php">All Branches</a></li>';
                            echo ' <li><a href="#">_________________</a></li>';

                            foreach($_SESSION['branches'] as $value) {

                                echo ' <li><a href="changeTextBranch.php?branch='.$value.'">'.$value.'</a></li>';
                            }
                        }
                        ?>
                    </ul>
                    </li>




























                    <?php
                    if($usertype=='Super User') {
                        echo '<li class="ic-grid-tables"><a href="javascript:"><span>TS-FS analysis</span></a>';
                    }else {
                        echo '<li class="ic-grid-tables"><a href="changeTSFSanalysis.php?branch='.$branch.'"><span>TS-FS analysis</span></a>';

                    }
                    ?>
                    <ul>
                        <?php
                        if($usertype=='Super User') {
                            echo ' <li><a href="all_tsfs_analysis.php">All Branches</a></li>';
                            echo ' <li><a href="#">_________________</a></li>';

                            foreach($_SESSION['branches'] as $value) {

                                echo ' <li><a href="changeTSFSanalysis.php?branch='.$value.'">'.$value.'</a></li>';
                            }
                        }
                        ?>
                    </ul>
                    </li>





                    <li class="ic-grid-tables"><a href="javascript:"><span>Pricing Against Competitors</span></a>
                        <ul>
                            <?php
                            foreach($_SESSION['wp_grades'] as $value) {

                                echo ' <li><a href="pricing_competitors.php?grade='.$value.'">'.$value.'</a></li>';
                            }

                            ?>

                        </ul>
                    </li>
                    <?php
                    if($_SESSION['usertype']=='Super User') {
                        echo ' <li class="ic-grid-tables"><a href="javascript:"><span>Site Management</span></a>
                        <ul>
                        <li><a href="admin_grade_management.php">WP Grades </a></li>
                        <li><a href="admin_branch_management.php">Branches </a></li>
                        <li><a href="admin_outgoing_management.php">Manage Outgoing </a></li>
                            <li><a href="admin_form_target_quarterly.php">Target Quarterly </a></li>
                        </ul>
                        </li>

                        ';
                    }
                    ?>



                </ul>
            </div>
            <div class="clear">
            </div>
            <div class="grid_2">
                <div class="box sidemenu">
                    <div class="block" id="section-menu">
                        <ul class="section menu">



                            <li><a class="menuitem">Supplier Management</a>
                                <ul class="submenu">
                                    <?php
                                    echo ' <li><a href="supplierlist.php">Supplier List</a></li>';

                                    if($_SESSION['usertype']=='Super User') {
                                        echo ' <li><a href="formAddNewSupplier.php">Add A New Supplier</a></li>';
                                        echo ' <li><a href="formUploadSuppliers.php">Bulk Adding</a></li>';

                                    }

                                    ?>
                                </ul>
                            </li>


                            <li><a class="menuitem">Price Management</a>
                                <ul class="submenu">
                                    <?php
                                    echo ' <li><a href="overall_price_list.php">Overall Price List</a></li>';
                                    ;


                                    ?>
                                </ul>
                            </li>
                            <li><a class="menuitem">Packing List</a>
                                <ul class="submenu">
                                    <?php
                                    echo ' <li><a href="frmPackingList.php">Generate</a></li>';
                                    echo ' <li><a href="viewPackingList.php">View Packing List</a></li
                    >';
                                    ?>
                                </ul>
                            </li>




                        </ul>
                    </div>
                </div>
            </div>

