<?php
session_start();
$id = $_GET['cash_req_id'];
include("config.php");
$query = mysql_query("SELECT * from cash_req where log_id=$id;");
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
        margin-top: -620px;
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
        Check Requisition
        <hr>
        <table>
            <tr>
                <td>Account Name:</td><td><input type="text" value="<?php echo $row['payee']; ?>" name="payee" readonly></td>
                <td>Date Submitted:</td><td><input type="text" value="<?php echo $row['date_submitted']; ?>" name="date_submitted" readonly></td>
            </tr>
            <tr>
                <td>Account No.:</td><td><input type="text" value="<?php echo $row['accnt_no']; ?>" name="accnt_no" readonly></td>
                <td>Date of Check:</td>  <td><input type='text'  id='inputField2' name='date_of_check' value="<?php echo $row['date_of_check']; ?>" onfocus='date1(this.id);'  readonly></td>
            </tr>
            <tr>
                <td>Amount:</td><td><input type="text" value="<?php echo $row['amount']; ?>" name="amount" readonly></td>
                <td></td>
            </tr>
        </table>
        Breakdown:<br>
        <textarea cols="60" rows="10" name="breakdown" readonly><?php echo $row['breakdown']; ?></textarea><br>
        Prepared By: <input type="text" value="<?php echo $row['prepared_by']; ?>" name="prepared_by" size="25" readonly><br>
        <?php
        if (trim($row['audited_signature']) != '') {
            echo "<img src='signatures/" . $row['audited_signature'] . ".jpg'  width=200 height=80><br>";
        }
        ?>
        Audited By(BH): <input type="text" value="<?php echo $row['audited_by']; ?>" name="audited_by" readonly><br>
        <?php
        if (trim($row['audited_signature2']) != '') {
            echo "<img src='signatures/" . $row['audited_signature2'] . ".jpg'  width=200 height=80><br>";
        }
        ?>
        
        Audited By(Acctg): <input type="text" value="<?php echo $row['audited_by2']; ?>" name="audited_by" readonly><br>
        <?php
        if (trim($row['approved_signature']) != '') {
            echo "<img src='signatures/" . $row['approved_signature'] . ".jpg'  width=200 height=80><br>";
        }
        ?>
        
        Approved By: <input type="text" value="<?php echo $row['approved_by']; ?>" name="approved_by" readonly><br>
        <?php
        if (trim($row['audited_by']) == $_SESSION['name']) {
            if ($row['status'] == '') {
                echo "<br>";
                echo "<a class='noprint' href='new_audit_cash_req.php?id=" . $row['log_id'] . "&type=auditor'><button onclick=\"return confirm('Are you sure you approve this request? once you click [OK] you cant undo your action.')\">Approve</button></a>";
                echo " <a href='new_audit_discashreq.php?disapprove_id=" . $row['log_id'] . "'><button onclick=\"return confirm('Are you sure you disapprove this request? once you click [OK] you cant undo your action.')\">Disapprove</button></a>";
                echo "<br><br>";
            }
        }
        ?>
        
        <?php
        if (trim($row['audited_by2']) == $_SESSION['name']) {
            if ($row['status'] == 'audited') {
                echo "<br>";
                echo "<a class='noprint' href='new_audit_cash_req.php?id=" . $row['log_id'] . "&type=auditor2'><button onclick=\"return confirm('Are you sure you approve this request? once you click [OK] you cant undo your action.')\">Approve</button></a>";
                echo " <a href='new_audit_discashreq.php?disapprove_id=" . $row['log_id'] . "'><button onclick=\"return confirm('Are you sure you disapprove this request? once you click [OK] you cant undo your action.')\">Disapprove</button></a>";
                echo "<br><br>";
            }
        }
        ?>
        
        <?php
        if (trim($row['approved_by']) == $_SESSION['name']) {
            if ($row['status'] == 'audited2') {
                echo "<br>";
                echo " <a class='noprint' href='new_audit_cash_req.php?id=" . $row['log_id'] . "&type=approver'><button onclick=\"return confirm('Are you sure you approve this request? once you click [OK] you cant undo your action.')\">Approve</button></a>";
                echo " <a href='new_audit_discashreq.php?disapprove_id=" . $row['log_id'] . "'><button onclick=\"return confirm('Are you sure you disapprove this request? once you click [OK] you cant undo your action.')\">Disapprove</button></a>";
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
                if ($row['attachment2'] != 'attachments/' && $row['attachment2'] != '') {
                    echo '<button class="noprint" >View Attachment 2</button></a>';
                } else {
                    echo '<button disabled class="noprint" >View Attachment 2</button></a>';
                }
                ?>
                <br>
                <A HREF="javascript:void(0)" onclick="window.open('<?php echo $row['attachment3']; ?>', 'Quotation', 'width=500,height=500')">
                    <?php
                    if ($row['attachment3'] != 'attachments/' && $row['attachment3'] != '') {
                        echo '<button class="noprint" >View Attachment 3</button></a>';
                    } else {
                        echo '<button disabled class="noprint" >View Attachment 3</button></a>';
                    }
                    ?>
                    </h3>
                    </center>

                    <span id="comments">
                        <?php
                        echo '<iframe src="commentutil_cash_req/demo.php?request_id=' . $id . '" height="100%" width="600" frameBorder="0"></iframe>';
                        ?>
                    </span>
