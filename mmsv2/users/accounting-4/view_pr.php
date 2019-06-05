<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <style>
        .data{
            font-size: 13px;
        }
        .buttons:hover{
            cursor: pointer;
        }
    </style>

    <body>
        <?php include 'layout/header.php'; ?>
        <!-- Start home section -->
        <div id="home">

            <!-- Start cSlider -->
            <div id="da-slider" class="da-slider">
                <div class="triangle"></div>
                <!-- mask elemet use for masking background image -->
                <div class="mask"></div>
                <!-- All slides centred in container element -->

                <div class="container">

                    <div class="title">
                        <?php
                        include 'layout/menu.php';
                        if (isset($_POST['filter'])) {
                            if (@$_POST['status'] == 'all') {
                                $status_filter = '';
                            } else {
                                $status_filter = @$_POST['status'];
                            }
                            $sql_pr = mysql_query("SELECT * from personnel_requisition WHERE status LIKE '$status_filter%' and date_requested >= '" . $_POST['from'] . "' and date_requested <= '" . $_POST['to'] . "' ORDER by date_requested Asc") or die(mysql_error());
                            $from = $_POST['from'];
                            $to = $_POST['to'];
                        } else {
                            $sql_pr = mysql_query("SELECT * from personnel_requisition WHERE status LIKE 'pending%' and date_requested LIKE '" . date('Y-m') . "%' ORDER by date_requested Asc") or die(mysql_error());
                            $from = date('Y/m');
                            $from = $from . '/01';
                            $to = date('Y/m/t');
                        }
                        ?>
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Personnel Requisition<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                            </table>
                            <input type="hidden" id="emp_num">
                            <table width="95%">
                                <tr>
                                <form method="post">
                                    <td colspan="8" align="right">Date: <input type="text" style="width:115px; height: 30px; margin-top: 10px;" id="datetimepicker" name="from" autocomplete="off" placeholder="required" value="<?php echo $from; ?>" required/> To: <input type="text" style="width:115px; height: 30px; margin-top: 10px;" id="datetimepicker1" name="to" autocomplete="off"  placeholder="required" value="<?php echo $to; ?>" required/> 
                                        Status: <select name="status" style="width:115px; height: 30px; margin-top: 10px;">
                                            <?php
                                            if (isset($_POST['filter'])) {
                                                $status = $_POST['status'];
                                                if (empty($status)) {
                                                    $status = 'all';
                                                }
                                                ?>
                                                <option value="" selected><?php echo ucwords($status); ?></option>

                                            <?php }
                                            ?>
                                            <option value="pending">Pending</option>
                                            <option value="approved">Approved</option>
                                            <option value="diapproved">Disapproved</option>
                                            <option value="noted">Noted</option>
                                            <option value="served">Served</option>
                                            <option value="cancelled">Cancelled</option>
                                            <option value="">All</option>
                                        </select>
                                        <input type="submit" class="btn btn-primary" value="Filter" name="filter">
                                </form>
                                </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table  class="data display datatable">
                                            <thead>
                                                <tr class="data">
                                                    <th class="data">Date Requested</th>
                                                    <th class="data">PR_No</th>
                                                    <th class="data" width="150px">Job Title</th>
                                                    <th class="data">Date Needed</th>
                                                    <th class="data">Employment Status</th>
                                                    <th class="data">Branch Requested</th>
                                                    <th class="data" width="120px">GM Status</th>
                                                    <th class="data" width="120px">HR Status</th>
                                                    <th class="data">Served TAT</th>
                                                    <th class="data" width="120px">Action</th>	
                                                </tr>
                                            </thead>
                                            <input type="hidden" id="pr_id">
                                            <?php
                                            while ($row_pr = mysql_fetch_array($sql_pr)) {
                                                if (strpos($row_user['branch_id'], '(' . $row_pr['branch_id'] . ')') !== false) {

                                                    $emp_branch = mysql_query("SELECT * from branches WHERE branch_id = '" . $row_pr['branch_id'] . "' ") or die(mysql_error());
                                                    $row_emp_branch = mysql_fetch_array($emp_branch);

                                                    $emp_position = mysql_query("SELECT * from positions WHERE p_id = '" . $row_pr['job_title'] . "' ") or die(mysql_error());
                                                    $row_emp_position = mysql_fetch_array($emp_position);

                                                    $emp_company = mysql_query("SELECT * from company WHERE company_id = '" . $row_pr['company_id'] . "' ") or die(mysql_error());
                                                    $row_emp_company = mysql_fetch_array($emp_company);

                                                    if ($row_pr['employment_status'] == 'Agency') {
                                                        $emp_status = $row_pr['employment_status'] . ' under ' . $row_emp_company['name'];
                                                    } else {
                                                        $emp_status = $row_pr['employment_status'];
                                                    }
                                                    $chk_served = strtotime($row_pr['hr_serve_date']);

                                                    //served tat start
                                                    if ($chk_served > 0) {
                                                        $date1 = $row_pr['gm_date'];
                                                        $date2 = $row_pr['hr_serve_date'];
                                                        $diff = abs(strtotime($date2) - strtotime($date1));
                                                        $years = floor($diff / (365 * 60 * 60 * 24));
                                                        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                                        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                                        if ($days > 1) {
                                                            $served_tat = $days . ' days';
                                                        } else {
                                                            $served_tat = $days . ' day';
                                                        }

                                                        $hr_status = ucwords($row_pr['hr_status'] . ' <i><font size="-1">' . date('M d, Y', strtotime($row_pr['hr_date']))) . '</i></font>';
                                                    } else {
                                                        $served_tat = '-';
                                                    }
                                                    //served tat end
                                                    //hr status start
                                                    if ($row_pr['hr_status'] == 'noted') {
                                                        $hr_status = ucwords($row_pr['hr_status'] . '<br> <i><font size="-1"> at ' . date('M d, Y', strtotime($row_pr['hr_date']))) . '</i></font>';
                                                    } else if ($row_pr['hr_status'] == 'served') {
                                                        $hr_status = ucwords($row_pr['hr_status'] . '<br> <i><font size="-1"> at ' . date('M d, Y', strtotime($row_pr['hr_serve_date']))) . '</i></font>';
                                                    } else if ($chk_served > 0) {
                                                        $hr_status = ucwords($row_pr['hr_status'] . '<br> <i><font size="-1"> at ' . date('M d, Y', strtotime($row_pr['hr_date']))) . '</i></font>';
                                                    } else if ($row_pr['hr_status'] == 'cancelled') {
                                                        $hr_status = ucwords($row_pr['hr_status'] . '<br> <i><font size="-1"> at ' . date('M d, Y', strtotime($row_pr['hr_date']))) . '</i></font>';
                                                    } else {
                                                        $hr_status = ucwords($row_pr['hr_status']);
                                                    }
                                                    //hr status end
                                                    //gm status start
                                                    if ($row_pr['gm_status'] != 'pending') {
                                                        $gm_status = ucwords($row_pr['gm_status'] . '<br> <i><font size="-1"> at ' . date('M d, Y', strtotime($row_pr['gm_date']))) . '</i></font>';
                                                    } else {
                                                        $gm_status = ucwords($row_pr['gm_status']);
                                                    }
                                                    //gm status end

                                                    echo '<tr>
                                                                <td class="data">' . date('Y/m/d', strtotime($row_pr['date_requested'])) . '</td>
                                                                <td class="data">' . $row_pr['pr_id'] . '</td>
                                                                <td class="data">' . $row_emp_position['position'] . '</td>
                                                                <td class="data">' . date('Y/m/d', strtotime($row_pr['date_needed'])) . '</td>
                                                                <td class="data">' . $emp_status . '</td>
                                                                <td class="data">' . $row_emp_branch['branch_name'] . '</td>
                                                                <td class="data">' . $gm_status . '</td>
                                                                <td class="data">' . $hr_status . '</td>
                                                                <td class="data">' . $served_tat . '</td>
                                                                <td class="data"><input type="image" data-jAlert data-title="Personnel Rrequest Form" data-iframe="view_emp_pr.php?pr_id=' . $row_pr['pr_id'] . '" data-fullscreen="true" title="View" src="../../images/button/view_icon.png" width="40" height="40"> | <img src="../../images/button/print_icon.png" width="40" height="40" title="Print" class="buttons" id="' . $row_pr['pr_id'] . '">';
                                                    if ($row_pr['gm_status'] == 'approved' && $row_pr['hr_status'] == 'pending') {
                                                        echo '| <input type="image" class="cancel" id="' . $row_pr['pr_id'] . '" title="Do you want to cancel this request?" src="../../images/button/cancel_icon.png" width="40" height="40">';
                                                    }
                                                    echo '</td>
                                                        </tr>';
                                                }
                                            }
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </center><br><br><br>
                    </div>
                    <!--Main body end-->

                </div>

            </div>
        </div>
        <!-- End home section -->
        <!-- Service section start -->
        <div class="section primary-section" id="service">
            <div class="container">
            </div>
        </div>
        <!-- Service section end -->

<?php include 'layout/footer.php'; ?>

        <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
        <script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
        <script src="js/setup.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                setupLeftMenu();
                $('.datatable').dataTable();
                setSidebarHeight();
                var first = $('.cancel').confirmation({
                    onShow: function () {
                        console.log('Start show event');
                    }
                });

                $('.buttons').click(function () {
                    var _thisId = $(this).attr('id');
                    window.open('view_emp_prPrint.php?pr_id=' + _thisId);
                });
            });

            $('input[type*="image"]').click(function () {
                var clas = $(this).attr('class');
                if (clas == 'cancel') {
                    var id = $(this).attr('id');
                    $("#pr_id").val(id);
                    var first = $('#' + id).confirmation({
                        onShow: function (reponse) {
                            console.log('Start show event');
                        }
                    });
                }
            });

        </script>
        <link rel='stylesheet' href='pop-up/jAlert.css'>
        <script src='pop-up/jAlert.js'></script>
        <script src='pop-up/jAlert-functions.js'></script>
        <script src="pop-up/jAlert.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <script src="pop-up/confirmation.js"></script>
        <script>
                    $(function () {
                        //for the data-jAlerts
                        $.jAlert('attach');
                    });
        </script>
        <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
        <script src="js/jquery.datetimepicker.full.js"></script>
        <script>
                    $('#datetimepicker').keydown(false);
                    $('#datetimepicker1').keydown(false);
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

                    $('#datetimepicker1').datetimepicker({
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
                    $('#datetimepicker1').datetimepicker({value: '', step: 30});
        </script>


