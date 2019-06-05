<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/del_form.css">
<script type="text/javascript" src="validation/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('input[type="file"]').change(function () {
            var upload_root = this.value;
            var upload_type = upload_root.slice(-3);
            var to_lower = upload_type.toLowerCase();
            if (to_lower != 'pdf') {
                alert("Invalid file type. Please choose PDF only.");
                $(this).val('');
            }
        });
    });
</script>
<?php
include("../../connect.php");

$sql_nte = mysql_query("SELECT * from nte WHERE nte_id = '" . $_GET['nte_id'] . "'") or die(mysql_error());
$row_nte = mysql_fetch_array($sql_nte);

if (isset($_POST['submit'])) {
    $target_dir = "../../attachment/nte/";
    $new_filename = $_GET['nte_id'].'-'. basename($_FILES["upload"]["name"]);

    if (!empty($row_nte['attachment'])) {
        $unlink = $target_dir . $row_nte['attachment'];
        if (unlink($unlink)) {
            if (move_uploaded_file(@$_FILES["upload"]["tmp_name"], $target_dir . $new_filename)) {
                mysql_query("UPDATE nte SET attachment='$new_filename' WHERE nte_id = '" . $_GET['nte_id'] . "' ");
                echo '<script>
            window.top.location.href="view_nte.php?status=active&active=view&http=201";
    </script>';
            } else {
                echo '<script>
            window.top.location.href="view_nte.php?status=active&active=view&http=400";
    </script>';
            }
        } else {
            echo '<script>
            window.top.location.href="view_nte.php?status=active&active=view&http=400";
    </script>';
        }
    } else {
        if (move_uploaded_file(@$_FILES["upload"]["tmp_name"], $target_dir . $new_filename)) {
            mysql_query("UPDATE nte SET attachment='$new_filename' WHERE nte_id = '" . $_GET['nte_id'] . "' ");
            echo '<script>
            window.top.location.href="view_nte.php?status=active&active=view&http=201";
    </script>';
        } else {
            echo '<script>
            window.top.location.href="view_nte.php?status=active&active=view&http=400";
    </script>';
        }
    }
}


$sql_del = mysql_query("SELECT * from delinquency WHERE nte='" . $row_nte['nte_id'] . "'");
$row_del = mysql_fetch_array($sql_del);

$sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_nte['emp_num'] . "'") or die(mysql_error());
if (mysql_num_rows($sql_emp) == 0) {
    $sql_emp = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '" . $row_nte['emp_num'] . "'") or die(mysql_error());
}
$row_emp = mysql_fetch_array($sql_emp);
$chk_count = strlen($row_emp['middlename']);
if ($chk_count > 1) {
    $str_counted = strlen($row_emp['middlename']) - 1;
    $middle = ', ' . substr($row_emp['middlename'], 0, -$str_counted) . '.';
} else {
    $middle = ', ' . $row_emp['middlename'] . '.';
}
$employee_fullname = ucwords($row_emp['lastname'] . ', ' . $row_emp['firstname'] . $middle);


$sql_sup = mysql_query("SELECT * from employees WHERE emp_num = '" . $row_nte['supervisor_num'] . "'") or die(mysql_error());
if (mysql_num_rows($sql_sup) == 0) {
    $sql_sup = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '" . $row_nte['supervisor_num'] . "'") or die(mysql_error());
}
$row_sub = mysql_fetch_array($sql_sup);
$chk_count = strlen($row_sub['middlename']);
if ($chk_count > 1) {
    $str_counted = strlen($row_sub['middlename']) - 1;
    $middle_sub = ', ' . substr($row_sub['middlename'], 0, -$str_counted) . '.';
} else {
    $middle_sub = ', ' . $row_sub['middlename'] . '.';
}
$employee_fullname_sub = ucwords($row_sub['lastname'] . ', ' . $row_sub['firstname'] . $middle_sub);

$sub_pos = mysql_query("SELECT * from positions WHERE p_id = '" . $row_sub['position_id'] . "'") or die(mysql_error());
$row_pos = mysql_fetch_array($sub_pos);

$sql_dep = mysql_query("SELECT * from departments WHERE dep_id = '" . $row_nte['dep_id'] . "'") or die(mysql_error());
$row_dep = mysql_fetch_array($sql_dep);

$emp_position = mysql_query("SELECT * from positions WHERE p_id = '" . $row_nte['position_id'] . "' ") or die(mysql_error());
$row_emp_position = mysql_fetch_array($emp_position);

$emp_branch = mysql_query("SELECT * from branches WHERE branch_id = '" . $row_nte['branch_id'] . "' ") or die(mysql_error());
$row_emp_branch = mysql_fetch_array($emp_branch);

$emp_company = mysql_query("SELECT * from company WHERE company_id = '" . $row_nte['company_id'] . "' ") or die(mysql_error());
$row_emp_company = mysql_fetch_array($emp_company);
?>
<style>
    .txt2{
        text-indent: 70px;
        font-weight: bold;
    }
    .txt{
        font-weight: bold;
        padding-top: 20px;
    }
    .txt3{
        font-weight: bold;
        padding-top: 20px;
        font-size: 12px;
    }
    .txt4{
        font-size: 12px;
        padding-top: 10px;
    }
    .txt5{
        font-size: 16px;
        font-weight: lighter;
        padding-top: 10px;
        text-transform: uppercase;
    }
    .textarea{
        resize: none;
        width: 100%;
    }
    select{
        width: 350px;
    }
    #upload{
        font-size: 16px;
        color: blue;
        font-style: italic;
        font-weight: bold;
    }
    #attached{
        float: left;
        font-size: 18px;
        font-weight: 800;
    }
</style>
<?php
$logo = "../../images/company_logo/" . $row_nte['company_id'] . ".png";
if (file_exists($logo)) {
    $img = '<img src="../../images/company_logo/' . $row_nte['company_id'] . '.png" height="80px" width="80px">';
} else {
    $img = '';
}
?>
<center>
    <table width="85%">
        <tr>
            <td style="color: gray;" colspan="2"><?php echo '<h4><b>' . $img . $row_emp_company['description'] . '</b></h4>'; ?></td>
            <td style="text-align: right; color: gray;"><h3><b>NOTICE TO EXPLAIN</b></h3></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td style="text-align: right; color: gray;"><h4><?php echo date('F d, Y', strtotime($row_nte['date_submitted'])) ?></h4></td>
        </tr>
        <tr>
            <td class="txt" colspan="2">TO:</td>
            <td></td>
        </tr>
        <tr>
            <td class="txt2">EMPLOYEE NAME :</td>
            <td colspan="2" class="txt5"><?php echo $employee_fullname; ?></td>
        </tr>
        <tr>
            <td class="txt2">POSITION :</td>
            <td class="txt5" id="emp_position" colspan="2"><?php echo $row_emp_position['position']; ?></td>
        </tr>
        <tr>
            <td class="txt2">BRANCH :</td>
            <td class="txt5" id="emp_branch" colspan="2"><?php echo $row_emp_branch['branch_name']; ?></td>
        </tr>
        <tr>
            <td class="txt">RE :</td>
            <td colspan="2" class="txt5"><?php echo '<a href="view_emp_delinquency.php?d_id=' . $row_del['d_id'] . '" target="_blank">' . $row_del['violation'] . '</a>'; ?></td>
        </tr>
        <tr>
            <td class="txt">FR :</td>
            <td colspan="2" class="txt5"><?php echo $row_dep['description']; ?></td>
        </tr>
        <tr>
            <td colspan="3"><hr></td>
        </tr>
        <tr>
            <td colspan="3">This office has received information/complaint of your alleged violation of company policy detailed hereunder: </td>
        </tr>
        <tr>
            <td colspan="3"><?php echo '<br/><b><i>' . nl2br(utf8_encode($row_nte['description'])) . '</i></b>'; ?></textarea></td>
        </tr>
        <tr>
            <td colspan="3"><br />In which it is a clear violation of our Company rules on <b>(Violated Company Policies)</b><br /><br />
                Please explain in writing and submit to the undersigned a letter explaining your side <b>within 120 hours</b> upon receipt of this notice. Failure to submit your explanation within the period above means that you waive your right to be heard and the management will decide on your case on the basis of the evidence at hand, and if warranted, impose the appropriate sanction.
                <br /><br /><br /><br />Please be guided accordingly.<br /><br /> <br />
            </td>
        </tr>
        <tr>
            <td colspan="2"><?php echo '<img src="../../images/signature/' . $row_nte['supervisor_num'] . '.png" width="50"><br/><span class="txt3">' . $employee_fullname_sub . '</span><br><span class="txt4">' . $row_pos['position'] . '</span><br /><br /><br /><br />'; ?></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" class="txt4">Received By:</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"><?php echo '<br /><span class="txt3" id="emp_name">' . $employee_fullname . '</span><br><span class="txt4" id="emp_position2">' . $row_emp_position['position'] . '</span><br/><br/><span class="txt4">Date Received: _______________________</span>'; ?></td>
            <td></td>
        </tr>
    </table>
    <div id="attached">
        <?php if(!empty($row_nte['attachment'])){
            $val = 'Replace';
            echo '<br/><br/>Attachment was already uploaded. <a href="../../attachment/nte/'.$row_nte['attachment'].'" target="_blank">Click here to view the attached file/s.</a><br/><br/>';
        }else{
            $val = 'Submit';
        }
        ?>
    </div>
    <div id="upload">
        <form method="post" enctype="multipart/form-data">
            Upload Attachment: <input type="file" name="upload" accept="application/pdf" required>
            <input type="submit" value="<?php echo $val;?>" name="submit" class="btn btn-primary">
        </form>
    </div>
</center>

