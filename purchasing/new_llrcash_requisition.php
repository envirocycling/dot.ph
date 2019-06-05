<?php
include("config.php");
include("templates/template.php");
?>
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
<div class="grid_11">
    <div class="box round first">
        <h2><?php
            if (isset($_POST['submit'])) {
                echo ucfirst($_POST['status']);
            }
            ?> Check Requests </h2>
        <form action="" method="POST">
            <h5>Search: <select name="status" required="">
                    <option value=''></option>
                    <option value='audited2'>Audited</option>
                    <option value='approved'>Approved</option>
                    <option value='processed'>Processed</option>
                    <option value='disapproved'>Disapproved</option>
                </select>
                <input type="submit" name="submit" value="Submit"></h5>
        </form>

        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo "<th>CR #</th>";
            echo "<th>Date Sent</th>";
            echo "<th>Amount</th>";
            echo "<th>Account Name</th>";
            echo "<th>Account No.</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "</thead>";
            if (isset($_POST['submit'])) {
                if ($_POST['status'] == 'processed') {
                    $sql = mysql_query("SELECT * FROM cash_req WHERE approved_by='" . $_SESSION['name'] . "' and deposited_by!=''");
                } else {
                    $sql = mysql_query("SELECT * FROM cash_req WHERE approved_by='" . $_SESSION['name'] . "' and status='" . $_POST['status'] . "' and deposited_by=''");
                }
            } else {
                $sql = mysql_query("SELECT * FROM cash_req WHERE approved_by='" . $_SESSION['name'] . "' and status='audited2'");
            }

            while ($row = mysql_fetch_array($sql)) {
                echo "<tr>";
                echo "<td>" . $row['log_id'] . "</td>";
                echo "<td>" . $row['date_submitted'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "<td>" . $row['payee'] . "</td>";
                echo "<td>" . $row['accnt_no'] . "</td>";
                if ($row['status'] == '') {
                    echo "<td>Pending</td>";
                } else if ($row['status'] == 'audited') {
                    echo "<td>Already audited by 1st auditor</td>";
                } else if ($row['status'] == 'audited2') {
                    echo "<td>Audited</td>";
                } else if ($row['status'] == 'disapproved') {
                    echo "<td>" . ucfirst($row['status']) . " by " . ucfirst($row['disapproved_by']) . "</td>";
                } else if ($row['status'] != '' && $row['deposited_by'] != '') {
                    echo "<td>Processed</td>";
                } else {
                    echo "<td>" . ucfirst($row['status']) . "</td>";
                }
                echo "<td>";

                echo "<a href='new_view_cash_req.php?cash_req_id=" . $row['log_id'] . "'><button>View</button></a>";

                if ($row['status'] == 'audited2') {
                    echo " <a href='new_audit_cash_req.php?id=" . $row['log_id'] . "&type=approver'><button onclick=\"return confirm('Are you sure you approve this request? once you click [OK] you cant undo your action.')\">Approve</button></a>";
                    echo " <a href='new_audit_discashreq.php?disapprove_id=" . $row['log_id'] . "'><button onclick=\"return confirm('Are you sure you disapprove this request? once you click [OK] you cant undo your action.')\">Disapprove</button></a>";
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