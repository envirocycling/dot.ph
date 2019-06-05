<?php

date_default_timezone_set("Asia/Manila");
include('connect.php');

$truck_id = $_GET['truck_id'];

echo '<tr>
                                        <td>Date</td>
                                        <td>HRM</td>
                                        <td>Remarks</td>
                                    </tr>';

$sql_he = mysql_query("SELECT * from tbl_hrm WHERE truck_id = '$truck_id' ORDER BY date Asc") or die(mysql_error());
while ($row_he = mysql_fetch_array($sql_he)) {
    if (mysql_num_rows($sql_he) > 0) {
        echo '<tr>
                <td style="font-size:18px;">' . date('Y/m/d', strtotime($row_he['date'])) . '</td>
                <td style="font-size:18px;">' . number_format($row_he['hrm']) . '</td>
                <td style="font-size:18px;">' . $row_he['remarks'] . '</td>
            </tr>';
    }
}

$sql_coSet = mysql_query("SELECT * from tbl_truck_report WHERE id = '$truck_id' and coSet > 0 ");
$row_coSet = mysql_fetch_array($sql_coSet);

$sql_coSched = mysql_query("SELECT * from tbl_changeoilset WHERE id='".$row_coSet['coSet']."'") or die(mysql_error());
echo '~<table border="1">';
echo '<tr>
                        <td colspan="6"><center><b>HRM CHANGE OIL SCHEDULE</b></center></td>
                    </tr>';
echo '<tr>
                        <td>Set</td>
                        <td>Engine Oil</td>
                        <td>ATF</td>
                        <td>Gear Oil</td>
                        <td>Hydraulic Oil</td>
                        <td>Coolant</td>';
echo '</tr>';
$row_coSched = mysql_fetch_array($sql_coSched);
    echo '<tr>';
    echo '<td>' . strtoupper($row_coSched['set']) . '</td>';
    echo '<td>' . number_format($row_coSched['engine_oil']) . '</td>';
    echo '<td>' . number_format($row_coSched['atf']) . '</td>';
    echo '<td>' . number_format($row_coSched['gear_oil']) . '</td>';
    echo '<td>' . number_format($row_coSched['hydraulic_oil']) . '</td>';
    echo '<td>' . number_format($row_coSched['coolant']) . '</td>';
    echo '</tr>';
echo '</table>';
