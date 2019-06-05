<?php
session_start();
$id = $_GET['check_req_id'];
include("config.php");
$query = mysql_query("SELECT * from fund_req where log_id=$id;");
$row = mysql_fetch_array($query);
?>
<style>
    textarea {
        overflow: hidden;
    }
    center{
        border-style:dashed;
        width:900px;
        padding: 30px;
    }
    #title{
        position: absolute;
        margin-top: 0px;
        margin-left: 50px;
    }
    #amount_title{
        position: absolute;
        margin-top: 0px;
        margin-left: 470px;
    }
    textarea{
        border-style:hidden;
    }
    input{
        border-style:hidden;
        text-align: left;
    }
    #comments{
        position:absolute;
        margin-left: 900px;
        margin-top: -600px;
    }
</style>
<style type="text/css" media="print">
    .noprint{
        display:none;
    }
</style>
<a href="printFR.php?fund_req_id=<?php echo $id; ?>"><button>Print</button></a>
<center>
    <table width="800" height="400" border="1" cellpadding="1" cellspacing="0">
        <tr>
            <td height="50" align="center"><b>ENVIROCYCLING FIBER INC <br> CHECK REQUISITION</b></td>
        </tr>
        <tr>
            <td height="90">
                <table width="800" style="padding: 5px;">
                    <tr>
                        <td width="400">PAYEE: <?php echo "<b>" . strtoupper($row['payee']) . "</b>"; ?><br> AMOUNT: <?php echo "<b>Php " . number_format($row['amount'], 2) . "</b>"; ?><br> DATE OF CHECK: <?php echo "<b>" . $row['date_of_check'] . "<b>"; ?></td>
                        <td width="400" style="vertical-align: top;">DATE: <?php echo "<b>" . $row['date_submitted'] . "</b>"; ?></td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>
            <td height="170" style="vertical-align: top; padding: 5px;" align="center">
                <h3 id='title'><i>* * * FUND TRANSFER TO <?php echo strtoupper($row['branch_submitted']); ?> * * *</i></h3> <h5 id='amount_title'><?php echo "Php " . $row['amount']; ?><h5>
                        <br>
                        <br>
                        <br>
                        <textarea cols="60" rows="10" name="breakdown" readonly>
                            <?php echo $row['breakdown']; ?>
                        </textarea><br>
                        </td>
                        </tr>
                        <tr>
                            <td height="100" >
                                <table height="100" width="800" style="padding: 5px;">
                                    <tr>
                                        <td width="266" style="vertical-align: top;">PREPARED BY: <input type="text" value="<?php echo $row['prepared_by']; ?>" name="prepared_by" size="25" readonly><br>
                                            <?php
                                            if (trim($row['prepared_signature']) != '') {
                                                echo "<img id='audited' src='signatures/" . $row['prepared_signature'] . ".jpg'  width=200 height=80><br>";
                                            }
                                            ?>
                                        </td>
                                        <td width="266" style="vertical-align: top;">AUDITED BY:
                                            <br>
                                            <?php
                                            $sql = mysql_query("SELECT * FROM users WHERE name like '%" . $row['audited_by'] . "%'");
                                            $rs = mysql_fetch_array($sql);
                                            echo $rs['fullname'];
                                            ?><br>
                                            <?php
                                            if (trim($row['audited_signature']) != '') {
                                                echo "<img id='audited' src='signatures/" . $row['audited_signature'] . ".jpg'  width=200 height=80><br>";
                                            }
                                            ?>
                                        </td>
                                        <td width="266" style="vertical-align: top;">APPROVED BY: <input type="text" value="<?php echo $row['approved_by']; ?>" name="audited_by" readonly><br>
                                            <?php
                                            if (trim($row['approved_signature']) != '') {
                                                echo "<img id='audited' src='signatures/" . $row['approved_signature'] . ".jpg'  width=200 height=80><br>";
                                            }
                                            ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        </table>
                        <?php
                        if (trim($row['audited_by']) == $_SESSION['name']) {
                            if ($row['audited_signature'] != '') {
                                echo "<a href='mark_as_audited3.php?del_id=" . $row['log_id'] . "'><button>Mark as Unaudited</button></a>";
                            } else {
                                echo "<a href='mark_as_audited3.php?id=" . $row['log_id'] . "'><button>Mark as Audited</button></a>";
                            }
                        }
                        ?>
                        <?php
                        if (trim($row['approved_by']) == $_SESSION['name']) {
                            echo "<a href='mark_as_approved3.php?id=" . $row['log_id'] . "'><button>Mark as Approved</button></a>";
                        }
                        ?>
                        <input type="hidden" value="<?php echo $row['submitted_by']; ?>" name="submitted_by">
                        <A HREF="javascript:void(0)"
                           onclick="window.open('<?php echo $row['attachment']; ?>',
                                           'Quotation', 'width=500,height=500')">
                               <?php
                               if ($row['attachment'] != 'attachments/' && $row['attachment'] != '') {
                                   echo '<button class="noprint" >View Attachment</button></a>';
                               } else {
                                   echo '<button disabled class="noprint" >View Attachment</button></a>';
                               }
                               ?>

                            </h3>
                            </center>
                            <span id="comments">
                                <?php
                                echo '<iframe src="commentutil_fund_req/demo.php?request_id=' . $id . '" height="100%" width="600" frameBorder="0"></iframe>';
                                ?>
                            </span>