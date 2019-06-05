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
                        <?php
                        include 'layout/menu.php';
                        $arr_leaveType = array();
                        $arr_leaveTypeDis = array();
                        if (isset($_POST['filter'])) {
                            $from = $_POST['from'];
                            $to = $_POST['to'] . ' 23:59:59';
                            $sql_leave = mysql_query("SELECT DISTINCT(emp_num), branch_id, position_id from leaves WHERE date_affected1 >= '$from' and 	date_affected2 <= '$to' and status = 'approved' and validated='1' ORDER by date_affected1 Asc") or die(mysql_error());

                            $sql_leaveType = mysql_query("SELECT DISTINCT(leave_type) as leave_type from leaves WHERE 	date_affected1 >= '$from' and 	date_affected1 <= '$to' and status = 'approved' and validated='1' ORDER by date_affected1 Asc") or die(mysql_error());

                            $sql_empLeave = mysql_query("SELECT * from leaves WHERE date_affected1 >= '$from' and date_affected2 <= '$to' and status = 'approved' and validated='1' ORDER by date_affected1 Asc") or die(mysql_error());
                        } else {
                            $sql_leave = mysql_query("SELECT DISTINCT(emp_num), branch_id, position_id from leaves WHERE date_affected1 LIKE '" . date('Y-m') . "%' and status = 'approved' and validated='1' ORDER by date_affected1 Asc") or die(mysql_error());
                            $sql_leaveType = mysql_query("SELECT DISTINCT(leave_type) as leave_type from leaves WHERE date_affected1 LIKE '" . date('Y-m') . "%' and status = 'approved' and validated='1' ORDER by date_affected1 Asc") or die(mysql_error());
                            $from = date('Y/m');
                            $from = $from . '/01';
                            $to = date('Y/m/t') . ' 23:59:59';
                            
                            $sql_empLeave = mysql_query("SELECT * from leaves WHERE date_affected1 >= '$from' and date_affected2 <= '$to' and status = 'approved' and validated='1' ORDER by date_affected1 Asc") or die(mysql_error());
                        }
                        while ($row_empLeave = mysql_fetch_array($sql_empLeave)) {
                            @$arr_leaveType[$row_empLeave['emp_num']][$row_empLeave['leave_type']] += $row_empLeave['no_days'];
                        }
                        ?>
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                        <style>
                            .data2{
                                text-transform: uppercase;
                            }
                            table{
                                background-color: white;
                            }
                        </style>
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Leave Summary Report<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                            </table>
                            <input type="hidden" id="emp_num">
                            <table width="95%">
                                <tr>
                                <form method="post">
                                    <td colspan="8" align="right">Date: <input type="text" style="width:115px; height: 30px; margin-top: 10px;" id="datetimepicker" name="from" autocomplete="off" placeholder="required" value="<?php echo $from; ?>" required/> To: <input type="text" style="width:115px; height: 30px; margin-top: 10px;" id="datetimepicker1" name="to" autocomplete="off"  placeholder="required" value="<?php echo date('Y/m/d', strtotime($to)); ?>" required/> 
                                        <input type="submit" class="btn btn-primary" value="Filter" name="filter">
                                </form>
                                </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><br><input type="button"  class="btn-success" onclick="tableToExcel('table', 'Report Delinquency')" value="Export XLS"><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table id="table" data-show-columns="true" data-url="/gh/get/response.json/wenzhixin/bootstrap-table/tree/master/docs/data/data1/">
                                            <thead>
                                                <tr class="data">
                                                    <th class="data">Employee</th>
                                                    <th class="data">Position</th>
                                                    <th class="data">Company</th>
                                                    <th class="data">Branch</th>
<?php
while ($row_leaveType = mysql_fetch_array($sql_leaveType)) {
    echo '<th class="data">' . ucwords($row_leaveType['leave_type']) . '</th>';
    array_push($arr_leaveTypeDis, $row_leaveType['leave_type']);
}
?>
                                                </tr>
                                            </thead>
<?php
while ($row_leave = mysql_fetch_array($sql_leave)) {

    $emp_branch = mysql_query("SELECT * from branches WHERE branch_id = '" . $row_leave['branch_id'] . "' ") or die(mysql_error());
    $row_emp_branch = mysql_fetch_array($emp_branch);

    $emp_company = mysql_query("SELECT * from company WHERE company_id = '" . $row_emp_branch['company_id'] . "' ") or die(mysql_error());
    $row_emp_company = mysql_fetch_array($emp_company);

    $emp_position = mysql_query("SELECT * from positions WHERE p_id = '" . $row_leave['position_id'] . "' ") or die(mysql_error());
    $row_emp_position = mysql_fetch_array($emp_position);

    $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_leave['emp_num'] . "' ") or die(mysql_error());
    if (mysql_num_rows($sql_emp) == 0) {
        $sql_emp = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '" . $row_leave['emp_num'] . "' ") or die(mysql_error());
    }
    $row_emp = mysql_fetch_array($sql_emp);
    $chk_count = strlen($row_emp['middlename']);
    if ($chk_count > 1) {
        $str_count = strlen($row_emp['middlename']) - 1;
        $middlename = substr($row_emp['middlename'], 0, -$str_count);
    } else {
        $middlename = $row_emp['middlename'];
    }
    if (empty($row_emp['middlename'])) {
        $middlename = '';
    } else {
        $middlename = ', ' . $middlename . '.';
    }
    $fullname_del = strtoupper($row_emp['lastname'] . ', ' . $row_emp['firstname'] . $middlename);

    echo '<tr class="data2">
                                                            <td>' . $fullname_del . '</td>
                                                            <td>' . $row_emp_position['position'] . '</td>
                                                            <td>' . $row_emp_company['name'] . '</td>
                                                            <td>' . $row_emp_branch['branch_name'] . '</td>';
    foreach ($arr_leaveTypeDis as $val_arr_leaveTypeDis) {
        echo '<td>' . @$arr_leaveType[$row_leave['emp_num']][$val_arr_leaveTypeDis] . '</td>';
    }
    echo '</tr>';
}
?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><br><input type="button"  class="btn-success" onclick="tableToExcel('table', 'Report Delinquency')" value="Export XLS"><br></td>
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


