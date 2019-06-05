<?php
include("config.php");
include("templates/template.php");
if (isset($_GET['cancel_id'])) {
    mysql_query("UPDATE fund_req SET status='cancelled' WHERE log_id='" . $_GET['cancel_id'] . "'");
    echo "<script>";
    echo "alert('Cancel Successfully...');";
    echo "location.replace('new_fund_requisition.php');";
    echo "</script>";
}
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
            ?> Fund Requests </h2>
        <form action="" method="POST">
            <h5>Search: <select name="status" required="">
                    <option value=''></option>
                    <option value=''>Pending</option>
                    <option value='audited'>Audited</option>
                    <option value='approved'>Approved</option>
                    <option value='disapproved'>Disapproved</option>
                    <option value='cancelled'>Cancelled</option>
                </select>
                <input type="submit" name="submit" value="Submit"></h5>
        </form>

        <a href="new_frm_fund_req.php"> <button>Submit New</button></a>

        <br>
        <br>
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
                $sql = mysql_query("SELECT * FROM fund_req WHERE branch_submitted='" . $_SESSION['branch'] . "' and status='" . $_POST['status'] . "'");
            } else {
                $sql = mysql_query("SELECT * FROM fund_req WHERE branch_submitted='" . $_SESSION['branch'] . "' and status=''");
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
                } else if ($row['status'] == 'disapproved') {
                    echo "<td>" . ucfirst($row['status']) . " by " . ucfirst($row['disapproved_by']) . "</td>";
                } else {
                    echo "<td>" . ucfirst($row['status']) . "</td>";
                }
                echo "<td>";
                echo "<a href='new_view_fund_req.php?fund_req_id=" . $row['log_id'] . "'><button>View</button></a>";
                if ($row['status'] == '') {
                    echo " <a href='new_edit_fund_req.php?check_req_id=" . $row['log_id'] . "'><button>Edit</button></a>";
                    echo " <a href='new_fund_requisition.php?cancel_id=" . $row['log_id'] . "'><button>Cancel</button></a>";
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