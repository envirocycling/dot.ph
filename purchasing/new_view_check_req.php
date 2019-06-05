<?php
session_start();
$id = $_GET['check_req_id'];
include("config.php");
$query = mysql_query("SELECT * from check_req where log_id=$id;");
$row = mysql_fetch_array($query);
?>
<style>
    center input{
        border-style:hidden;
        border-bottom:solid;
        border-width:1px;
    }
    textarea {
        overflow: hidden;
    }
    center{
        border-style:dashed;
        width:600px;
    }
    #comments{
        position:absolute;
        margin-left:560px;
        margin-top: -500px;
    }
</style>
<style type="text/css" media="print">
    .noprint{
        display:none;
    }
</style>
<input type="button" class="noprint" onclick="window.print()" value="Print" />
<center>
    <img src="logo.png"><br>
    <?php

    // conversion

    function convertNumber($number) {
        list($integer, $fraction) = explode(".", (string) $number);

        $output = "";

        if ($integer{0} == "-") {
            $output = "negative ";
            $integer = ltrim($integer, "-");
        } else if ($integer{0} == "+") {
            $output = "positive ";
            $integer = ltrim($integer, "+");
        }

        if ($integer{0} == "0") {
            $output .= "zero";
        } else {
            $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
            $group = rtrim(chunk_split($integer, 3, " "), " ");
            $groups = explode(" ", $group);

            $groups2 = array();
            foreach ($groups as $g) {
                $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});
            }

            for ($z = 0; $z < count($groups2); $z++) {
                if ($groups2[$z] != "") {
                    $output .= $groups2[$z] . convertGroup(11 - $z) . (
                            $z < 11 && !array_search('', array_slice($groups2, $z + 1, -1)) && $groups2[11] != '' && $groups[11]{0} == '0' ? " " : ", "
                            );
                }
            }

            $output = rtrim($output, ", ");
        }

//        if ($fraction > 0) {
//            $output .= " point";
//            for ($i = 0; $i < strlen($fraction); $i++) {
//                $output .= " " . convertDigit($fraction{$i});
//            }
//        }

        return $output;
    }

    function convertGroup($index) {
        switch ($index) {
            case 11:
                return " decillion";
            case 10:
                return " nonillion";
            case 9:
                return " octillion";
            case 8:
                return " septillion";
            case 7:
                return " sextillion";
            case 6:
                return " quintrillion";
            case 5:
                return " quadrillion";
            case 4:
                return " trillion";
            case 3:
                return " billion";
            case 2:
                return " million";
            case 1:
                return " thousand";
            case 0:
                return "";
        }
    }

    function convertThreeDigit($digit1, $digit2, $digit3) {
        $buffer = "";

        if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0") {
            return "";
        }

        if ($digit1 != "0") {
            $buffer .= convertDigit($digit1) . " hundred";
            if ($digit2 != "0" || $digit3 != "0") {
                $buffer .= " ";
            }
        }

        if ($digit2 != "0") {
            $buffer .= convertTwoDigit($digit2, $digit3);
        } else if ($digit3 != "0") {
            $buffer .= convertDigit($digit3);
        }

        return $buffer;
    }

    function convertTwoDigit($digit1, $digit2) {
        if ($digit2 == "0") {
            switch ($digit1) {
                case "1":
                    return "ten";
                case "2":
                    return "twenty";
                case "3":
                    return "thirty";
                case "4":
                    return "forty";
                case "5":
                    return "fifty";
                case "6":
                    return "sixty";
                case "7":
                    return "seventy";
                case "8":
                    return "eighty";
                case "9":
                    return "ninety";
            }
        } else if ($digit1 == "1") {
            switch ($digit2) {
                case "1":
                    return "eleven";
                case "2":
                    return "twelve";
                case "3":
                    return "thirteen";
                case "4":
                    return "fourteen";
                case "5":
                    return "fifteen";
                case "6":
                    return "sixteen";
                case "7":
                    return "seventeen";
                case "8":
                    return "eighteen";
                case "9":
                    return "nineteen";
            }
        } else {
            $temp = convertDigit($digit2);
            switch ($digit1) {
                case "2":
                    return "twenty-$temp";
                case "3":
                    return "thirty-$temp";
                case "4":
                    return "forty-$temp";
                case "5":
                    return "fifty-$temp";
                case "6":
                    return "sixty-$temp";
                case "7":
                    return "seventy-$temp";
                case "8":
                    return "eighty-$temp";
                case "9":
                    return "ninety-$temp";
            }
        }
    }

    function convertDigit($digit) {
        switch ($digit) {
            case "0":
                return "zero";
            case "1":
                return "one";
            case "2":
                return "two";
            case "3":
                return "three";
            case "4":
                return "four";
            case "5":
                return "five";
            case "6":
                return "six";
            case "7":
                return "seven";
            case "8":
                return "eight";
            case "9":
                return "nine";
        }
    }

    $num = round($row['amount'], 2);
    $paymentsss = $row['amount'];
    $check = preg_split("/[.]/", $num);

    $amount = strtoupper(convertNumber($paymentsss));
    if (empty($check[1])) {
        $cents = " and 00/100 only";
        $amount .=strtoupper($cents);
    } else {
        if (strlen($check[1]) == 1) {
            $cents = " and $check[1]0/100 only";
        } else {
            $cents = " and $check[1]/100 only";
        }
        $amount .=strtoupper($cents);
    }

    if ($row['branch_submitted'] == 'Pampanga' || $row['branch_submitted'] == 'Sauyo' || $row['branch_submitted'] == 'Urdaneta') {
        echo '<h5 id="letter_head"><i>ENVIROCYCLING FIBER INC.<br>';
    } else if ($row['branch_submitted'] == 'Calamba' || $row['branch_submitted'] == 'Mangaldan') {
        echo '<h5 id="letter_head"><i>SOUTHZONE PAPER COLLECTION INC.<br>';
    } else if ($row['branch_submitted'] == 'Makati' || $row['branch_submitted'] == 'Pasay' || $row['branch_submitted'] == 'Cainta') {
        echo '<h5 id="letter_head"><i>PASAY FIBER RECOVERY CORP.<br>';
    } else if ($row['branch_submitted'] == 'Kaybiga') {
        echo '<h5 id="letter_head"><i>NOVA FIBER RECOVERY CORP.<br>';
    } else if ($row['branch_submitted'] == 'Cavite') {
        echo '<h5 id="letter_head"><i>DASMARINAS FIBER COLLECTION INC.<br>';
    } else {
        echo '<h5 id="letter_head"><i>ENVIROCYCLING FIBER INC.<br>';
    }
    ?>
    <!--  Ninoy Aquino Hi-way, Mabalacat, Pampanga</i></h5><div id='asterisk1'>***************************</div> -->
    <h3>
        Payment Requisition
        <hr>
        <table>
            <tr>
                <td>Payee Name:</td><td><input type="text" value="<?php echo $row['payee_name']; ?>" name="payee" readonly></td>
                <td>Date Submitted:</td><td><input type="text" value="<?php echo $row['date_submitted']; ?>" name="date_submitted" readonly></td>
            </tr>
            <tr>
                <td>Mode of Payment.:</td><td><input type="text" value="<?php echo $row['mode_of_payment']; ?>" name="accnt_no" readonly></td>
                <td>Date of Check:</td>  <td><input type='text'  id='inputField2' name='date_of_check' value="<?php echo $row['date_of_check']; ?>" onfocus='date1(this.id);'  readonly></td>
            </tr>
            <tr>
                <td>Amount:</td><td><input type="text" value="<?php echo number_format($row['amount'],2); ?>" name="amount" readonly></td>
                <td>3rd Party Ref.No:</td><td><input type="text" value="<?php echo strtoupper($row['ref_no']); ?>" name="amount" readonly></td>
            </tr>
            <tr>
                <td>Amount in words:</td>
                <td colspan="3" style="border-bottom:solid black;border-bottom-width: 1px;"><?php echo $amount;?></td>
            </tr>
<!--            <tr>
                <td>Amount:</td>
                <td colspan="2"><center><input type="text" id="amountInWords"></center></td>
            </tr>-->
        </table>
        Breakdown:<br>
        <textarea cols="60" rows="10" name="breakdown" readonly><?php echo $row['breakdown']; ?></textarea><br>
        Bank Details:<br>
        Bank: <input type="text" value="<?php echo $row['bank']; ?>" name="prepared_by" size="25" readonly><br>
        Account Name: <input type="text" value="<?php echo $row['payee']; ?>" name="payee" size="25" readonly><br>
        Account No: <input type="text"value="<?php echo $row['accnt_no']; ?>" name="accnt_no" size="25" readonly><br><hr></hr>
        Prepared By: <input type="text" value="<?php echo $row['prepared_by']; ?>" name="prepared_by" size="25" readonly><br>
        <?php
        if (trim($row['audited_signature']) != '') {
            echo "<img src='signatures/" . $row['audited_signature'] . ".jpg'  width=200 height=80><br>";
        }
        ?>
        Approved By: <input type="text" value="<?php echo $row['audited_by']; ?>" name="audited_by" readonly><br>
        <?php
        if (trim($row['approved_signature']) != '') {
            echo "<img src='signatures/" . $row['approved_signature'] . ".jpg'  width=200 height=80><br>";
        }
        ?>
        <!--Approved By: <input type="text" value="<?php echo $row['approved_by']; ?>" name="approved_by" readonly><br>-->
        <?php
//        if (trim($row['audited_by']) == $_SESSION['name']) {
//            if ($row['status'] == '') {
//                echo "<br>";
//                echo "<a class='noprint' href='new_audit_check_req.php?id=" . $row['log_id'] . "&type=auditor'><button onclick=\"return confirm('Are you sure you approve this request? once you click [OK] you cant undo your action.')\">Approve</button></a>";
//                echo " <a href='new_audit_discheckreq.php?disapprove_id=" . $row['log_id'] . "'><button onclick=\"return confirm('Are you sure you disapprove this request? once you click [OK] you cant undo your action.')\">Disapprove</button></a>";
//                echo "<br><br>";
//            }
//        }
        ?>
        <?php
        if (trim($row['approved_by']) == $_SESSION['name']) {
            if ($row['status'] == 'audited') {
                echo "<br>";
                echo " <a class='noprint' href='new_audit_check_req.php?id=" . $row['log_id'] . "&type=approver'><button onclick=\"return confirm('Are you sure you approve this request? once you click [OK] you cant undo your action.')\">Approve</button></a>";
                echo " <a href='new_audit_discheckreq.php?disapprove_id=" . $row['log_id'] . "'><button onclick=\"return confirm('Are you sure you disapprove this request? once you click [OK] you cant undo your action.')\">Disapprove</button></a>";
                echo "<br><br>";
            }
        }
        ?>

        <input type="hidden" value="<?php echo $row['submitted_by']; ?>" name="submitted_by">
        <A HREF="javascript:void(0)" onclick="window.open('<?php echo $row['attachment']; ?>', 'Quotation', 'width=500,height=500')">
            <?php
            if ($row['attachment'] != 'attachments/' && $row['attachment'] != '') {
                echo '<button class="noprint" >View Attachment 1</button></a>';
            } else {
                echo '<button disabled class="noprint" >View Attachment 1</button></a>';
            }
            ?>
            <br>
            <A HREF="javascript:void(0)" onclick="window.open('<?php echo $row['attachment2']; ?>', 'Quotation', 'width=500,height=500')">
                <?php
                if ($row['attachment'] != 'attachments/' && $row['attachment2'] != '') {
                    echo '<button class="noprint" >View Attachment 2</button></a>';
                } else {
                    echo '<button disabled class="noprint" >View Attachment 2</button></a>';
                }
                ?>
                <br>
                <A HREF="javascript:void(0)" onclick="window.open('<?php echo $row['attachment3']; ?>', 'Quotation', 'width=500,height=500')">
                    <?php
                    if ($row['attachment'] != 'attachments/' && $row['attachment3'] != '') {
                        echo '<button class="noprint" >View Attachment 3</button></a>';
                    } else {
                        echo '<button disabled class="noprint" >View Attachment 3</button></a>';
                    }
                    ?>
                    </h3>
                    </center>

                    <span id="comments">
                        <?php
                        echo '<iframe src="commentutil_check_req/demo.php?request_id=' . $id . '" height="100%" width="600" frameBorder="0"></iframe>';
                        ?>
                    </span>
