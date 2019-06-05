<?php
session_start();
include('config.php');
?>
<link href="css/select2.min.css" rel="stylesheet">
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/select2.min.js"></script>
<style>
    #supp_drop_down{
        width: 100%;
        text-align:center;
        font-size:12px;
    }

</style>
<script>
    $(document).ready(function () {
     
        $('#supp_drop_down').select2();

        var account_name = $('#supp_drop_down').val();
        var account_name2 = $('#payee2').val();

        if (account_name != '') {
            $('#payee2').attr("disabled", true);
            $('#payee3').val(account_name);
        } else if (account_name2 != '') {
            $('#supp_drop_down').attr("disabled", true);
        } else {
            $('#supp_drop_down').attr("disabled", false);
            $('#payee2').attr("disabled", false)
        }

        //check ref_no if already exist    
        $(".ref_no").keyup(function () {
            var ref_no = $('.ref_no').val();
            var myid = $('#my_id').val();
            if (ref_no == "") {
                $("#txt_noti").html("");
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        $("#txt_noti").html(xmlhttp.responseText);
                    }
                };
                xmlhttp.open("GET", "new_check_req_chk.php?q=" + ref_no, true);
                xmlhttp.send();
                $('.ref_no2').val(ref_no);
            }

        });
        //end  ref_no if already exist    

    });

    function alphanum(evt) {
        evt = (evt) ? evt : window.event;
        var code = (evt.which) ? evt.which : evt.keyCode;
        if (!(code > 47 && code < 58) && // numeric (0-9)
                !(code > 64 && code < 91) && // upper alpha (A-Z)
                !(code > 96 && code < 123)) { // lower alpha (a-z)
            return false;
        }
        return true;
    }
</script>

<script type="text/javascript">


    function val() {
        var account_name = $('#supp_drop_down').val();
        var account_name2 = $('#payee2').val();
        var splits = account_name.split("=");
        //alert(splits[1]);
        if (account_name != '') {
            $('#payee2').attr("disabled", true);
            $('#payee3').val(splits[1]);
            $('#acctount_no').val(splits[0]);
            $('#accnt_no3').val(splits[0]);
            $('#payee_new3').val("");
            //document.myForm.submit();
        } else if (account_name2 != '') {
            $('#supp_drop_down').attr("disabled", true);
            $('#payee_new3').val(account_name2);
        } else {
            $('#supp_drop_down').attr("disabled", false);
            $('#payee2').attr("disabled", false)
            //document.myForm.submit();
        }
        if (account_name == '') {
            $('#payee3').val("");
            $('#acctount_no').val("");
            $('#accnt_no3').val("");
            //document.myForm.submit();
        }
    }
    ;






</script>
<style>
    body{
        font-family: Arial;
    }
    input[type="submit"]{
        font-size: 15px;
    }
    input[type="number"]{
        font-size: 15px;
        width:100%;
    }
    input[type="text"]{
        font-size: 15px;
        width:100%;
    }
    select{
        font-size: 15px;
        width:100%;
    }
    textarea{
        font-size: 15px;
        text-align:left;
        width:100%;
    }
    .form{
        font-size: 18px;
    }
    #inputField2{
        text-transform: uppercase;
        width:100%;
    }
</style>

<center>

    <h2>Payment Requisition</h2>
    <hr>
    <table>
        <form action="new_submit_checkreq.php" method="POST" enctype='multipart/form-data'>
            <input type="hidden" id="payee3" name="payee_frm">
            <input type="hidden" id="payee_new3" name="payee_new">
            <input type="hidden" id="accnt_no3" name="accnt_frm">
            <tr class="form">
                <td>Payee Name</td>
                <td><input type="text" value="" name="payeeName" required></td>
            </tr>                   
            <tr class="form">
                <td>Mode of Payment</td>
                <td>
                    <select name="modeOfPayment" required>
                        <?php
                        $sql_mode = mysql_query("SELECT * from mode_of_payment ORDER BY mode Asc");
                        echo '<option value="" selected disabled>Please select</option>';
                        while ($row_mode = mysql_fetch_array($sql_mode)) {
                            echo '<option value="' . $row_mode['mode'] . '">' . $row_mode['mode'] . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>                   
            <tr class="form">
                <td>Date Submitted: </td>
                <td><input type="text" value="<?php echo date('Y/m/d'); ?>" name="date_submitted" readonly></td>
            </tr>
            <tr class="form">
                <td>Amount: </td>
                <td><input type="number" value="" step="any" name="amount" required></td>
            </tr>
            <tr class="form">
                <td colspan="3"><center><i id="amountWords"></i></center><br/></td>
            </tr>
            <tr class="form">
                <td>Date of Check: </td>
                <td><input type='text'  id='inputField2' name='date_of_check' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly></td>
            </tr>
            <tr class="form">
                <td><input type='text' class="ref_no2" id='inputField2' name='ref_no2' hidden required>3rd Party Ref No: </td>
                <td><input type='text' class="ref_no" id='inputField2' name='ref_no' autocomplete="off" onkeypress="return alphanum(event);" required><font size="-1"><i>(e.g. Sales Invoice No.)</i></font></td>
                <td id="txt_noti"></td>
            </tr>
            <tr class="form">
                <td style="vertical-align: top;">Breakdown:</td>
                <td><textarea cols="30" rows="10" name="breakdown" required></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><br /><center><h3>Bank Details  (if any)</h3></center></td>
            </tr>
            <tr class="form">
                <td>Bank: </td>
                <td><input type="text" name="bank"></td>
            </tr>
            <tr>
                <td  class="form">Account Name: </td>
                <td>
                    <!--<form method="post"  name="myForm" >
                    --><select id="supp_drop_down" name="payee" onChange="val();">
                            <?php
                            $sql_acct = mysql_query("SELECT * from sup_bank_accounts") or die(mysql_error());
                            if (!empty($_POST['payee'])) {
                                $payee_split = explode("=", $_POST['payee']);
                                $payee = $payee_split[1];
                                $number = $payee_split[0];
                                echo '<option value="' . $_POST['payee'] . '">' . $payee . '</option>';
                            }
                            echo '<option value="">- Please Select -</option>';
                            while ($row_acct = mysql_fetch_array($sql_acct)) {
                                echo '<option value="' . $row_acct['account_number'] . '=' . $row_acct['account_name'] . '">' . strtoupper($row_acct['account_name']) . '</option>';
                            }
                            ?>

                        </select>
                    <!--</form>-->
    </td>
                <td class="form">If New Account Name: </td>
                <td class="form"><input type="text" value="" style="width:100%;" name="payee2" id="payee2" onKeyUp="val();"></td>
            </tr>
            <tr class="form">
                <td>Account Number: </td>
                <td><input type="text" id="acctount_no" onKeyUp="val2();"></td>
            </tr>
            <tr>
                <td><br /></td>
            </tr>
            <tr class="form">
                <td>Attachment: </td>
                <td><input type="file" name="attachment"></td>
            </tr>
            <tr class="form">
                <td>Attachment2: </td>
                <td><input type="file" name="attachment2"></td>
            </tr>
            <tr class="form">
                <td>Attachment3: </td>
                <td><input type="file" name="attachment3"></td>
            </tr>
            <tr class="form">
                <td>Prepared By: </td>
                <td><input type="text" value="" name="prepared_by"></td>
            </tr>
            <tr class="form">
                <td>Approved By: </td>
                <td>
                    <?php
                    include("config.php");
                    $result = mysql_query("SELECT * FROM users where authority='signatory' and position='BH' ORDER by name");
                    echo "<select name='audited_by' required>";
                    echo "<option value=''>Select </option>";
                    while ($row = mysql_fetch_array($result)) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . " - " . $row['fullname'] . "</option>";
                    }
                    echo "</select>";
                    ?>
                </td>
            </tr>
<!--            <tr class="form">
                <td>Approved By: </td>
                <td>
                    <?php
//                    $result = mysql_query("SELECT * FROM users where authority='signatory' and position='General Manager' ORDER by name");
//
//                    echo "<select name='approved_by' >";
//                    echo "<option value=''>Select </option>";
//                    while ($row = mysql_fetch_array($result)) {
//                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . " - " . $row['fullname'] . "</option>";
//                    }
//                    echo "</select>";
                    ?>
                </td>
            </tr>-->
            <tr class="form">
                <td colspan="2" align="center"><input type="hidden" value="<?php echo $_SESSION['username']; ?>" name="submitted_by">
                    <input type="submit" value="Submit"></td>
            </tr>
    </table>


    <br>
    </form>
</center>
