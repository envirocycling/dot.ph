<?php include("templates/template.php"); ?>
<style>
    table td{
        font-size: 12px;
        border-bottom:solid;
        border-width:1px;
        padding:5px;
    }
    #items{
        color:gray;
        font-size:8px;
    }
</style>
<?php include("config.php"); ?>
<div class="grid_10">
    <div class="box round first">
        <h2>Fund Requests </h2>
        <?php if ($_SESSION['authority'] == 'signatory') { ?>
            <form action="filter_fund_req.php" method="POST">
                <select name='type' onchange='this.form.submit()'>

                    <?php
                    if ($_SESSION['fund_req_type'] == 'all_me') {
                        echo "<option value='all_me'>All My Pending</option>";
                    } else if ($_SESSION['fund_req_type'] == 'to_be_audited') {
                        echo "<option value='to_be_audited'>To be Audited By Me</option>";
                    } else if ($_SESSION['fund_req_type'] == 'to_be_approved') {
                        echo "<option value='to_be_approved'>To be Approved By Me</option>";
                    } else if ($_SESSION['fund_req_type'] == 'audited') {
                        echo "<option value='audited'>Already Audited By Me</option>";
                    } else if ($_SESSION['fund_req_type'] == 'approved') {
                        echo "<option value='approved'>Already Approved By Me</option>";
                    } else if ($_SESSION['fund_req_type'] == 'disapproved') {
                        echo "<option value='approved'>Already Approved By Me</option>";
                    }
                    ?>

                    <option value="all_me">All My Pending</option>
                    <option value="to_be_audited">To be Audited By Me</option>
                    <option value="to_be_approved">To be Approved By Me</option>
                    <option value="audited">Already Audited By Me</option>
                    <option value="approved">Already Approved By Me</option>
                    <option value="disapproved">Already Disapproved By Me</option>
                </select>
            </form>
        <?php } else { ?>
            <form action="admin_filter_fund_req.php" method="POST">
                <select name='status' onchange='this.form.submit()'>

                    <?php echo "<option value='" . $_SESSION['fund_req_status'] . "'>" . $_SESSION['fund_req_status'] . "</option>" ?>
                    <option value="all">all</option>
                    <option value="pending">pending</option>
                    <option value="audited">audited</option>
                    <option value="approved">approved</option>
                    <option value="completed">completed</option>
                    <option value="disapproved">disapproved</option>
                </select>
            </form>
        <?php } ?>
        <table class="data display datatable" id="example">
            <?php
            if ($_SESSION['authority'] != 'signatory') {
                ?>
                <a href="frm_fund_req.php"> <button>Submit New</button></a><br>
                <?php
            }
            $branch = $_SESSION['branch'];
            include("config.php");

            if ($_SESSION['username'] == 'lonlon') {
                if ($_SESSION['fund_req_status'] == 'pending') {
                    $query = "SELECT * FROM fund_req where audited_signature='' and approved_signature='' and status!='disapproved'";
                } else if ($_SESSION['fund_req_status'] == 'audited') {
                    $query = "SELECT * FROM fund_req where audited_signature!='' and approved_signature='' and status!='disapproved'";
                } else if ($_SESSION['fund_req_status'] == 'approved') {
                    $query = "SELECT * FROM fund_req where audited_signature='' and approved_signature!='' and status!='disapproved'";
                } else if ($_SESSION['fund_req_status'] == 'completed') {
                    $query = "SELECT * FROM fund_req where audited_signature!='' and approved_signature!='' and status!='disapproved'";
                } else if ($_SESSION['fund_req_status'] == 'all') {
                    $query = "SELECT * FROM fund_req ";
                } else if ($_SESSION['fund_req_status'] == 'disapproved') {
                    $query = "SELECT * FROM fund_req WHERE status='disapproved'";
                }
            } else {
                if ($_SESSION['authority'] == 'signatory') {
                    if ($_SESSION['fund_req_type'] == 'all_me') {
                        $query = "SELECT * FROM fund_req where ((audited_by='" . $_SESSION['name'] . "' and audited_signature='' ) or (approved_by='" . $_SESSION['name'] . "' and approved_signature='')) and status!='disapproved'";
                    } else if ($_SESSION['fund_req_type'] == 'to_be_audited') {
                        $query = "SELECT * FROM fund_req where (audited_by='" . $_SESSION['name'] . "' and audited_signature='' ) and status!='disapproved'";
                    } else if ($_SESSION['fund_req_type'] == 'to_be_approved') {
                        $query = "SELECT * FROM fund_req where (approved_by='" . $_SESSION['name'] . "' and approved_signature='' ) and status!='disapproved'";
                    } else if ($_SESSION['fund_req_type'] == 'approved') {
                        $query = "SELECT * FROM fund_req where (approved_by='" . $_SESSION['name'] . "' and approved_signature!='' ) and status!='disapproved'";
                    } else if ($_SESSION['fund_req_type'] == 'audited') {
                        $query = "SELECT * FROM fund_req where (audited_by='" . $_SESSION['name'] . "' and audited_signature!='' ) and status!='disapproved' ";
                    } else if ($_SESSION['fund_req_type'] == 'disapproved') {
                        $query = "SELECT * FROM fund_req where audited_by='" . $_SESSION['name'] . "' and status='disapproved' ";
                    }
                } else {
                    if ($_SESSION['fund_req_status'] == 'pending') {
                        $query = "SELECT * FROM fund_req where branch_submitted='" . $_SESSION['branch'] . "' and audited_signature='' and approved_signature='' and status!='disapproved'";
                    } else if ($_SESSION['fund_req_status'] == 'audited') {
                        $query = "SELECT * FROM fund_req where branch_submitted='" . $_SESSION['branch'] . "'  and audited_signature!='' and approved_signature='' and status!='disapproved'";
                    } else if ($_SESSION['fund_req_status'] == 'approved') {
                        $query = "SELECT * FROM fund_req where branch_submitted='" . $_SESSION['branch'] . "'  and audited_signature='' and approved_signature!='' and status!='disapproved'";
                    } else if ($_SESSION['fund_req_status'] == 'completed') {
                        $query = "SELECT * FROM fund_req where branch_submitted='" . $_SESSION['branch'] . "'  and audited_signature!='' and approved_signature!='' and status!='disapproved'";
                    } else if ($_SESSION['fund_req_status'] == 'disapproved') {
                        $query = "SELECT * FROM fund_req where branch_submitted='" . $_SESSION['branch'] . "' and status='disapproved'";
                    } else if ($_SESSION['fund_req_status'] == 'all') {
                        $query = "SELECT * FROM fund_req where branch_submitted='" . $_SESSION['branch'] . "'";
                    }
                }
            }
            $result = mysql_query($query);
            echo "<thead>";
            echo "<th>CR #</th>";
            echo "<th>Date Sent</th>";
            echo "<th>Amount</th>";
            echo "<th>Payee</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "</thead>";
            while ($row = mysql_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['log_id'] . "</td>";
                echo "<td>" . $row['date_submitted'] . "</td>";
                if ($row['amount'] == '') {
                    echo "<td>0</td>";
                } else {
                    echo "<td>Php " . number_format($row['amount'], 2) . "</td>";
                }
                echo "<td>" . $row['payee'] . "</td>";
                if ($row['status'] == '') {
                    echo "<td>Pending</td>";
                } else if ($row['status'] == 'audited') {
                    echo "<td>Audited by: <u>" . $row['audited_by'] . "</u></td>";
                } else {
                    echo "<td>" . $row['status'] . "</td>";
                }
                echo "<td><a href='view_fund_req.php?check_req_id=" . $row['log_id'] . "'><button>View</button></a>";
                if ($row['audited_signature'] == '' && $_SESSION['authority'] == 'signatory' && $row['status'] != 'disapproved') {
                    echo " <a href='reject_fund_req.php?rej_req_id=" . $row['log_id'] . "'><button>Disapprove</button>";
                }
                if ($row['submitted_by'] == $_SESSION['username']) {
                    if ($row['status'] == '') {
                        echo " <a href='edit_fund_req.php?check_req_id=" . $row['log_id'] . "'><button>Edit</button>";
                    }
                    if ($row['status'] == '') {
                        echo " <a href='delete_fund_req.php?reject_fund_req=" . $row['log_id'] . "'><button>Delete</button></a>";
                    }
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>

        </table>

    </div>
</div>


<div class="clear">
</div>