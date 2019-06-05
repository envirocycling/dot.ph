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
                        if (isset($_POST['filter'])) {
                            if (@$_POST['status'] == 'all') {
                                $status_filter = '';
                            } else {
                                $status_filter = @$_POST['status'];
                            }
                            $sql_del = mysql_query("SELECT * from delinquency WHERE (status LIKE '$status_filter%' or implementation_status LIKE '$status_filter%') and implementation_status!='N/A' and date_committed >= '" . $_POST['from'] . "' and date_committed <= '" . $_POST['to'] . "' and company_id='" . $row_user['agency_id'] . "'") or die(mysql_error());
                            $from = $_POST['from'];
                            $to = $_POST['to'];
                        } else {
                            $sql_del = mysql_query("SELECT * from delinquency WHERE implementation_status='pending to agency' and company_id='" . $row_user['agency_id'] . "'") or die(mysql_error());
                            $from = date('Y/m');
                            $from = $from . '/01';
                            $to = date('Y/m/t');
                        }
                        ?>
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                        <style>
                            .data2{
                                text-transform: uppercase;
                            }
                        </style>
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Employees<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                            </table>
                            <input type="hidden" id="emp_num">
                            <?php
                            $sql_employees = mysql_query("SELECT * from employees WHERE company_id='" . $_SESSION['company_id'] . "' ORDER by lastname Asc") or die(mysql_error());
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
                                                //$middlename_view = substr($row_employees['middlename'],0,-$str_counted);
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

                                                $num = 1;
                                                echo '<tr class="data2">';
                                                echo '<td>' . $employee_fullname . '</td>
                                                            <td>' . $row_employees['emp_num'] . '</td>
                                                            <td>' . date('M d, Y', strtotime($row_employees['birthdate'])) . '</td>
                                                            <td>' . $row_emp_company['name'] . '</td>
                                                            <td>' . $row_emp_branch['branch_name'] . '</td>
                                                            <td>' . $row_emp_position['position'] . '</td>
                                                            <td>' . date('M d, Y', strtotime($row_employees['date_hired'])) . '</td>
                                                            <td>' . $row_emp_status['code'] . '</td>';
                                                echo '<td><input type="image" data-jAlert data-title="Employee Information" title="View" data-iframe="view_emp_data.php?emp_num=' . $row_employees['emp_num'] . '" data-fullscreen="true" src="../../images/button/view_icon.png" width="40" height="40">';
                                                if (empty($separated)) {
                                                    echo ' | <input type="image" src="../../images/button/edit_icon.png" title="Edit" class="edit" id="edit_' . $row_employees['emp_num'] . '" width="40" height="40"></td>';
                                                }
                                                echo '</tr>';
                                                $num++;
                                            }
                                            ?>
                                        </table>
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
                                            var first = $('.delete').confirmation({
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
                                                window.open("view_edit_employee.php?emp_num=" + id[1] + "&active=view");
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
