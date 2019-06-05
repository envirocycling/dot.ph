<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/del_form.css">
<script type="text/javascript" src="validation/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var status = $('[name=spnstatus]').text();
        if (status === 'cleared') {
            $('[name=markAsCleared]').hide();
        }
        $('[name=markAsCleared]').click(function () {
            var report_id = "<?php echo $_GET['report_id']; ?>";
            var con = confirm("Do you want to proceed?");
            if (con === true) {
                $.ajax({
                    url: 'process/view_ia_cleared.php?report_id=' + report_id
                }).done(function (response) {
                    window.top.location.href = "view_ia.php?status=active&active=view&http=" + response;
                });
            }
        });
    });
</script>
<style>
    table{
        font-style: italic;
    }
    .txt_val{
        padding-left: 40px;
    }
</style>
<?php
include("../../connect.php");

if (isset($_POST['submitUp'])) {
    $sql_ia = mysql_query("SELECT * from incident_accident  WHERE report_id = '" . $_GET['report_id'] . "'");
    $row_ia = mysql_fetch_array($sql_ia);

    $to = '';
    @$target_dir = "../../attachment/ia/acknowledgment/";
    @$target_file = $target_dir . $_GET['report_id'] . '-' . basename($_FILES["upload"]["name"]);
    if (!file_exists(@$target_file)) {
        move_uploaded_file(@$_FILES["upload"]["tmp_name"], $target_file);
    }

    if (mysql_query("UPDATE incident_accident SET  form='" . $_GET['report_id'] . '-' . basename($_FILES["upload"]["name"]) . "'  WHERE report_id = '" . $_GET['report_id'] . "' ")) {

        echo '<script>
                 window.top.location.href="view_ia.php?status=active&active=view&http=201";
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
                    <td class="txt_val"><?php echo 'Php' . $row_ia['final_cost']; ?></td>
                </tr>
                <?php
            }
            $hrAtt = explode('-', $row_ia['hr_attachment']);
            if (!empty($hrAtt[1])) {
                ?>
                <td><a href="../../attachment/ia/<?php echo $row_ia['hr_attachment']; ?>" target="_blank">Click here to view the attachment.</a></td>
                <?php
            }
            echo '</tr>';
        ?>
        <tr>
            <td class="txt_val"><center><br>
            <?php
            $sql_deduct = mysql_query("SELECT * from forms WHERE status='' and type='deduct'");
            $row_deduct = mysql_fetch_array($sql_deduct);

            if (empty($row_ia['form']) && $row_ia['final_category'] == 'for billing' && $row_ia['final_cost'] > 0) {
                echo '<form method="post" enctype="multipart/form-data">
                                                        Acknowledgment Form: <input type="file" name="upload" accept="application/pdf,image/*" required>&nbsp;<input type="submit" class="btn btn-primary" value="Upload Form" name="submitUp">';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i><a href="../../forms/' . $row_deduct['name'] . '" target="_blank">Download authority to deduct form here</a></i>';
                echo '<br /><br /><i><font color="red">***No uploaded authority to deduct / charge slip***</font></i>';
            }
            ?>

        </center></td>
        </tr>
        <?php
        if (!empty($row_ia['form']) && $row_ia['final_category'] == 'for billing' && $row_ia['final_cost'] > 0) {
            ?>
            <tr>
                <td><a href="<?php echo '../../attachment/ia/acknowledgment/' . $row_ia['form']; ?>" target="_blank">View Acknowledgment Form. Kindly click here.</a></td>
            </tr>
        <?php } ?>
        <tr>
            <td class="txt_val"><center>*** This is report is <?php echo $row_ia['status'];?> ***</center></td>
        </tr>
         <?php } ?>
    </table>
</center>
<br><br>
