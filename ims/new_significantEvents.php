<?php
include("templates/template.php");
include 'config.php';
date_default_timezone_set("Asia/Singapore");
?>
<style>
    #total{

        font-weight: bold;

        background-color: yellow;

    }
</style>

<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />

<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>

<script type="text/javascript">

    function date1(str) {

    new JsDatePick({
    useMode: 2,
            target: str,
            dateFormat: "%Y/%m/%d"



    });
    }
    ;
    function date2(str) {

    new JsDatePick({
    useMode: 2,
            target: str,
            dateFormat: "%Y/%m"



    });
    }
            ;</script>
<script>
var tableToExcel = (function () {
var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
                            , base64 = function (s) {
                            return window.btoa(unescape(s))
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
//    window.location.href = uri + base64(format(template, ctx))
}
})()</script>

<?php
if (isset($_POST['filter_month'])) {
    $month = date('Y/m', strtotime($_POST['filter_month']));
} else {
    $month = date('Y/m');
}
?>

<div class="grid_6">

    <div class="box round first">

        <form action="new_significantEvents.php" method="POST">

            <br>

            <h6>Occurrence</h6>
            <br/>
            <table width="95%">
                <tr>
                    <td>Date: </td>
                    <td><input type='text'  id='inputField' name='date' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8" required></td>
                    <td>Branch Affected: </td>
                    <td>
                        <select name="branch">
                            <?php
                            $sql_branches = mysql_query("SELECT * from branches ORDER BY branch_name Asc");
                            while ($row_branches = mysql_fetch_array($sql_branches)) {
                                if (strtoupper($_SESSION['user_branch']) == strtoupper($row_branches['branch_name'])) {
                                    $attr = 'selected';
                                } else {
                                    $attr = '';
                                }
                                echo '<option value="' . $row_branches['branch_name'] . '" ' . $attr . '>' . $row_branches['branch_name'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td>Prepared By: </td>
                    <td><input type='text' name="prepared_by" value="<?php echo strtoupper($_SESSION['username']); ?>" readonly></td>
                </tr>
                <tr>
                    <td colspan="6"><br/><br/>Occurrence: <br/><textarea style="width:100%; resize: none;" rows="10" name="narration" required></textarea></td>
                </tr>
            </table>
            <input name="submit" type="submit" value="Submit">

        </form>

    </div>

</div>



<?php
if (isset($_POST['btn_app'])) {
    $val = explode('_', $_POST['btn_app']);
    mysql_query("UPDATE significant_events SET status='" . $val[0] . "' WHERE id='" . $val[1] . "' ");
} else if (isset($_POST['btn_dis'])) {
    $val = explode('_', $_POST['btn_dis']);
    mysql_query("UPDATE significant_events SET status='" . $val[0] . "' WHERE id='" . $val[1] . "' ");
}

if (isset($_POST['submit'])) {

    $date = $_POST['date'];
    $date_submitted = date('Y/m/d');
    $branch = $_POST['branch'];
    $prepared_by = $_POST['prepared_by'];
    $narration = utf8_decode(mysql_real_escape_string($_POST['narration']));

    mysql_query("INSERT INTO significant_events (date_submitted, date, branch, prepared_by, narration, status) VALUES('$date_submitted', '$date', '$branch', '$prepared_by', '$narration', 'pending')") or die(mysql_error());
}
if (empty($_POST['filter_month'])) {
    $m = date('Y/m');
} else {
    $m = $_POST['filter_month'];
}
$m2 = $m . '/01';
?>

<div class="grid_10" >

    <div class="box round first grid">

        <h2>Occurrences for the month of <?php echo date('F', strtotime($m2));?></h2>
        <br>
        <form action="new_significantEvents.php" method="post">
            Month: <input type='text'  id='inputField2' name='filter_month' value="<?php echo $m; ?>" onfocus='date2(this.id);' readonly size="8">
            <input type="submit" name="btn_month" value="Submit">
        </form>
        </br>
        <center><input type="button"  class="btn-success" onclick="tableToExcel('example', 'Significant Events')" value="Export XLS"></center>

        <table class="data display datatable" id="example" border="1">
            <?php
            echo "<thead>";
            echo "<th>Date</th>";
            echo "<th>Branch Affected</th>";
            echo "<th>Prepared by</th>";
            echo "<th>Occurrence</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "</thead>";
            if(strtoupper($_SESSION['user_branch']) != 'PAMPANGA'){
                $sql_sigEve = mysql_query("SELECT * from significant_events WHERE date LIKE '" . date('Y-m', strtotime($m2)) . "%' and branch LIKE '%".$_SESSION['user_branch']."%' ORDER BY date ASC");
            } else {
                $sql_sigEve = mysql_query("SELECT * from significant_events WHERE date LIKE '" . date('Y-m', strtotime($m2)) . "%' ORDER BY date ASC");
            }
            while (@$row_sigEve = mysql_fetch_array($sql_sigEve)) {
                echo '<tr>
                    <td>' . @$row_sigEve['date'] . '</td>
                    <td>' . utf8_encode(@$row_sigEve['branch']) . '</td>
                    <td>' . utf8_encode(@$row_sigEve['prepared_by']) . '</td>
                    <td>' . utf8_encode($row_sigEve['narration']) . '</td>
                    <td>' . @$row_sigEve['status'] . '</td>';
                if ($_SESSION['class'] == '1' && $row_sigEve['status'] == 'pending') {
                    echo '<td><form method="post" onsubmit="return confirm(\'Do you want to proceed?\');" target="_blank"><button name="btn_app" value="approved_' . $row_sigEve['id'] . '">Approve</button>&nbsp;&nbsp;<button name="btn_dis" value="disapproved_' . $row_sigEve['id'] . '">Disapprove</button></form></td>';
                } else {
                    echo '<td>-</td>';
                }
                echo '</tr>';
            }
            ?>



        </table>
    </div>
</div>

<div class="clear">



</div>



<div class="clear">



</div>


