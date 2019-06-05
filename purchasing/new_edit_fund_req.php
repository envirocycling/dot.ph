<?php
@session_start();
include("config.php");
$sql = mysql_query("SELECT * FROM fund_req WHERE log_id='" . $_GET['check_req_id'] . "'");
$rs = mysql_fetch_array($sql);
?>
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
</script>
<style>
    body{
        font-family: Arial;
    }
    input{
        font-size: 15px;
    }
    select{
        font-size: 15px;

    }
    textarea{
        font-size: 15px;
        text-align:left;
    }
    .form{
        font-size: 18px;
    }
</style>
<center>
    <form action="new_submit_edit_fundreq.php" method="POST" enctype='multipart/form-data'>
        <h2>Check Requisition</h2>
        <hr>
        <table class="form">
            <tr>
                <td>Account Name: </td>
                <td><input type="hidden" name="log_id" value="<?php echo $_GET['check_req_id']; ?>">
                    <input type="text" value="<?php echo $rs['payee']; ?>" name="payee" required></td>
            </tr>
            <tr>
                <td>Account Number: </td>
                <td><input type="text" value="<?php echo $rs['accnt_no']; ?>" name="accnt_no" required></td>
            </tr>
            <tr>
                <td>Date Submitted: </td>
                <td><input type="text" value="<?php echo date('Y/m/d'); ?>" name="date_submitted" readonly></td>
            </tr>
            <tr>
                <td>Amount: </td>
                <td><input type="text" value="<?php echo $rs['amount']; ?>" name="amount" required></td>
            </tr>
            <tr>
                <td>Date of Check: </td>
                <td><input type='text'  id='inputField2' name='date_of_check' value="<?php echo $rs['date_of_check']; ?>" onfocus='date1(this.id);' readonly></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">Breakdown:</td>
                <td><textarea cols="30" rows="10" name="breakdown" required><?php echo $rs['breakdown']; ?></textarea></td>
            </tr>
            <tr>
                <td>Attachment: </td>
                <td><input type="file" name="attachment"></td>
            </tr>
            <tr>
                <td>Attachment2: </td>
                <td><input type="file" name="attachment2"></td>
            </tr>
            <tr>
                <td>Attachment3: </td>
                <td><input type="file" name="attachment3"></td>
            </tr>
            <tr>
                <td>Prepared By: </td>
                <td><input type="text" value="<?php echo $rs['prepared_by']; ?>" name="prepared_by"></td>
            </tr>
            <tr>
                <td>Audited By: </td>
                <td>
                    <?php
                    include("config.php");
                    $result = mysql_query("SELECT * FROM users where authority='signatory' and position='BH'");
                    echo "<select name='audited_by' required>";
                    echo "<option value='" . $rs['audited_by'] . "'>" . $rs['audited_by'] . "</option>";
                    while ($row = mysql_fetch_array($result)) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . " - " . $row['fullname'] . "</option>";
                    }
                    echo "</select>";
                    ?>
                </td>
            </tr>
            <tr>
                <td>Approved By: </td>
                <td>
                    <?php
                    $result = mysql_query("SELECT * FROM users where authority='signatory' and position='Accounting' ORDER by name");
                    echo "<select name='approved_by' >";
                    echo "<option value='" . $rs['approved_by'] . "'>" . $rs['approved_by'] . "</option>";
                    while ($row = mysql_fetch_array($result)) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . " - " . $row['fullname'] . "</option>";
                    }
                    echo "</select>";
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="hidden" value="<?php echo $_SESSION['username']; ?>" name="submitted_by">
                    <input type="submit" value="Submit"></td>
            </tr>
        </table>


        <br>
    </form>
</center>