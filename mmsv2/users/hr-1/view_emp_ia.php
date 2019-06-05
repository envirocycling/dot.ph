<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/del_form.css">
<script type="text/javascript" src="validation/jquery.min.js"></script>
<style>
    table{
        font-style: italic;
    }
    .txt_val{
        padding-left: 40px;
    }
</style>
<script>
    $(document).ready(function () {
        $('input[type="file"]').change(function () {
            var upload_root = $('[name="upload"]').val();
            var upload_type = upload_root.slice(-3);
            var to_lower = upload_type.toLowerCase();
            if (to_lower != 'pdf') {
                alert("Invalid file type. Please choose PDF only.");
                $('[name="upload"]').val('');
            }
        });
    });
</script>
<?php
include("../../connect.php");

if (isset($_POST['submit'])) {
    $sql_ia = mysql_query("SELECT * from incident_accident  WHERE report_id = '" . $_GET['report_id'] . "'");
    $row_ia = mysql_fetch_array($sql_ia);
    $personEx = explode(")", $row_ia['person']);
    $pAgency = 0;
    $person = '';
    $agencyId = '';
    foreach ($personEx as $feachVal) {
        $repVal = str_replace("(", "", $feachVal);
        $exVa = explode("_", $repVal);
        if (empty($exVa[1])) {
            $sql_emp = mysql_query("SELECT * from employees WHERE emp_num='$repVal'");
            $row_emp = mysql_fetch_array($sql_emp);

            $str_count = strlen($row_emp['middlename']) - 1;
            $fullname = ucwords($row_emp['firstname'] . ' ' . substr($row_emp['middlename'], 0, -$str_count) . '. ' . $row_emp['lastname']);
            $person .= $fullname . ', ';

            $sql_agency = mysql_query("SELECT * from company WHERE company_id='" . $row_emp['company_id'] . "' and type = '0'");
            if (mysql_num_rows($sql_agency) > 0) {
                $pAgency++;
                $agencyId .= '~' . $row_emp['company_id'];
            }
        } else {
            $person .= $repVal . ', ';
        }
    }

    $to = '';
    if ($_POST['final_cost'] > '0') {
        $status = 'pending to accounting';
        $content = "Good day Ma'am/Sir \r\n Report for " . $person . " is pending for billing/deduction or charge. For the BH/Agency, kindly upload authority to deduct/charge slip form signed by the person involved. This request is now " . $status;

        $sql_emailTo2 = mysql_query("SELECT * from email WHERE  status='' and department='accounting'") or die(mysql_error());
        while ($row_emailTo2 = mysql_fetch_array($sql_emailTo2)) {
            $to .= $row_emailTo2['email'] . ',';
        }
    } else if ($_POST['final_category'] == 'for delinquency') {
        $status = 'pending to supervisor';
        $content = "Good day Ma'am/Sir \r\n Report for " . $person . " is pending for creating delinquency. For the BH kindly submit delinquency report for employee involved. This request is now " . $status;
    } else {
        $status = '-';
        $content = "Good day Ma'am/Sir \r\n Report for " . $person . " is for information only. This request is now close";
    }

    @$target_dir = "../../attachment/ia/";
    @$target_file = $target_dir . $_GET['report_id'] . '-' . basename($_FILES["upload"]["name"]);
    if (!file_exists(@$target_file)) {
        move_uploaded_file(@$_FILES["upload"]["tmp_name"], $target_file);
    }

    if (mysql_query("UPDATE incident_accident SET final_category='" . $_POST['final_category'] . "', final_cost='" . $_POST['final_cost'] . "', status='$status', hr_attachment='" . $_GET['report_id'] . '-' . basename($_FILES["upload"]["name"]) . "', hr_remarks='" . mysql_real_escape_string($_POST['remarks']) . "'  WHERE report_id = '" . $_GET['report_id'] . "' ")) {

        $cc = 'CC: ';
        $exAgencyId = explode("~", $agencyId);
        foreach ($exAgencyId as $feachVal) {
            $sql_emailCC = mysql_query("SELECT * from email WHERE emp_num = '$feachVal' and status='' and department='agency'") or die(mysql_error());
            while ($row_emailCC = mysql_fetch_array($sql_emailCC)) {
                $cc .= $row_emailCC['email'] . ',';
            }
        }

        $sql_emailTo = mysql_query("SELECT * from email WHERE department = 'hr' and status=''") or die(mysql_error());
        while ($row_emailTo = mysql_fetch_array($sql_emailTo)) {
            $cc .= $row_emailTo['email'] . ',';
        }

        $sql_bh = mysql_query("SELECT * from users WHERE status='' and branch_id LIKE '%(" . $row_del['branch_id'] . ")%' and user_type='3'") or die(mysql_error());
        while ($row_bh = mysql_fetch_array($sql_bh)) {
            $sql_emailBH = mysql_query("SELECT * from email WHERE emp_num = '" . $row_bh['emp_num'] . "' and status=''") or die(mysql_error());
            $row_emailBH = mysql_fetch_array($sql_emailBH);
            $to .= $row_emailBH['email'] . ',';
        }

        $subject = "INCIDENT/ACCIDENT REPORT";
        $message = $content . ".\r\n\n Please Login here http://mmsv2.efi.net.ph/ to do more action.\r\n\n Thank you. \r\n\n Note: This is a system generated email, do not reply to this email. Use Google Chrome or Mozilla Firefox to view it properly.";
        $headers = "From: envirocyclingfiberincorporated@efi.net.ph" . "\r\n" . $cc;
        mail($to, $subject, $message, $headers);

        echo '<script>
                 window.top.location.href="view_ia.php?status=active&active=view&http=200";
             </script>';
    } else {
        echo '<script>
                 window.top.location.href="view_ia.php?status=active&active=view&http=400";
             </script>';
    }
} else if (isset($_POST['bClear'])) {
    if (mysql_query("UPDATE incident_accident SET status='cleared' WHERE report_id = '" . $_GET['report_id'] . "' ")) {
        echo '<script>
                 window.top.location.href="view_ia.php?status=active&active=view&http=200";
             </script>';
    } else {
        echo '<script>
                 window.top.location.href="view_ia.php?status=active&active=view&http=400";
             </script>';
    }
}

$sql_ia = mysql_query("SELECT * from incident_accident WHERE report_id = '" . $_GET['report_id'] . "'") or die(mysql_error());
$row_ia = mysql_fetch_array($sql_ia);

$sql_branch = mysql_query("SELECT * from branches WHERE branch_id='" . $row_ia['branch_id'] . "'") or die(mysql_error());
$row_branch = mysql_fetch_array($sql_branch);

$emp_num = explode(")", $row_ia['person']);
$employee_fullname = '';
foreach ($emp_num as $participants) {
    $participants = str_replace("(", "", $participants);
    if ($participants > 0) {
        $supp = explode('_', $participants);
        if (!empty($supp[0]) && !empty($supp[1])) {
            $employee_fullname .= $participants . '<br>';
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
            $employee_fullname .= strtoupper($row_employees['lastname'] . ', ' . $row_employees['firstname'] . $middlename_view) . '<br>';
        }
    }
}
?>
<br>
<center>
    <?php
//    if (@$_GET['head'] == 1) {
    echo '<table width="100%">
                        <tr>
                            <td><center><h4>Incident / Accident Form</h4></center></td>
                        </tr>
                </table>';
//    }
//    
    ?>

    <br>
    <table width="70%">
        <tr>
            <td><span class="txt">Date:</span> <?php echo date('Y/m/d'); ?></td>
        </tr>
        <tr>
            <td><span class="txt">Branch:</span> <?php echo $row_branch['branch_name']; ?></td>
        </tr>
        <tr>
            <td><span class="txt">Category:</span> <?php echo ucwords($row_ia['category']); ?></td>
        </tr>
        <?php
        if ($row_ia['category'] == 'for billing') {
            echo '<tr>
                                <td><span class="txt">Status:</span>' . ucwords($row_ia['status']) . '</td>
                            </tr>';
        }
        ?>
        <?php
        if ($row_ia['cost'] > 0) {
            echo '<tr>
                                <td><span class="txt">Cost:</span>Php' . number_format($row_ia['cost'], 2) . '</td>
                            </tr>';
        }
        ?>
        <tr>
            <td class="txt"><br/><br/><br/>Brief description of the incident:</td>
        </tr>
        <tr>
            <td class="txt_val"><?php echo $row_ia['description']; ?></td>
        </tr>
        <tr>
            <td class="txt"><br/>What happened?</td>
        </tr>
        <tr>
            <td class="txt_val"><?php echo $row_ia['what_happened']; ?></td>
        </tr>
        <tr>
            <td class="txt"><br/>When did it happen? (Indicate date and time):</td>
        </tr>
        <tr>
            <td class="txt_val"><?php echo date('Y/m/d h:i A', strtotime($row_ia['date_happened'])); ?></td>
        </tr>
        <tr>
            <td class="txt"><br/>Where did it happen? (Indicate the specific place of the incident)</td>
        </tr>
        <tr>
            <td class="txt_val"><?php echo $row_ia['where_happened']; ?></td>
        </tr>
        <tr>
            <td class="txt"><br/>Who are the persons involved?</td>
        </tr>
        <tr>
            <td class="txt_val"><?php echo $employee_fullname; ?></td>
        </tr>
        <tr>
            <td><br/><hr></hr></td>
        </tr>
        <tr>
            <td class="txt"><br/>Corrective Action:</td>
        </tr>
        <tr>
            <td class="txt_val"><?php echo $row_ia['corrective_action']; ?></td>
        </tr>
        <tr>
            <td class="txt"><br/>Preventive Action:</td>
        </tr>
        <tr>
            <td class="txt_val"><?php echo $row_ia['preventive_action']; ?></td>
        </tr>
        <tr>
            <td><br/><br/><hr><br/><br/><br/></td>
        </tr>
        <?php
        if ($row_ia['status'] == 'pending to hr' && empty($row_ia['final_category'])) {
            ?>
            <tr class="txt">
                <td>HR Action:</td>
            </tr>
            <form action="" method="post" enctype="multipart/form-data">
                <tr>
                    <td>Category:
                        <select name="final_category" required>
                            <option value="" selected disabled>Please Select</option>
                            <option value="for information">For Information</option>
                            <option value="for delinquency">For Delinquency</option>
                            <option value="for billing">For Billing</option>
                        </select>
                    </td>
                </tr>
                <tr class="cost">
                    <td>Initial Cost:<input type="number" style="height: 28px;" placeholder="optional" name="final_cost"></td>
                </tr>
                <tr class="cost">
                    <td>Remarks:<textarea name="remarks" rows="3" style="width:500px;"></textarea></td>
                </tr>
                <tr class="cost">
                    <td>Attachment PDF (optional): <input type="file" name="upload" accept="application/pdf" title="optional"/></td>
                </tr>
                <tr class="cost">
                    <td><input type="submit" class="btn btn-primary" name="submit"></td>
                </tr>
            </form>
            <?php
        }
        if ($row_ia['final_category'] == 'for billing') {
            ?>
            <tr class="txt">
                <td>HR Action:</td>
            </tr>
            <tr>
                <td class="txt"><br/>Final Category:</td>
            </tr>
            <tr>
                <td class="txt_val"><?php echo ucwords($row_ia['final_category']); ?></td>
            </tr>
            <?php
            if ($row_ia['final_cost'] > 0) {
                ?>
                <tr>
                    <td class="txt"><br/>Final Cost:</td>
                </tr>
                <tr>
                    <td class="txt_val"><?php echo $row_ia['final_cost']; ?></td>
                </tr>
                <?php
            }
            if (!empty($row_ia['hr_remarks'])) {
                echo '<tr>
                    <td class="txt"><br/>Remarks:</td>
                </tr>
                <tr>
                    <td class="txt_val">' . $row_ia['hr_remarks'] . '</td>
                </tr>';
            }
            $hrAtt = explode('-', $row_ia['hr_attachment']);
            if (!empty($hrAtt[1])) {
                ?>
                <td><a href="../../attachment/ia/<?php echo $row_ia['hr_attachment']; ?>" target="_blank">Click here to view the attachment.</a></td>
                <?php
            }
            echo '</tr>';
        if ($row_ia['status'] == 'pending to hr') {
            if ($row_ia['final_category'] == 'for billing') {
                if ($row_ia['final_cost'] > 0 && !empty($row_ia['form'])) {
                    echo '<tr>
                            <td><form method="post" onsubmit="return confirm(\'Do you want to proceed?\')"><input type="submit" name="bClear" value="Mark as Clear" class="btn btn-primary"></form></td>
                        </tr>';
                }
            } else {
                echo '<tr>
                            <td><form method="post" onsubmit="return confirm(\'Do you want to proceed?\')"><input type="submit" name="bClear" value="Mark as Clear" class="btn btn-primary"></form></td>
                        </tr>';
            }
        }
        ?>
        <?php
        if (!empty($row_ia['form']) && $row_ia['final_category'] == 'for billing' && $row_ia['final_cost'] > 0) {
            ?>
            <tr>
                <td><a href="<?php echo '../../attachment/ia/acknowledgment/' . $row_ia['form']; ?>" target="_blank">View Acknowledgment Form. Kindly click here.</a></td>
            </tr>
        <?php }?>
        <tr>
            <td class="txt_val"><center>*** This is report is <?php echo $row_ia['status']; ?> ***</center></td>
        </tr>
        <?php }?>
    </table>
</center>
<br><br>
