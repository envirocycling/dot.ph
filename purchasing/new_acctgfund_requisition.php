<?php
include("config.php");
include("templates/template.php");
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
    #inputField2{
        height: 19px;
        width: 100px;
    }
</style>
<?php include("config.php"); ?>
<div class="grid_11">
    <div class="box round first">
        <h2><?php
            if (isset($_POST['submit'])) {
                echo ucfirst($_POST['status']);
            }
            ?> Fund Requests </h2>



        <?php
        if ($_SESSION['username'] == 'afr' || $_SESSION['username'] == 'AFR') {
            echo "<form action='' method='POST'>";
            echo "<h5>Search: </h5>";
            echo "Date :<input type='text' id='inputField2' value='" . date('Y/m/d') . "' name='date' onfocus='date1(this.id);' readonly> ";
            echo "Type: <select name='status' required>
                    <option value=''></option>
                    <option value='audited'>Audited</option>
                    <option value='approved'>Approved</option>
                    <option value='disapproved'>Disapproved</option>
                    <option value='cancelled'>Cancelled</option>
                </select>
                <input type='submit' name='submit' value='Submit'>
        </form>";
            echo '<table class="data display datatable" id="example">';
            echo "<thead>";
            echo "<th>CR #</th>";
            echo "<th>Date Sent</th>";
            echo "<th>Branch</th>";
            echo "<th>Amount</th>";
            echo "<th>Account Name</th>";
            echo "<th>Account No.</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "</thead>";
            if (isset($_POST['submit'])) {
                if ($_POST['status'] == 'approved') {
                    $sql = mysql_query("SELECT * FROM fund_req WHERE date_submitted='" . $_POST['date'] . "' and status='" . $_POST['status'] . "'");
                } else {
                    $sql = mysql_query("SELECT * FROM fund_req WHERE date_submitted='" . $_POST['date'] . "' and status='" . $_POST['status'] . "'");
                }
            } else {
                $sql = mysql_query("SELECT * FROM fund_req WHERE  status='audited'");
            }


            while ($row = mysql_fetch_array($sql)) {
                echo "<tr>";
                echo "<td>" . $row['log_id'] . "</td>";
                echo "<td>" . $row['date_submitted'] . "</td>";
                echo "<td>" . $row['branch_submitted'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "<td>" . $row['payee'] . "</td>";
                echo "<td>" . $row['accnt_no'] . "</td>";
                if ($row['status'] == '') {
                    echo "<td>Pending</td>";
                } else if ($row['status'] == 'disapproved') {
                    echo "<td>" . ucfirst($row['status']) . " by " . ucfirst($row['disapproved_by']) . "</td>";
                } else {
                    echo "<td>" . ucfirst($row['status']) . "</td>";
                }
                echo "<td>";

                echo "<a href='new_view_fund_req.php?fund_req_id=" . $row['log_id'] . "'><button>View</button></a>";

                if ($row['status'] == 'audited') {
                    echo " <a href='new_audit_fund_req.php?id=" . $row['log_id'] . "&type=approver'><button onclick=\"return confirm('Are you sure you approve this request? once you click [OK] you cant undo your action.')\">Approve</button></a>";
                    echo " <a href='new_audit_disfundreq.php?disapprove_id=" . $row['log_id'] . "'><button onclick=\"return confirm('Are you sure you disapprove this request? once you click [OK] you cant undo your action.')\">Disapprove</button></a>";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<form action='' method='POST'>
            <h5>Search: <select name='status' required>
                    <option value=''></option>
                    <option value='audited'>Audited</option>
                    <option value='approved'>Approved</option>
                    <option value='disapproved'>Disapproved</option>
                    <option value='cancelled'>Cancelled</option>
                </select>
                <input type='submit' name='submit' value='Submit'></h5>
        </form>";
            echo '<table class="data display datatable" id="example">';
            echo "<thead>";
            echo "<th>CR #</th>";
            echo "<th>Date Sent</th>";
            echo "<th>Branch</th>";
            echo "<th>Amount</th>";
            echo "<th>Account Name</th>";
            echo "<th>Account No.</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "</thead>";
            if (isset($_POST['submit'])) {
                if ($_POST['status'] == 'approved') {
                    $sql = mysql_query("SELECT * FROM fund_req WHERE status='" . $_POST['status'] . "'");
                } else {
                    $sql = mysql_query("SELECT * FROM fund_req WHERE approved_by='" . $_SESSION['name'] . "' and status='" . $_POST['status'] . "'");
                }
            } else {
                $sql = mysql_query("SELECT * FROM fund_req WHERE approved_by='" . $_SESSION['name'] . "' and status='audited'");
            }


            while ($row = mysql_fetch_array($sql)) {
                echo "<tr>";
                echo "<td>" . $row['log_id'] . "</td>";
                echo "<td>" . $row['date_submitted'] . "</td>";
                echo "<td>" . $row['branch_submitted'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "<td>" . $row['payee'] . "</td>";
                echo "<td>" . $row['accnt_no'] . "</td>";
                if ($row['status'] == '') {
                    echo "<td>Pending</td>";
                } else if ($row['status'] == 'disapproved') {
                    echo "<td>" . ucfirst($row['status']) . " by " . ucfirst($row['disapproved_by']) . "</td>";
                } else {
                    echo "<td>" . ucfirst($row['status']) . "</td>";
                }
                echo "<td>";

                echo "<a href='new_view_fund_req.php?fund_req_id=" . $row['log_id'] . "'><button>View</button></a>";

                if ($row['status'] == 'audited') {
                    echo " <a href='new_audit_fund_req.php?id=" . $row['log_id'] . "&type=approver'><button onclick=\"return confirm('Are you sure you approve this request? once you click [OK] you cant undo your action.')\">Approve</button></a>";
                    echo " <a href='new_audit_disfundreq.php?disapprove_id=" . $row['log_id'] . "'><button onclick=\"return confirm('Are you sure you disapprove this request? once you click [OK] you cant undo your action.')\">Disapprove</button></a>";
                }
                echo "</td>";
                echo "</tr>";
            }
        }
        ?>


        </table>

    </div>
</div>


<div class="clear">
</div>