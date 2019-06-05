<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />
    <script src="bootstrap-table/bootstrap-table.js"></script>
    <link type="text/css" rel="stylesheet" href="bootstrap-table/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="bootstrap-table/bootstrap-table.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <script>
        $(document).ready(function () {
            $("#table").bootstrapTable({
                search: true,
                showToggle: true,
                searchAlign: 'left'
            });
        });
    </script>
    <style>
        .data{
            font-size: 13px;
        }
    </style>

    <body>
        <?php include 'layout/header.php'; ?>
        <script type="text/javascript">             var tableToExcel = (function () {
                var uri = 'data:application/vnd.ms-excel;base64,'
                        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body><table>{table}</table></body></html>'
                        , base64 = function (s) {
                            return window.btoa(unescape(encodeURIComponent(s)))
                        }
                , format = function (s, c) {
                    return s.replace(/{(\w+)}/g, function (m, p) {
                        return c[p];
                    })
                }
                return function (table, name) {
                    if (!table.nodeType)
                        table = document.getElementById(table)
                    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
                    window.location.href = uri + base64(format(template, ctx))
                }
            })()
        </script>
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
                        <script>
                            $(document).ready(function () {
                                var sort_by = $('select[name="sort_by"]').val();
                                if (sort_by == 'Date') {
                                    $('#s_date').show(200);
                                } else {
                                    $('#s_date').hide();
                                }
                                $('select[name="sort_by"]').change(function () {
                                    var sort_by = $('select[name="sort_by"]').val();
                                    if (sort_by == 'Date') {
                                        $('#s_date').show(200);
                                    } else {
                                        $('#s_date').hide();
                                    }
                                });
                            });
                        </script>
                        <?php
                        include 'layout/menu.php';
                        if (isset($_POST['filter'])) {
                            $sql_ia = mysql_query("SELECT * from incident_accident WHERE date_submitted >=  '" . $_POST['from'] . "' and date_submitted <=  '" . $_POST['to'] . "' ORDER by date_submitted Asc") or die(mysql_error());
                            $from = $_POST['from'];
                            $to = $_POST['to'];
                        } else {
                            $sql_ia = mysql_query("SELECT * from incident_accident WHERE date_submitted LIKE '" . date('Y-m') . "%' ORDER by date_submitted Asc") or die(mysql_error());
                            $from = date('Y/m');
                            $from = $from . '/01';
                            $to = date('Y/m/t');
                        }
                        ?>
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                        <style>
                            .data2{
                                font-size: 11px;
                                padding-bottom: 15px;
                                text-transform: uppercase;
                            }
                        </style>
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Report Training & Seminars<br></center></td>
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
                                        <input type="submit" class="btn btn-primary" value="Filter" name="filter">
                                </form>
                                </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><br><input type="button"  class="btn-success" onclick="tableToExcel('table', 'Trainig & Seminar Report')" value="Export XLS"><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table id="table" data-show-columns="true" data-url="/gh/get/response.json/wenzhixin/bootstrap-table/tree/master/docs/data/data1/">
                                            <thead>
                                                <tr class="data">
                                                    <th class="data">Date Submitted</th>
                                                    <th class="data">Branch</th>
                                                    <th class="data">Category</th>
                                                    <th class="data">Cost</th>
                                                    <th class="data">Status</th>
                                                    <th class="data">Description</th>
                                                    <th class="data">What Happened</th>
                                                    <th class="data" data-visible="false">When did it happened</th>
                                                    <th class="data">Person Involved</th>
                                                    <th class="data" data-visible="false">Corrective Action</th>
                                                    <th class="data" data-visible="false">Preventive Action</th>
                                                </tr>
                                            </thead>
                                            <input type="hidden" id="pr_id">
                                            <?php
                                            while ($row_ia = mysql_fetch_array($sql_ia)) {

                                                $sql_branch = mysql_query("SELECT * from branches WHERE branch_id='" . $row_ia['branch_id'] . "'");
                                                $row_branch = mysql_fetch_array($sql_branch);

                                                if ((@$_POST['sort_by'] == 'Date') || (!isset($_POST['sort_by']))) {
                                                    $ctr = 1;
                                                    $person = '';
                                                    $personEx = explode(")", $row_ia['person']);
                                                    foreach ($personEx as $feachVal) {
                                                        $repVal = str_replace("(", "", $feachVal);
                                                        $exVa = explode("_", $repVal);
                                                        if (empty($exVa[1])) {
                                                            $sql_emp = mysql_query("SELECT * from employees WHERE emp_num='$repVal'");
                                                            $row_emp = mysql_fetch_array($sql_emp);

                                                            $str_count = strlen($row_emp['middlename']) - 1;
                                                            $fullname = ucwords($row_emp['firstname'] . ' ' . substr($row_emp['middlename'], 0, -$str_count) . '. ' . $row_emp['lastname']);
                                                            if (mysql_num_rows($sql_emp) > 0) {
                                                                $person .= $ctr . '.) ' . $fullname . '<br>';
                                                            }
                                                        } else {
                                                            $person .= $ctr . '.) ' . $repVal . '<br>';
                                                        }
                                                        $ctr++;
                                                    }

                                                    echo '<tr class="data2">
                                                                <td>' . date('Y/m/d', strtotime($row_ia['date_submitted'])) . '</td>
                                                                <td>' . $row_branch['branch_name'] . '</td>
                                                                <td>' . $row_ia['final_category'] . '</td>';
                                                    if ($row_ia['cost'] > 0) {
                                                        echo '<td>' . number_format($row_ia['cost'], 2) . '</td>';
                                                    } else {
                                                        echo '<td> - </td>';
                                                    }
                                                    echo '<td>' . $row_ia['status'] . '</td>';
                                                    echo '<td>' . $row_ia['description'] . '</td>';
                                                    echo '<td>' . $row_ia['what_happened'] . '</td>';
                                                    echo '<td>' . date('Y/m/d h:i A', strtotime($row_ia['date_happened'])) . '</td>';
                                                    echo '<td>' . $person . '</td>';
                                                    echo '<td>' . $row_ia['corrective_action'] . '</td>';
                                                    echo '<td>' . $row_ia['preventive_action'] . '</td>';
                                                    echo '</tr>';
                                                }
                                            }
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><input type="button"  class="btn-success" onclick="tableToExcel('table', 'Trainig & Seminar Report')" value="Export XLS"></td>
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


