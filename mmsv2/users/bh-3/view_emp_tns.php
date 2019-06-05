<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
<style>
    #table{
        width:1000px;
        border-bottom: groove;
        border-top: groove;
        border-left: groove;
        border-right: groove;
    }
    .table{
        width:400px;
    }
    .tr{
        border-bottom: groove;
        border-top: groove;
        border-left: groove;
        border-right: groove;
    }
    .attachement{
        font-style: italic;
        color: blue;
        font-size: 13px;
        font-weight: 700;
    }
</style>
<?php
include("../../connect.php");

$sql_tns = mysql_query("SELECT * from  training_seminar WHERE tns_id = '" . $_GET['tns_id'] . "'") or die(mysql_error());
$row_tns = mysql_fetch_array($sql_tns);
$emp = explode(")", $row_tns['participants']);

$sql_gm = mysql_query("SELECT * from users WHERE user_type = '2'") or die(mysql_error());
$row_gm = mysql_fetch_array($sql_gm);
$sql_gmname = mysql_query("SELECT * from employees WHERE emp_num='" . $row_tns['gm_num'] . "'") or die(mysql_error());
$row_gmname = mysql_fetch_array($sql_gmname);
$chk_strgm = strlen($row_gmname['middlename']);
if ($chk_strgm > 1) {
    $str_countgm = strlen($row_gmname['middlename']) - 1;
    $gm_middlename = substr($row_gmname['middlename'], 0, -$str_countgm);
} else {
    $gm_middlename = $row_gmname['middlename'];
}
if (empty($row_gmname['middlename'])) {
    $gm_middlename = '';
} else {
    $gm_middlename = ', ' . $gm_middlename . '.';
}
$gm_fullname = ucwords($row_gmname['lastname'] . ', ' . $row_gmname['firstname'] . $gm_middlename);

$sql_prepared = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_tns['prepared_num'] . "' ") or die(mysql_error());
$row_prepared = mysql_fetch_array($sql_prepared);
$chk_str = strlen($row_prepared['middlename']);
if ($chk_str > 1) {
    $str_count = strlen($row_prepared['middlename']) - 1;
    $middlename = substr($row_prepared['middlename'], 0, -$str_count);
} else {
    $str_count = strlen($row_prepared['middlename']);
    $middlename = $row_prepared['middlename'];
}
if (empty($row_prepared['middlename'])) {
    $middlename = '';
} else {
    $middlename = ', ' . $middlename . '.';
}
$fullnamePrepared = ucwords($row_prepared['lastname'] . ', ' . $row_prepared['firstname'] . $middlename);
?>
<center>   
    <table id="table">
        <tr>
            <td colspan="6"><center><h2><?php echo ucwords($row_tns['title']); ?></h2></center></td>
        </tr>
        <tr>
            <td colspan="6"><center><font size='-1'><?php echo strtoupper($row_tns['venue']); ?></font></center><br></td>
        </tr>
        <tr>
            <td width="100px">Facilitator:</td>
            <td colspan="5" style="text-align: left;"><?php echo ucwords($row_tns['facilitator']); ?></td>
        </tr>
        <tr>
            <td width="100px">Date:</td>
            <td colspan="5" style="text-align: left;"><?php echo date('F d, Y h:i A', strtotime($row_tns['from_date'])) . ' to ' . date('F d, Y h:i A', strtotime($row_tns['to_date'])); ?></td>
        </tr>
        <tr>
            <!--<td colspan="4">-->
            <?php
//            $sql_att = mysql_query("SELECT * from training_seminar_attachment WHERE tns_id = '" . $row_tns['tns_id'] . "'");
//            while ($row_att = mysql_fetch_array($sql_att)) {
//                echo 'Attachment : <a class="attachement" target="_blank" href="../../attachment/tns/' . $row_att['file_name'] . '">' . $row_att['file_name'] . '</a><br >';
//            }
            ?>
            <!--</td>-->
        </tr>
<!--        <tr>
<td width="100px">Attachment:</td>
<td colspan="3" style="text-align: left;"><a href="../../attachment/tns/<?php echo $row_tns['attachment']; ?>" target="_blank"><font color="blue" style="text-decoration: underline;"><i><?php echo $row_tns['attachment']; ?></font></i></a></td>
</tr>-->
        <tr>
            <td width="100px">Type:</td>
            <td colspan="5" style="text-align: left;"><?php echo ucwords($row_tns['type']); ?></td>
        </tr>
        <tr>
            <td width="100px">Status:</td>
            <td colspan="5" style="text-align: left;"><?php echo ucwords($row_tns['status']); ?></td>
        </tr>
        <tr>
            <td colspan="6"><br></td>
        </tr>
        <tr height="35px;">
            <td class="tr"><b>No</b></td>
            <td colspan="3" class="tr"><b>Employee Name</b></td>
            <td class="tr"><b>Attachment</b></td>
            <td class="tr"><b>Certificate</b></td>
        </tr>
        <?php
        $arrAtt = array();
        $arrAttCert = array();
        $sql_att = mysql_query("SELECT * from training_seminar_attachment WHERE tns_id = '" . $row_tns['tns_id'] . "'");
        while ($row_att = mysql_fetch_array($sql_att)) {
            $attend1 = str_replace('(','',$row_att['emp_num']);
            $attend = str_replace(')','',$attend1);
             if(is_numeric($row_att['file_name'])){
                 $att = '';
             }else{
                 $att = $row_att['file_name'];
             }
             if(is_numeric($row_att['cert_name'])){
                 $attCert = '';
             }else{
                 $attCert = $row_att['cert_name'];
             }
            $arrAtt[$attend]='<a class="attachement" target="_blank" href="../../attachment/tns/' . $row_att['file_name'] . '">'.$att.'</a>';
            $arrAttCert[$attend] = '<a class="attachement" target="_blank" href="../../attachment/tns/' . $row_att['cert_name'] . '">' . $attCert. '</a>';
//            echo 'Attachment : <a class="attachement" target="_blank" href="../../attachment/tns/' . $row_att['file_name'] . '">' . $row_att['file_name'] . '</a><br >';
        }

        $num = 1;
        $numCtr = 0;
        foreach ($emp as $attendee) {
            $attendee = str_replace("(", "", $attendee);
            if ($attendee > 0) {
                $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '$attendee'") or die(mysql_error());
                if (mysql_num_rows($sql_emp) == 0) {
                    $sql_emp = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '$attendee'") or die(mysql_error());
                }
                $row_emp = mysql_fetch_array($sql_emp);
                $chk_str = strlen($row_emp['middlename']);
                if ($chk_str > 1) {
                    $str_count = strlen($row_emp['middlename']) - 1;
                    $middlename = substr($row_emp['middlename'], 0, -$str_count);
                } else {
                    $str_count = strlen($row_emp['middlename']);
                    $middlename = $row_emp['middlename'];
                }
                $fullname = ucwords($row_emp['lastname'] . ', ' . $row_emp['firstname'] . ' ' . $middlename . '.');
                echo '<tr>
                            <td class="tr">' . $num . '.</td>
                            <td colspan="3" class="tr">' . $fullname . '</td>
                            <td class="tr">' . @$arrAtt[$attendee] . '</td>
                            <td class="tr">' . @$arrAttCert[$attendee] . '</td>
                        </tr>';
                $num++;
                $numCtr++;
            }
        }
        ?>
    </table>
    <br/><br/><br/>
    <table class="table">
        <tr>
            <td><img src="../../images/signature/<?php echo $row_tns['prepared_num']; ?>.png" height="40" width="90"></td>
        </tr>
        <tr>
            <td><?php echo $fullnamePrepared; ?></td>
        </tr>
        <tr>
            <td>Prepared By<br/></td>
        </tr>
        <tr>
            <td><?php if ($row_tns['status'] == 'approved') { ?><img src="../../images/signature/<?php echo $row_tns['gm_num']; ?>.png" height="40" width="90"><?php } ?></td>
        </tr>
        <tr>
            <td><?php echo $gm_fullname; ?></td>
        </tr>
        <tr>
            <td>Approved By</td>
        </tr>
    </table>
</center>
