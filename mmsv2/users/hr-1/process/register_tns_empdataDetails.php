
<style>
    .empDetails .thead{
        background-color: #2789f9;
        font-family: 'Calibri';
        text-transform: uppercase;
        font-weight: bold;
        color: white;
    }
    .data, .val{
        text-decoration: underline;
    }
</style>
<?php

include('../../../connect.php');

$emp_num = str_replace('(', '', rtrim($_POST['emp_num'], ')'));

$sql_emp = mysql_query("SELECT * FROM employees WHERE emp_num = '$emp_num'");
if(mysql_num_rows($sql_emp) == 0){
   $sql_emp = mysql_query("SELECT * FROM employees_deactivated WHERE emp_num = '$emp_num'"); 
}
$row_emp_data = mysql_fetch_array($sql_emp);

$company = mysql_query("SELECT * from company WHERE status='' and company_id='" . $row_emp_data['company_id'] . "'") or die(mysql_error());
$row_company = mysql_fetch_array($company);

$position = mysql_query("SELECT * from positions WHERE p_id='" . $row_emp_data['position_id'] . "'") or die(mysql_error());
$row_position = mysql_fetch_array($position);

$otherPosition = '';
$arrOtherPosition = str_replace('[', '', explode(']', $row_emp_data['other_positionId']));
foreach ($arrOtherPosition as $thisVal) {
    $positionOther = mysql_query("SELECT * from positions WHERE  p_id='$thisVal'") or die(mysql_error());
    $row_positionOther = mysql_fetch_array($positionOther);
    $otherPosition .= strtoupper($row_positionOther['position']) . ',<br>';
}

$position = mysql_query("SELECT * from positions WHERE  p_id='" . $row_emp_data['position_id'] . "'") or die(mysql_error());
$row_position = mysql_fetch_array($position);

$branch = mysql_query("SELECT * from branches WHERE status='' and branch_id='" . $row_emp_data['branch_id'] . "'") or die(mysql_error());
$row_branch = mysql_fetch_array($branch);

$sql_rank = mysql_query("SELECT * from rank WHERE r_id='" . $row_emp_data['rank_id'] . "'") or die(mysql_error());
$row_rank = mysql_fetch_array($sql_rank);

$emp_status = mysql_query("SELECT * from employment_status WHERE e_id='" . $row_emp_data['status_id'] . "'") or die(mysql_error());
$row_emp_status = mysql_fetch_array($emp_status);

@$arr_tertiary = explode('~', $row_emp_data['tertiary']);
@$arr_secondary = explode('~', $row_emp_data['secondary']);
@$arr_primary = explode('~', $row_emp_data['elementary']);

echo '<table class="empDetails '.$_POST['class'].'" >';
echo '  <tr>
            <td align="left" colspan="4"><h4>' . $row_emp_data['lastname'] . ', ' . $row_emp_data['firstname'] . ', ' . $row_emp_data['middlename'] . '</h4></td>
        </tr>
        <tr class="thead">
             <td colspan="4">EDUCATIONAL ATTAINMENT</td>
        </tr>
        <tr>
            <td>TERTIARY:</td>
            <td class="data">' . @$arr_tertiary[0] . '</td>
            <td>YEAR GRADUATED:</td>
            <td class="data">' . @$arr_tertiary[1] . '</td>
        </tr>
        <tr>
            <td>SECONDARY:</td>
            <td class="data">' . @$arr_secondary[0] . '</td>
            <td>YEAR GRADUATED:</td>
            <td class="data">' . @$arr_secondary[1] . '</td>
        </tr>
        <tr>
            <td>ELEMENTARY:</td>
            <td class="data">' . @$arr_primary[0] . '</td>
            <td>YEAR GRADUATED:</td>
            <td class="data">' . @$arr_primary[1] . '</td>
        </tr>
        <tr class="thead">
            <td colspan="4">EMPLOYMENT DETAILS</td>
        </tr>
        <tr>
            <td class="td_1">Date Hired:</td>
            <td align="left"><span class="val">' . date('F d, Y', strtotime($row_emp_data['date_hired'])) . '</span></td>
            <td>Orig. Hiring Date:</td>
            <td align="left"  style="width:20%;"><span class="val">' . date('F d, Y', strtotime($row_emp_data['date_start'])) . '</span></td>
        </tr>
        <tr>
            <td class="td_1">Company:</td>
            <td align="left"><span class="val">' . $row_company['description'] . ' (' . $row_company['name'] . ')</span></td>
            <td style="width:20%;">Branch:</td>
            <td align="left"><span class="val">' . $row_branch['branch_name'] . '</span></td>
        </tr>
        <tr>
            <td class="td_1">Position:</td>
            <td align="left"><span class="val">' . $row_position['position'] . '</span></td>
            <td class="td_1">Other Position:</td>
            <td align="left"><span class="val">' . rtrim($otherPosition, ', ') . '</span></td>	
        </tr>
        <tr>
            <td class="td_1">Rank:</td>
            <td align="left"><span class="val">' . $row_rank['description'] . '</span></td>
            <td style="width:20%;">Employement Status:</td>
            <td align="left"><span class="val">' . $row_emp_status['code'] . '</span></td>		
        </tr>
        <tr>
            <td class="td_1">Stay-in:</td>
            <td align="left"><span class="val">' . $row_emp_data['stayin'] . '</span></td>
            <td class="td_1"></td>
            <td align="left"></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr class="thead">
             <td colspan="4">TRAINING AND SEMINAR ATTENDED</td>
        </tr>';

$sql_tnsHis = mysql_query("SELECT * from training_seminar WHERE participants LIKE '%($emp_num)%' ORDER BY from_date Asc") or die(mysql_error());
while ($row_tnsHis = mysql_fetch_array($sql_tnsHis)) {
    echo '<tr>
            <td class="data">' . date('M d, Y h:i A', strtotime($row_tnsHis['from_date'])) . '<br> to <br>' . date('M d, Y h:i A', strtotime($row_tnsHis['to_date'])) . '</td>
            <td colspan="2" class="data"><center>' . $row_tnsHis['title'] . '</center></td>
            <td class="data"><center>' . $row_tnsHis['bond'] . ' months</center></td>
        </tr>';
}
echo '</table>';


