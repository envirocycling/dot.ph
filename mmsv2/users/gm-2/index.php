<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />
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
                        ?>
<!--                        <script>
                            function zoom(id) {
                                var zoom = $('#' + id).attr('class');
                                if (zoom != 'out') {
                                    $('#' + id).width("100%");
                                    $('#ann_ctrl').val('1');
                                    $('#' + id).attr('class', 'out');
                                } else {
                                    $('#' + id).width("50%");
                                    $('#ann_ctrl').val('0');
                                    $('#' + id).attr('class', 'imgs');
                                }
                            }
                        </script>-->
                    </div>
                    <div class="main">
                        <link rel="stylesheet" type="text/css" href="css/index_portions.css">
                        <link rel="stylesheet" href="../../slider/birthday_corner/iframe.css">
                        <div class="main_wrapper">
                            <!--Anoouncement start -->
                            <?php
                            if (isset($_POST['filter'])) {
                                $sql_ann = mysql_query("SELECT * from announcement WHERE date_post LIKE  '" . $_POST['year'] . "%' ORDER by date_post Desc") or die(mysql_error());
                            } else {
                                $sql_ann = mysql_query("SELECT * from announcement WHERE date_post LIKE '" . date('Y-') . "%' ORDER by date_post Desc") or die(mysql_error());
                            }
                            ?>
                            <div id="announcements"><span class="announcements2">Announce</span>ments</div>
                            <div id="announcements_frame" name="announcement">
                                <table width="95%">
                                    <tr>
                                    <form method="post">
                                        <td colspan="8" align="right"> Year: <select name="year" style="width:100px; margin-top: 10px;" >
                                                <?php
                                                $year_from = '2016';
                                                $year_to = date('Y') + 1;
                                                $year = date('Y');
                                                while ($year_from <= $year_to) {
                                                    if (isset($_POST['filter'])) {
                                                        if ($_POST['year'] == $year_from) {
                                                            $attr = 'selected';
                                                        } else {
                                                            $attr = '';
                                                        }
                                                    } else if ($year == $year_from) {
                                                        $attr = 'selected';
                                                    } else {
                                                        $attr = '';
                                                    }
                                                    echo '<option value="' . $year_from . '" ' . @$attr . '>' . $year_from . '</option>';
                                                    $year_from++;
                                                }
                                                ?>
                                            </select>
                                            <input type="submit" class="btn btn-primary" value="Filter" name="filter">
                                    </form>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table class="data display datatable">
                                                <thead>
                                                    <tr class="data">
                                                        <th class="data">Date Posted</th>
                                                        <th class="data">Title</th>
                                                        <th class="data">Action</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                while ($row_ann = mysql_fetch_array($sql_ann)) {

                                                    echo '<tr class="data2">
                                                                <td>' . date('Y/m/d', strtotime($row_ann['date_post'])) . '</td>
                                                                <td>' . strtoupper($row_ann['title']) . '</td>
                                                                <td><input type="image" data-jAlert data-title="Announcement" data-iframe="view_ann.php?a_id=' . $row_ann['a_id'] . '" title="View" data-fullscreen="true" src="../../images/button/view_icon.png" width="40" height="40"></td>
                                                        </tr>';
                                                }
                                                ?>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!--Anoouncement end -->

                            <!--noti start -->
                            <div id="event"><span class="noti">Notifications</span></div>
                            <div id="event_frames">
                                <br />
                                <?php
                                $sql_noti_leave = mysql_query("SELECT * from leaves WHERE status='pending to gm' and manager_status='pending'") or die(mysql_error());
                                $row_noti_leave = mysql_num_rows($sql_noti_leave);

                                if ($row_noti_leave > 0) {
                                    $row_notit_leave = mysql_fetch_array($sql_noti_leave);
                                    echo '<a href="view_leave.php?status=active&active=view">You have <font color="black">' . $row_noti_leave . ' leave request to approve</font>.</a><hr>';
                                }

                                $sql_noti_pr = mysql_query("SELECT * from personnel_requisition WHERE gm_status='pending'") or die(mysql_error());
                                $row_noti_pr = mysql_num_rows($sql_noti_pr);
                                if ($row_noti_pr > 0) {
                                    while ($row_notit_pr = mysql_fetch_array($sql_noti_pr)) {
                                        @$hr_pending += 1;
                                    }
                                    echo '<a href="view_pr.php?status=active&active=view">You have <font color="black">' . $hr_pending . ' pending to approve</font> personnel requisition request.</a><hr>';
                                }

                                $sql_noti_mm = mysql_query("SELECT * from manpower_movement WHERE status='pending to gm'") or die(mysql_error());
                                $row_noti_mm = mysql_num_rows($sql_noti_mm);
                                if ($row_noti_mm > 0) {
                                    while ($row_notit_mm = mysql_fetch_array($sql_noti_mm)) {
                                        @$mm += 1;
                                    }
                                    echo '<a href="view_empmovement.php?status=active&active=view">You have <font color="black">' . @$mm . ' pending to transfer </font> employee movement request.</a><hr>';
                                }

                                $sql_tns = mysql_query("SELECT * from training_seminar WHERE status='pending to gm'") or die(mysql_error());
                                $row_tns_num = mysql_num_rows($sql_tns);
                                if ($row_tns_num > 0) {
                                    while ($row_tns = mysql_fetch_array($sql_tns)) {
                                        @$tns += 1;
                                    }
                                    echo '<a href="view_trainingseminar.php?status=active&active=view">You have <font color="black">' . @$tns . ' pending to approved </font> training & seminar request.</a><hr>';
                                }

                                $sql_noti_sepa = mysql_query("SELECT * from form_clearance WHERE gm_status='0' and accounting_status='cleared' and supervisor_status='cleared' and treasury_status='cleared' and hr_status='cleared' and it_status='cleared'") or die(mysql_error());
                                $row_noti_sepa = mysql_num_rows($sql_noti_sepa);
                                if ($row_noti_sepa > 0) {
                                    while ($row_notit_sepa = mysql_fetch_array($sql_noti_sepa)) {
                                        @$sepa += 1;
                                    }
                                    echo '<a href="view_employee.php?status=deactived&active=view&clearance=pending">You have <font color="black">' . @$sepa . ' pending to approved </font> employee clearance request.</a><hr>';
                                }
                                ?>
                            </div>
                            <!--noti end -->

                            <!--birthday start -->
                            <div id="bday"><center>Birthday Corner<br>
                                    <span id="bday2"><?php echo 'Month of ' . date('F'); ?><br></span>
                                    <span id="bday3">Happy Birthday!<br><br></span>
                                    <div id="bday4">
                                        <?php
                                        echo '<br>';
                                        $ctrl = 1;
                                        $chk_date = '';
                                        $sql_bday = mysql_query("SELECT DATE_FORMAT(`birthdate`,'%m-%d') as birthdate, DATE_FORMAT(`birthdate`,'%Y-%m-%d') as birthdate2, lastname, firstname, middlename, company_id from employees Order By birthdate Asc") or die(mysql_error());
                                        while ($row_bday = mysql_fetch_array($sql_bday)) {
                                            $sql_company = mysql_query("SELECT * from company WHERE company_id = '" . $row_bday['company_id'] . "'");
                                            $row_company = mysql_fetch_array($sql_company);
                                            if ($row_company['type'] == '1') {
                                                $c_month = date('m');
                                                $row_m = date('m', strtotime($row_bday['birthdate2']));

                                                $c_day = date('d');
                                                $row_day = date('d', strtotime($row_bday['birthdate2']));

                                                if ($c_month == $row_m && $c_day <= $row_day) {
                                                    $chk_str = strlen($row_bday['middlename']);
                                                    if ($chk_str > 1) {
                                                        $str_count = strlen($row_bday['middlename']) - 1;
                                                        $middlename = substr($row_bday['middlename'], 0, -$str_count);
                                                    } else {
                                                        $str_count = strlen($row_bday['middlename']);
                                                        $middlename = $row_bday['middlename'];
                                                    }
                                                    if (empty($row_bday['middlename'])) {
                                                        $middlename = '';
                                                    } else {
                                                        $middlename = ' ' . $middlename . '. ';
                                                    }
                                                    $fullname = ucwords(strtolower($row_bday['firstname'] . $middlename . $row_bday['lastname']));
                                                    if (empty($chk_date)) {
                                                        $chk_date = date('M d', strtotime($row_bday['birthdate2']));
                                                    }
                                                    if ($ctrl == 1 && $chk_date == date('M d', strtotime($row_bday['birthdate2']))) {
                                                        echo '&nbsp;<font size="5em">' . $fullname . '(' . $row_company['name'] . ') - ' . date('M d', strtotime($row_bday['birthdate2'])) . '</font>&nbsp;&nbsp;<hr>';
                                                    } else {
                                                        echo '&nbsp;' . $fullname . ' - ' . date('M d', strtotime($row_bday['birthdate2'])) . '&nbsp;&nbsp;<hr>';
                                                        $ctrl++;
                                                    }
                                                    $chk_date = date('M d', strtotime($row_bday['birthdate2']));
                                                }
                                            }
                                        }
                                        ?></div>
                                </center>
                            </div>
                            <div id="iframe_wrapper">
                                <iframe id="iframe_bday" frameborder="0" src="../../slider/birthday_corner/events.php?page=init" height="100%" width="100%"></iframe>
                            </div>
                            <!--birthday end -->
                        </div>
                    </div>
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
    </body>
</html>

<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<script type="text/javascript" src="js/jquery.ui.core.min2.js"></script>
<script src="js/setup.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>

<link rel='stylesheet' href='pop-up/jAlert.css'>
<script src='pop-up/jAlert.js'></script>
<script src='pop-up/jAlert-functions.js'></script>
<script src="pop-up/jAlert.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
--><script src="pop-up/confirmation.js"></script>
<script>
    $(function () {
        //for the data-jAlerts
        $.jAlert('attach');
    });

</script>