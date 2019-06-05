<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:index.php");
}
?>
<style>
    h1{
        color:white;
    }
</style>
<?php
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
            jQuery(document).ready(function ($) {
                $('a[rel*=facebox]').facebox({
                    loadingImage: 'src/loading.gif',
                    closeImage: 'src/closelabel.png'
                })
            })
        </script>
    </head>
    <body>
        <div class="container_12">
            <div class="grid_12 header-repeat">
                <div id="branding">
                    <div class="floatleft">
                        <img style="position: absolute; margin-top: -15px;" src="images/efi_ico.png" height="50" width="50"/><h1 style="position: absolute; margin-left: 50px;">&nbsp;EFI PURCHASING SYSTEM</h1></div>
                    <div class="floatright">
                        <div class="floatleft">
                            <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                        <div class="floatleft marginleft10">
                            <ul class="inline-ul floatleft">
                                <li>Welcome <i><u><b><?php echo $_SESSION['username']; ?></b></u></i></li>
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
                    <?php
                    if ($_SESSION['username'] == 'lonlon') {
                        echo '   <ul class="select"><li><a href="admin.php"><b>Home</b></a></li></ul>
                        <ul class="select"><li><a href="viewRequests.php"><b>Unclassified</b></a></li></ul>
                        <ul class="select"><li><a href="adminApprovedPR.php"><b>Approved</b></a></li></ul>
                        <ul class="select"><li><a href="adminDisapproved.php"><b>Disapproved</b></a></li></ul>
                        <ul class="select"><li><a href="servedPRs.php"><b>Served</b></a></li></ul>
                        <ul class="select"><li><a href="adminOfficeSupplies.php"><b>Office Supplly PRs</b></a></li></ul>
                        <ul class="select"><li><a href="DeliveredadminOfficeSupplies.php"><b>Delivered Supply</b></a></li></ul>
                        <ul class="select"><li><a href="queuedtobh.php"><b>Queued To BH</b></a></li></ul>
                        <ul class="select"><li><a href="queuedtollr.php"><b>Queued To LLR</b></a></li></ul>
                        <ul class="select"><li><a href="queuedtohr.php"><b>Queued To HR</b></a></li></ul>
                         <ul class="select"><li><a href="for_canvassing.php"><b>For Canvassing</b></a></li></ul>
               <ul class="select"><li><a href="check_requisition.php"><b>Check Requisition</b></a></li></ul>
               <ul class="select"><li><a href="fund_requisition.php"><b>Fund Requisition</b></a></li></ul>
			     <ul class="select"><li><a href="users.php"><b>Users</b></a></li></ul>';
                    } else if ($_SESSION['position'] == 'Accounting') {
					  echo '<ul class="select"><li><a href="home.php"><b>Home</b></a></li></ul>';
                        echo '<ul class="select"><li><a href="new_acctgcheck_requisition.php"><b>Check Requisition</b></a></li></ul>
                        <ul class="select"><li><a href="new_acctgcash_requisition.php"><b>Cash Requisition</b></a></li></ul>';
                        echo '<li class = "ic-grid-tables"><a href = "javascript:"><span>Fund Requisition</span></a>';
                        echo '<ul>';
                        echo '<li><a href="new_acctgfund_requisition.php"><b>Fund Request</b></a></li>';
                        echo '<li><a href="new_acctgfund_maintaining.php"><b>Maintaning Balance</b></a></li>';
                        echo '</ul>';
                        echo '</li>';
//                        if ($_SESSION['username'] == 'afr' || $_SESSION['username'] == 'AFR' || $_SESSION['username'] == 'acctg' || $_SESSION['username'] == 'ACCTG') {
//                            echo '<ul class="select"><li><a href="fund_requisition2.php"><b>Fund Requisition</b></a></li></ul>';
//                        } else {
//                            echo '<ul class="select"><li><a href="fund_requisition.php"><b>Fund Requisition</b></a></li></ul>';
//                        }
                    } else if ($_SESSION['username'] == 'rgm') {
                        echo '<ul class="select"><li><a href="adminOfficeSupplies.php"><b>Office Supplly PRs</b></a></li></ul>';
                        echo '<ul class="select"><li><a href="DeliveredadminOfficeSupplies.php"><b>Delivered Supply</b></a></li></ul>';
                        echo '<li class = "class"><a href = "new_approve_cash_requisition.php"><b>Cash Requisition</b></a></li>';
                    } else if ($_SESSION['username'] == 'efi_hrd') {
                        echo '<li class="ic-dashboard"><a href="formPR.php"><b>Send PR</b></a></li>';
                        echo '<ul class="select"><li><a href="hrRequests.php"><b>PPE Request</b></a></li></ul>';
                        echo '<li class="ic-dashboard"><li><a href="hrprRequests.php"><b>Queued to Mgmt.</b></a></li>';
                        echo '<ul class="select"><li><a href="cash_requisition.php"><b>Cash Requisition</b></a></li></ul>';
                    } else if ($_SESSION['username'] == 'lorna_regala') {
                        echo '  <ul class="select"><li><a href="llrRequests.php"><b>Pending</b></a></li></ul>
                        <ul class="select"><li><a href="llrApproved.php"><b>Approved</b></a></li></ul>
                        <ul class="select"><li><a href="llrDisApproved.php"><b>Disapproved</b></a></li></ul>
                        <ul class="select"><li><a href="llrServed.php"><b>Served</b></a></li></ul>
                        <ul class="select"><li><a href="new_llrcheck_requisition.php"><b>Check Requisition</b></a></li></ul>
                        <ul class="select"><li><a href="new_llrcash_requisition.php"><b>Cash Requisition</b></a></li></ul>
                        <ul class="select"><li><a href="new_llrfund_requisition.php"><b>Fund Requisition</b></a></li></ul>';

//                        <ul class="select"><li><a href="check_requisition.php"><b>Check Requisition</b></a></li></ul>
//                        <ul class="select"><li><a href="cash_requisition.php"><b>Cash Requisition</b></a></li></ul>
//                        <ul class="select"><li><a href="fund_requisition2.php"><b>Fund Requisition</b></a></li></ul>';
                    } else if ($_SESSION['position'] == 'BH') {
                        echo '  <ul class="select"><li><a href="home.php"><b>Pending</b></a></li></ul>';
                        echo '  <ul class="select"><li><a href="bhToSignDisapprovedPR.php"><b>My Disapproved PRs</b></a></li></ul>';
                        echo '  <ul class="select"><li><a href="bhToSignForwardedPR.php"><b>My Queued PRs to Mgmt.</b></a></li></ul>';
                        echo ' <ul class="select"><li><a href="for_canvassing.php"><b>For Canvassing</b></a></li></ul>';

                        echo ' <ul class = "select"><li><a href = "new_bhcheck_requisition.php"><b>Check Requisition</b></a></li></ul > ';

//                        echo ' <ul class = "select"><li><a href = "check_requisition.php"><b>Check Requisition</b></a></li></ul > ';
                        echo '<ul class = "select"><li><a href = "new_bhcash_requisition.php"><b>Cash Requisition</b></a></li></ul>';

//                                                echo '<ul class = "select"><li><a href = "cash_requisition.php"><b>Cash Requisition</b></a></li></ul>';

                        echo '<ul class = "select"><li><a href = "new_bhfund_requisition.php"><b>Fund Requisition</b></a></li></ul>';

//                        echo '<ul class = "select"><li><a href = "fund_requisition.php"><b>Fund Requisition</b></a></li></ul>';
                    } else if ($_SESSION['username'] == 'rex') {
                        echo ' <ul class = "select"><li><a href = "mechanic.php"><b>Pending</b></a></li></ul>
                        <ul class = "select"><li><a href = "mechanic_disapproved.php"><b>My Disapproved PRs</b></a></li></ul>
                        <li class = "ic-dashboard"><li><a href = "mechaBHApproval.php"><b>Queued to BH</b></a></li>
                        <li class = "ic-dashboard"><li><a href = "mechaAdminApproval.php"><b>Queued to Mgmt.</b></a></li>';
                    } else if ($_SESSION['username'] == 'restie') {
                        echo ' <ul class = "select"><li><a href = "electric.php"><b>Pending</b></a></li></ul>
                        <ul class = "select"><li><a href = "electric_disapproved.php"><b>My Disapproved PRs</b></a></li></ul>
                        <li class = "ic-dashboard"><li><a href = "electricBHApproval.php"><b>Queued to BH</b></a></li>
                        <li class = "ic-dashboard"><li><a href = "electricAdminApproval.php"><b>Queued to Mgmt.</b></a></li>';
                    } else if ($_SESSION['username'] == 'jake' || $_SESSION['username'] == 'JAKE') {
                        echo '<li class = "class"><a href = "new_approve_check_requisition.php"><b>Check Requisition</b></a></li>';
                    } else if ($_SESSION['username'] == 'canvasser') {
                        
                    } else {
                        echo '
                        <li class = "ic-dashboard"><a href = "home.php"><b>Home</b></a></li>';
                        echo '<li class = "ic-dashboard"><a href = "formPR.php"><b>Send PR</b></a></li>
                        <li class = "ic-dashboard"><li><a href = "forRexApproval.php"><b>Queued to Mechanic</b></a></li>
						<li class = "ic-dashboard"><li><a href = "forRestyApproval.php"><b>Queued to Electronic</b></a></li>
                        <li class = "ic-dashboard"><a href = "OfficeSupplies.php"><b>Office Supplies</b></a></li>
                        <li class = "ic-dashboard"><a href = "PPESupplies.php"><b>PPE Supplies</b></a></li>
                        <li class = "ic-dashboard"><li><a href = "forBHApproval.php"><b>Queued to BH</b></a></li>
                        <li class = "ic-dashboard"><li><a href = "prRequests.php"><b>Queued to Mgmt.</b></a></li>
                        <li class = "ic-grid-tables"><a href = "javascript:"><span>Canvassing</span></a>
                        <ul>
                        <li><a href = "for_canvassing.php">Outgoing</a></li>
                        <li><a href = "incoming_canvassing.php">Incoming</a></li>
                        </ul>
                        </li>
                        <ul class = "select"><li><a href = "new_check_requisition.php"><b>Check Requisition</b></a></li></ul>
                        <ul class = "select"><li><a href = "new_cash_requisition.php"><b>Cash Requisition</b></a></li></ul>
                        <ul class = "select"><li><a href = "new_fund_requisition.php"><b>Fund Requisition</b></a></li></ul > ';

//                        <ul class="select"><li><a href="check_requisition.php"><b>Check Requisition</b></a></li></ul>
//                        <ul class="select"><li><a href="cash_requisition.php"><b>Cash Requisition</b></a></li></ul>
//                        <ul class="select"><li><a href="fund_requisition.php"><b>Fund Requisition</b></a></li></ul>';
                    }
					if($_SESSION['username'] == 'dsd'){
							echo '<ul class="select"><li><a href="hrRequests.php"><b>PPE Request</b></a></li></ul>';
						}
                    ?>

                    </li>
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