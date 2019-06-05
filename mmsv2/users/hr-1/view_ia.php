<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="stylesheet" href="validation/bootstrap.css"/>	
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
                        if (isset($_POST['filter'])) {
                            $sql_tns = mysql_query("SELECT * from incident_accident WHERE date_submitted LIKE '" . $_POST['year'] . "%'") or die(mysql_error());
                            $year = $_POST['year'];
                        } else {
                            if (@$_GET['noti'] > 0) {
                                $sql_tns = mysql_query("SELECT * from incident_accident WHERE status = 'pending to hr'") or die(mysql_error());
                            } else {
                                $sql_tns = mysql_query("SELECT * from incident_accident WHERE date_submitted LIKE '" . date('Y') . "%'") or die(mysql_error());
                            }
                            $year = date('Y');
                        }
                        ?>
                    </div>
                    <link rel="stylesheet" type="text/css" href="css/override.css">
                    <!--Main body-->
                    <div class="main">
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Incident / Accident<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                            </table>
                            <style>
                                .data2{
                                    text-transform: uppercase;
                                }
                                .buttons:hover{
                                    cursor: pointer;
                                }
                            </style>
                            <input type="hidden" id="emp_num">
                            <table width="95%">
                                <tr>
                                <form method="post">
                                    <td colspan="8" align="right">
                                        Year: <select name="year" style="width:100px; margin-top: 10px;" >
                                            <?php
                                            $year_from = '2010';
                                            $year_to = date('Y');
                                            echo '<option value="' . $year . '" selected >' . $year . '</option>';
                                            while ($year_from <= $year_to) {
                                                echo '<option value="' . $year_from . '">' . $year_from . '</option>';
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
                                        <input type="hidden" id="leave_id">
                                        <table  class="data display datatable">
                                            <thead>
                                                <tr class="data">
                                                    <th class="data">Report ID</th>
                                                    <th class="data">Date Submitted</th>
                                                    <th class="data">Category</th>
                                                    <th class="data">Description</th>
                                                    <th class="data">Person Involved</th>
                                                    <th class="data">Status</th>
                                                    <th class="data" width="150px">Action</th>	
                                                </tr>
                                            </thead>
                                            <?php
                                            while ($row_tns = mysql_fetch_array($sql_tns)) {
                                                $emp_num = explode(")", $row_tns['person']);
                                                $participants_num = 1;
                                                $employee_fullname = '';
                                                foreach ($emp_num as $participants) {
                                                    $participants = str_replace("(", "", $participants);
                                                    $participants_num++;
                                                    if ($participants > 0) {
                                                        $supp = explode('_', $participants);
                                                        if (!empty($supp[0]) && !empty($supp[1])) {
                                                            $employee_fullname .= $participants_num . '. ' . $participants . '<br>';
                                                        } else {
                                                            $sql_employees = mysql_query("SELECT * from employees WHERE emp_num = '$participants'");
                                                            $row_employees = mysql_fetch_array($sql_employees);
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
                                                            $employee_fullname .= $participants_num . '. ' . ucwords($row_employees['lastname'] . ', ' . $row_employees['firstname'] . $middlename_view) . '<br>';
                                                        }
                                                        $participants_num++;
                                                    }
                                                }
                                                echo '<tr class="data2">
                                                        <td>' . $row_tns['report_id'] . '</td>
                                                        <td>' . date('Y/m/d', strtotime($row_tns['date_submitted'])) . '</td>
                                                        <td>' . $row_tns['final_category'] . '</td>
                                                        <td>' . strtoupper($row_tns['description']) . '</td>
                                                        <td>' . $employee_fullname . '</td>
                                                        <td>' . strtoupper($row_tns['status']) . '</td>
                                                        <td class="data"><input type="image" data-jAlert data-title="Incident / Accident Report" title="View" data-iframe="view_emp_ia.php?report_id=' . $row_tns['report_id'] . '" data-fullscreen="true" src="../../images/button/view_icon.png" width="40" height="40"> | <img src="../../images/button/print_icon.png" width="40" height="40" title="Print" class="buttons" id="' . $row_tns['report_id'] . '"></td>
                                                    </tr>';
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
                    window.open('view_emp_iaPrint.php?report_id=' + _thisId);
                });

            });

            $('input[type*="image"]').click(function () {
                var clas = $(this).attr('class');
                var id = $(this).attr('id');
                if (clas == 'edit') {
                    window.top.location.href = "view_ia_edit.php?active=view&report_id=" + id;
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
