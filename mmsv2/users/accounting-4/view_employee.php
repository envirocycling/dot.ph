<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />
    <style>
        .data{
            font-size: 15px;
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
                        ?>
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                        <style>
                            .data2{
                                text-transform: uppercase;
                            }
                            .empSummary td{
                                border-left: solid;
                                border-right: solid;
                                border-width: 1px;
                                height: 25px;
                            }
                            .empSummary td{
                                border-bottom: solid;
                                border-width: 1px;
                                border-collapse: collapse;
                            }
                            .total{
                                background-color: yellow;
                            }
                        </style>
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center><?php
                                    if (strpos($_GET['status'], 'to') !== false) {
                                        echo '<font color="blue"><b>' . ucwords(substr_replace($_GET['status'], ' ' . substr($_GET['status'], 2), 2)) . '</b></font>';
                                    } else if ($_GET['status'] == 'deactived') {
                                        echo '<font color="red"><b>Separated</b></font>';
                                    } else {
                                        echo '<font color="green"><b>' . ucwords($_GET['status']) . '</b></font>';
                                    }
                                    ?> Employees<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right">Show Employee Summary <input type="checkbox" name="empSummary"></td>
                                </tr>
                            </table>
                            <table class="empSummary empSum">
                                <?php
                                $arr_company = array();
                                $arr_companyData = array();
                                $arr_summaryBranch = array();
                                $arr_summaryCompany = array();
                                $sql_summary = mysql_query("SELECT * from employees");
                                while ($row_summary = mysql_fetch_array($sql_summary)) {
                                    @$arr_company[$row_summary['branch_id']][$row_summary['company_id']] ++;
                                    @$arr_summaryBranch[$row_summary['branch_id']] ++;
                                    @$arr_summaryCompany[$row_summary['company_id']] ++;
//                                            @$arr_branch[$row_summary['branch_id']]++;
                                }
                                $sql_company = mysql_query("SELECT * from company WHERE status='' Order By type Desc");
                                echo '<tr>';
                                echo '<td>&nbsp;</td>';
                                while ($row_company = mysql_fetch_array($sql_company)) {
                                    echo '<td><label class="label">' . $row_company['name'] . '</label></td>';
                                    array_push($arr_companyData, $row_company['company_id']);
                                }
                                echo '<td class="total">Total</td>';
                                echo '</tr>';
                                $sql_branch = mysql_query("SELECT * from branches WHERE status='' ORDER BY branch_name Asc");
                                while ($row_branch = mysql_fetch_array($sql_branch)) {
                                    echo '<tr>';
                                    echo '<td>' . $row_branch['branch_name'] . '</td>';
                                    foreach ($arr_companyData as $val) {
                                        echo '<td><center>' . @$arr_company[$row_branch['branch_id']][$val] . '</center></td>';
                                    }
                                    echo '<td class="total"><center>' . @$arr_summaryBranch[$row_branch['branch_id']] . '</center></td>';
                                    echo '</tr>';
                                }
                                echo '<tr>
                                    <td class="total">Total</td>';
                                foreach ($arr_companyData as $val) {
                                    echo '<td class="total"><center>' . @$arr_summaryCompany[$val] . '</center></td>';
                                    @$total += @$arr_summaryCompany[$val];
                                }
                                echo '<td class="total"><b><center>' . @$total . '</center></b></td>';
                                echo '</tr>';
                                ?>
                            </table>
                            <br /><br /><br />
                            <input type="hidden" id="emp_num">
                            <?php
                            $tbl_active = '';
                            if ($_GET['status'] == 'active') {
                                $tbl_active = 'employee';
                                $sql_employees = mysql_query("SELECT * from employees ORDER by lastname Asc") or die(mysql_error());
                            } else if ($_GET['status'] == 'deactived') {
                                $tbl_active = 'employee';
                                $sql_employees = mysql_query("SELECT * from employees_deactivated ORDER by lastname Asc") or die(mysql_error());
                            }
                            if ($tbl_active == 'employee') {
                                ?>
                                <table width="95%">
                                    <tr>
                                        <td>
                                            <table  class="data display datatable">
                                                <thead>
                                                    <tr class="data">
                                                        <th class="data">Employee Name</th>
                                                        <th class="data">Emp_No</th>
                                                        <th class="data">Birthdate</th>
                                                        <th class="data">Company</th>
                                                        <th class="data">Branch</th>
                                                        <th class="data">Position</th>
                                                        <th class="data">Date Hired</th>
                                                        <th class="data">Status</th>
                                                        <?php
                                                        if ($_GET['status'] == 'deactived') {
                                                            echo '<th class="data">Clearance Status</th>';
                                                        }
                                                        ?>
                                                        <th class="data" width="160px">Action</th>	
                                                    </tr>
                                                </thead>
                                                <?php
                                                while ($row_employees = mysql_fetch_array($sql_employees)) {
                                                    $str_counted = strlen($row_employees['middlename']) - 1;
                                                    if ($str_counted == 0) {
                                                        $middlename_view = $row_employees['middlename'];
                                                    } else {
                                                        $middlename_view = substr($row_employees['middlename'], 0, -$str_counted);
                                                    }
                                                    if (empty($row_employees['middlename'])) {
                                                        $middlename_view = '';
                                                    } else {
                                                        $middlename_view = ', ' . $middlename_view . '.';
                                                    }
                                                    $employee_fullname = ucwords($row_employees['lastname'] . ', ' . $row_employees['firstname'] . $middlename_view);

                                                    $emp_branch = mysql_query("SELECT * from branches WHERE branch_id = '" . $row_employees['branch_id'] . "' ") or die(mysql_error());
                                                    $row_emp_branch = mysql_fetch_array($emp_branch);

                                                    $emp_position = mysql_query("SELECT * from positions WHERE p_id = '" . $row_employees['position_id'] . "' ") or die(mysql_error());
                                                    $row_emp_position = mysql_fetch_array($emp_position);

                                                    $emp_company = mysql_query("SELECT * from company WHERE company_id = '" . $row_employees['company_id'] . "' ") or die(mysql_error());
                                                    $row_emp_company = mysql_fetch_array($emp_company);

                                                    $emp_status = mysql_query("SELECT * from employment_status WHERE e_id = '" . $row_employees['status_id'] . "' ") or die(mysql_error());
                                                    $row_emp_status = mysql_fetch_array($emp_status);


                                                        echo '<tr>
                                                            <td class="data">' . $employee_fullname . '</td>
                                                            <td class="data">' . $row_employees['emp_num'] . '</td>
                                                            <td class="data">' . date('M d, Y', strtotime($row_employees['birthdate'])) . '</td>
                                                            <td class="data">' . $row_emp_company['name'] . '</td>
                                                            <td class="data">' . $row_emp_branch['branch_name'] . '</td>
                                                            <td class="data">' . $row_emp_position['position'] . '</td>
                                                            <td class="data">' . date('M d, Y', strtotime($row_employees['date_hired'])) . '</td>
                                                            <td class="data">' . $row_emp_status['code'] . '</td>';
                                                        if ($_GET['status'] == 'deactived') {
                                                            $sql_clearance = mysql_query("SELECT * from form_clearance WHERE emp_num='" . $row_employees['emp_num'] . "'");
                                                            $row_clearance = mysql_fetch_array($sql_clearance);
                                                            if ($row_emp_company['type'] == '0' || mysql_num_rows($sql_clearance) == 0) {
                                                                $clearanceStatus = '-';
                                                            } else if ($row_clearance['gm_status'] == '1') {
                                                                $clearanceStatus = '<a href="../../forms/clearance.php?emp_num=' . $row_employees['emp_num'] . '" target="_blank">APPROVED</a>';
                                                            } else {
                                                                if ($_SESSION['dep_id'] == '2') {
                                                                    if($row_clearance['accounting_status'] == 'cleared') {
                                                                        $clearanceStatus = '<a href="../../forms/clearance.php?emp_num=' . $row_employees['emp_num'] . '" target="_blank"><font color="orange">PENDING</font></a>';
                                                                    }else{
                                                                        $clearanceStatus = '<a href="../../forms/clearance.php?emp_num=' . $row_employees['emp_num'] . '" target="_blank"><font color="red">PENDING</font></a>';
                                                                    }
                                                                } else if ($_SESSION['dep_id'] == '4') {
                                                                    if($row_clearance['treasury_status'] == 'cleared') {
                                                                        $clearanceStatus = '<a href="../../forms/clearance.php?emp_num=' . $row_employees['emp_num'] . '" target="_blank"><font color="orange">PENDING</font></a>';
                                                                    }else{
                                                                        $clearanceStatus = '<a href="../../forms/clearance.php?emp_num=' . $row_employees['emp_num'] . '" target="_blank"><font color="red">PENDING</font></a>';
                                                                    }
                                                                }
                                                            }
                                                            echo '<td>' . $clearanceStatus . '</td>';
                                                        }
                                                        echo '<td class="data"><input type="image" data-jAlert data-title="Employee Information" title="View" data-iframe="view_emp_data.php?emp_num=' . $row_employees['emp_num'] . '" data-fullscreen="true" src="../../images/button/view_icon.png" width="40" height="40">';
                                                        echo '</td>
                                                    </tr>';
                                                    }
                                                ?>
                                            </table>
                                        <?php } ?>
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

                $('.empSum').hide();
                $('[name=empSummary]').click(function () {
                    if ($(this).prop('checked')) {
                        $('.empSum').show(500);
                    } else {
                        $('.empSum').hide(100);
                    }
                });
            });

            $('input[type*="image"]').click(function () {
                var clas = $(this).attr('class');
                if (clas == 'delete') {
                    var id = $(this).attr('id');
                    $('#emp_num').val(id);
                    var first = $('#' + id).confirmation({
                        onShow: function (reponse) {
                            console.log('Start show event');
                        }
                    });
                } else if (clas == 'edit') {
                    var txt_id = $(this).attr('id');
                    var id = txt_id.split("_");
                    window.top.location.href = "view_edit_employee.php?emp_num=" + id[1] + "&active=view";
                } else if (clas == 'cancel') {
                    var id = $(this).attr('id');
                    $('#emp_num').val(id);
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
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        --><script src="pop-up/confirmation.js"></script>
        <script>
            $(function () {
                //for the data-jAlerts
                $.jAlert('attach');
            });

        </script>
